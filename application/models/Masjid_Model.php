<?php
class Masjid_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_masjids = 'tbl_masjids';		
	}	
	
	public function ViewMasjids(){
		$this->db->select("*");
		$this->db->from($this->tbl_masjids);
		$where_array = array("delete_status" => 1);
		$this->db->where($where_array);
		$query = $this->db->get(); 
		//print_r($this->db->last_query());
		$result = $query->result_array();
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 			
			$masjid_id = $row['masjid_id'];			
			$masjid_name = $row['masjid_name'];			
			$country = $row['country'];			
			$mobile_no = $row['mobile_no'];		
			
			$Delete = base_url('Masjid_Controller/delete_id').'/'.$masjid_id;
			$DeleteLink = '<a type="button" href="#" onclick="confirmDelete(\''.$Delete.'\')" class=" btn-sm btn btn btn-danger m-1"><i class="fa fa-trash p-2" aria-hidden="true"></i></a>';
						
			$EditLink = '<a type="button" class="btn-sm btn btn-secondary m-1" href="' . base_url('Masjid_Controller/updatedata/') . $masjid_id . '" aria-hidden="true"><i class="fa fa-edit p-2" aria-hidden="true"></i></a>';
			
			$ViewLink = '<a type="button" class="btn-sm btn btn-info m-1" href="' . base_url('Masjid_Controller/MasjidDetails/') . $masjid_id . '" aria-hidden="true"><i class="fa fa-eye p-2" aria-hidden="true"></i></a>';
			            			            
			$Action = $EditLink. $ViewLink .$DeleteLink;

			$row = array();
			$row[] = $iId;
			$row[] = $masjid_id;
			$row[] = $masjid_name;
			$row[] = $country;
			$row[] = $mobile_no;
			$row[] = $Action;
			$data1[] = $row;
			$i++;
			
		}
		$output = array("data" => $data1);
		return $output;		
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
	
	public function get_masjid_details($masjid_id) {
		$query = $this->db->get_where('tbl_masjids', array('masjid_id' => $masjid_id));
		return $query->row_array();
	}

		
		//update data//
	public function select($masjid_id){
		$query = $this->db->get_where('tbl_masjids', array('masjid_id' => $masjid_id));		
		return $query->row();
	}
	
	public function ViewDetails($masjid_id){
		$query = $this->db->get_where('tbl_masjids', array('masjid_id' => $masjid_id));		
		return $query->row();
	}
	
	public function update($data) {
		$where_array_upd = array("masjid_id" =>  $data['masjid_id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"masjid_name" => $data['masjid_name'],
			"description" => $data['description'],
			"location" => $data['location'],
			"area" => $data['area'],
			"pincode" => $data['pincode'],
			"country" => $data['country'],
			"contact_person" => $data['contact_person'],
			"mobile_no" => $data['mobile_no'],
		);

		return $this->db->update($this->tbl_masjids, $update_data);
	}

}

?>