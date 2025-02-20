<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>
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
            <a class="nav-link" href="<?php echo base_url("MasjidIndex");?>">
              <i class="fas fa-mosque"></i>
              List of Masjid 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url("CourseIndex");?>">
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
        <h1 class="h2">Update Your Masjid Details</h1>
        <a href="<?php echo base_url("CourseIndex");?>" class="btn btn-primary">Back</a>
      </div>
    
      <form action="<?php echo $formAction;?>" method="POST" class="row g-3">
		<select class="form-select" name="masjid_name" id="masjid_name" >
		<option  placeholder="" disabled selected>Select Masjid Name</option>
			<?php 
					 $query = $this->db->select('masjid_name,masjid_id')
							->from('tbl_masjids')
							->where('delete_status','1')
							->order_by('masjid_name','ASC')
							->get();

				$result = $query->result();

				foreach ($result as $row) {
					$masjid_name = $row->masjid_name;
					$masjid_id = $row->masjid_id;

					echo '<option value="' . $masjid_id . '"';
					if ($masjid_id == $response->masjid_name) {
						echo "selected";
					}
					echo '>' . $masjid_name . '</option>';
				}				
				?>
		</select>
		<select class="form-select" name="student_type" aria-label="Default select example">
			<option value="">Select student Type</option>
			<option value="Adult" <?php echo ($response->student_type == 'Adult') ? 'selected' : ''; ?>>Adult</option>
			<option value="Children" <?php echo ($response->student_type == 'Children') ? 'selected' : ''; ?>>Children</option>
		</select>		
		<select class="form-select" name="gender" aria-label="Default select example">
			<option value="">Select Gender</option>
			<option value="Male" <?php echo ($response->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
			<option value="Female" <?php echo ($response->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
		</select>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Course Full Name :</label>
          <input type="text" class="form-control" id="inputEmail4" name="course_name" value="<?php echo $response->course_name; ?>" maxlength="15" required>
          <div class="invalid-feedback">
            Please Enter the Course name.
          </div>
        </div>
        <div class="col-md-6">
          <label for="title" class="form-label">Title:</label>
          <input type="description" class="form-control" id="title" name="title" value="<?php echo $response->title; ?>">
        </div>
        <div class="col-md-6">
          <label for="description" class="form-label">Description :</label>
          <textarea type="text" rows="3" class="form-control" id="description" name="description"><?php echo isset($response->description) ? htmlspecialchars($response->description) : ''; ?></textarea>
        </div>      
        <div class="col-12 text-center">
          <button type="submit" name="submit" id="submit" value="Update" class="btn btn-success">Update</button>
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
