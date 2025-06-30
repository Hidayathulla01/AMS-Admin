<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<style>

body {
  margin: 0;
  padding: 0;
}
.home-section nav {
  width: 100px;
  margin-left: -47px; / Adjust the margin value as needed /
}
form{
	position: fixed;
	margin-left: 15%;
	height: 100%;
	width: 85%;
	background:#fffff;
	transition: all 0.5s ease;
}
.card-body{
	background: rgba(39, 63, 107,0.2);
}
.container{
	font-size: 14px;
}
label.bmd-label-floating::after {
  content: " *";
  color: red;
}
</style>
</head>
<body>

<?php 
$CI = get_instance();
	$userData = $CI->session->userdata('user_data');
	
	$username = $userData['user_id'];
	$masjid_id = $userData['masjid_id'];
	
//die($response);
?>
<form id="UpdateForm"   action="<?php echo $form_action;?>" method="POST"><br
<div class="wrapper">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >FILL YOUR DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
							<label for="TotalFund" class="bmd-label-floating"><b>Available Funds</b></label>
							<input class="form-control" id="AvailFund2" readonly><br><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label  class="bmd-label-floating1"><b>Voucher Number</b></label>
											<input type="text"  name="voucher_number" value="<?php echo $response->voucher_number; ?>"  id="voucher_number" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="value" class="bmd-label-floating"><b>Value of Voucher</b></label>
											<input type="text" name="value" id="voucher_value" value="<?php echo $response->value; ?>"  class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating1"><b>Number of Vouchers</b></label>
											<input type="text" name="no_of_voucher" id="no_of_voucher" autocomplete="off" class="form-control" value="1" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
										<label class="bmd-label-floating1"><b>Expiry Date</b></label>
											<?php
											$expiryDate = date('Y-m-d', strtotime('+6 months'));
											?>
											<input type="date" name="expiry_date" class="form-control" 
											value="<?php  $expiryDate = date('Y-m-d', strtotime($response->expiry_date)); 
											echo $expiryDate; ?>" >
										</div>
									</div>
								</div><br>
								<div class="row">
								<div class="col-md-6">
										<label for="masjid_id" class="bmd-label-floating" for="masjid_id"><b>Masjid Name</b></label>
										<input type="text" name="masjid_id"  value="<?php echo $response->masjid_id; ?>" class="form-control" readonly>
									</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="beneficiary_id" class="bmd-label-floating"><b>Beneficiary ID</b></label>
										<select class="form-select" name="beneficiary_id"  style="width:100%;" id="beneficiary_id" onchange="fetch_select(this.value);" onclick="fetch_select(this.value);" required>
											  <option value="<?php echo $response->beneficiary_id; ?>" >Select Beneficiary</option>
											<?php 
												$Beneficiary_info = $this->db->select('beneficiary_id,fullname')
																->from('tb_beneficiary')
																->where('status','1')
																->where('masjid_id', $masjid_id)
																->where('masjid_id',$masjid_id)
																->order_by('beneficiary_id','ASC')
																->get();
												$Beneficiary_Rslt = $Beneficiary_info->result_array();
												//print_r($Beneficiary_Rslt);
												foreach($Beneficiary_Rslt as $row){												
													$beneficiary_id = trim($row['beneficiary_id']);
													$fullname = trim($row['fullname']);
													echo'<option value="'.$beneficiary_id.'"';
													if($beneficiary_id == $response->beneficiary_id){echo "selected";}
													echo'>'.$fullname. ' - ' . $beneficiary_id .'</option>';
												}
											?>
											</select>
										</div>
									</div>
									</div><br>
									<div class="row">
									<div class="col-md-6">
										<div  class="form-group bmd-form-group">
											<label for="contact_number" class="bmd-label-floating"><b>Contact number</b></label>
											<input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo $response->contact_number; ?>" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div  class="form-group">
											<label for="address1" class="bmd-label-floating"><b>Address 1</b></label>
											<div  class="form-group bmd-form-group">
												<textarea class="form-control" name="address1" id="address1" placeholder="Type Your Area,State,Pincode" rows="3" readonly><?php echo isset($response->address1) ? htmlspecialchars($response->address1) : ''; ?></textarea>
											</div>
										</div>
									</div>
									</div><br>
								<input type="submit"  class="btn btn-primary" name="Update" value="Update">
								<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("VoucherIndex"); ?>'">Close
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<script>
//fetch the address and contact_number:/*
function fetch_select(val){
	var BenId = $("#beneficiary_id").val();
	var url = '<?php echo base_url('GetBeneficiaryData') ?>';
		$.ajax({
			type: "POST",
			url: url,
			data: {
				BeneifId: BenId
			},
			 dataType: "json",
			success: function(data){
				//alert(data);
				var contact_number = data[0].contact_number;
				 var address1 = data[0].address1;
				//alert(contact_number);
				console.log(data);
				$("#contact_number").val(contact_number);
				$("#address1").val(address1);
		}
	});
}

//function for Alert low Available amount:
$(document).ready(function() {
  $('#UpdateForm').submit(function(event) {
    // Get the values of the AvailFund and voucher_value  fields    
	var AvailFundString = $('#AvailFund2').val();
	var AvailFund = parseFloat(AvailFundString.replace("S$", "").replace(/,/g, '')); // Removing "S$" and commas
    var VoucherValue = parseInt($('#voucher_value').val(), 10);
   
    // Compare the values
     if (AvailFund < VoucherValue) {
		alert('Your Available fund is $'+AvailFund+' Kindly modify the voucher number or value within the available fund limit.');
      event.preventDefault();
    } 
    
  });
});
</script>
</body>
</html>

