<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settlement_Controller extends CI_controller{	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Settlement_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->library('session');
		$this->load->library('form_validation');
		
		
		$userData = $this->session->userdata('user_data');
		if (empty($userData)) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			return redirect('login');
		}
	}
	
	public function SettlementList(){
        $this->load->view('Settlement_Table_View');
	}
	
	public function GetVouchersList(){
		$data = $this->Settlement_Model->GetList();
        echo json_encode($data);
	}
	
	//for update Settlement Status 
	public function Approvalupdate($transaction_id){
		$response=$this->Settlement_Model->UpdateApproval($transaction_id);
		 if ($response == true) {	 
			$this->load->view('Settlement_Table_View.php');
		}
	}
	
	//for update Settlement Status
	public function SettlementUpdate($id){
		$response=$this->Settlement_Model->UpdateSettlement($id);
		 if ($response == true) {
			$this->load->view('Settlement_Table_View.php');
		}
	}
	
	public function BulkApproval() {
	  if($this->input->post('checkbox_value')){
		   $transaction_id = $this->input->post('checkbox_value');
		   //print_r($payment_request_id);
		   //die();
		   for($count = 0; $count < count($transaction_id); $count++){
				$this->Settlement_Model->UpdateApprovalStatus($transaction_id[$count]);
		   }
		}
	}
	
	public function BulkSettlement() {
	  if($this->input->post('checkbox_value')){
		   $transaction_id = $this->input->post('checkbox_value');
		   //print_r($payment_request_id);
		   //die();
		   for($count = 0; $count < count($transaction_id); $count++){
				$this->Settlement_Model->UpdateSettledStatus($transaction_id[$count]);
		   }
		}
	}
	
	public function VouchersDetails(){
		$this->load->view('Vouchers_details_View.php');
	}
}
?>