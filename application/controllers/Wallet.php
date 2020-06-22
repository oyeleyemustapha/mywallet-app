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
        $data['pageTitle']="Dashboard";
        $data['userInfo']=$this->userInfo();
        $data['transactions']=$this->fetch_transactions(5);
        $this->load->view('parts/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('parts/footer', $data);
    }


    //PROFILE
    public function profile(){
        $this->verify();
        $data['pageTitle']="Profile";
        $data['userInfo']=$this->userInfo();
        $this->load->view('parts/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('parts/footer', $data);
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
        $data['pageTitle']="My Wallet";
        $data['userInfo']=$this->userInfo();
        $data['wallet']= $this->fetch_wallet_info();
        $this->load->view('parts/header', $data);
        $this->load->view('wallet', $data);
        $this->load->view('parts/footer', $data);
    }

    private function fetch_wallet_info(){
        $this->verify();
        $this->curl->get(BASE_URL.'wallet');
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }


    //TRANSACTIONS
    public function transactions(){
        $this->verify();
        $data['pageTitle']="Transactions";
        $data['userInfo']=$this->userInfo();
        $data['transactions']= $this->fetch_transactions();
        $this->load->view('parts/header', $data);
        $this->load->view('transactions', $data);
        $this->load->view('parts/footer', $data);
    }


    //TRANSACTION
    public function transaction_info(){
        $this->verify();
        $this->form_validation->set_rules('transaction_id', 'Transaction', 'required');
        if($this->form_validation->run()){
            $data['details']=$this->transaction($this->input->post('transaction_id'));
            $this->load->view('transaction', $data);
        }
    }

    //FETCH TRANSACTION DETAILS
    private function transaction($transaction_id){
        $this->verify();
        $this->curl->get(BASE_URL.'transaction/'.$transaction_id);
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }


    //FETCH USER INFO
     private function userinfo(){
        $this->verify();
        $this->curl->get(BASE_URL.'user');
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }



    //FUND WALLET
    public function fund_wallet(){
        $this->verify();
        $data['pageTitle']="Fund Wallet";
        $data['userInfo']=$this->userInfo();
        $data['wallet']= $this->fetch_wallet_info();
        $data['scripts']='<script src="https://js.paystack.co/v2/inline.js"></script>';
       
        $this->load->view('parts/header', $data);
        $this->load->view('fund', $data);
        $this->load->view('parts/footer', $data);
    }


    //VEFIFY TRANSACTION
    public function verify_payment(){
        $this->verify();
        $this->form_validation->set_rules('wallet', 'Wallet', 'required');
        $this->form_validation->set_rules('ref_no', 'Reference ID', 'required');
        $this->form_validation->set_rules('amount', 'Amount Paid', 'required|numeric');
        if($this->form_validation->run()){
            $result = array();
                $url = 'https://api.paystack.co/transaction/verify/'.$this->input->post('ref_no');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                //curl_setopt($ch, CURLOPT_SSLVERSION , 3);
                //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); 
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt(
                  $ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer sk_test_161d94e383c5f48a5c95ce2f1ac4406dc2c727d7']
                );
                $request = curl_exec($ch);
                if($request){
                     $result = json_decode($request, true);
                     if($result['data']['status'] == 'success'){


                        //CREDIT RECIEVER WALLET
                        $credit_data=array(
                            'WALLET'=> $this->input->post('wallet'),
                            'AMOUNT'=> $this->input->post('amount')/100,
                            'DESCRIPTION'=>"Wallet funding through paystack with Reference number  ".$this->input->post('ref_no')
                        );
                        if($this->credit($credit_data)->status=="successful"){
                            echo "Your wallet has been credited";
                        }
                        else{
                            echo "There is an error crediting your wallet.";
                        }
                     }
                     else{
                        echo "Transaction was not successful.";
                     }

                }
                else{
                    if($errno = curl_errno($ch)) {
                        $error_message = curl_strerror($errno);
                        echo $error_message;
                    }
                }
                curl_close($ch);
        }
        else{
            echo form_error('ref_no');
        }
    }





    //TRANSFER
    public function transfer(){
        $this->verify();
            $data['pageTitle']="Transfer";
            $data['userInfo']=$this->userInfo();
            $data['transactions']= $this->fetch_transactions();
            $this->load->view('parts/header', $data);
            $this->load->view('transfer', $data);
            $this->load->view('parts/footer', $data);
    }


    //CHECK IF WALLET NUMBER EXIST
    private function isWalletExist($wallet_no){
        $this->verify();
        $this->curl->get(BASE_URL.'wallet/'.$wallet_no);
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }


    //VERIFY WALLET NUMBER
    public function verify_wallet(){
        $this->verify();
        $this->form_validation->set_rules('wallet_no', 'wallet Number', 'required');
        if($this->form_validation->run()){
            if($this->isWalletExist($this->input->post('wallet_no'))==false){
                echo "Wallet number is not valid";
            }
        }
    }


    //PROCESS FUND TRANSFER
    public function process_transfer(){
        $this->verify();
        $this->form_validation->set_rules('reciever', 'wallet Number', 'required');
        $this->form_validation->set_rules('wallet_balance', 'wallet Balance', 'required|numeric');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('sender', 'Sender', 'required');
        
        if($this->form_validation->run()){

            $data=array(
                'WALLET_NO'=>trim($this->input->post('reciever')),
                'AMOUNT'=>trim($this->input->post('amount')),
                'WALLET_BALANCE'=>trim($this->input->post('wallet_balance'))
            );

            if($this->isWalletExist($data['WALLET_NO'])!=false){
                
                //CHECK IF TRANSFER AMOUNT IS GREATER THAN THE WALLET BALANCE
                if($data['AMOUNT']>$data['WALLET_BALANCE']){
                    echo "Transfer amount can't be greater than Wallet balance";
                }
                else{


                    
                    //DEBIT SENDER WALLET
                    $debit_data=array(
                        'WALLET'=> $this->input->post('sender'),
                        'AMOUNT'=> $data['AMOUNT'],
                        'DESCRIPTION' =>"Fund transfer to ".$data['WALLET_NO']
                    );
                    $this->debit($debit_data);                   
                

                    //CREDIT RECIEVER WALLET
                    $credit_data=array(
                        'WALLET'=> $data['WALLET_NO'],
                        'AMOUNT'=> $data['AMOUNT'],
                        'DESCRIPTION'=>"Fund transfer from  ".$this->input->post('sender')
                    );
                    $this->credit($credit_data);

                    echo "Transfer successful.";
                }  
            }
            else{
                echo "Wallet number is not valid";
            }
        }
        else{

            $error="";

            if(form_error('wallet')){
                $error.=form_error('wallet');
            }

            if(form_error('wallet_balance')){
                $error.=form_error('wallet_balance');
            }

            if(form_error('amount')){
                $error.=form_error('amount');
            }
            if(form_error('sender')){
                $error.=form_error('sender');
            }
            echo $error;
        }  
    }



    //DEBIT WALLET
    private function debit($debit_data){
        $this->verify();
        $this->curl->post(BASE_URL.'debit', array(
            'wallet_no'=> $debit_data['WALLET'],
            'amount'=> $debit_data['AMOUNT'],
            'description'=> $debit_data['DESCRIPTION']
        ));
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }


     //CREDIT WALLET
    private function credit($credit_data){
        $this->verify();
        $this->curl->post(BASE_URL.'credit',  array(
            'wallet_no'=> $credit_data['WALLET'],
            'amount'=> $credit_data['AMOUNT'],
            'description'=> $credit_data['DESCRIPTION']
        ));
        if($this->curl->error){
            return false;
        }
        else{
            return $this->curl->response;
        }
    }







   



    



 
}


?>