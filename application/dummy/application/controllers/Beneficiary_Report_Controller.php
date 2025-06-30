<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiary_Report_Controller extends CI_controller{
	
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
		$this->load->model('Beneficiary_Report_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
	}
	
	public function BeneficiaryReport(){
        $this->load->view('Beneficiaries_Report_Table_View');
	}
	
	public function GetReport(){
		$data = $this->Beneficiary_Report_Model->GetList();
        echo json_encode($data);
	}
	
	public function Export() {
    // create file name
        $fileName = 'data-'.time().'.xlsx';  
        $ResultNew['report_data'] = $this->Beneficiary_Report_Model->BeneficiaryList();
		$this->load->view('Beneficiaries_Report_ExportView.php',$ResultNew);       
    }

}
?>