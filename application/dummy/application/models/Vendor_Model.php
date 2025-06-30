<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Vendor_Model extends CI_Model {

	function __construct(){			
	parent::__construct();      
		$this->tb_vendors = 'tb_vendors';
		$this->tb_user_access = 'tb_user_access';
	}
	
	public function GetVendorData(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
			
		foreach($result as $row){
			$GetId = $row['vendors_management'];
		}
		
		$this->db->select("*");
		$this->db->from($this->tb_vendors);
		$where_array = array("status" => 1);
		$this->db->where($where_array); 
		$query = $this->db->get();            
		$result = $query->result_array();
		$data1 = array();
		$i=1;
		foreach ($result as $row) {
			$iId = $i;
			$id = $row['id'];
			$vendor_id = $row['vendor_id'];
			$shop_name = $row['shop_name'];
			$contact_person = $row['contact_person'];
			$nature_of_business = $row['nature_of_business'];
			$operating_hours = $row['operating_hours'];
			$address_1 = $row['beneficiary_address_1'];
			//address_2 = $row['beneficiary_address_2'];
			$postal_code = $row['postal_code'];
			$contact_number = $row['contact_number'];
			$created_by = $row['masjid_id'];
			
			//$status = $row['status'];
		
			if (strpos($GetId,'Delete')){
			$Delete = base_url('Vendor_Controller/upd_data').'/'.$id;
			$DeleteLink = '<a href="#" onclick="confirmDelete(\''.$Delete.'\')"><i class="fas fa-trash"></i></a>';}
			
			if (strpos($GetId,'Edit')){
			$EditLink = '<a href="#" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit "></i></a>';}				
			
			$Action = $DeleteLink .  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $EditLink;

			$row = array();
			
			$row[] = $iId;
			$row[] = $vendor_id;
			$row[] = $shop_name; 
			$row[] = $contact_person; 
			$row[] = $nature_of_business;
			$row[] = $operating_hours;
			$row[] = $address_1;
			//$row[] = $address_2;
			$row[] = $postal_code;          
			$row[] = $contact_number;  
			$row[] = $created_by;  
			
			if (strpos($GetId,'Edit')){
			  $row[] = $Action;
			 }
			 elseif(strpos($GetId,'Delete')){
				 $row[] = $Action;
			 }
			 
			$data1[] = $row;
			$i++;				
	   }
		$output = array("data" => $data1);
		return $output;
	}		
		
	public function saverecords($data) {			
		$this->db->insert('tb_vendors', $data);			
		return true;
	}
	
	//delete(update)
	public function updatedata($id){
		$where_array_upd = array("id" => $id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_vendors, array("status" => 0));
		return true;
	}	
	
	//update data//
	public function select($id){
		$query = $this->db->get_where('tb_vendors', array('id' => $id));		
		return $query->row();
	}	
				
	public function update_data($data) {
		$where_array_upd = array("id" =>  $data['id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"vendor_id" => $data['vendor_id'],
			"shop_name" => $data['shop_name'],
			"contact_person" => $data['contact_person'],
			"password" => $data['password'],
			"nature_of_business" => $data['nature_of_business'],
			"operating_hours" => $data['operating_hours'],
			"beneficiary_address_1" => $data['beneficiary_address_1'],
			"beneficiary_address_2" => $data['beneficiary_address_2'],
			"postal_code" => $data['postal_code'],
			"contact_number" => $data['contact_number']
		);

		return $this->db->update($this->tb_vendors, $update_data);
	}		
}

?>