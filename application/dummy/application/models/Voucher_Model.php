<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Voucher_Model extends CI_Model {

	function __construct(){			
		parent::__construct();      
		$this->tb_vouchers = 'tb_vouchers';
		$this->tb_user_access = 'tb_user_access';
		$this->tb_beneficiary = 'tb_beneficiary';
	}
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
		$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
		$qry = $this->db->query($sql);
		$result = $qry->result_array();
			
		foreach($result as $row){
			$GetId = $row['vouchers_management'];
		}
		//print_r($GetId);
			
		$this->db->select("*");
		$this->db->from($this->tb_vouchers);
		if($username == 'admin'){
			$where_array = array("status" => 1);
		}else{
			$where_array = array("status" => 1,  "masjid_id" => $masjid_id);
		}
		$this->db->where($where_array);
		$this->db->order_by('created_date', 'desc');
		$query = $this->db->get(); 
		
		$result = $query->result_array();
		//print_r($result);
		$data1 = array();
		$i = 1;
		foreach ($result as $row) {	
			$iId = $i;
			$id = $row['id'];
			$beneficiary_id = $row['beneficiary_id'];
			$voucher_number = $row['voucher_number'];
			$no_of_voucher = $row['no_of_voucher'];
			$value = $row['value'];
			$expiry_date = $row['expiry_date'];
			$expirydate = date('Y-m-d',strtotime($expiry_date));
			
			if (strpos($GetId,'Delete') !== FALSE){
			$Delete = base_url('Voucher_Controller/Del_data').'/'.$id;
			$DeleteLink = '<a href="#" onclick="confirmDelete(\''.$Delete.'\')"><i class="fas fa-trash"></i></a>';}
			
			if (strpos($GetId,'Edit') !== FALSE){
			$EditLink = '<a href="#" id="" onclick="edit_list(\''.$id.'\')"><i class="fas fa-edit"></i></a>';}	
			
			$Action = $DeleteLink .  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $EditLink;

			$row = array();
			$row[] = $iId;
			$row[] = $beneficiary_id;
			$row[] = $voucher_number; 
			$row[] = $no_of_voucher;				
			$row[] = $value;
			$row[] = $expirydate;
			      
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
		$this->db->insert('tb_vouchers', $data);			
		return true;
	}
	
	//delete(update)
	public function Deletedata($id){
		$where_array_upd = array("id" => $id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_vouchers, array("status" => 0));
		return true;
	}
	
	//update data//
	public function select($id){
		$query = $this->db->get_where('tb_vouchers', array('id' => $id));		
		return $query->row();
	}
				
	public function updateVoucher($data) {
		//print_r($data);
		//die();
		$where_array_upd = array("id" =>  $data['id']);
		$this->db->where($where_array_upd);

		$updateVoucher_data = array(
			"beneficiary_id" => $data['beneficiary_id'],
			"contact_number" => $data['contact_number'],
			"address1" => $data['address1'],
			"masjid_id" => $data['masjid_id'],
			"voucher_number" => $data['voucher_number'],
			"no_of_voucher" => $data['no_of_voucher'],
			"value" => $data['value'],
			"expiry_date" => $data['expiry_date']
		);
		return $this->db->update($this->tb_vouchers, $updateVoucher_data);
		//print_r ($this->db->last_query());
	}

		/* dropdown to get beneficiary data - FUNCTION */	
	public function BenDataModel($BenSelected){
		$query = $this->db->get_where('tb_beneficiary', array('beneficiary_id' => $BenSelected));
		$result= $query->result_array();
		return $result;
	}
}

?>