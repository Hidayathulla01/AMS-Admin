<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title>Administrators</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<!-- Datatables -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<!-- Bootstrap core CSS -->
	<link href="./assets/dist/css/bootstrap5.css" rel="stylesheet">
	<link href="./assets/dist/css/dashboard.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
  <body>
    <!-- SideBar and Navbar -->
	<?php include('SideBar.php'); ?>
	
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 ">
      </div>
	  
     <!--  <h2>Section title</h2> -->
	<div class="dashboard-content">
	  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="<?php echo ('DashboardIndex');?>">Dashboard</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Administrators</li>
		</ol>
	  </nav>
	  <!-- <p class="fs-5">Dashboard / Adminstartors</p> -->
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Admins List</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addAdminCanvas" aria-controls="addAdminCanvas">
                    + Add Admin
                </button>
    </div>
    <hr class="dropdown-divider">
    <div class="table-responsive">
        <table id="example" class="table table-striped display nowrap">
            <thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Gender</th>
				<th scope="col">Email</th>
				<th scope="col">Mobile No</th>
				<th scope="col">Action</th>
			  </tr>
            </thead>
			<tbody>
				<?php 
					$i = 1;
					foreach ($AdminList as $Data) { ?>
					<tr>
						<td scope="col"><?php echo $i; ?></td>
						<td scope="col"><?php echo $Data['fullname']; ?></td>
						<td scope="col"><?php echo $Data['gender']; ?></td>
						<td scope="col"><?php echo $Data['email']; ?></td>
						<td scope="col"><?php echo $Data['mobile_no']; ?></td>
						<td class="action-btns">
							<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#ViewAdminCanvas"><i class="fas fa-eye"></i></a>
							<a  type="button" data-id="<?= $Data['admin_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editAdminCanvas"><i class="fas fa-pen"></i></a>
							<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['admin_id']; ?>">
							<i class="fas fa-trash"></i></a>
						</td>
					</tr>
				<?php
					$i++;
					} 
				?>
			</tbody>
        </table>
    </div>
</div>
		<!-- Offcanvas for Add Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="addAdminCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Add Administrator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST" class="needs-validation"  enctype="multipart/form-data" action="<?php echo ('AddAdmin');?>" novalidate>
                <!-- FrstName and LastName -->
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Full name" required>
						<div class="invalid-feedback">Please enter Valid Details</div>
                    </div>
					<div class="col-md-6 mb-3 required-label">
							<label for="email" class="form-label">EMAIL ID </label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                </div>
				<div class="row">
					<div class="col-md-6 mb-3 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control"  name="dob">
					</div>			
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label class="form-label">GENDER </label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" id="male"  value="male" required>
						   <label class="form-check-label" for="male">Male</label>
						   </div>
						<div class="form-check form-check-inline">
						   <input class="form-check-input" type="radio" name="gender" id="female"  value="female" required>
						   <label class="form-check-label" for="female">Female</label>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
						</div>
                    </div>
					<div class="col-md-6 mb-3">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="profile_picture">
					</div>
                </div>
                <div class="row">
					<div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" id="mobile" name="mobile_no" class="form-control">
                        </div>
                    </div>
					<div class="mb-3 col-md-6 mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address"></textarea>
					</div>
				</div>
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
		
		<!-- Offcanvas for Edit Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="editAdminCanvas" aria-labelledby="editAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editAdminCanvasLabel">Edit Administrator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
		<?php //pr(base_url($AdminList['profile_picture'])); ?>
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateAdminData');?>" class="needs-validation" novalidate>
                <!-- FrstName and LastName -->
				 <input type="hidden" name="admin_id" id="EditAdminId">
				<div class="text-center mb-3">
						<img id="profileImage" src="" class="rounded-circle border border-secondary" alt="Profile Image" width="100" height="100" style="border-radius:50%;">
					<input type="file" class="form-control mt-3 mx-auto" name="EditProfilePicture" id="EditProfilePicture" style="max-width: 300px;">
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="EditFullname" name="fullname" placeholder="Enter Full name" value="<?= isset($AdminList['fullname']) ? $AdminList['fullname'] : ''; ?>" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
					<div class="col-md-6 mb-3 required-label">
						<label for="email" class="form-label">EMAIL ID </label>
						<input type="email" class="form-control" id="EditEmail" name="email" placeholder="Enter email" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                </div>
				<div class="row">
					<div class="col-md-6 mb-3 required-label" style="position: relative;">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" id="EditPassword" name="password" placeholder="Enter password" required>
						<span id="toggleIcon" class="fas fa-eye" onclick="togglePasswordVisibility()" style="position: absolute; right: 25px; top: 40px; cursor: pointer;"></span>
						<div class="invalid-feedback">Please enter Valid Details.</div>	
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" id="EditDob" name="dob">
					</div>			
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label class="form-label">GENDER </label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="EditGender" id="EditGendermale"  value="male" required>
						   <label class="form-check-label" for="EditGendermale">Male</label>
						   </div>
						<div class="form-check form-check-inline">
						   <input class="form-check-input" type="radio" name="EditGender" id="EditGenderfemale"  value="female" required>
						   <label class="form-check-label" for="EditGenderfemale">Female</label>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
						</div>
                    </div>
					<div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" id="EditMobile" name="mobile_no" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
					<div class="mb-3 col-md-6 mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control" id="EditAddress" name="address" rows="3" placeholder="Enter address"></textarea>
					</div>
				</div>
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Editsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
		
		<!-- Offcanvas for View Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="ViewAdminCanvas" aria-labelledby="ViewAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="ViewAdminCanvasLabel">Edit Administrator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateAdminData');?>">
                <!-- FrstName and LastName -->
				 <input type="hidden" name="admin_id" id="ViewAdminId">
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="ViewFullname" name="fullname" placeholder="Enter Full name" value="<?= isset($AdminList['fullname']) ? $AdminList['fullname'] : ''; ?>" required>
                    </div>
					<div class="col-md-6 mb-3 required-label">
							<label for="email" class="form-label">EMAIL ID </label>
							<input type="email" class="form-control" id="ViewEmail" name="email" placeholder="Enter email" required>
					</div>
                </div>
				<div class="row">
					<div class="col-md-6 mb-3 required-label" style="position: relative;">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" id="ViewPassword" name="password" placeholder="Enter password" required>
						<span id="toggleIcon" class="fas fa-eye" onclick="togglePasswordVisibility()" style="position: absolute; right: 25px; top: 40px; cursor: pointer;"></span>						
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" id="ViewDob" name="dob">
					</div>			
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label class="form-label">GENDER </label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="ViewGender" id="ViewGendermale"  value="male" required>
						   <label class="form-check-label" for="EditGendermale">Male</label>
						   </div>
						<div class="form-check form-check-inline">
						   <input class="form-check-input" type="radio" name="ViewGender" id="ViewGenderfemale"  value="female" required>
						   <label class="form-check-label" for="EditGenderfemale">Female</label>
						</div>
						</div>
                    </div>
					<div class="col-md-6 mb-3">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="ViewProfilePicture" id="ViewProfilePicture">
					</div>
                </div>
                <div class="row">
					<div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" id="ViewMobile" name="mobile_no" class="form-control">
                        </div>
                    </div>
					<div class="mb-3 col-md-6 mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control" id="ViewAddress" name="address" rows="3" placeholder="Enter address"></textarea>
					</div>
				</div>
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Viewsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
    </main>
