<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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


<form  id="AddForm" method="POST" action="<?php echo base_url("createVoucher");?>" ><br>
<div class="wrapper" >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >CREATE MANUAL VOUCHER HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
							<label for="TotalFund" class="bmd-label-floating"><b>Available Funds</b></label>
							<input class="form-control" id="AvailFund1" readonly><br><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label  class="bmd-label-floating1"><b>Voucher Number</b></label>
											<input type="text"  name="voucher_number" value="<?php echo isset($masjid_id) ? $masjid_id : ''; ?>"  id="voucher_number" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="value" class="bmd-label-floating"><b>Value of Voucher</b></label>
											<input type="text" name="value"  id="VoucherValue" class="form-control" autocomplete="off" value="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
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
											<input type="date" name="expiry_date" class="form-control" value="<?php echo $expiryDate; ?>" >
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
										<select class="form-select" name="beneficiary_id"  style="width:100%;" id="beneficiary_id" onchange="fetch_select(this.value);" onclick="fetch_select(this.value);" required>
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
											<input type="text" name="contact_number" id="contact_number" class="form-control" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div  class="form-group">
											<label for="address1" class="bmd-label-floating"><b>Address 1</b></label>
											<div  class="form-group bmd-form-group">
												<textarea class="form-control" name="address1" id="address1" placeholder="Type Your Area,State,Pincode" rows="3" readonly></textarea>
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

	 //Auto generate the voucher number
	function generateRandomNumber() {
	  const min = 10000; 
	  const max = 99999; 

	  // Generate a random 10-digit number
	  const randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
	  var data = document.getElementById('voucher_number').value;
	  //alert(data+'s');
	 
	  // Display the generated number in the textbox
	  document.getElementById('voucher_number').value = data + randomNumber;
	}

	// Call the function to generate the number when the page loads
	generateRandomNumber();

	//fetch the address and contact_number:
	function fetch_select(val){
			
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
					 var contact_number = data[0].contact_number;
					 var address1 = data[0].address1;
					//alert(contact_number);
					console.log(data);
					$("#contact_number").val(contact_number);
					$("#address1").val(address1);
				}
			});
	}
	$('#AddForm').submit(function(event) {
    // Get the values
	var AvailFundString = $('#AvailFund1').val();
	var AvailFund = parseFloat(AvailFundString.replace("S$", "").replace(/,/g, '')); // Removing "S$" and commas
    var VoucherValue = parseInt($('#VoucherValue').val(),10);

   alert(VoucherValue);
    // Compare the values
     if (AvailFund < VoucherValue) {
		alert('Your Available fund is S$'+AvailFund+' Kindly modify the voucher number or value within the available fund limit.');
      event.preventDefault();
    }
  });
	

</script>

</html> 


