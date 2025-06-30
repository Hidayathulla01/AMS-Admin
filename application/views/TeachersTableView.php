<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title>Teachers</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<!-- Datatables -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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
	<div class="dashboard-content">
	  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="<?php echo ('DashboardIndex');?>">Dashboard</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Teachers List</li>
		</ol>
	  </nav>
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Teachers List</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addCanvas" aria-controls="addAdminCanvas">
                    + Add Teacher
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
				<th scope="col">Date of Join</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$i = 1;
				foreach ($TeacherList as $Data) { ?>
				<tr>
					<td scope="col"><?php echo $i; ?></td>
					<td scope="col"><?php echo $Data['fullname']; ?></td>
					<td scope="col"><?php echo $Data['gender']; ?></td>
					<td scope="col"><?php echo $Data['email']; ?></td>
					<td scope="col"><?php echo $Data['date_of_join']; ?></td>
					<td class="action-btns">
						<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#ViewTeacherCanvas">
							<i class="fas fa-eye"></i>
						</a>
						<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['teacher_id']; ?>">
							<i class="fas fa-trash"></i>
						</a>
						<a  type="button" data-id="<?= $Data['teacher_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editTeacherCanvas"><i class="fas fa-pen"></i></a>
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
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="addCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Add Teacher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
			<form method="POST"  enctype="multipart/form-data" action="<?php echo ('Teacher_Controller/addTeacher');?>">
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="fullname2" name="fullname" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">EMAIL</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter first name" required>
                    </div>
                </div>
                <div class="row mb-3">
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" name="password" placeholder="Enter password" required>
					</div>
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" name="mobile_no" class="form-control">
                        </div>
                    </div>
				</div>
                <div class="row mb-3">
					<div class="col-md-12">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" id="profile_picture" name="profile_picture">
					 </div>
                </div>
				<div class="row mb-3">
                    <div class="col-md-6 required-label">
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
						</div>
                    </div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control"  name="dob">
					</div>	
                </div>
                <div class="row mb-3">
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF JOINING</label>
						<input type="date" class="form-control"  name="date_of_join">
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF RESIGNING</label>
						<input type="date" class="form-control"  name="date_of_resigning">
					</div>
				</div>				
				<div class="col-md-12  mb-3">
					 <label for="address" class="form-label">ADDRESS</label>
                     <textarea class="form-control"  name="address" rows="3" placeholder="Enter address"></textarea>
				</div>                
                <!-- Buttons -->
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
		
		<!-- Offcanvas for Edit Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="editTeacherCanvas" aria-labelledby="editAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editAdminCanvasLabel">Edit Administrator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
			<form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateTeacherData');?>">
				 <input type="hidden" name="EditTeacherId" id="EditTeacherId">
				 <div class="text-center mb-3">
					<img id="profileImage" src="" class="rounded-circle border border-secondary" alt="Profile Image" width="100" height="100" style="border-radius:50%;">
					<input type="file" class="form-control mt-3 mx-auto" name="EditProfilePicture" id="EditProfilePicture" style="max-width: 300px;">
				</div>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="EditFullname" name="EditFullname" id="EditFullname" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">EMAIL</label>
                        <input type="text" class="form-control" name="EditEmail" id="EditEmail" placeholder="Enter first name" required>
                    </div>
                </div>
                <div class="row mb-3">
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" name="EditPassword" id="EditPassword" placeholder="Enter password" required>
					</div>
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" name="EditMobile" id="EditMobile" class="form-control">
                        </div>
                    </div>
				</div>
				<div class="row mb-3">
                    <div class="col-md-6 required-label">
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
						</div>
                    </div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" id="EditDob" name="EditDob">
					</div>	
                </div>
                <div class="row mb-3">
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF JOINING</label>
						<input type="date" class="form-control" id="EditDateofjoin" name="EditDateofjoin">
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF RESIGNING</label>
						<input type="date" class="form-control" id="EditDateofResigning" name="EditDateofResigning">
					</div>
				</div>				
				<div class="col-md-12  mb-3">
					 <label for="address" class="form-label">ADDRESS</label>
                     <textarea class="form-control" id="EditAddress" name="EditAddress" rows="3" placeholder="Enter address"></textarea>
				</div>                
                <!-- Buttons -->
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Editsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
	</div>
		
		<!-- Offcanvas for View Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="ViewTeacherCanvas" aria-labelledby="viewTeacherCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="viewTeacherCanvasLabel">View Teacher Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form>
				 <input type="hidden" name="ViewTeacherId" id="ViewTeacherId">
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="ViewFullname" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">EMAIL</label>
                        <input type="text" class="form-control" name="EditEmail" id="ViewEmail" placeholder="Enter first name" required>
                    </div>
                </div>
                <div class="row mb-3">
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="type" class="form-control" name="EditPassword" id="ViewPassword" placeholder="Enter password" required>
					</div>
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" name="EditMobile" id="ViewMobile" class="form-control">
                        </div>
                    </div>
				</div>
                <div class="row mb-3">
					<div class="col-md-12">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" id="ViewProfilePicture" name="EditProfilePicture">
					 </div>
                </div>
				<div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label class="form-label">GENDER </label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="EditGender" id="ViewGendermale"  value="male" required>
							<label class="form-check-label" for="EditGendermale">Male</label>
						   </div>
							<div class="form-check form-check-inline">
							   <input class="form-check-input" type="radio" name="EditGender" id="ViewGenderfemale"  value="female" required>
							   <label class="form-check-label" for="EditGenderfemale">Female</label>
							</div>
						</div>
                    </div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" id="ViewDob" name="EditDob">
					</div>	
                </div>
                <div class="row mb-3">
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF JOINING</label>
						<input type="date" class="form-control" id="ViewDateofjoin" name="EditDateofjoin">
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF RESIGNING</label>
						<input type="date" class="form-control" id="ViewDateofResigning" name="EditDateofResigning">
					</div>
				</div>				
				<div class="col-md-12  mb-3">
					 <label for="address" class="form-label">ADDRESS</label>
                     <textarea class="form-control" id="ViewAddress" name="ViewAddress" rows="3" placeholder="Enter address"></textarea>
				</div>                
                <!-- Buttons -->
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Editsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
    </main>
<script type="text/javascript">
	$(document).ready(function() {
		
	var table; 
	table = $('#example').DataTable({
		"processing": true,
	} );
	} );
	
	function confirmDelete(deleteUrl) {
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}	

$(document).on('click', '.edit-btn', function() {
    var TeacherId = $(this).data('id');

    $.ajax({
		url: "<?= base_url('Teacher_Controller/getTeacherData') ?>",
        type: "POST",
        data: { id: TeacherId },
        success: function(response) {			
            var data = JSON.parse(response);
			//console.log(TeacherId);
			console.log(response);
			$('#EditTeacherId').val(data.teacher_id);
            $('#editTeacherCanvas #EditEmail').val(data.email);
            $('#editTeacherCanvas #EditPassword').val(data.password);
            $('#editTeacherCanvas #EditFullname').val(data.fullname);
			$('#editTeacherCanvas input[name="EditGender"][value="' + data.gender + '"]').prop('checked', true);
            $('#editTeacherCanvas #EditMobile').val(data.mobile_no);
            $('#editTeacherCanvas #EditDob').val(data.dob);
            $('#editTeacherCanvas #EditDateofjoin').val(data.date_of_join);
            $('#editTeacherCanvas #EditDateofResigning').val(data.date_of_resigning);
            $('#editTeacherCanvas #EditAddress').val(data.address);			
			var imagePath = (data.profile_picture && data.profile_picture.trim() !== '' && data.profile_picture !== 'null') ? '<?= base_url() ?>' + data.profile_picture.replace('./', '')
				: '<?= base_url('assets/images/avatar.png') ?>';
			$('#profileImage').attr('src', imagePath);
			
            //$('#ViewTeacherCanvas').offcanvas('show');
            $('#editTeacherCanvas').offcanvas('show');
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
        var teacherId = $(this).data('id');  // Get student ID from data-id attribute
		console.log(teacherId);

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
                    url: '<?= base_url("Teacher_Controller/DeleteTeacher/"); ?>' + teacherId,  // Adjust controller name if needed
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();  // Reload page after deletion
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
