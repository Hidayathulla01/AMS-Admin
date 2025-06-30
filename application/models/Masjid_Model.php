<?php
class Masjid_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_masjids = 'tbl_masjids';		
	}	
	
	public function ViewMasjids(){
		$this->db->select("*, (SELECT COUNT(masjid_id) FROM {$this->tbl_masjids} WHERE delete_status = 1) AS TotalMasjids");
		$this->db->from($this->tbl_masjids);
		$where_array = array("delete_status" => 1);
		$this->db->where($where_array);
		$query = $this->db->get(); 
		//pr($this->db->last_query());
		$result = $query->result_array();
		return $result;		
	}
	
	public function savedata($data) {			
		$this->db->insert('tbl_masjids', $data);			
		return true;
	}
			
	/*** Delete data ***/
	public function del_data($masjid_id){
		$where_array_upd = array("masjid_id" => $masjid_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tbl_masjids, array("delete_status" => 0));
		return true;
	}	
	
	public function getMasjidDataById($id) {
		return $this->db->where('masjid_id', $id)->get('tbl_masjids')->row_array();
	}
	
	public function UpdateMasjid($masjid_id, $data){
		$this->db->where('masjid_id', $masjid_id);
		$wd =  $this->db->update('tbl_masjids', $data);
		//pr($this->db->last_query());
		return $wd;
	}
	
	public function DeleteMasjidData($id) {
		$this->db->where('masjid_id', $id);
		return $this->db->update('tbl_masjids', array('delete_status' => 0)); 
	}

}

?>