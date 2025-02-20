<?php
class Masjid_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tb_masjids = 'tb_masjids';
		$this->tb_user_access = 'tb_user_access';
	}	
	
	public function ViewMasjids(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
			
		foreach($result as $row){
			$GetId = $row['masjid_management'];
		}
		//print_r($GetId);
		
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
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 
			$id = $row['id'];
			$masjid_id = $row['masjid_id'];
			$masjid_name = $row['masjid_name'];
			$masjid_location = $row['masjid_location'];
				
			if (strpos($GetId,'Delete') !== FALSE){
			$Delete = base_url('Masjid_Controller/delete_id').'/'.$id;
			$DeleteLink = '<a href="#" onclick="confirmDelete(\''.$Delete.'\')"><i class="fas fa-trash"></i></a>';
			}
			
			if(strpos($GetId,'Edit') !== FALSE){
			$EditLink = '<a href="#" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit "></i></a>';
			}
			
			$Action = $DeleteLink .  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $EditLink;

			$row = array();
			$row[] = $iId;
			$row[] = $masjid_id;
			$row[] = $masjid_name; 
			$row[] = $masjid_location;
			if (strpos($GetId,'Delete') !== FALSE){
			  $row[] = $Action;
			 }
			 elseif(strpos($GetId,'Edit') !== FALSE){
				 $row[] = $Action;
			 }
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
		return $output;		
	}
	
	public function savedata($data) {			
		$this->db->insert('tb_masjids', $data);			
		return true;
	}
			
			
	//Delete data//

	public function del_data($id){
		$where_array_upd = array("id" => $id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_masjids, array("status" => 0));
		return true;
	}
		
		//update data//
	public function select($id){
		$query = $this->db->get_where('tb_masjids', array('id' => $id));		
		return $query->row();
	}
	
	public function update($data) {
		$where_array_upd = array("id" =>  $data['id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"masjid_id" => $data['masjid_id'],
			"masjid_name" => $data['masjid_name'],
			"masjid_location" => $data['masjid_location'],
		);

		return $this->db->update($this->tb_masjids, $update_data);
	}



}

?>