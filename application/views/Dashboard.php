<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
/* Light Mode (Default) */
body {
  background-color: #ffffff;
  color: #000000;
  transition: background-color 0.3s, color 0.3s;
}

/* Dark Mode */
body.dark-mode {
  background-color: #000;
  color: #000;
}

/* Adjust any other specific elements as necessary */
.navbar {
  background-color: #f8f9fa; /* Light mode */
}

body.dark-mode .navbar {
  background-color: #333333; /* Dark mode */
}

.action-btns button {
            border: none;
            padding: 6px 8px;
            margin-right: 5px;
            border-radius: 5px;
        }
.action-btns .view-btn {
            background-color: #d4f4dd;
            color: #2ca44a;
			border: none;
            padding: 6px 8px;
            margin-right: 5px;
            border-radius: 5px;
        }
		.action-btns .delet-btn {
            background-color: #fde2e4;
            color: #d9534f;
        }
		*:focus {
  box-shadow: none !important;
  outline: none !important;
}
		
	@keyframes vibrate {
		0%, 100% { transform: translateX(0); }
		25%, 75% { transform: translateX(-5px); }
		100% { transform: translateX(5px); }
	}
	.toast { animation: vibrate 3s ease-in-out; }
</style>
<link href="./assets/dist/css/bootstrap5.css" rel="stylesheet">
<link href="./assets/dist/css/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  </head>
  <body>  
    <!-- SideBar and Navbar -->
	<?php include('SideBar.php'); ?>		
	<?php 	
		$userData = $this->session->userdata('user_data');
		$fullname = $userData['fullname'];	
		$TotalMasjidCount = $MasjidCount[0]['TotalMasjids'];
		$TotalCourseCount = $CourseCount[0]['TotalCourses'];
		$TotalTeacherCount = $TeacherCount[0]['TotalTeachers'];
		$TotalStudentCount = $StudentCount[0]['TotalStudents'];
	
	?>		
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="heading fs-4">Dashboard</h1>        
      </div>
     <!--  <h2>Section title</h2> -->
	  <div class="dashboard-content">
		<div class="alert-reminder" style="display: flex; align-items: center;">
		  <span>Latest Updated:</span>
		  <marquee behavior="scroll" direction="left" style="margin-left: 10px; flex: 1;">
			Masjid Darul Gufran
		  </marquee>
		</div>
        <h4 class="mb-2 heading">Good Morning!</h4>
        <h6><?php echo $fullname;?></h6><br>
        <h4 class="mb-3 fs-5 fw-light">Overview</h4>
        <div class="row g-4">
          <div class="col-md-3 col-sm-6">
			  <div class="overview-card pink d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color:white;"></i>
				  <i class="fas fa-graduation-cap fa-stack-1x" style="color:#ff0078;"></i>
				</span>
				<div>
				  <p class="mb-1">No of Students</p>
				  <div class="value"><?php echo $TotalStudentCount; ?></div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="overview-card purple d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: white;"></i>
				  <i class="fas fa-users fa-stack-1x" style="color: #065392;"></i>
				</span>
				<div>
				  <p class="mb-1">No of Teachers</p>
				  <div class="value"><?php echo $TotalTeacherCount; ?></div>
				</div>
			  </div>
			</div>
			
			<div class="col-md-3 col-sm-6">
			  <div class="overview-card blue d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: white;"></i>
				  <i class="fas fa-mosque fa-stack-1x" style="color: #007bff;"></i>
				</span>
				<div>
				  <p class="mb-1">No of Masjids</p>
				  <div class="value"><?php echo $TotalMasjidCount; ?></div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="overview-card info d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: white;"></i>
				  <i class="fas fa-file-alt fa-stack-1x" style="color: #17a2b8;"></i>
				</span>
				<div>
				  <p class="mb-1">No of Courses</p>
				  <div class="value"><?php echo $TotalCourseCount; ?></div>
				</div>
			  </div>
			</div>
			</div>
		<div class="d-flex justify-content-between align-items-center mt-4">
		  <h4 class="mb-3 fs-5 fw-light">Classes</h4>
		</div>
        <div class="row g-4">
			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #FFE6F0;"></i>
				  <i class="fas fa-chalkboard-teacher fa-stack-1x" style="color: #FF016A;"></i>
				</span>
				<div>
				  <p class="mb-1">Total Classes</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #FFF7E7; "></i>
				  <i class="fas fa-hourglass-start fa-stack-1x" style="color: #F4A83A;"></i>
				</span>
				<div>
				  <p class="mb-1">Pending</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #E7FFF0;"></i>
				  <i class="fas fa-cogs fa-stack-1x" style="color: #5FC868;"></i>
				</span>
				<div>
				  <p class="mb-1">Processing</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #E8F8FF;"></i>
				  <i class="fas fa-truck fa-stack-1x" style="color: #008ABB;"></i>
				</span>
				<div>
				  <p class="mb-1">Out for Delivery</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #EBE6FE;"></i>
				  <i class="fas fa-check-circle fa-stack-1x" style="color: #787FF8;"></i>
				</span>
				<div>
				  <p class="mb-1">Delivered</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #FEEAEB;"></i>
				  <i class="fas fa-times-circle fa-stack-1x" style="color: #F64D4C;"></i>
				</span>
				<div>
				  <p class="mb-1">Canceled</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #E9EFFE;"></i>
				  <i class="fas fa-undo fa-stack-1x" style="color: #4C7CF6;"></i>
				</span>
				<div>
				  <p class="mb-1">Returned</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>

			<div class="col-md-3 col-sm-6">
			  <div class="stats-card d-flex align-items-center">
				<span class="fa-stack fa-2x">
				  <i class="fas fa-circle fa-stack-2x" style="color: #FEEAEB;"></i>
				  <i class="fas fa-ban fa-stack-1x" style="color: #F64D4C;"></i>
				</span>
				<div>
				  <p class="mb-1">Rejected</p>
				  <div class="value">0</div>
				</div>
			  </div>
			</div>
        </div>
      </div>
    </main>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  // Function to format and display the current date and time
  function displayDateTime() {
    const now = new Date();
    const options = { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric', 
      hour: '2-digit', 
      minute: '2-digit' 
    };
    const formattedDateTime = now.toLocaleDateString('en-US', options);
    document.getElementById('date-time').textContent = formattedDateTime;
  }
  displayDateTime();
</script>
<script>
const themeSwitch = document.getElementById('themeSwitch');
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-mode');
    themeSwitch.checked = true;
  }
});

themeSwitch.addEventListener('change', () => {
  if (themeSwitch.checked) {
    document.body.classList.add('dark-mode');
    localStorage.setItem('theme', 'dark');
  } else {
    document.body.classList.remove('dark-mode');
    localStorage.setItem('theme', 'light');
  }
});

</script>
<script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "timeOut": 3000,
            "extendedTimeOut": 1000,
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
		
		<?php if ($this->session->flashdata('success')): ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php endif; ?>
</script>
</body>
</html>
