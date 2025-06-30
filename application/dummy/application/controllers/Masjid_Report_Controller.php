<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid_Report_Controller  extends CI_controller{
	
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
		$this->load->model('Masjid_Report_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}	
	
	public function MasjidReport(){
        $this->load->view('MasjidsReport_Table_View');
	}	
	
	public function GetListReport(){
		$data = $this->Masjid_Report_Model->ViewMasjids();
        echo json_encode($data);
	}
	
	public function ExportMasjids() {
    // create file name
        $fileName = 'data-'.time().'.xlsx';  
        $ResultNew['report_data'] = $this->Masjid_Report_Model->MasjidList();
		$this->load->view('Masjids_Report_ExportView.php',$ResultNew);       
    }
}
?>