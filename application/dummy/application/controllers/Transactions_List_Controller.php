<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_List_Controller extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Transactions_List_Model');
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
	
	public function TransactionsList(){
        $this->load->view('Transactions_List_Table_View');
	}
	
	public function GetTransactionsList(){
		$data = $this->Transactions_List_Model->GetList();
        echo json_encode($data);
	}
	
	 public function ExportTransactions() {
    // create file name
        $fileName = 'data-'.time().'.xlsx';  
        $ResultNew['report_data'] = $this->Transactions_List_Model->TransactionsList();
		$this->load->view('Transactions_Report_ExportView.php',$ResultNew);       
    }
}

?>