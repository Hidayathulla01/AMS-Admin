<?php
defined('BASEPATH') OR exit('NO direct script access allowed');

class Settlement_Model extends CI_Model {
	function __construct(){			
		parent::__construct();      
			//$this->tb_vouchers = 'tb_vouchers';
			//$this->tb_payments = 'tb_payments';
			$this->tb_payments = 'tb_transactions';
	}
	
	public function GetList(){
		$userData = $this->session->userdata('user_data');
		$username = $userData['user_id'];
		$masjid_id = $userData['masjid_id'];
		
		$this->db->select("*");
		$this->db->from($this->tb_transactions);
		$where_array = array("status" => 1);		
		$this->db->where($where_array); 
		$query = $this->db->get();
		$result = $query->result_array();
		$data1 = array();
		//$counter = 1;
		foreach ($result as $row) {
			//$id;
			//$payment_request_id = $row['payment_request_id'];
			$transaction_id = $row['transaction_id'];
			$masjid_id = $row['masjid_id'];
			$beneficiary_id = $row['beneficiary_id'];
			$voucher_number = $row['voucher_number'];
			$vendor_id = $row['vendor_id'];
			$Voucher_value = $row['Voucher_value'];
			$request_status = $row['request_status'];
			if($request_status=='1'){
				$Approval = base_url('Settlement_Controller/Approvalupdate').'/'.$transaction_id;
				$ApprovalLink = '<button class="btn-sm btn btn-danger" href="#" onclick="Approval(\''.$Approval.'\')"" style="display:block;float:left;width:120px;"> SUBMITTED</button>';				$voucher_status = $ApprovalLink;
			}
			elseif($request_status=='2'){
				 $Settlement = base_url('Settlement_Controller/SettlementUpdate').'/'.$transaction_id;
				$SettlementLink = '<button class="btn-sm btn btn-primary" href="#" onclick="Settlement(\''.$Settlement.'\')"" style="display:block;float:left; width:120px;"> APPROVED</button>';				$voucher_status = $SettlementLink;
			}
			elseif($request_status=='3'){
				$Settled = '<button class="btn-sm btn btn-success" href="#" onclick="" style="width:120px; display:block; float:left;"> SETTLED</button>';
				$request_status = $Settled;
			}
			$TransactionDetails ='<br><a href="#" onclick="VouchersDetails(\''.$transaction_id.'\')">Details</a>';
			
			//$no_of_vouchers = $row['no_of_vouchers'];	
			//$remark = $row['remark'];	
			
			$row = array();
			//$row[] = $counter;
			//$row[] = $id . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="Approval" id="Approval' . $id . '" value="' . $transaction_id . '" name="checkbox[]">';
			//$row[] = $payment_request_id;
			$row[] = $transaction_id;
			$row[] = $masjid_id;
			$row[] = $beneficiary_id;
			$row[] = $voucher_number;
			$row[] = $vendor_id;
			$row[] = $Voucher_value;
			$row[] = $request_status;
			$row[] = $TransactionDetails;
			//$row[] = $no_of_vouchers;
			//$row[] = $remark;	
			$data1[] = $row;
			//$counter++;
		}
		
		$output = array("data" => $data1);
		return $output;
	}
	
	public function UpdateApproval($transaction_id){
		$where_array_upd = array("transaction_id" => $transaction_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_transactions, array("request_status" => 2));
		return true;
	}
	
	public function UpdateSettlement($transaction_id){
		$where_array_upd = array("transaction_id" => $transaction_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tb_transactions, array("request_status" => 3));
		return true;
	}
	
	public function UpdateApprovalStatus($transaction_id){
		$datetime = date('Y-m-d H:i:s');
		$this->db->set('request_status', 2);
		$this->db->set('approval_date', $datetime);
		$this->db->where('request_status', 1);
		$this->db->where_in('transaction_id', $transaction_id);
		$this->db->update('tb_transactions');
		//print_r($this->db->last_query());
	}
	
	public function UpdateSettledStatus($transaction_id){
		$this->db->set('request_status', 3);
		$this->db->where('request_status', 2);
		$this->db->where_in('transaction_id', $transaction_id);
		$this->db->update('tb_transactions');
	}
}
?>