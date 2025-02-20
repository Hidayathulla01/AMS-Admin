<!DOCTYPE html>
<html>
<head>
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
</head>

<?php 
	$CI = get_instance();
	$userData = $CI->session->userdata('user_data');
		
	$username = $userData['user_id'];
	$masjid_id = $userData['masjid_id'];
	
	/*  // Fetch masjid_name based on the selected masjid_id from the database
        $query = $this->db->select('masjid_name')
            ->from('tb_masjids')
            ->where('masjid_id', $masjid_id)
            ->get();

        $result = $query->row_array();
        $masjid_name = $result['masjid_name']; */
			
?>
<body>	
<form   action="<?php echo $formAction;?>" method="POST"><br>
<div class="wrapper">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary" style="background-color:#223A68;">
							<h4 class="card-title" style="color:#ffffff;" >UPDATE USER DETAILS HERE</h4>
						</div>
						<div class="card-body">
							<form><br>
								<div class="row">
										<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="user_id" class="bmd-label-floating"><b>User-Id</b></label>
											<input type="text"  name="user_id"  value="<?php echo $response->user_id; ?>" class="form-control" readonly>
										</div>
									</div><br>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="password" class="bmd-label-floating"><b>Password</b></label>
										<input type="password"  name="password"  value="<?php echo $response->password; ?>" class="form-control">
										</div>
									</div>
									</div><br>
									<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="fullname"  class="bmd-label-floating"><b>Full Name</b></label>
											<input type="text"  name="fullname"  value="<?php echo $response->fullname; ?>" class="form-control" >
										</div>
									</div>
									<?php 
									if($username=='admin'){
									?>
									<div class="col-md-6">
										<label for="masjid_id"><b>Masjid Name</b></label>
										<select class="form-select" name="masjid_id" id="masjid_id" >
										<option  placeholder="" readonly>Select Your Masjid Name</option>
										<?php 
												 $query = $this->db->select('masjid_name,masjid_id')
														->from('tb_masjids')
														->where('status','1')
														->order_by('masjid_name','ASC')
														->get();

											$result = $query->result();

											foreach ($result as $row) {
												$masjid_name = $row->masjid_name;
												$masjid_id = $row->masjid_id;

												echo '<option value="' . $masjid_id . '"';
												if ($masjid_id == $response->masjid_id) {
													echo "selected";
												}
												echo '>' . $masjid_name . '</option>';
											}
											
											?>
										</select>									
									</div><br>
									<?php 
									}									
									else{
									?>
									<div class="col-md-6">
										<label for="masjid_id" class="bmd-label-floating" for="masjid_id"><b>Masjid ID</b></label>
										<input type="text" name="masjid_id"  value="<?php echo $masjid_id; ?>" class="form-control" readonly>
									</div>
									<?php 
									}
									?>
								</div>
									<hr>
									<div class="mb-3 row">
										<div class="col-sm-12">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Page Name</th>
														<th>Access Type And Permission&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="SelectAll" name="SelectAll[]" id="SelectAll" value=""<?php 
														if (
															strpos($response->masjid_management, 'View,Add,Edit,Delete') !== false &&
															strpos($response->beneficiary_management, 'View,Add,Edit,Delete') !== false &&
															strpos($response->vendors_management, 'View,Add,Edit,Delete') !== false &&
															strpos($response->vouchers_management, 'View,Add,Edit,Delete') !== false &&
															strpos($response->users_management, 'View,Add,Edit,Delete') !== false
														) {
															echo 'checked';
														}
														?>>&nbsp;&nbsp;Select All</th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td>Masjids Management </td>
													<td>
													<input type="checkbox" name="Masjids[]" value="View" <?php if (strpos($response->masjid_management, 'View') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; View &nbsp;&nbsp;
													
													<input type="checkbox" name="Masjids[]" value="Add" <?php if (strpos($response->masjid_management, 'Add') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Add &nbsp;&nbsp;
													
													<input type="checkbox" name="Masjids[]" value="Edit" <?php if (strpos($response->masjid_management, 'Edit') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Edit &nbsp;&nbsp;
													
													<input type="checkbox" name="Masjids[]" value="Delete" <?php if (strpos($response->masjid_management, 'Delete') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Beneficiaries Management </td>
													<td>
													<input type="checkbox" name="Beneficiary[]" value="View"<?php if (strpos($response->beneficiary_management, 'View') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Add"<?php if (strpos($response->beneficiary_management, 'Add') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Edit"<?php if (strpos($response->beneficiary_management, 'Edit') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Delete"<?php if (strpos($response->beneficiary_management, 'Delete') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Vendors Management </td>
													<td>
													<input type="checkbox" name="Vendors[]" value="View"<?php if (strpos($response->vendors_management, 'View') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Add"<?php if (strpos($response->vendors_management, 'Add') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Edit"<?php if (strpos($response->vendors_management, 'Edit') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Delete"<?php if (strpos($response->vendors_management, 'Delete') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>E-Vouchers Management </td>
													<td>
													<input type="checkbox" name="Voucher[]" value="View"<?php if (strpos($response->vouchers_management, 'View') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Add"<?php if (strpos($response->vouchers_management, 'Add') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Edit"<?php if (strpos($response->vouchers_management, 'Edit') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Delete"<?php if (strpos($response->vouchers_management, 'Delete') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Users Management </td>
													<td>
													<input type="checkbox" name="Users[]" value="View" <?php if (strpos($response->users_management, 'View') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; View &nbsp;&nbsp;
														
													<input type="checkbox" name="Users[]" value="Add" <?php if (strpos($response->users_management, 'Add') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Add &nbsp;&nbsp;
													
													<input type="checkbox" name="Users[]" value="Edit"<?php if (strpos($response->users_management, 'Edit') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Users[]" value="Delete"<?php if (strpos($response->users_management, 'Delete') !== false) {
														echo 'checked';
													} ?>>&nbsp;&nbsp; Delete
													</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								    <input type="submit"  class="btn btn-primary " name="Update" value="Update">
									<button class="btn btn-dark " style="margin-right: 10px" data-dismiss="modal" onclick="window.location.href='<?php echo base_url("UsersIndex"); ?>'">Close
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
</body>
</html> 
<script>
 // JavaScript to handle common "Select All" checkbox
    var selectAllCommonCheckbox = document.getElementById('SelectAll');
    selectAllCommonCheckbox.addEventListener('change', function () {
        var allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < allCheckboxes.length; i++) {
            allCheckboxes[i].checked = this.checked;
        }
		 });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // Attach a change event handler to all checkboxes
    $('input[type="checkbox"]').change(function() {
      // Check if any checkbox is unchecked
      var anyUnchecked = $('input[type="checkbox"]:not(#SelectAll):checked').length < $('input[type="checkbox"]:not(#SelectAll)').length;
      
      // Update the "Select All" checkbox accordingly
      $('#SelectAll').prop('checked', !anyUnchecked);
    });

    // Attach a change event handler to the "Select All" checkbox
    $('#SelectAll').change(function() {
      // Update all other checkboxes based on the "Select All" checkbox
      $('input[type="checkbox"]:not(#SelectAll)').prop('checked', this.checked);
    });
  });
</script>