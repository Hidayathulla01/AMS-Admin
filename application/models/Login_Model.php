<?php 
defined('BASEPATH') OR exit('NO direct script access allowed');

	class Login_Model extends CI_Model{
		
		function __construct(){
			parent::__construct();      
			$this->tbl_admin = 'tbl_admin';
		}
		
	public function GetUser($email,$password){	
		$sql = "select * from tbl_admin where email='$email' AND password='$password'";
		$qry = $this->db->query($sql);
		return $qry->result_array(); 
	}
}