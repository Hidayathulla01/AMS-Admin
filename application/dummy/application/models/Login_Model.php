<?php 
defined('BASEPATH') OR exit('NO direct script access allowed');

	class Login_Model extends CI_Model{
		
		function __construct(){
			parent::__construct();      
			$this->tb_users = 'tb_users';
		}
		
	public function GetUser($masjid_id,$username){
		if($username != "admin" ){
			$AddMasjidId = "AND masjid_id = '$masjid_id'";
		}else{
			$AddMasjidId = ' ';
		}
		
		//return $this->db->where('masjid_id', $masjid_id)->get('tb_users')->row();
		$sql = "select user_id,masjid_id,password from tb_users where user_id='$username' $AddMasjidId AND status = '1'";
		$qry = $this->db->query($sql);
		//print_r($this->db->last_query());
		return $qry->result_array(); 
	}
}