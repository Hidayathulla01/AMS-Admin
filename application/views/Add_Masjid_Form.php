<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
	
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


    <?php echo link_tag(base_url('assets/dist/css/style.css')); ?>
    <!-- Bootstrap core CSS -->
	<?php echo link_tag(base_url('assets/dist/css/bootstrap.min.css')); ?>  

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">AMS</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 bg-dark" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?php echo base_url("Index");?>">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?php echo base_url("DashboardIndex");?>">
              <i class="fa fa-bars"></i>
              Dashboard
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url("MasjidIndex");?>">
              <i class="fas fa-mosque"></i>
              List of Masjid 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("CourseIndex");?>">
              <i class="fa fa-book"></i>
              List of Courses 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("TeacherIndex");?>">
             <i class="fas fa-chalkboard-teacher"></i>
              List of Teachers 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("StudentIndex");?>">
              <i class="fa fa-users"></i>
              List of Students
            </a>
        </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Masjid</h1>
        <a href="<?php echo base_url("MasjidIndex");?>" class="btn btn-primary">Back</a>
      </div>
    
      <form method="POST" action="<?php echo base_url("Masjid_Controller/add");?>"  class="row g-3"  enctype="multipart/form-data">
        <div class="col-md-6">
          <label for="masjid_name" class="form-label"><b>Masjid Name</b></label>
          <input type="text" class="form-control" name="masjid_name" id="masjid_name" placeholder="Enter the Masjid Full Name" required>
        </div>
        <div class="col-md-6">
          <label for="masjid_image" class="form-label"><b>Masjid Image</b></label>
          <input type="file" class="form-control" name="masjid_image" id="masjid_image" placeholder="Upload Masjid Image">
        </div>
		<div class="col-md-6">
          <label for="pincode" class="form-label"><b>Pincode</b></label>
          <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter the Pincode">
        </div>
        <div class="col-md-6">
          <label for="description" class="form-label"><b>Description</b></label>
          <textarea type="description" rows="3" name="description" class="form-control" id="description" placeholder="Enter the Description"></textarea>
        </div>
		<div class="col-md-6">
          <label for="area" class="form-label"><b>Area</b></label>
          <textarea type="area" rows="3" class="form-control" name="area" id="area" placeholder="Enter the area"></textarea>
        </div>
        
        <div class="col-md-6">
          <label for="country" class="form-label"><b>Country</b></label>
          <input type="text" class="form-control" name="country" id="country" placeholder="Enter the Country">
        </div>
        <div class="col-md-6">
          <label for="contact_person" class="form-label"><b>Contact person</b></label>
          <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Enter the Contact Person">
        </div>
        <div class="col-md-6">
          <label for="mobile_no" class="form-label"><b>Mobile number</b></label>
          <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter the Mobile Number" oninput="this.value = this.value.replace(/[^0-9+]/g, '')">
        </div>
        <div class="col-md-6">
          <label for="location" class="form-label"><b>Location</b></label>
          <textarea type="text"  rows="3" class="form-control" name="location" id="location" placeholder=" Enter the location"></textarea>
        </div>
          <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-success" id="submitbtn" name="submit" value="submit">Save</button>
      </div>
      </form>

    </main>
  </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
	  <script src="dashboard.js"></script>
  </body>
</html>
