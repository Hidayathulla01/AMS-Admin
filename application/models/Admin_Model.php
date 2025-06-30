<?php
class Admin_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_admin = 'tbl_admin';		
	}	
	
	public function ViewAdmins() {
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];    		
		$this->db->select("*");
		$this->db->from($this->tbl_admin);
		$this->db->where("delete_status", 1);
		$this->db->where("admin_id !=", $id);
		$query = $this->db->get();		
		return $query->result_array();
	}

	
	public function savedata($data) {			
		$this->db->insert('tbl_admin', $data);			
		return true;
	}	
	
	public function getAdminDataById($id) {
		return $this->db->where('admin_id', $id)->get('tbl_admin')->row_array();
	}
	
	public function UpdateAdmin($admin_id, $data){
		$this->db->where('admin_id', $admin_id);
		return $this->db->update('tbl_admin', $data);
		//pr($this->db->last_query());
	}
	
	public function DeleteAdminData($id) {
		$this->db->where('admin_id', $id);
		return $this->db->update('tbl_admin', array('delete_status' => 0)); 
	}
}

?>