<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Funds_Model extends CI_Model {
	function __construct(){			
		parent::__construct();
			$this->tb_funds = 'tb_funds';
	}
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		//die($username);
		/*$sql = "SELECT masjid_name FROM tb_masjids WHERE masjid_id =  '".$masjid_id."'";
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
		
		foreach($result as $row){
			$GetMasjid = $row['masjid_name'];
		}*/
		
		$this->db->select("*");
		$this->db->from($this->tb_funds);
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
			$masjid_id = $row['masjid_id'];
			$fund_allocation = $row['fund_allocation'];
			$for_the_year = $row['for_the_year'];
		//	if (strpos($GetId, 'Add')=== false)
			if (strpos($username, 'admin')!== FALSE){
			$EditLink = '<a href="#" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit "></i></a>';}			
			
			$Action = $EditLink;

			$row = array();
			$row[] = $iId;
			$row[] = $masjid_id;
			$row[] = $fund_allocation;
			$row[] = $for_the_year;
			if (strpos($username, 'admin')!== FALSE){
			$row[] = $Action;
			}
			$data1[] = $row;
			$i++;
		}
			$output = array("data" => $data1);
			return $output;
	}
		
	public function saverecords($data) {
		$this->db->insert('tb_funds', $data);			
		return true;
	}

	//update data//
	public function select($id){
		$query = $this->db->get_where('tb_funds', array('id' => $id));		
		return $query->row();
	}
	
	public function update_data($data) {
		$where_array_upd = array("id" =>  $data['id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"masjid_id" => $data['masjid_id'],
			"fund_allocation" => $data['fund_allocation'],
			"for_the_year" => $data['for_the_year']
		);
		//print_r($update_data);
		//	die();
		return $this->db->update($this->tb_funds, $update_data);
	}
}

?>