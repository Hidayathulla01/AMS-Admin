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
</style>
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

<form  method="POST" action="<?php echo base_url("createFund");?>" ><br>

<div class="wrapper " >
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >ALLOCATE FUND DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="masjid_id" class="bmd-label-floating" for="masjid_id"><b>Masjid Name</b></label>
											<select class="form-select form-control" aria-label="Default select example" name="masjid_id" required>
											<option  placeholder="">Select Masjid Name</option>
												<?php 
												$query = $this->db->select('masjid_name,masjid_id')
																->from('tb_masjids')
																->where('status','1')
																->order_by('masjid_name','ASC')
																->get();
																
												$result=$query->result_array();
														
												foreach($result as $row){
													$masjid_name = $row['masjid_name'];
													$masjid_id = $row['masjid_id'];
													echo'<option value="'.$masjid_id.'">'.$masjid_name.'</option>';
												}
												?> 
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating"><b>Fund Allocation(S$)</b></label>
											<input type="text" name="fund_allocation" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
										</div>
									</div>
									</div><br>
										<div class="col-md-6">
											<div class="form-group bmd-form-group">
												<label class="bmd-label-floating"><b>For The Year</b></label>
												<input type="number" name="for_the_year" placeholder="YYYY" min="2024" max="2074" class="form-control" >
											</div>
										</div>
										 <input type="submit"  class="btn btn-primary " name="submit" value="submit">
										 <button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("FundsIndex"); ?>'">Close
										</button>
									</div>
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


