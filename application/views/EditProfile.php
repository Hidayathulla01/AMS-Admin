<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Students</title>

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
		  <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
		</ol>
	  </nav>
	<?php 	
	
	?>		
	  <!-- <p class="fs-5">Dashboard / Edit Profile</p> -->
	  <div class="form-container p-4 bg-white rounded shadow">
        <h4 class="mb-4 pb-2 border-bottom fs-5 fw-light">Edit Profile</h4>
		<!-- <hr class="dropdown-divider border" /> -->
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateAdminData');?>" class="needs-validation" novalidate>
                <!-- FrstName and LastName -->
				 <input type="hidden" name="admin_id" id="EditAdminId" value="<?= isset($AdminData['admin_id']) ? $AdminData['admin_id'] : ''; ?>">
				<div class="text-center mb-3">
						<img src="<?= !empty($AdminData['profile_picture']) ? base_url($AdminData['profile_picture']) : base_url('assets/images/avatar.png'); ?>" class="rounded-circle border border-secondary" alt="Profile Image" width="100" height="100" style="border-radius:50%;">
					<input type="file" class="form-control mt-3 mx-auto" name="EditProfilePicture" style="max-width: 300px;" id="EditProfilePicture">
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="EditFullname" name="fullname" placeholder="Enter Full name" value="<?= isset($AdminData['fullname']) ? $AdminData['fullname'] : ''; ?>" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
					<div class="col-md-6 mb-3 required-label">
						<label for="email" class="form-label">EMAIL ID </label>
						<input type="email" class="form-control" id="EditEmail" name="email" placeholder="Enter email" value="<?= isset($AdminData['email']) ? $AdminData['email'] : ''; ?>" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                </div>
				<div class="row">
					<div class="col-md-6 mb-3 required-label" style="position: relative;">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control" id="EditPassword" name="password" placeholder="Enter password" value="<?= isset($AdminData['password']) ? $AdminData['password'] : ''; ?>" required>
						<span id="toggleIcon" class="fas fa-eye" onclick="togglePasswordVisibility()" style="position: absolute; right: 25px; top: 40px; cursor: pointer;"></span>
						<div class="invalid-feedback">Please enter Valid Details.</div>	
					</div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" id="EditDob" name="dob" value="<?= isset($AdminData['dob']) ? $AdminData['dob'] : ''; ?>">
					</div>			
				</div>
                <div class="row">
                    <div class="col-md-6 mb-3 required-label">
                        <label class="form-label">GENDER </label>
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="EditGender" id="EditGendermale" value="male" 
									<?= $AdminData['gender'] == 'male' ? 'checked' : ''; ?> required>
								<label class="form-check-label" for="EditGendermale">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="EditGender" id="EditGenderfemale" value="female" 
									<?= $AdminData['gender'] == 'female' ? 'checked' : ''; ?> required>
								<label class="form-check-label" for="EditGenderfemale">Female</label>
							</div>
							<div class="invalid-feedback">Please enter valid details.</div>
						</div>
                    </div>
					<div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label">MOBILE</label>
                        <div class="input-group">
                            <span class="input-group-text">+65</span>
                            <input type="text" id="EditMobile" name="mobile_no" class="form-control" value="<?= isset($AdminData['mobile_no']) ? $AdminData['mobile_no'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
					<div class="mb-3 col-md-6 mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control" id="EditAddress" name="address" rows="3" placeholder="Enter address"><?php echo isset($AdminData['address']) ? htmlspecialchars($AdminData['address']) : ''; ?></textarea>
					</div>
				</div>
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Editsubmit" class="btn btn-custom me-2" value="Save">
                    <a type="button" href="<?php echo base_url('DashboardIndex');?>"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</a>
                </div>
            </form>
      </div>
	  </div>
    </main>
<script>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="./assets/dist/js/dashboard.js"></script>

    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
