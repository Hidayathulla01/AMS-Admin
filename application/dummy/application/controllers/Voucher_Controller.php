<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_Controller extends CI_controller{
	
	public function __construct(){
	parent::__construct ();
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Voucher_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->library('form_validation');
		
		$userData = $this->session->userdata('user_data');
		if (empty($userData)) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			return redirect('login');
		}
	}
	
	public function VoucherIndex(){
        $this->load->view('Vouchers_Table_View');
	}
	
	public function GetListData(){
		$data = $this->Voucher_Model->GetList();
        echo json_encode($data);
	}
	
//func for Add Voucher form page
	public function createVoucher(){
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];
		
		$this->load->view('Add_Voucher_Form',$masj);
		if ($this->input->post('submit')) {
            $data['beneficiary_id'] = $this->input->post('beneficiary_id');
            $data['contact_number'] = $this->input->post('contact_number');
            $data['address1'] = $this->input->post('address1');
            $data['voucher_number'] = $this->input->post('voucher_number');
            $data['no_of_voucher'] = $this->input->post('no_of_voucher');
            $data['value'] = $this->input->post('value');
            $data['expiry_date'] = $this->input->post('expiry_date');
            $data['masjid_id'] = $masjid_id;
            $data['created_by'] = $masjid_id;
			
            $resp = $this->Voucher_Model->saverecords($data);
            if ($resp == true) {
				redirect('VoucherIndex');		
            }
		}		
	}
	
	public function BulkUpload(){
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];
		$this->load->view('Voucher_Bulk_Upload.php',$masj);	
		if ($this->input->post('submit')) {
			$data['voucher_number'] = $this->input->post('hiddenResult');
			$explode_data = explode(',', $data['voucher_number']);

		foreach ($explode_data as $one) {
			$data['voucher_number'] = trim($one);
			$data['no_of_voucher'] = 1;
			$data['beneficiary_id'] = $this->input->post('beneficiary_id');
			$data['contact_number'] = $this->input->post('contact_number');
			$data['address1'] = $this->input->post('address1');
			$data['value'] = $this->input->post('value');
			$data['expiry_date'] = $this->input->post('expiry_date');
			$data['masjid_id'] = $masjid_id;
			$data['created_by'] = $masjid_id;
			$resp = $this->Voucher_Model->saverecords($data);
		}
		if ($resp == true) {
			redirect('VoucherIndex');
		}
	}
}
	
	//for delete func   
	public function Del_data($id){
		$response=$this->Voucher_Model->Deletedata($id);
		if ($response == true) {
			$this->load->view('Vouchers_Table_View.php');
		}
	}
				
		/* UPDATE FUNCTION */	
	public function updatedata($id) {
		$data['response'] = $this->Voucher_Model->select($id);
		$data['form_action'] = base_url('Voucher_Controller/upd/' . $id); 
		$this->load->view('Voucher_UpdateForm.php', $data);
	}

	public function upd($id) {
		$update_data = array(
			'id' => $id,
			'masjid_id'  => $this->input->post('masjid_id'),
			'beneficiary_id' => $this->input->post('beneficiary_id'),
			'contact_number' => $this->input->post('contact_number'),
			'address1' => $this->input->post('address1'),
			'voucher_number' => $this->input->post('voucher_number'),
			'no_of_voucher' => $this->input->post('no_of_voucher'),
			'value' => $this->input->post('value'),
			'expiry_date' => $this->input->post('expiry_date')
		);	
		//print_r($update_data);
		//die();
		$res = $this->Voucher_Model->updateVoucher($update_data);
	
		if ($res) {
			$this->load->view('Vouchers_Table_View.php');
		}
	}
			
		/* dropdown to get beneficiary data - FUNCTION */	
	public function GetBeneficiaryData() {
		$BenSelected = $this->input->post('BeneifId');
		$result = $this->Voucher_Model->BenDataModel($BenSelected);
		echo json_encode($result);
		//die($result);
	}
}
?>