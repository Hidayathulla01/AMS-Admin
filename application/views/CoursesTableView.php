<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title>Courses</title>

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
		  <li class="breadcrumb-item active" aria-current="page">Courses</li>
		</ol>
	  </nav>
	  <!-- <p class="fs-5">Dashboard / Adminstartors</p> -->
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Courses List</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addAdminCanvas" aria-controls="addAdminCanvas">
         + Add Course</button>
    </div>
    <hr class="dropdown-divider">
    <div class="table-responsive">
        <table id="example" class="table table-striped display nowrap">
            <thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Course Name</th>
				<th scope="col">Masjid</th>
				<th scope="col">Student Type</th>
				<th scope="col">Action</th>
			  </tr>
            </thead>
			<tbody>
				<?php 
					$i = 1;
					foreach ($CourseList as $Data) { ?>
					<tr>
						<td scope="col"><?php echo $i; ?></td>
						<td scope="col"><?php echo $Data['course_name']; ?></td>
						<td scope="col"><?php echo $Data['masjid_name']; ?></td>
						<td scope="col"><?php echo $Data['student_type']; ?></td>
						<td class="action-btns">
							<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#viewAdminCanvas">
								<i class="fas fa-eye"></i>
							</a>
							<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['course_id']; ?>">
								<i class="fas fa-trash"></i>
							</a>
							<a  type="button" data-id="<?= $Data['course_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editCourseCanvas"><i class="fas fa-pen"></i></a>
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
    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="addAdminCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false"
	>
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Add Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('AddCourse');?>" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="course_name" class="form-label">COURSE NAME</label>
                        <input type="text" class="form-control" name="course_name" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="form-label">TITLE</label>
                        <input type="text" class="form-control" name="title">
                    </div>	
                </div>
                <div class="row mb-3">	
					 <div class="col-md-6 required-label">
						<label class="form-label">STUDENT TYPE</label>
						<select class="form-select" name="student_type" id="student_type">
						  <option value="" disabled selected>Student Type</option>
						  <option value="Adult">Adult</option>
						  <option value="Childrens">Childrens</option>
						</select>
					</div>		
					 <div class="col-md-6 required-label">
						<label class="form-label">MASJID</label>
						<select class="form-select" name="masjid_name" required>
							<option value="" disabled selected>Select Masjid</option>
							<?php 
							$query = $this->db->select('masjid_name,masjid_id')
										->from('tbl_masjids')
										->where('delete_status','1')
										->order_by('masjid_name','ASC')
										->get();
											
							$result = $query->result_array();                 
							foreach($result as $row){
								$masjid_name = $row['masjid_name'];
								$masjid_id = $row['masjid_id'];
								echo '<option value="'.$masjid_id.'">'.$masjid_name.'</option>';
							}
							?> 
						</select>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				</div>
				<div class="row mb-3">	
					<div class="col-md-6">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="profile_picture" id="profile_picture">
					 </div>	
					<div class="col-md-6  mb-3">
						 <label for="address" class="form-label">DESCRIPTION</label>
						 <textarea class="form-control"  name="description" rows="3" placeholder="Enter address"></textarea>
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
    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="editCourseCanvas" aria-labelledby="editAdminCanvasLabel" data-bs-backdrop="false"
	>
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editCCanvasLabel">Edit Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateCourseData');?>" class="needs-validation" novalidate>
				 <input type="hidden" name="EditCourseId" id="EditCourseId">
				<div class="text-center mb-3">
						<img id="profileImage" src="" class="rounded-circle border border-secondary" alt="Profile Image" width="100" height="100" style="border-radius:50%;">
					<input type="file" class="form-control mt-3 mx-auto" name="EditProfilePicture" id="EditProfilePicture" style="max-width: 300px;">
				</div>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="course_name" class="form-label">COURSE NAME</label>
                        <input type="text" class="form-control" name="EditCourseName" id="EditCourseName" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="form-label">TITLE</label>
                        <input type="text" class="form-control" name="EditTitle" id="EditTitle">
                    </div>	
                </div>
                <div class="row mb-3">	
					 <div class="col-md-6 required-label">
						<label class="form-label">STUDENT TYPE</label>
						<select class="form-select" name="EditStudentType" id="EditStudentType">
						  <option value="" disabled selected>Student Type</option>
						  <option value="Adult">Adult</option>
						  <option value="Childrens">Childrens</option>
						</select>
					</div>		
					<div class="col-md-6 required-label">
						<label class="form-label">MASJID</label>
						<select class="form-select" name="EditMasjidname" id="EditMasjidname" required>
							<option value="" disabled selected>Select Masjid</option>
							<?php 
							$query = $this->db->select('masjid_name, masjid_id')
											  ->from('tbl_masjids')
											  ->where('delete_status', '1')
											  ->order_by('masjid_name', 'ASC')
											  ->get();
											  
							$result = $query->result_array();                 
							foreach($result as $row){
								$masjid_name = $row['masjid_name'];
								$masjid_id = $row['masjid_id'];
								
								// If masjid_id from the AJAX response matches the current one, add selected attribute
								$selected = (isset($course_data) && $course_data['masjid_id'] == $masjid_id) ? 'selected' : '';
								
								echo '<option value="'.$masjid_id.'" '.$selected.'>'.$masjid_name.'</option>';
							}
							?> 
						</select>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				</div>
				<div class="row mb-3">	
					<div class="col-md-6">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="EditProfilePicture" id="EditProfilePicture">
					 </div>	
					<div class="col-md-6  mb-3">
						 <label for="address" class="form-label">DESCRIPTION</label>
						 <textarea class="form-control"  name="EditDescription" id="EditDescription" rows="3" placeholder="Enter address"></textarea>
					</div>                
				</div>
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </form>
        </div>
		</div>
		
		<!-- Offcanvas for View Administrator -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="viewAdminCanvas" aria-labelledby="viewAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="viewAdminCanvasLabel">View Administrator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form>
                <!-- FrstName and LastName -->
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FIRST NAME </label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name" readonly>
                    </div>
                    <div class="col-md-6 required-label">
                        <label for="lastName" class="form-label">LAST NAME </label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name" readonly>
                    </div>
                </div>
				 <!-- Email  -->
				<div class="col-12 mb-3 required-label">
                        <label for="email" class="form-label">EMAIL ID </label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" readonly>
                 </div>
                <!-- Mobile and Password -->
                <div class="row mb-3">
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" readonly>
					</div>
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" id="mobile" class="form-control" readonly>
                        </div>
                    </div>
				</div>
				
					<!-- Gender and Status -->
					 
					<div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label class="form-label">GENDER </label>
                    <div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                       <label class="form-check-label" for="male">Male</label>
                       </div>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                       <label class="form-check-label" for="female">Female</label>
                    </div>
                    </div>
                    </div>
					
					 <div class="col-md-6 required-label">
						<label class="form-label">STATUS </label>
						<select class="form-select" name="status" id="status" required>
						  <option value="" disabled selected>Select Status</option>
						  <option value="active">Active</option>
						  <option value="inactive">Inactive</option>
						</select>
					</div>
                </div>
				
				<div class="col-12 mb-3">
					 <label for="address" class="form-label">Address</label>
                     <textarea class="form-control" id="address" rows="3" placeholder="Enter address" readonly></textarea>
					 </div>
                
                <!-- Buttons -->
                <div class="d-flex justify-content-left">
                    <!-- <button type="submit" class="btn btn-custom me-2">Update</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
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
    var CourseId = $(this).data('id');

    $.ajax({
		url: "<?= base_url('getCourseData') ?>",
        type: "POST",
        data: { id: CourseId },
        success: function(response) {
			console.log(response);
            var data = JSON.parse(response);
			//console.log(data.mobile_no);
			$('#EditCourseId').val(data.course_id);
            $('#editCourseCanvas #EditCourseName').val(data.course_name);
            $('#editCourseCanvas #EditTitle').val(data.title);
            $('#editCourseCanvas #EditDescription').val(data.description);
            $('#editCourseCanvas #EditMasjidname').val(data.masjid_name);
            $('#editCourseCanvas #EditStudentType').val(data.student_type);			
			var imagePath = (data.profile_picture && data.profile_picture.trim() !== '' && data.profile_picture !== 'null') ? '<?= base_url() ?>' + data.profile_picture.replace('./', '') 
				: '<?= base_url('assets/images/avatar.png') ?>';
			$('#profileImage').attr('src', imagePath);

			$('#profileImage').attr('src', imagePath);
            $('#editCourseCanvas').offcanvas('show');
        }
    });
});
</script>	
<script>
$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').on('click', function() {
		//alert('dfdf');
        var courseId = $(this).data('id');  // Get student ID from data-id attribute
		console.log(courseId);

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
                    url: '<?= base_url("Course_Controller/DeleteCourse/"); ?>' + courseId,  // Adjust controller name if needed
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
                                'Failed to delete student.',
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
