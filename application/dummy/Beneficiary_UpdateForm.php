<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<style>
body {
  margin: 0;
  padding: 0;
}
form{
	position: fixed;
	margin-left: 15%;
	height: 100%;
	width: 100%;
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
<body>	 
<form   action="<?php echo $form_action;?>" method="POST"><br>
  
<div class="wrapper " >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >UPDATE YOUR DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Beneficiary ID</b></label>
											<input type="text"  name="beneficiary_id"  value="<?php echo $response->beneficiary_id; ?>" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid ID</b></label>
											<input type="text"  name="masjid_id"  value="<?php echo $response->masjid_id; ?>" class="form-control" readonly>
										</div>
									</div>
									</div><br>
									<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Full Name</b></label>
											<input type="text"  name="fullname"  value="<?php echo $response->fullname; ?>" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Password</b></label>
											<input type="password"  name="password" value="<?php echo $response->password; ?>" class="form-control" required>
										</div>
									</div>
									</div><br>
									<div class="row">
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Unit Number</b></label>
											<input type="text" name="unit_number"  value="<?php echo $response->unit_number; ?>" class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Postal Code </b></label>
											<input type="text" name="postal_code"  value="<?php echo $response->postal_code; ?>" class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Contact number</b></label>
											<input type="text" name="contact_number"  value="<?php echo $response->contact_number; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9+]/g, '')" required>
										</div>
									</div>
								</div><br>								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="address1" class="bmd-label-floating"><b>Address 1</b></label>
											<div class="form-group bmd-form-group">
												<textarea class="form-control" name="address1" placeholder="Type Your Area, State, Pincode" rows="3" required><?php echo isset($response->address1) ? htmlspecialchars($response->address1) : ''; ?></textarea>
											</div>
										</div>
									</div> 
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Address 2</b></label>
											<div class="form-group bmd-form-group">
												<textarea class="form-control" name="address2" placeholder="Type Your Area, State, Pincode" rows="3"><?php echo isset($response->address2) ? htmlspecialchars($response->address2) : ''; ?></textarea>
											</div>
										</div>
									</div>								
								</div><br>
								<center><input type="submit"  class="btn btn-primary " name="Update" value="Update"></center>   
								<button class="btn btn-dark" style="margin-right: 10px"  data-dismiss="modal" onclick="window.location.href='<?php echo base_url("BeneficiaryIndex"); ?>'">Close
								</button>
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

</html> 
