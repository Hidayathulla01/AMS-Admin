<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Masjid</title>

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

    <!-- Custom styles for this template -->
  </head>
  <body>
    <!-- SideBar and Navbar -->
	<?php include('SideBar.php'); ?>
	
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	<div class="dashboard-content">
	  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="<?php echo ('DashboardIndex');?>">Dashboard</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Masjids</li>
		</ol>
	  </nav>
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Masjid List</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addAdminCanvas" aria-controls="addAdminCanvas">  + Add Masjid</button>
    </div>
    <hr class="dropdown-divider">
		<div class="table-responsive">
			<table id="example" class="table table-striped display nowrap">
			<thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Masjid Name</th>
				<th scope="col">address</th>
				<th scope="col">Contact Person</th>
				<th scope="col">Mobile no</th>
				<th scope="col">Action</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					foreach ($MasjidList as $Data) { ?>
					<tr>
						<td scope="col"><?php echo $i; ?></td>
						<td scope="col"><?php echo $Data['masjid_name']; ?></td>
						<td scope="col"><?php echo $Data['address']; ?></td>
						<td scope="col"><?php echo $Data['contact_person']; ?></td>
						<td scope="col"><?php echo $Data['mobile_no']; ?></td>
						<td class="action-btns">
							<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#viewAdminCanvas">
								<i class="fas fa-eye"></i>
							</a>
							<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['masjid_id']; ?>">
								<i class="fas fa-trash"></i>
							</a>
							<a  type="button" data-id="<?= $Data['masjid_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editMasjidCanvas"><i class="fas fa-pen"></i></a>
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
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Add Masjid</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('AddMasjid');?>" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">MASJID NAME </label>
                        <input type="text" class="form-control" id="fullname2" name="masjid_name" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">CONTACT PERSON</label>
                        <input type="text" class="form-control" name="contact_person" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                </div>
                <div class="row mb-3">
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <input type="text" name="mobile_no" class="form-control">
                        </div>
                    </div>
					<div class="col-md-6">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" id="profile_picture" name="profile_picture">
					 </div>
				</div>
				<div class="row">
				<div class="col-md-6  mb-3">
					 <label for="address" class="form-label">ADDRESS</label>
                     <textarea class="form-control"  name="address" rows="3" placeholder="Enter address"></textarea>
				</div>  		
				<div class="col-md-6  mb-3">
					 <label for="address" class="form-label">DESCRIPTION</label>
                     <textarea class="form-control"  name="description" rows="3" placeholder="Enter address"></textarea>
				</div>                
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
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="editMasjidCanvas" aria-labelledby="editMasjidCanvas" data-bs-backdrop="false" 
	class="needs-validation" novalidate>
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editMasjidCanvas">Edit MASJID</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateMasjidData');?>" class="needs-validation" novalidate>
				<input type="hidden" name="EditMasjidId" id="EditMasjidId">
				<div class="text-center mb-3">
						<img id="profileImage" src="" class="rounded-circle border border-secondary" alt="Profile Image" width="100" height="100" style="border-radius:50%;">
					<input type="file" class="form-control mt-3 mx-auto" name="EditProfilePicture" id="EditProfilePicture" style="max-width: 300px;">
				</div>
                <div class="row mb-3">
                    <div class="col-md-12 required-label">
                        <label for="firstName" class="form-label">MASJID NAME </label>
                        <input type="text" class="form-control" id="EditMasjidname" name="EditMasjidname" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">CONTACT PERSON</label>
                        <input type="text" class="form-control" name="EditContactperson" id="EditContactperson" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
					<div class="col-md-6">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" name="EditMobileno" id="EditMobileno" class="form-control">
                        </div>
                    </div>
				</div>
				<div class="row">
				<div class="col-md-6  mb-3">
					 <label for="address" class="form-label">ADDRESS</label>
                     <textarea class="form-control"  name="EditAddress" id="EditAddress" rows="3" placeholder="Enter address"></textarea>
				</div>
				<div class="col-md-6  mb-3">
					 <label for="address" class="form-label">DESCRIPTION</label>
                     <textarea class="form-control"  name="EditDescription" id="EditDescription" rows="3" placeholder="Enter address"></textarea>
				</div>                
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
		

$(document).on('click', '.edit-btn', function() {
    var MasjidId = $(this).data('id');

    $.ajax({
		url: "<?= base_url('Masjid_Controller/getMasjidData') ?>",
        type: "POST",
        data: { id: MasjidId },
        success: function(response) {			
            var data = JSON.parse(response);
			//console.log(MasjidId);
			//console.log(response);
			$('#EditMasjidId').val(data.masjid_id);
            $('#editMasjidCanvas #EditMasjidname').val(data.masjid_name);
            $('#editMasjidCanvas #EditContactperson').val(data.contact_person);
            $('#editMasjidCanvas #EditMobileno').val(data.mobile_no);
            //$('#editMasjidCanvas #EditProfilePicture').val(data.password);
            $('#editMasjidCanvas #EditAddress').val(data.address);
            $('#editMasjidCanvas #EditDescription').val(data.description);			
			var imagePath = (data.profile_picture && data.profile_picture.trim() !== '' && data.profile_picture !== 'null') ? '<?= base_url() ?>' + data.profile_picture.replace('./', '')
				: '<?= base_url('assets/images/avatar.png') ?>';
			$('#profileImage').attr('src', imagePath);
            $('#editMasjidCanvas').offcanvas('show');
        }
    });
});

</script><script>
$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').on('click', function() {
		//alert('dfdf');
        var masjidId = $(this).data('id');  // Get student ID from data-id attribute
		console.log(masjidId);

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
                    url: '<?= base_url("Masjid_Controller/DeleteMasjid/"); ?>' + masjidId,  // Adjust controller name if needed
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
