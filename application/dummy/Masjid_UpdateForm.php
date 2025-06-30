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
	width: 85%;
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
<form   action="<?php echo $formAction;?>" method="POST"><br>
<div class="wrapper" >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >UPDATE MASJID DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid ID</b></label>
											<input type="text"  name="masjid_id"  value="<?php echo $response->masjid_id; ?>" class="form-control" readonly>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid Name</b></label>
											<input type="text"  name="masjid_name" value="<?php echo $response->masjid_name; ?>" class="form-control" >
										</div>
									</div>
								</div><br>
								<div class="col-md-8">
									<div class="form-group">
										<label><b>Location</b></label>
										<div class="form-group bmd-form-group">
											<textarea class="form-control" name="masjid_location" rows="3" ><?php echo isset($response->masjid_location) ? htmlspecialchars($response->masjid_location) : ''; ?></textarea>
										</div>
									</div>
								</div><br>
								<input type="submit"  class="btn btn-primary " name="submit" value="Update">
								<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("MasjidIndex"); ?>'">Close</button>
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
