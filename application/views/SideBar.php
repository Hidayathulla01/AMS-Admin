<!doctype html>
<html lang="en">
<body> 
<style>
body{
	font-family: 'Poppins', sans-serif;
	background-color: #f7f8fa;
	color: #5e5e5e;
    }
	.breadcrumb-item a {
		text-decoration: none;
		color: #5e5e5e;
	}
	.form-container {
		background: #fff;
		border-radius: 10px;
		padding: 20px;
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
	}
	.btn-danger {
		background-color: #065392;
		border-color: #065392;
	}
	.btn-danger:hover {
		background-color: #065392;
		border-color: #065392;
	}
	.btn-outline-danger {
		color: #065392;
		border-color: #065392;
	}
	.btn-outline-danger:hover {
		background-color: #065392;
		color: #fff;
	}
	.table-striped tbody tr:nth-of-type(odd) {
		background-color: #f9fafb;
	}
	.status-active {
		background-color: #d4f4dd;
		color: #2ca44a;
		padding: 4px 10px;
		border-radius: 5px;
		font-size: 14px;
	}
	.action-btns button {
		border: none;
		padding: 6px 8px;
		margin-right: 5px;
		border-radius: 5px;
	}
	.action-btns .view-btn {
		background-color: #fde2e4;
		color: #d9534f;
	}
	.action-btns .edit-btn {
		background-color: #d4f4dd;
		color: #2ca44a;
	}
	.action-btns .delete-btn {
		background-color: #fde2e4;
		color: #d9534f;
	}
</style> 
  
	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<!-- Include Toastr -->
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-2">
  <!-- Logo -->
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
    <img src="<?php echo base_url('/assets/Logo/Home.png'); ?>" alt="Logo" class="logo-img" style="height: 60px; width: auto;">
  </a>

  <!-- Sidebar Toggle Button (Visible on Mobile) -->
  <button class="navbar-toggler d-md-none bg-dark1" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Notification & Profile Dropdown -->
  <div class="d-flex align-items-center ms-auto me-3">
	<button class="btn btn-warning position-relative me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#notificationOffcanvas" aria-controls="notificationOffcanvas"><i class="far fa-bell"></i>
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span></button>
  
 <!-- Notification Offcanvas -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="notificationOffcanvas" data-bs-backdrop="false" aria-labelledby="notificationOffcanvasLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="notificationOffcanvasLabel">Push Notification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body position-sticky">
			<!-- Notification Controls -->
		<div class="d-flex justify-content-between mb-3">
		  <a href="#" class="text-decoration-none">Mark as Read</a>
		  <a href="#" class="text-decoration-none text-danger">Remove All</a>
		</div>


    <!-- Notification Cards -->
    <div class="d-flex align-items-center mb-3">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="checkbox1">
      </div>
      <!-- Card -->
      <div class="card w-100 ms-2">
        <!-- Card Body -->
        <div class="card-body">
          <p class="mb-0" id="date-time"></p>
          <p class="mb-0 mt-2"><strong>Title</strong></p>
        </div>
        <!-- Card Footer -->
        <div class="card-footer text-end action-btns">
          <a href="Push_Notification.html" class="view-btn" title="View"><i class="fas fa-eye"></i></a>
          <button class="delet-btn" title="Delete"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    </div>

    <div class="d-flex align-items-center mb-2">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="checkbox2">
      </div>
      <!-- Card -->
      <div class="card w-100 ms-2">
        <div class="card-body">
          <p class="mb-0">Date & Time</p>
          <p class="mb-0 mt-2"><strong>Title</strong></p>
        </div>
        <div class="card-footer text-end action-btns">
          <button class="view-btn" title="View"><i class="fas fa-eye"></i></button>
          <button class="delet-btn" title="Delete"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    </div>

    <div class="d-flex align-items-center mb-2">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="checkbox3">
      </div>
      <!-- Card -->
      <div class="card w-100 ms-2">
        <div class="card-body">
          <p class="mb-0">Date & Time</p>
          <p class="mb-0 mt-2"><strong>Title</strong></p>
        </div>
        <div class="card-footer text-end action-btns">
          <button class="view-btn" title="View"><i class="fas fa-eye"></i></button>
          <button class="delet-btn" title="Delete"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Profile Dropdown -->
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <!-- Profile Image -->
		<img src="<?= !empty($AdminData['profile_picture']) ? base_url($AdminData['profile_picture']) : base_url('assets/images/avatar.png'); ?>" class="profile-img" alt="Profile Image">
        <!-- Username -->
		<?php 
		$userData = $this->session->userdata('user_data');
		$fullname = $userData['fullname'];
		$email = $userData['email'];
		?>
        <span class="d-none d-md-inline"><strong><?php print_r($fullname) ;?></strong></span>
      </button>

      <!-- Dropdown Menu -->
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown" style="min-width: 250px;">
        <!-- Profile Card -->
        <li>
          <div class="text-center p-3">
            <!-- Larger Profile Image with Edit Icon -->
            <label for="fileInput" class="position-relative" style="cursor: pointer;">
			<img src="<?= !empty($AdminData['profile_picture']) ? base_url($AdminData['profile_picture']) : base_url('assets/images/avatar.png'); ?>" class="profile-img" alt="Profile Image" style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ddd;">
              <div class="position-absolute bottom-0 start-50 translate-middle-x bg-light p-1 rounded-circle border">
                <i class="fas fa-pen" style="font-size: 12px; color: #555;"></i>
              </div>
            </label>
            <input type="file" id="fileInput" class="form-control mt-2" style="display: none;" accept="image/*">

            <!-- User Information -->
            <p class="mt-2 mb-0"><strong><?php print_r($fullname) ;?></strong></p>
            <p class="text-muted small mb-0"><?php print_r($email) ;?></p>
            <p class="text-muted small mb-1">+8801254875855</p>
          </div>
        </li>

        <!-- Actions -->
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?php echo base_url('EditProfileIndex');?>"><i class="fas fa-edit me-2"></i> Edit Profile</a></li>
		<li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="ChangePassword.html"><i class="fas fa-key me-2"></i> Change Password</a></li>
		<li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</header>
