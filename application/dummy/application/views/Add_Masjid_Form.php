<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

<form   method="POST" action="<?php echo base_url("Masjid_Controller/add");?>" ><br>
  

<div class="wrapper" >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >FILL MASJID DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid ID</b></label>
											<input type="text"  name="masjid_id"  class="form-control" required>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Masjid Name</b></label>
											<input type="text"  id="masjid_name" name="masjid_name"  class="form-control" >
										</div>
									</div>
								</div><br>
								<div class="col-md-8">
									<div class="form-group">
										<label><b>Location</b></label>
										<div class="form-group bmd-form-group">
											<textarea class="form-control" name="masjid_location" rows="3" ></textarea>
										</div>
									</div>
								</div><br>
								<input type="submit"  class="btn btn-primary" id="submitbtn" name="submit" value="submit">
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

<script>
$('#submitbtn').click(function (event) {
		masjid_name = $('#masjid_name').val();			
		if ($.trim(masjid_name).length === 0){			
			$('#masjid_name').val('');				
			$("#masjid_name").attr('required', true);
			event.preventDefault();	 // If (data.exists) is TRUE, prevent form submission				
		//return false;
		}
});
</script>
</html> 


