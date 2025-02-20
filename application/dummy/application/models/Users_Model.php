<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_model{

	function __construct(){
		parent::__construct();
		$this->tb_users = 'tb_users';
		$this->tb_user_access = 'tb_user_access';
	}
		
	public function ViewUsers(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
			
		foreach($result as $row){
			$GetId = $row['users_management'];
		}
		
		$this->db->select("*");
		$this->db->from($this->tb_users);
		if($username == 'admin'){
			$where_array = array("status" => 1);
		}else{
			$where_array = array("status" => 1,  "masjid_id" => $masjid_id);
		}
		$this->db->where($where_array); 
		$query = $this->db->get();            
		$result = $query->result_array();
		$data1 = array();
		$counter = 1;
        foreach ($result as $row) {
			$id = $row['id'];
			$user_id = $row['user_id'];
			$fullname = $row['fullname'];
			$masjid_id = $row['masjid_id'];
			
			if (strpos($GetId,'Delete')!== FALSE){
			$Delete = base_url('Users_Controller/delete_user').'/'.$id;
			$DeleteLink = '<a href="#" onclick="confirmDelete(\''.$Delete.'\')"><i class="fas fa-trash"></i></a>';
			}
			
			if (strpos($GetId,'Edit')!== FALSE){
			$EditLink = '<a href="#" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit"></i></a>';}
			
			
			$Action = $DeleteLink .  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $EditLink;

			$row = array();
			$row[] = $counter;
			$row[] = $user_id; 
			$row[] = $fullname;
			$row[] = $masjid_id;
			
		    if (strpos($GetId,'Edit')!== FALSE){
			  $row[] = $Action;
			 }
			 elseif(strpos($GetId,'Delete')!== FALSE){
				 $row[] = $Action;
			 }
			$data1[] = $row;
			$counter++;
		}
		
		$output = array("data" => $data1);
		return $output;		
	}
	
	public function is_user_id_exists($user_id) {
    // Query the database to check if the user ID exists
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('tb_users'); 
    if ($query->num_rows() > 0) {
        return true;
    } 
	
	//print_r($this->db->last_query());
	
}


	//insert data//
	public function save($data) {
		$this->db->insert('tb_users', $data);			
		return true;
	}
	
	public function InsertAccess($AccessData) {
		$this->db->insert('tb_user_access', $AccessData);			
		return true;
	}
	
	//Delete data//
	public function del_user($id){
		$where_array_upd = array("id" => $id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_users, array("status" => 0));
		return true;
	}
	
	//update data//
	public function select($id){
		
		$sql = "SELECT * FROM tb_users tu INNER JOIN tb_user_access ap ON ap.user_id=tu.user_id WHERE tu.id ='".$id."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		//print_r($result);
		return $result;
	}
	
	public function Update_UserInfo($update_data) {
		
		$where_array_upd = array("id" =>  $update_data['id']);
		$this->db->where($where_array_upd);

		$update_data1 = array(
			"id" =>  $update_data['id'],
			"user_id" => $update_data['user_id'],
			"password" => $update_data['password'],
			"fullname" => $update_data['fullname'],
			"masjid_id" => $update_data['masjid_id']						
		);
		//print_r($update_data1);
		//die();

		return $this->db->update($this->tb_users, $update_data1);
		
	}
	public function updateAccess($AccessData) {
		$where_array_update = array("user_id" =>  $AccessData['user_id']);
		$this->db->where($where_array_update);
		
		$AccessData = array(
			"user_id" =>  $AccessData['user_id'],
			"masjid_management" => $AccessData['masjid_management'],
			"beneficiary_management" => $AccessData['beneficiary_management'],
			"vendors_management" => $AccessData['vendors_management'],
			"vouchers_management" => $AccessData['vouchers_management'],
			"users_management" => $AccessData['users_management']
		);
		//print_r($AccessData);
		//die();

		return  $this->db->update($this->tb_user_access, $AccessData);
	}
}