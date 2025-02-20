<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Beneficiary_Report_Model extends CI_Model {

	function __construct(){			
		parent::__construct();      
			$this->tb_beneficiary = 'tb_beneficiary';
	}
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
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
		$counter = 1;
		foreach ($result as $row) {
			$id = $row['id'];
			$beneficiary_id = $row['beneficiary_id'];
			$masjid_id = $row['masjid_id'];
			$fullname = $row['fullname'];
			$citizen = $row['citizen'];
			$contact_number = $row['contact_number'];
			$address1 = $row['address1'];

			$row = array();
			$row[] = $counter;
			$row[] = $beneficiary_id;
			$row[] = $masjid_id;
			$row[] = $fullname; 
			$row[] = $citizen;			
			$row[] = $contact_number;				
			$row[] = $address1; 
			$data1[] = $row;
			$counter++;
		}
		$output = array("data" => $data1);
		return $output;
	}
	
	public function saverecords($data) {			
		$this->db->insert('tb_beneficiary', $data);			
		return true;
	}
	  // get Beneficiary list
    public function BeneficiaryList() {
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
        $this->db->select('*');
        $this->db->from('tb_beneficiary');
		if($username == 'admin'){
			$where_array = array("status" => 1);
		}else{
			$where_array = array("status" => 1,  "masjid_id" => $masjid_id);
		}
		$this->db->where($where_array); 
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>