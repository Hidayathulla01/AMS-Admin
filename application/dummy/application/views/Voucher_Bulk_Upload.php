<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<style>

body {
  margin: 0;
  padding: 0;
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
	 <?php 
	$CI = get_instance();
	$userData = $CI->session->userdata('user_data');
	
	$username = $userData['user_id'];
	$masjid_id = $userData['masjid_id'];
?> 

<form id="AddBulkForm" method="POST" action="<?php echo base_url("BulkUpload");?>" ><br>
<div class="wrapper" >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >CREATE BULK VOUCHER HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
							
								<div class="row">
									<div style="display:none;" class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Voucher Number</b></label>
											<input type="text"  name="voucher_number" value="<?php echo isset($masjid_id) ? $masjid_id : ''; ?>"  id="voucher_number" class="form-control" readonly>
											<input type="text" id="hiddenResult" name="hiddenResult" value="">
										</div>
									</div>
								</div><br>
								<div class="row">
								<div class="col-md-6">
							<label for="AvailFund" class="bmd-label-floating"><b>Available Funds(S$)</b></label>
							<input class="form-control" id="AvailFund">
							</div>
								<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating1"><b>Number of Vouchers</b></label>
											<input type="text" name="no_of_voucher" id="no_of_voucher" autocomplete="off" class="form-control" required>
										</div>
									</div>
									
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="value" class="bmd-label-floating"><b>Value of Vouchers</b></label>
											<input type="text" name="value" id="value" autocomplete="off" class="form-control" value="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
										<label class="bmd-label-floating1"><b>Expiry Date</b></label>
											<?php
											$expiryDate = date('Y-m-d', strtotime('+6 months'));
											?>
											<input type="date" name="expiry_date" class="form-control" value="<?php echo $expiryDate; ?>">
										</div>
									</div>
									
								</div><br>
									<div class="row">
									<div class="col-md-6">
										<label for="masjid_id" class="bmd-label-floating" for="masjid_id"><b>Masjid Name</b></label>
										<input type="text" name="masjid_id"  value="<?php echo $masjid_id; ?>" class="form-control" readonly>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="beneficiary_id" class="bmd-label-floating"><b>Beneficiary ID</b></label>
											<select class="form-select" name="beneficiary_id" style="width:100%;" onchange="fetch_select1(this.value);" onclick="fetch_select1(this.value);" id="beneficiary_id" required>
											<option value="" >Select Beneficiary</option>
											<?php 
												$query = $this->db->select('fullname,beneficiary_id')
														->from('tb_beneficiary')
														->where('status','1')
														->where('masjid_id',$masjid_id)
														->order_by('fullname','ASC')
														->get();
														
												$result=$query->result_array();												
												foreach($result as $row){
													$fullname = $row['fullname'];
													$beneficiary_id = $row['beneficiary_id'];
													echo'<option value="'.$beneficiary_id.'">'.$fullname. ' - ' . $beneficiary_id .'</option>';
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
											<input type="text" name="contact_number" id="contact_number1" class="form-control" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" readonly >
										</div>
									</div>
									<div class="col-md-6">
										<div  class="form-group">
											<label for="address1" class="bmd-label-floating"><b>Address 1</b></label>
											<div  class="form-group bmd-form-group">
												<textarea class="form-control" name="address1" id="address12" placeholder="Type Your Area,State,Pincode" rows="3" readonly></textarea>
											</div>
										</div>
									</div>
									</div><br>
								<input type="submit"  class="btn btn-primary" name="submit" value="submit" />
								<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("VoucherIndex"); ?>'">Close</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
</body>
<script>
  
document.getElementById('no_of_voucher').addEventListener('keyup', function(event) {
  if (!isNaN(event.key)) {
        const min = 10000; 
        const max = 99999; 
        var no_of_voucher = document.getElementById('no_of_voucher').value;
        var voucher_number = document.getElementById('voucher_number').value;
        var result = '';

        for (var i = 0; i < no_of_voucher; i++) {
            const randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
            result += voucher_number + randomNumber + ', ';
//alert(result);			
	     }
		 
		 //for remove comma
        result = result.replace(/,\s*$/, '');
        document.getElementById('hiddenResult').value  = result;

        // Update the voucher_number input field with the concatenated result
        //document.getElementById('voucher_number').value = result;
        event.preventDefault();
    }
});

function fetch_select1(val){
		var BenId = $("#beneficiary_id").val();
		//alert(BenId);
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
				$("#contact_number1").val(contact_number);
				$("#address12").val(address1);
			}
		});
}

$(document).ready(function() {
  $('#AddBulkForm').submit(function(event) {
	var AvailFundString = $('#AvailFund').val();
	var AvailFund = parseFloat(AvailFundString.replace("S$", "").replace(/,/g, '')); // Removing "S$" and commas
	//alert(AvailFund);
	
    var TotalValueOfVoucher = parseInt($('#no_of_voucher').val(), 10) * parseInt($('#value').val(), 10); //get amt 
	
   if (AvailFund < TotalValueOfVoucher) {
	  alert('Your Available fund is $'+ AvailFund +' Kindly modify the voucher number or value within the available fund limit.');
      event.preventDefault();
    }
  });
});
</script>
</html> 