<!-- NavBar end -->

<!-- SideBar start -->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse ps-1 mt-4 ">
      <div class="position-sticky " style="height: 100%; overflow-y: auto;" >
	  <!-- Close Button -->
        <div class="d-flex justify-content-end mt-4">
          <button class="btn btn-sm btn-outline-danger m-2 d-md-none" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-expanded="false" aria-label="Close Sidebar">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <ul class="nav flex-column mt-4">
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'DashboardIndex') ? 'active' : ''; ?>" href="<?php echo base_url("DashboardIndex"); ?>">
              <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard
            </a>
          </li>
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'AdminIndex') ? 'active' : ''; ?>" href="<?php echo base_url("AdminIndex"); ?>">
              <i class="fas fa-user-shield"></i>&nbsp;&nbsp;Administrators</a>
            </a>
          </li>
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'MasjidIndex') ? 'active' : ''; ?>" href="<?php echo base_url("MasjidIndex"); ?>">
              <i class="fas fa-mosque"></i>&nbsp;&nbsp;Masjids</a>
            </a>
          </li>
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'CourseIndex') ? 'active' : ''; ?>" href="<?php echo base_url("CourseIndex"); ?>">
              <i class="fas fa-clipboard-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;Courses</a>
            </a>
          </li>
		  <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'TeacherIndex') ? 'active' : ''; ?>" href="<?php echo base_url("TeacherIndex"); ?>">
              <i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;Teachers
            </a>
          </li>
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'AssignClassIndex') ? 'active' : ''; ?>" href="<?php echo base_url("AssignClassIndex"); ?>">
              <i class="fas fa-clipboard-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;Assign Class</a>
            </a>
          </li>
          <li class="nav-item">
			<a class="nav-link <?php echo ($this->uri->segment(1) == 'StudentIndex') ? 'active' : ''; ?>" href="<?php echo base_url("StudentIndex"); ?>">
              <i class="fas fa-user-graduate"></i>&nbsp;&nbsp;&nbsp;&nbsp;Students</a>
            </a>
          </li>
		  <div class="nav-section p-1 m-1">COMMUNICATIONS</div>
		<li class="nav-item">
            <a class="nav-link" href="Push_Notification.html">
              <i class="fab fa-whatsapp"></i>  Whatsapp
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Push_Notification.html">
              <i class="fas fa-bell"></i>  Push Notifications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-envelope"></i>  Messages
            </a>
          </li>
		  <div class="nav-section p-1 m-1">REPORTS</div>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-clipboard-list"></i>  Student Attendance
			  </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-tasks"></i>  Teacher visit
			  </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?= base_url('AttendanceReports') ?>">
              <i class="fas fa-clipboard-list"></i>  Attendance Reports
			  </a>
          </li>
		  <div class="nav-section p-1 m-1">SETUP</div>
			<li class="nav-item">
			<a class="nav-link" data-bs-toggle="collapse" href="#settingsMenu" role="button" aria-expanded="false" aria-controls="settingsMenu">
				<i class="fas fa-cogs"></i> Settings <i class="fas fa-chevron-down float-end"></i>
			</a>
		  <div class="collapse" id="settingsMenu">
			<ul class="nav flex-column ms-3">
			  <li class="nav-item">
				<div class="form-check form-switch">
				  <input class="form-check-input" type="checkbox" id="themeSwitch">
				  <label class="form-check-label" for="themeSwitch">Dark Mode</label>
				</div>
			  </li>
			</ul>
		  </div>
		</li>
        </ul>
      </div>
    </nav>
	</div>
	</div>
	<!-- SideBar end -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>
</html>