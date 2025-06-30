<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
	   
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<body>
<style>

body {
  margin: 0;
  padding: 0;
  overflow-y: scroll;
}
.card-body{
	background: rgba(39, 63, 107,0.2);

}
.form{
	position: fixed;
	margin-top: 50px;
	margin-left: 15%;
	background: #ffffff;
	transition: all 0.5s ease;
    overflow-y: auto;
}
.container{
	font-size: 12px;
}
.btn{
	float: right;
	margin-top: 10px;
	color: #ffff;
}
table{
	font-size: 14px;
	
}
</style>
<?php
	$userData = $this->session->userdata('user_data');
	$username = $userData['user_id'];
		
	$sql = "SELECT * FROM tb_payments WHERE vendor_id = 'VNID001' AND voucher_status = '3'";
	$sql1 = "SELECT tb_payments.transaction_id,tb_payments.qr_token_id, tb_transactions.voucher_number FROM tb_payments inner JOIN tb_transactions ON tb_payments.qr_token_id = tb_transactions.qr_token_id";
	
		
	$qry = $this->db->query($sql);
	$result = $qry->result_array();
		//print_r($result);
		//die();
	foreach($result as $row){
		$GetId1 = $row['payment_request_id'];
		$GetId2 = $row['voucher_status'];
		$GetId3 = $row['req_date_time'];
		$GetId4 = $row['no_of_vouchers'];
		$GetId5 = $row['vendor_id'];
		$GetId6 = $row['total_amount'];
	}
		//print_r($masjid_id);
		//die();
?>

	<div style="height:200px;width:50%;" class="form">
		<div class="container">
			<table id="example" class="table table-striped">
				<thead>
					<tr>
						<th>No of Vouchers</th>
						<th>Voucher Number</th>
						<th>Value Of Voucher</th>
						<th>Payment Request Date</th>	
						<th>Transaction Status</th>
						<th>Total Amount(S$)</th>	
					</tr>
				</thead>
				<tbody>  
					<tr>
						<td><?php echo $GetId1; ?></td>
						<td><?php echo $GetId2; ?></td>
						<td><?php echo $GetId3; ?></td>
						<td><?php echo $GetId4;; ?></td>
						<td><?php echo $GetId5;; ?></td>
						<td><?php echo $GetId6;; ?></td>
					<tr>
				</tbody>
			</table>
			
			<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("SettlementList"); ?>'">Close
			</button>
		</div>
	</div><br>
</body>
<script type="text/javascript">

	$(document).ready(function() {
	var table; 
	table = $('#example').DataTable({
	} );
	} );
</script>
</html> 


