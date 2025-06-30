<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Beneficiary_Model extends CI_Model {

	function __construct(){
	  parent::__construct();
		$this->tb_beneficiary = 'tb_beneficiary';
		$this->tb_user_access = 'tb_user_access';
    }
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
			
		foreach($result as $row){
			$GetId = $row['beneficiary_management'];
		}
		//print_r($GetId);
		
		$this->db->select("*");
		$this->db->from($this->tb_beneficiary);
		if($username == 'admin'){
			$where_array = array("status" => 1);
		}else{
			$where_array = array("status" => 1,  "masjid_id" => $masjid_id);
		}
		$this->db->where($where_array); 
		$query = $this->db->get();
		$result = $query->result_array();
		$data1 = array();
		$i = 1;
		foreach ($result as $row) {
			$iId = $i;
			$id = $row['id'];
			$beneficiary_id = $row['beneficiary_id'];
			$fullname = $row['fullname'];
			//$age = $row['age'];
			//$citizen = $row['citizen'];
			$postal_code = $row['postal_code'];
			//$unit_number = $row['unit_number'];
			$contact_number = $row['contact_number'];
			$address1 = $row['address1'];
			$created_by = $row['masjid_id'];
				
			if (strpos($GetId,'Delete')!== FALSE){
			$Delete = base_url('Beneficiary_Controller/upd_data').'/'.$id;
			$DeleteLink = '<a href="#" onclick="confirmDelete(\''.$Delete.'\')"><i class="fas fa-trash "></i></a>';	
			}
			
			if (strpos($GetId,'Edit')!== FALSE){
			$EditLink = '<a href="#" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit "></i></a>';			
			}			
			
			$Action = $DeleteLink .  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $EditLink;

			$row = array();
			
			$row[] = $iId;
			$row[] = $beneficiary_id;
			$row[] = $fullname; 
			//$row[] = $age;
			//$row[] = $citizen;
			$row[] = $postal_code;
			$row[] = $contact_number;
			$row[] = $address1;
			$row[] = $created_by;   
			
			if (strpos($GetId,'Edit')!== FALSE){
			  $row[] = $Action;
			 }
			 elseif(strpos($GetId,'Delete')!== FALSE){
				 $row[] = $Action;
			}
				
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
		return $output;
	}
		
		
	public function saverecords($data) {
		$this->db->insert('tb_beneficiary', $data);		
		return true;
	}
		
	//delete(update)
	public function updatedata($id){
		$where_array_upd = array("id" => $id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_beneficiary, array("status" => 0));
		return true;
	}
		
	//update data//
	public function select($id){
		$query = $this->db->get_where('tb_beneficiary', array('id' => $id));		
		$result = $query->row();
		//print_r($result);
		return  $result;
	}
	
	public function update_data($data) {
		$where_array_upd = array("id" =>  $data['id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"beneficiary_id" => $data['beneficiary_id'],
			//"masjid_id" => $data['masjid_id'],
			"fullname" => $data['fullname'],
			"age" => $data['age'],
			"password" => $data['password'],
			"citizen" => $data['citizen'],
			"nationality" => $data['nationality'],
			"unit_number" => $data['unit_number'],
			"postal_code" => $data['postal_code'],
			"contact_number" => $data['contact_number'],
			//"annual_income" => $data['annual_income'],
			"address1" =>  $data['address1'],
			"address2" =>  $data['address2']
		);

		return $this->db->update($this->tb_beneficiary, $update_data);
	}

}

?>