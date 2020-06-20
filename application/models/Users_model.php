<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Users_model extends CI_Model{
 	
 	//VERIFY USER TOKEN
 	function verify_user($data){
 		$this->db->select('*');
 		$this->db->from('login');
 		$this->db->where('USERNAME', $data->USERNAME);
 		$this->db->where('PASSWORD', $data->PASSWORD);
 		$query= $this->db->get();
 		if($query->num_rows()==1){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	function login_log($user_number){
 		$this->db->insert('login_logs', array('USER_NO'=>$user_number));
 	}


 	//GET LIST OF USERS
 	function get_users($user_no){
 		$this->db->select('users.NAME, users.PHONE, users.EMAIL, users.USER_NO, users.DATE_CREATED, login.USERNAME, login.PASSWORD, login.STATUS, wallets.WALLET_NO, wallets.AMOUNT WALLET_BALANCE');
 		$this->db->from('users');
 		$this->db->join('login', 'users.USER_NO=login.USER_NO', 'left');
 		$this->db->join('wallets', 'users.USER_NO=wallets.USER_NO', 'left');
 		$this->db->where('users.USER_NO', $user_no);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->row_array();
 		}
 		else{
 			return false;
 		}
 	}

 	//login user
 	function login_user($data){
 		$this->db->select('login.USER_NO, login.USERNAME, login.PASSWORD, login.STATUS, wallets.WALLET_NO');
 		$this->db->from('login');
 		$this->db->join('wallets', 'login.USER_NO=wallets.USER_NO', 'left');
 		$this->db->where('USERNAME', $data['USERNAME']);
 		$this->db->where('PASSWORD', $data['PASSWORD']);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->row_array();
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH LOGIN INFO
 	function fetch_login_info($user_no){
 		$this->db->select('USER_NO, USERNAME, PASSWORD, STATUS');
 		$this->db->from('login');
 		$this->db->where('USER_NO', $user_no);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->row_array();
 		}
 		else{
 			return false;
 		}
 	}
 	
 	//UPDATE USER DATA
 	function update_user($data){
 		$this->db->where('user_no', $data['USER_NO']);
 		if($this->db->update('users', $data)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE USER LOGIN DATA 
 	function update_login($data){
 		$this->db->where('user_no', $data['USER_NO']);
 		if($this->db->update('login', $data)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}
	
}


?>