<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Masjid_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));		
	}	
	
	public function MasjidIndex(){
        $this->load->view('Masjid_Table_View');
	}	
	
	public function DashboardIndex(){
		$this->load->view('Dashboard.php');
	}	
	
	public function add(){
		$this->load->view('Add_Masjid_Form');	
        if ($this->input->post('submit')) {            		
            $data['masjid_name'] = $this->input->post('masjid_name');
            //$data['profile_picuture'] = $this->input->post('masjid_image');
			
			/**** Call the Helper for Profile pic Upload ****/
			$upload_result = upload_file('masjid_image', './assets/images/MasjidImage/');
			if ($upload_result['status']) {
				$data['profile_picture'] = $upload_result['file_path'];
			} else {
				log_message('error', 'Helper function reached: ' . $data);
				$this->session->set_flashdata('error', $upload_result['error']);
				// print_r( $upload_result['error']) ; die();
				redirect('MasjidIndex');
				return;
			} 
			$data['location'] = $this->input->post('location');
			$data['area'] = $this->input->post('area');			
			$data['country'] = $this->input->post('country');
            $data['contact_person'] = $this->input->post('contact_person');            
			$data['description'] = $this->input->post('description');
			$data['pincode'] = $this->input->post('pincode');
			$data['mobile_no'] = $this->input->post('mobile_no');
          //print_r($data) ; die();
            $resp = $this->Masjid_Model->savedata($data);
            if ($resp == true) {
				redirect('MasjidIndex');		
            }
		}
	}	
	
	public function GetList(){
		$data = $this->Masjid_Model->ViewMasjids();
        echo json_encode($data);
		//print_r($data);
	}
	
	/***for delete func ***/
	public function delete_id($masjid_id){
		$response=$this->Masjid_Model->del_data($masjid_id);
		 if ($response == true) {			 
			redirect('MasjidIndex');
		}		
	}
	
	//for Details-View Page
	public function MasjidDetails($masjid_id) {
		$data['response'] = $this->Masjid_Model->ViewDetails($masjid_id);
		$data['formAction'] = base_url('Masjid_Controller/upd/' . $masjid_id); 
		$this->load->view('Masjid_Details_View.php', $data);
	}	
	
	//for Update
	public function updatedata($masjid_id) {
		$data['response'] = $this->Masjid_Model->select($masjid_id);
		$data['formAction'] = base_url('Masjid_Controller/upd/' . $masjid_id); 
		$this->load->view('Masjid_UpdateForm.php', $data);
	}	
	
	public function upd($masjid_id) {
		$update_data = array(
			'masjid_id' => $masjid_id,
			'masjid_name' => $this->input->post('masjid_name'),
			'description' => $this->input->post('description'),
			'location' => $this->input->post('location'),
			'area' => $this->input->post('area'),
			'pincode' => $this->input->post('pincode'),
			'country' => $this->input->post('country'),
			'contact_person' => $this->input->post('contact_person'),
			'mobile_no' => $this->input->post('mobile_no')
		);
		
		$res = $this->Masjid_Model->update($update_data);
		if ($res) {
				redirect('MasjidIndex');
		} 
	}
}
?>