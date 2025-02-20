<?php 
defined('BASEPATH') OR exit('NO direct script access allowed');

	class Login_Model extends CI_Model{
		
		function __construct(){
			parent::__construct();      
			$this->tbl_users = 'tbl_users';
		}
		
	public function GetUser($email,$password){	
		$sql = "select email,password from tbl_users where email='$email' AND password='$password'";
		$qry = $this->db->query($sql);
		//print_r($this->db->last_query());
		//die();
		return $qry->result_array(); 
	}
}