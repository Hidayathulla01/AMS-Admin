<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiary_Controller extends CI_controller{
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
		$this->load->model('Beneficiary_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}	
	
	public function BeneficiaryIndex(){
        $this->load->view('Beneficiaries_Table_View');
	}
	
//func for Add_Beneficiary form page
	public function create(){
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];
		$this->load->view('Add_Beneficiary_Form');	
        if ($this->input->post('submit')) {
            $data['beneficiary_id'] = $this->input->post('beneficiary_id');
			$data['masjid_id'] = $this->input->post('masjid_id');
            $data['fullname'] = $this->input->post('fullname');
            $data['age'] = $this->input->post('age');
            $data['password'] = $this->input->post('password');
            $data['citizen'] = $this->input->post('citizen');
            $data['nationality'] = $this->input->post('nationality');
            $data['unit_number'] = $this->input->post('unit_number');
            $data['postal_code'] = $this->input->post('postal_code');
            $data['contact_number'] = $this->input->post('contact_number');
           // $data['annual_income'] = $this->input->post('annual_income');
			$data['address1'] = $this->input->post('address1');
            $data['address2'] = $this->input->post('address2');
			$data['masjid_id'] = $masjid_id;
			$data['created_by'] = $masjid_id;
			
            $resp = $this->Beneficiary_Model->saverecords($data);
			
            if ($resp == true) {
				redirect('BeneficiaryIndex');		
            }
		}	
	}
	
	public function GetDataList(){		
		$data = $this->Beneficiary_Model->GetList();
        echo json_encode($data);
	}
	
	//for delete func
	public function upd_data($id){
		$response=$this->Beneficiary_Model->updatedata($id);
		 if ($response == true) {
			$this->load->view('Beneficiaries_Table_View.php');
		}
	}
				
		///////update data://///////
	public function updatedata($id) {
		$data['response'] = $this->Beneficiary_Model->select($id);
		$data['form_action'] = base_url('Beneficiary_Controller/upd/' . $id); 
		$this->load->view('Beneficiary_UpdateForm.php', $data);
	}

	public function upd($id) {
		$update_data = array(
			'id' => $id,
			'beneficiary_id' => $this->input->post('beneficiary_id'),
			'fullname' => $this->input->post('fullname'),
			//'masjid_id' => $this->input->post('masjid_id'),
			'age' => $this->input->post('age'),
			'password' => $this->input->post('password'),
			'citizen' => $this->input->post('citizen'),
			'nationality' => $this->input->post('nationality'),
			'unit_number' => $this->input->post('unit_number'),
			'postal_code' => $this->input->post('postal_code'),
			'contact_number' => $this->input->post('contact_number'),
			//'annual_income' => $this->input->post('annual_income'),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),	
		);

		$res = $this->Beneficiary_Model->update_data($update_data);	
		if ($res) {
				$this->load->view('Beneficiaries_Table_View.php');
		} 
	}
		
}
?>