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
.Benifi{
	padding:15px;
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
	
	/*  // Fetch masjid_name based on the selected masjid_id from the database
        $query = $this->db->select('masjid_name')
            ->from('tb_masjids')
            ->where('masjid_id', $masjid_id)
            ->get();

        $result = $query->row_array();
        $masjid_name = $result['masjid_name']; */
			
?>

<form  method="POST" action="<?php echo base_url("Users_Controller/add");?>" onsubmit="return validateForm()"><br>
<div class="wrapper " >
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
											<label for="user_id" class="bmd-label-floating"><b>User-Id</b></label>
											<input type="text"  name="user_id" id="user_id"  class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="password" class="bmd-label-floating"><b>Password</b></label>
											<input type="password"  name="password" class="form-control" required>
										</div>
									</div>	
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group bmd-form-group">
											<label for="fullname" class="bmd-label-floating"><b>Full Name</b></label>
											<input type="text"  name="fullname"  class="form-control" required>
										</div>
									</div>
									<?php 
									if($username=='admin'){
									?>
									<div class="col-md-6">
										<label for="masjid_id" class="bmd-label-floating" for="masjid_id"><b>Masjid Name</b></label>
										<select class="form-select form-control" aria-label="Default select example" name="masjid_id" required>
										<option  placeholder="">Select Your Masjid Name</option>
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
														<th>Access Type And Permission &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="SelectAll" name="SelectAll[]" id="SelectAll" value="">&nbsp;&nbsp;Select All</th>
													</tr>
												</thead>
												<tbody>
												<tr>
													<td>Masjids Management </td>
													<td>
													<input type="checkbox" name="Masjids[]" value="View">&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Masjids[]" value="Add">&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Masjids[]" value="Edit">&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Masjids[]" value="Delete">&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Beneficiaries Management </td>
													<td>
													<input type="checkbox" name="Beneficiary[]" value="View">&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Add">&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Edit">&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Beneficiary[]" value="Delete">&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Vendors Management </td>
													<td>
													<input type="checkbox" name="Vendors[]" value="View">&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Add">&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Edit">&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Vendors[]" value="Delete">&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>E-Vouchers Management </td>
													<td>
													<input type="checkbox" name="Voucher[]" value="View">&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Add">&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Edit">&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Voucher[]" value="Delete">&nbsp;&nbsp; Delete
													</td>
												</tr>
												<tr>
													<td>Users Management </td>
													<td>
													<input type="checkbox" name="Users[]" value="View">&nbsp;&nbsp; View &nbsp;&nbsp;
													<input type="checkbox" name="Users[]" value="Add">&nbsp;&nbsp; Add &nbsp;&nbsp;
													<input type="checkbox" name="Users[]" value="Edit">&nbsp;&nbsp; Edit &nbsp;&nbsp;
													<input type="checkbox" name="Users[]" value="Delete">&nbsp;&nbsp; Delete
													</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								    <input type="submit"  class="btn btn-primary " name="submit" id="Validation" value="submit">
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
</div>
</form>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
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
  
  
function confirmDelete(deleteUrl) {
	
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}
$(document).ready(function () {
        $("#Validation").click(function () {
            $("#myModal").load("<?php echo base_url("Users_Controller/add");?>", function () {
				alert("This User Already Exist");
                $("#myModal").modal("show");
				
            });
        });
    });

    //alert('User ID already exists. Please choose a different one.');
</script>


