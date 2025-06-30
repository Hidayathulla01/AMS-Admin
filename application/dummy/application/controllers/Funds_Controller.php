<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funds_Controller extends CI_controller{
	
	public function __construct(){
		parent::__construct ();	
		$this->load->database();
		$this->load->model('Funds_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	
	public function FundsIndex(){
        $this->load->view('Funds_Table_View');
	}
	
//func for Add_Funds form page
	public function createFund(){
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];		
		$Username = $userData['user_id'];		
		
		$this->load->view('Add_Funds_Form');	
		if ($this->input->post('submit')) {
            $data['masjid_id'] = $this->input->post('masjid_id');
            $data['fund_allocation'] = $this->input->post('fund_allocation');
            $data['for_the_year'] = $this->input->post('for_the_year');
            $data['created_by'] = $Username;

            $resp = $this->Funds_Model->saverecords($data);
			
            if ($resp == true) {
				redirect('FundsIndex');		
            }
		}
	}
	
	public function GetFundList(){
		$data = $this->Funds_Model->GetList();
        echo json_encode($data);
	}
	
	/** UPDATE FUNCTION **/	
	public function updatedata($id) {
		$data['response'] = $this->Funds_Model->select($id);
		$data['formAction'] = base_url('Funds_Controller/updateFund/' . $id); 
		$this->load->view('Funds_Update_Form.php', $data);
	}

	public function updateFund($id) {
		$update_data = array(
		'id' => $id,
		'masjid_id' => $this->input->post('masjid_id'),
		'fund_allocation' => $this->input->post('fund_allocation'),
		'for_the_year' => $this->input->post('for_the_year')
	);
		//print_r($update_data);
		//die();

		$res = $this->Funds_Model->update_data($update_data);
		if ($res) {
			$this->load->view('Funds_Table_View.php');
		}
	}
}
?>