<!-- Toastr -->
<script type="text/javascript">
	$(document).ready(function() {		
	var table; 
	table = $('#example').DataTable({
		"processing": true,
	});
	});
	
$(document).on('click', '.edit-btn', function() {
    var AdminId = $(this).data('id');

    $.ajax({
		url: "<?= base_url('Admin_Controller/getAdminData') ?>",
        type: "POST",
        data: { id: AdminId },
        success: function(response) {
			console.log(response);
			
            var data = JSON.parse(response);
			console.log(data);
			$('#EditAdminId').val(data.admin_id);
            $('#editAdminCanvas #EditFullname').val(data.fullname);
            $('#editAdminCanvas #EditEmail').val(data.email);
            $('#editAdminCanvas #EditPassword').val(data.password);			
			var imagePath = (data.profile_picture && data.profile_picture.trim() !== '' && data.profile_picture !== 'null') ? '<?= base_url() ?>' + data.profile_picture.replace('./', '')
				: '<?= base_url('assets/images/avatar.png') ?>';
			$('#profileImage').attr('src', imagePath);
            $('#editAdminCanvas #EditDob').val(data.dob);
			$('#editAdminCanvas input[name="EditGender"][value="' + data.gender + '"]').prop('checked', true);
            $('#editAdminCanvas #EditMobile').val(data.mobile_no);
            $('#editAdminCanvas #EditAddress').val(data.address);
            $('#editAdminCanvas').offcanvas('show');
        }
    });
});

$(document).on('click', '.view-btn', function() {
    var AdminId = $(this).data('id');
console.log(AdminId);
    $.ajax({
		url: "<?= base_url('Admin_Controller/getAdminData') ?>",
        type: "POST",
        data: { id: AdminId },
        success: function(response) {
			
            var data = JSON.parse(response);
			console.log(data.AdminId);
			$('#EditAdminId').val(data.admin_id);
            $('#editAdminCanvas #ViewFullname').val(data.fullname);
            $('#editAdminCanvas #ViewtEmail').val(data.email);
            $('#editAdminCanvas #ViewPassword').val(data.password);
            $('#editAdminCanvas #ViewDob').val(data.dob);
			$('#editAdminCanvas input[name="ViewGender"][value="' + data.gender + '"]').prop('checked', true);
            $('#editAdminCanvas #ViewMobile').val(data.mobile_no);
            $('#editAdminCanvas #ViewAddress').val(data.address);
            $('#ViewAdminCanvas').offcanvas('show');
        }
    });
});

function togglePasswordVisibility() {
    var passwordField = document.getElementById("EditPassword");  
    var toggleIcon = document.getElementById("toggleIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}
</script>	
<script>
$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').on('click', function() {
		//alert('dfdf');
        var adminId = $(this).data('id');  // Get student ID from data-id attribute
		console.log(adminId);

        // SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request to delete student
                $.ajax({
                    url: '<?= base_url("Admin_Controller/DeleteAdmin/"); ?>' + adminId,  // Adjust controller name if needed
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete data.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Something went wrong with the server.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<script>
     <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "<?php echo $this->session->flashdata('success'); ?>",
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "<?php echo $this->session->flashdata('error'); ?>",
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>
	
</script>
</body>
</html>
