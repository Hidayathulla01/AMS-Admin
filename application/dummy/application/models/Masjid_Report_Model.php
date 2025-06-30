<?php
class Masjid_Report_Model extends CI_model{

	function __construct(){
		parent::__construct();
			$this->tb_masjids = 'tb_masjids';
	}
	
	public function ViewMasjids(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
		$this->db->select("*");
		$this->db->from($this->tb_masjids);
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
			$masjid_id = $row['masjid_id'];
			$masjid_name = $row['masjid_name'];
			$masjid_location = $row['masjid_location'];
			$row = array();
			$row[] = $counter;
			$row[] = $masjid_id;
			$row[] = $masjid_name; 
			$row[] = $masjid_location;
			$data1[] = $row;
			$counter++;
		}
	  $output = array("data" => $data1);
		return $output;
	}

	public function savedata($data) {
		$this->db->insert('tb_masjids', $data);
		return true;
	}
	
	
	 public function MasjidList() {
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
        $this->db->select('*');
        $this->db->from('tb_masjids');
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