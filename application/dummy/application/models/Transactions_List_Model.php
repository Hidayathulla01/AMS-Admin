<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Transactions_List_Model extends CI_Model {

	function __construct(){			
		parent::__construct();      
			$this->tb_vouchers = 'tb_vouchers';
			$this->tb_transactions = 'tb_transactions';
	}
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
		$this->db->select("*");
		$this->db->from($this->tb_transactions);
		if($username == 'admin'){
			$where_array = array("status" => 1);
		}else{
			$where_array = array("status" => 1,"masjid_id" => $masjid_id);
		}
		$this->db->where($where_array); 
		$query = $this->db->get();
		$result = $query->result_array();
		//print_r($result);
		//die();
		$data1 = array();
		$counter = 1;
		foreach ($result as $row) {
			$id = $row['id'];
			$beneficiary_id = $row['beneficiary_id'];
			$masjid_id = $row['masjid_id'];
			$voucher_number = $row['voucher_number'];
			$value = $row['value'];
			$created_date = $row['created_date'];
			$payment_status = $row['payment_status'];
			 
		    if($payment_status=='1'){
				$payment_status = 'Redeemed';
			}
			elseif($payment_status=='2'){
				$payment_status = 'Settlement Requested';
			}
			elseif($payment_status=='3'){
				$payment_status = 'Payment In Progress';
			}
			elseif($payment_status=='4'){
				$payment_status = 'Payment Completed';
			}
			elseif($payment_status=='5'){
				$payment_status = 'Expired';
			}
			
			$row = array();
			$row[] = $counter;
			$row[] = $beneficiary_id;
			$row[] = $masjid_id;
			$row[] = $voucher_number; 
			$row[] = $value;
			$row[] = $created_date;
			$row[] = $payment_status;
			$data1[] = $row;
			$counter++;
		}    
		$output = array("data" => $data1);
		return $output;
	}
}
?>