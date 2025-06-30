<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_Controller extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');
		$userData = $this->session->userdata('user_data');
		if (empty($userData)) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			return redirect('login');
		}
		$this->load->database();
		$this->load->model('Vendor_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}
	
	
	public function VendorIndex(){
        $this->load->view('Vendors_Table_View');
	}
	
	public function GetVendorList(){		
		$data = $this->Vendor_Model->GetVendorData();
		//print_r($data);
        echo json_encode($data);
	}

	
//func for Add_Beneficiary form page
	public function createVendor(){	
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];	
		$this->load->view('Add_Vendor_Form');	
		if ($this->input->post('submit')) {
            $data['vendor_id'] = $this->input->post('vendor_id');
            $data['shop_name'] = $this->input->post('shop_name');
            $data['contact_person'] = $this->input->post('contact_person');
            $data['password'] = $this->input->post('password');
            $data['nature_of_business'] = $this->input->post('nature_of_business');
            $data['operating_hours'] = $this->input->post('operating_hours');
            $data['beneficiary_address_1'] = $this->input->post('address_1');
            $data['beneficiary_address_2'] = $this->input->post('address_2');
            $data['postal_code'] = $this->input->post('postal_code');
            $data['contact_number'] = $this->input->post('contact_number');
			$data['masjid_id'] = $masjid_id;
			$data['created_by'] = $masjid_id;
			
            $resp = $this->Vendor_Model->saverecords($data);
			
            if ($resp == true) {
				redirect('VendorIndex');		
            }
		}	 
	}
	
	
	
	
	//for delete func   
	public function upd_data($id){

		$response=$this->Vendor_Model->updatedata($id);
		if ($response == true) {			 
			$this->load->view('Vendors_Table_View.php');
		}		
	}
				
		/** UPDATE FUNCTION **/	
	public function updatedata($id) {
		$data['response'] = $this->Vendor_Model->select($id);
		$data['form_action'] = base_url('Vendor_Controller/upd/' . $id); 
		$this->load->view('Vendor_UpdateForm.php', $data);
	}

	public function upd($id) {
			
		$update_data = array(
			'id' => $id,
			'vendor_id' => $this->input->post('vendor_id'),
			'shop_name' => $this->input->post('shop_name'),
			'contact_person' => $this->input->post('contact_person'),
			'password' => $this->input->post('password'),
			'nature_of_business' => $this->input->post('nature_of_business'),
			'operating_hours' => $this->input->post('operating_hours'),
			'beneficiary_address_1' => $this->input->post('address_1'),
			'beneficiary_address_2' => $this->input->post('address_2'),
			'postal_code' => $this->input->post('postal_code'),
			'contact_number' => $this->input->post('contact_number'),
		);	

		$res = $this->Vendor_Model->update_data($update_data);
	
		if ($res) {
			$this->load->view('Vendors_Table_View.php');
		}
	}
		
}
?>