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
		if ($userData) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			//return redirect('login');
		}
		//print_r($masjid_id);
		//die();
?>
<form  method="POST" action="<?php echo base_url("createVendor");?>" ><br>

<div class="wrapper" >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >FILL YOUR DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Vendor ID</b></label>
											<input type="text"  name="vendor_id" id="vendor_id"  class="form-control" readonly >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Password</b></label>
											<input type="password"  name="password"  class="form-control" required>
										</div>
									</div>									
								</div><br>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid ID</b></label>
											<input type="text"  name="masjid_id"  value="<?php echo $masjid_id; ?>" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Shop Name</b></label>
											<input type="text"  name="shop_name"  class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Contact number</b></label>
											<input type="text" name="contact_number"  class="form-control" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" required>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Contact Person</b></label>
											<input type="text"  name="contact_person"  class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Nature of Business</b></label>
											<input type="text" name="nature_of_business"   class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Postal Code</b></label>
											<input type="text" name="postal_code"  class="form-control" required>
										</div>
									</div>
									

								</div><br>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="bmd-label-floating"><b>Operating Hours</b></label>
											<div class="form-group bmd-form-group">
												<textarea class="form-control" name="operating_hours"    placeholder="Type Your Area,State,Pincode" rows="2" required></textarea>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
												<label class="bmd-label-floating"><b> Address 1</b></label>
											<div class="form-group bmd-form-group">
													<textarea class="form-control" name="address_1" placeholder="Type Your Area,State,Pincode" rows="2" required></textarea>
											</div>
										</div>
									</div>
									<div class="col-md-4">
											<div class="form-group">
												<label><b> Address 2</b></label>
												<div class="form-group bmd-form-group">
													<textarea class="form-control" name="address_2"  placeholder="Type Your Area,State,Pincode" rows="2" ></textarea>
												</div>
											</div>
									</div>
								</div><br>
								<input type="submit"  class="btn btn-primary" name="submit" value="submit">
								<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("VendorIndex"); ?>'">Close</button>
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

function generateRandomNumber(vendor_id) {
  const min = 100000;
  const max = 999999;
  // Generate a random number
  const randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;

  // Display the generated number in the textbox
  document.getElementById('vendor_id').value = vendor_id + randomNumber;
}

// Call the function with your BNFID when the page loads
generateRandomNumber('VNID');

</script>
</html> 


