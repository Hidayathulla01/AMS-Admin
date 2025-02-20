<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Controller  extends CI_controller{
	
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
		$this->load->model('Users_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}
	
	public function UsersIndex(){
        $this->load->view('Users_Table_View');
	}	
	
	public function add(){
		$this->load->library('session');
		$userData = $this->session->userdata('user_data');
		$masjid_id = $userData['masjid_id'];
		$this->load->view('Add_User_Form');	
        if ($this->input->post('submit')) {
            $user_id = $data['user_id'] = $this->input->post('user_id');
			if ($this->Users_Model->is_user_id_exists($user_id)) {
				//$this->session->set_flashdata('error', 'Invalid login. Please check the User Id and Password.');
				redirect('UsersIndex');
			}
            $data['fullname'] = $this->input->post('fullname');
            $data['masjid_id'] = $this->input->post('masjid_id');													   
            $data['password'] = $this->input->post('password');
			$data['created_by'] = $masjid_id;

			$resp = $this->Users_Model->save($data);
			
			$MasjidsPermission = $this->input->post('Masjids');			 
			foreach ($MasjidsPermission as $Masjidsvalue) {
				$MasjidsCheck .=  rtrim($Masjidsvalue . ',');
			}
		 
			$BeneficiaryPermission = $this->input->post('Beneficiary');			 
			foreach ($BeneficiaryPermission as $Beneficiaryvalue) {
				$BeneficiaryCheck .= $Beneficiaryvalue . ',';
			}
		 
		    $VendorsPermission = $this->input->post('Vendors');		 
			foreach ($VendorsPermission as $Vendorsvalue) {
				$VendorsCheck .= $Vendorsvalue . ',';
			}
		 
			$VouchersPermission = $this->input->post('Voucher');		 
			foreach ($VouchersPermission as $Vouchersvalue) {
				$VouchersCheck .= $Vouchersvalue . ',';
			}
		 
			$UsersPermission = $this->input->post('Users');		 
			foreach ($UsersPermission as $Usersvalue) {
				$UsersCheck .= $Usersvalue . ',';
			}
		 
			$AccessData['user_id'] = $this->input->post('user_id');
			$AccessData['created_by'] = $masjid_id;
			$AccessData['beneficiary_management'] = rtrim($BeneficiaryCheck, ',');
			$AccessData['masjid_management'] = rtrim($MasjidsCheck, ',');
			$AccessData['vendors_management'] = rtrim($VendorsCheck, ',');
			$AccessData['vouchers_management'] = rtrim($VouchersCheck, ',');
			$AccessData['users_management'] = rtrim($UsersCheck, ',');
		//print_r($AccessData);
		//die();
			$resp = $this->Users_Model->InsertAccess($AccessData);		 
			if ($resp == true) {
				redirect('UsersIndex');		
				 
			}
		}
	}
	
	public function UsersList(){		
		$data = $this->Users_Model->ViewUsers();
        echo json_encode($data);
	}
	
	//for delete func
	public function delete_user($id){
		$response=$this->Users_Model->del_user($id);
		 if ($response == true) {			 
			$this->load->view('Users_Table_View.php');
		}			
	}
	
	//for Update
	public function updatedata($id) {
		$data['response'] = $this->Users_Model->select($id);
		$data['formAction'] = base_url('Users_Controller/upd/' . $id); 
		$this->load->view('Users_UpdateForm.php', $data);
	}

	public function upd($id) {
		
		$update_data = array(
			'id' => $id,
			'user_id' => $this->input->post('user_id'),
			'password' => $this->input->post('password'),
			'fullname' => $this->input->post('fullname'),
			'masjid_id' => $this->input->post('masjid_id')
			
		);
		//print_r($update_data);
		//die();
		$response = $this->Users_Model->Update_UserInfo($update_data);
		
		
		$MasjidsPermission = $this->input->post('Masjids');			 
		foreach ($MasjidsPermission as $Masjidsvalue) {
			$MasjidsCheck .=  rtrim($Masjidsvalue . ',');
		}
		 
		$BeneficiaryPermission = $this->input->post('Beneficiary');		 
		foreach ($BeneficiaryPermission as $Beneficiaryvalue) {
			$BeneficiaryCheck .= $Beneficiaryvalue . ',';
		}
		 
		$VendorsPermission = $this->input->post('Vendors');		 
		foreach ($VendorsPermission as $Vendorsvalue) {
			$VendorsCheck .= $Vendorsvalue . ',';
		}
		 
		$VouchersPermission = $this->input->post('Voucher');		 
		foreach ($VouchersPermission as $Vouchersvalue) {
			$VouchersCheck .= $Vouchersvalue . ',';
		}
		 
		$UsersPermission = $this->input->post('Users');		 
		foreach ($UsersPermission as $Usersvalue) {
			$UsersCheck .= $Usersvalue . ',';
		}
		 
		$AccessData['user_id'] = $this->input->post('user_id');
		$AccessData['beneficiary_management'] = rtrim($BeneficiaryCheck, ',');
		$AccessData['masjid_management'] = rtrim($MasjidsCheck, ',');
		$AccessData['vendors_management'] = rtrim($VendorsCheck, ',');
		$AccessData['vouchers_management'] = rtrim($VouchersCheck, ',');
		$AccessData['users_management'] = rtrim($UsersCheck, ',');
		//print_r($AccessData);
		 // die();
		$resp = $this->Users_Model->updateAccess($AccessData);		
		if ($resp) {
			$this->load->view('Users_Table_View.php');
		}
	}
}