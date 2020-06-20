<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Curl\Curl;

class Wallet extends CI_Controller {

    function __construct()
    {
        parent::__construct();
         
        $this->load->helper('string');
        $this->load->library('form_validation');
        
        define('BASE_URL', 'http://localhost/wallet-api/customers/');
        $this->curl=new Curl();
        if(!isset($_SESSION['TOKEN'])){
            $token=NULL;
        }
        else{
            $token=$_SESSION['TOKEN'];
        }
        $this->curl->setHeader('Authorization', $token);
    }


    public function index(){
        $this->load->view('login');
    }


    //PROCESS LOGIN
    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run()){
            $login_data=array(
                'USERNAME'=> $this->input->post('username'),
                'PASSWORD'=> $this->input->post('password')
            );

            $this->curl->post(BASE_URL.'login', array(
                'username'=> $login_data['USERNAME'],
                'password'=> $login_data['PASSWORD'],
            ));
            if($this->curl->error){
                if($this->curl->errorCode==404){
                   $this->session->set_flashdata('error', 'Invalid username or Password');
                   redirect(base_url());
                }
                elseif($this->curl->errorCode==400){
                   $this->session->set_flashdata('error', 'Your account has been deactivated');
                   redirect(base_url());
                }
            }
            else{
                $_SESSION['TOKEN']= $this->curl->response->token;
                redirect(base_url('dashboard'));
            }
        }
        else{
            $error="";

            if(form_error('username')){
                $error.=form_error('username');
            }

            if(form_error('password')){
                $error.=form_error('password');
            }   
        }  
    }

    //LOGOUT 
    public function logout(){
        unset($_SESSION['TOKEN']);
        redirect(base_url());

    }

    //VERIFY USER
    private function verify(){
        if(!isset($_SESSION['TOKEN'])){
             $this->session->set_flashdata('error', 'Please login with your account');
            redirect(base_url());
        }
    }


    //DASHBOARD
    public function dashboard(){
        $this->verify();

        $this->curl->get(BASE_URL.'user');
        if(!$this->curl->error){
            $data['pageTitle']="Dashboard";
            $data['userInfo']=$this->curl->response;
            $data['transactions']=$this->fetch_transactions(5);
            $this->load->view('parts/header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('parts/footer', $data);
        }
        else{
              var_dump($this->curl->errorCode);
              if($this->curl->errorCode==401){
                    $this->session->set_flashdata('error', 'You are not authorized.');
                    redirect(base_url());
              } 
        }
    }


    //PROFILE
    public function profile(){
        $this->verify();
        $this->curl->get(BASE_URL.'user');
        if(!$this->curl->error){
            $data['pageTitle']="Profile";
            $data['userInfo']=$this->curl->response;
            $this->load->view('parts/header', $data);
            $this->load->view('profile', $data);
            $this->load->view('parts/footer', $data);
        }
        else{

            var_dump($this->curl->errorCode);
            if($this->curl->errorCode==401){
                    $this->session->set_flashdata('error', 'You are not authorized.');
                    redirect(base_url());
             } 
        }
    }


    //REGENERATE TOKEN
    private function regenerate($user_no){
            $this->curl->post(BASE_URL.'regenerate', array(
                'user_no' => $user_no
            ));

            if(!$this->curl->error){
                $_SESSION['TOKEN']= $this->curl->response->token;                
            }
    }

    //UPDATE PROFILE
    public function update_profile(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('user_no', 'User No', 'required');
        if($this->form_validation->run()){
            $this->curl->post(BASE_URL.'user', array(
                'name'=> $this->input->post('name'),
                'phone'=> $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'user_no' => $this->input->post('user_no')
            ));
            $msg="";
            if($this->curl->error){
                if($this->curl->errorCode==400){
                   $msg="There is a problem updating your profile";
                }
            }
            else{
                $msg="Your profile has been updated.";

                //REGENERATE TOKEN
                $this->regenerate($this->input->post('user_no'));
            }
        }
        else{
            $error="";

            if(form_error('name')){
                $error.=form_error('name');
            }

            if(form_error('email')){
                $error.=form_error('email');
            }

            if(form_error('phone')){
                $error.=form_error('phone');
            }

            if(form_error('user_no')){
                $error.=form_error('user_no');
            }   

            $msg=$error;
        }

        echo $msg;
    }

    //UPDATE PASSWORD
    public function update_password(){
        $this->form_validation->set_rules('user_no', 'User NO', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password]');
        if($this->form_validation->run()){
            $this->curl->post(BASE_URL.'password', array(
                'password'=> $this->input->post('password'),
                'user_no' => $this->input->post('user_no')
            ));
            $msg="";
            if($this->curl->error){
                if($this->curl->errorCode==400){
                   $msg="There is a problem updating your password";
                }
            }
            else{
                $msg="Your password has been updated.";

                //REGENERATE TOKEN
                $this->regenerate($this->input->post('user_no'));
            }
        }
        else{
            $error="";

            if(form_error('password')){
                $error.=form_error('password');
            }

            if(form_error('confirm-password')){
                $error.=form_error('confirm-password');
            }
            $msg=$error;
        }

        echo $msg;
    }


    //GET TRANSACTION
    private function fetch_transactions($records=NULL){
        $this->verify();
        if($records!=NULL){
            $data=array(
                'records'=>$records
            );
        }
        else{
            $data=array(
                'records'=>'All'
            );
        }
        $this->curl->get(BASE_URL.'logs', $data);  
        if($this->curl->error){
            if($this->curl->errorCode==404){
                return false;
            }
        }
        else{
            return $this->curl->response;
        }
    }


    //WALLET

    public function wallet(){
        $this->verify();
        $this->curl->get(BASE_URL.'user');
        if(!$this->curl->error){
            $data['pageTitle']="My Wallet";
            $data['userInfo']=$this->curl->response;
            $data['wallet']= $this->fetch_wallet_info();
            $this->load->view('parts/header', $data);
            $this->load->view('wallet', $data);
            $this->load->view('parts/footer', $data);
        }
        else{
              var_dump($this->curl->errorCode);
              if($this->curl->errorCode==401){
                    $this->session->set_flashdata('error', 'You are not authorized.');
                    redirect(base_url());
              } 
        }

    }

    private function fetch_wallet_info(){
        $this->verify();
        $this->curl->get(BASE_URL.'wallet');
        return $this->curl->response;
    }




    



 
}


?>