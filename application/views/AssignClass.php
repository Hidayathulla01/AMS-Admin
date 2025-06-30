<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title>Assign Class</title>

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
		  <li class="breadcrumb-item active" aria-current="page">Assign Class</li>
		</ol>
	  </nav>
	  <!-- <p class="fs-5">Dashboard / Adminstartors</p> -->
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Assign Classes For Teachers</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addAdminCanvas" aria-controls="addAdminCanvas">
        + Assign Classes</button>
    </div>
    <hr class="dropdown-divider">
    <?php if (!empty($AssignClassList)) { ?>
			<div class="accordion" id="scheduleAccordion">
    <?php
    $accordionIndex = 1;
	$daysMap = [
		'1' => 'Monday',
		'2' => 'Tuesday',
		'3' => 'Wednesday',
		'4' => 'Thursday',
		'5' => 'Friday',
		'6' => 'Saturday',
		'7' => 'Sunday'
	];
	//print_r($AssignClassList);
    foreach ($AssignClassList as $Data) { ?>
        <div>
        <div class="accordion-item m-3">
            <h2 class="accordion-header d-flex align-items-center justify-content-between" id="heading<?php echo $accordionIndex; ?>">
                <div class="d-flex align-items-center flex-grow-1">
                    <button class="accordion-button collapsed flex-grow-1" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseOne<?php echo $accordionIndex; ?>" 
                            aria-expanded="false" 
                            aria-controls="collapseOne<?php echo $accordionIndex; ?>">
                        <?php echo $Data['fullname']; ?> : <?php echo $Data['masjid_name']; ?> - <?php echo isset($daysMap[$Data['days']]) ? $daysMap[$Data['days']] : 'Unknown'; ?>
                    </button>
                </div>
                <div class="d-flex align-items-center ms-3 action-btns">
					<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#viewAssignClassCanvas"><i class="fas fa-eye"></i></a>
					<a  type="button" data-id="<?= $Data['class_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editAssignClassCanvas"><i class="fas fa-pen"></i></a>
					<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['class_id']; ?>"><i class="fas fa-trash"></i></a>
                </div>
            </h2>
            <div id="collapseOne<?php echo $accordionIndex; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $accordionIndex; ?>" data-bs-parent="#scheduleAccordion">
                <div class="accordion-body">
                    <div class="d-flex gap-2 flex-wrap" id="clinicButtonsContainer">
                        <?php 
                        $Courses = explode(",", $Data['course_names']);
                        foreach ($Courses as $AssignedCourses) { ?>
                            <div class="clinic-tag d-flex align-items-center btn-custom text-white px-3 py-1 rounded">
                                <?php echo $AssignedCourses; ?> 
                                <button class="btn btn-sm text-white ms-2 remove-clinic-btn" title="Remove">X</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php 
        $accordionIndex++;
    } ?>
</div>
<?php } else { ?>
    <div class="alert alert-warning m-3 text-center" role="alert">No data available</div>
<?php } ?>
</div>
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="addAdminCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Assign Classes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo base_url('AssignClass_Controller/AssignClass');?>" class="needs-validation" novalidate>
				<div class="row mb-3">
                    <div class="position-relative col-md-12 required-label">
						<label class="form-label">SELECT TEACHER</label>
						<div class="position-relative">
							<!-- Input Field for Search -->
							<input type="text" class="form-control pe-5" name="teacher_id1" id="TeachersearchInput" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
							 <input type="hidden" name="teacher_id" id="teacherId">
							<!-- Dropdown Icon -->
							<i class="fas fa-angle-down position-absolute" 
							   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
						</div>
						<ul class="dropdown-menu w-100 mt-1" id="dropdownList1">
							<?php
							$query = $this->db->select('fullname, teacher_id')
											  ->from('tbl_teacher')
											  ->where('delete_status', '1')
											  ->order_by('fullname', 'ASC')
											  ->get();
							$result = $query->result_array();
							foreach ($result as $row) {
								$fullname = htmlspecialchars($row['fullname']); // Sanitize output
								$teacher_id = htmlspecialchars($row['teacher_id']);
								echo "<li><a class='dropdown-item TeachersDropdown' href='#' data-id='$teacher_id'>$fullname</a></li>";
							}
							?>
						</ul>
					<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					</div>
					<div class="row mb-3">
						<div class="position-relative col-md-12 required-label">
							<label class="form-label">SELECT MASJID</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="masjid_id1" id="searchInput" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								 <input type="hidden" name="masjid_id" id="masjidId">
								<!-- Dropdown Icon -->
								<i class="fas fa-angle-down position-absolute" 
								   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
							</div>
							<ul class="dropdown-menu w-100 mt-1" id="dropdownList">
								<?php
								$query = $this->db->select('masjid_name, masjid_id')
												  ->from('tbl_masjids')
												  ->where('delete_status', '1')
												  ->order_by('masjid_name', 'ASC')
												  ->get();
								$result = $query->result_array();
								foreach ($result as $row) {
									$masjid_name = htmlspecialchars($row['masjid_name']); // Sanitize output
									$masjid_id = htmlspecialchars($row['masjid_id']);
									echo "<li><a class='dropdown-item' href='#' data-id='$masjid_id'>$masjid_name</a></li>";
								}
								?>
							</ul>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					<div class="row mb-3">
						<div class="position-relative col-md-12 required-label">
							<label class="form-label">SELECT COURSE</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="course_id1" id="searchInput2" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								 <input type="hidden" name="course_id" id="courseid2">
								<!-- Dropdown Icon -->
								<i class="fas fa-angle-down position-absolute" 
								   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
							</div>
							<ul class="dropdown-menu w-100 mt-1" id="dropdownList3">
								<?php
								$query = $this->db->select('course_name, course_id')
												  ->from('tbl_courses')
												  ->where('delete_status', '1')
												  ->order_by('course_name', 'ASC')
												  ->get();
								$result = $query->result_array();
								foreach ($result as $row) {
									$course_name = htmlspecialchars($row['course_name']); // Sanitize output
									$course_id = htmlspecialchars($row['course_id']);
									echo "<li><a class='dropdown-item' href='#' data-id='$course_id'>$course_name</a></li>";
								}
								?>
							</ul>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				<div class="row mb-3">
					<div class="col-md-6">
						<label class="form-label">CLASS DAYS</label>
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="visit_type" value="Daily" id="newStatus" required checked>
								<label class="form-check-label" for="newStatus">Daily</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="visit_type" value="Weekly" id="existingStatus" required>
								<label class="form-check-label" for="existingStatus">Weekly</label>
							</div>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				</div>
				<div class="row mb-3">
					<?php
					$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
					foreach ($weekdays as $index => $day) {
						$weekday_id = $index + 1;
						echo "
						<div class='row mb-3 align-items-center weekday-row'>
							<div class='col-md-3'>
								<div class='form-check'>
									<input type='checkbox' class='form-check-input weekday-checkbox' name='selected_days[] id='weekday_$weekday_id'  data-id='$weekday_id' value='$weekday_id' disabled>
									<label class='form-check-label' for='weekday_$weekday_id'>$day</label>
								</div>
							</div>
							<div class='col-md-3'>
								<input type='time' class='form-control weekday-input' name='start_time_$weekday_id' placeholder='Start Time' disabled>
							</div>
							<div class='col-md-3'>
								<input type='time' class='form-control weekday-input' name='end_time_$weekday_id' placeholder='End Time' disabled>
							</div>
						</div>";
					}
					?>
				</div>           
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
			</div>
            </form>
        </div>
		</div>
		
		<!-- Offcanvas for Edit Administrator -->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="editAssignClassCanvas" aria-labelledby="editAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editAdminCanvasLabel">Edit Assigned Class</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo base_url('UpdateAssignClassData');?>" class="needs-validation" novalidate>
			<input type="hidden" name="EditAssignClassId" id="EditAssignClassId">
				<div class="row mb-3">
                    <div class="position-relative col-md-12 required-label">
						<label class="form-label">SELECT TEACHER</label>
						<div class="position-relative">
							<!-- Input Field for Search -->
							<input type="text" class="form-control pe-5" name="teacher_id1" id="TeachersearchInput1" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
							 <input type="hidden" name="Editteacher_id" id="teacherId1" value="<?= isset($teacher_id) ? htmlspecialchars($teacher_id) : '' ?>">
							<!-- Dropdown Icon -->
							<i class="fas fa-angle-down position-absolute" 
							   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
						</div>
						<ul class="dropdown-menu w-100 mt-1" id="dropdownList2">
							<?php
							$query = $this->db->select('fullname, teacher_id')
											  ->from('tbl_teacher')
											  ->where('delete_status', '1')
											  ->order_by('fullname', 'ASC')
											  ->get();
							$result = $query->result_array();
							foreach ($result as $row) {
								$fullname = htmlspecialchars($row['fullname']); // Sanitize output
								$teacher_id = htmlspecialchars($row['teacher_id']);
								//echo "<li><a class='dropdown-item TeachersDropdown' href='#' data-id='$teacher_id'>$fullname</a></li>";
								$selected = ($teacher_id == $row['teacher_id']) ? 'selected' : '';
								echo "<li><a class='dropdown-item TeachersDropdown $selected' href='#' data-id='{$row['teacher_id']}'>{$row['fullname']}</a></li>";
							}
							?>
						</ul>
					</div>
					<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					<div class="row mb-3">
						<div class="position-relative col-md-12 required-label">
							<label class="form-label">SELECT MASJID</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="masjid_id1" id="searchInput1" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								 <input type="hidden" name="Editmasjid_id" id="masjidId1" value="<?= isset($masjid_id) ? htmlspecialchars($masjid_id) : '' ?>">
								<!-- Dropdown Icon -->
								<i class="fas fa-angle-down position-absolute" 
								   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
							</div>
							<ul class="dropdown-menu w-100 mt-1" id="MasjidDropdownList">
								<?php
								$query = $this->db->select('masjid_name, masjid_id')
												  ->from('tbl_masjids')
												  ->where('delete_status', '1')
												  ->order_by('masjid_name', 'ASC')
												  ->get();
								$result = $query->result_array();
								foreach ($result as $row) {
									$masjid_name = htmlspecialchars($row['masjid_name']); // Sanitize output
									$masjid_id = htmlspecialchars($row['masjid_id']);
									//echo "<li><a class='dropdown-item' href='#' data-id='$masjid_id'>$masjid_name</a></li>";
									$selected = ($masjid_id == $row['masjid_id']) ? 'selected' : '';
									echo "<li><a class='dropdown-item $selected' href='#' data-id='{$row['masjid_id']}'>{$row['masjid_name']}</a></li>";
								}
								?>
							</ul>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					<div class="row mb-3">
						<div class="position-relative col-md-12 required-label">
							<label class="form-label">SELECT COURSE</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="Editcourse_id" id="searchInput3" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								 <input type="hidden" name="EditselectedCourses" id="courseid3" value="<?= isset($course_id) ? htmlspecialchars($course_id) : '' ?>">
								<!-- Dropdown Icon -->
								<i class="fas fa-angle-down position-absolute" 
								   style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
							</div>
							<ul class="dropdown-menu w-100 mt-1" id="dropdownList4">
								<?php
								$query = $this->db->select('course_name, course_id')
												  ->from('tbl_courses')
												  ->where('delete_status', '1')
												  ->order_by('course_name', 'ASC')
												  ->get();
								$result = $query->result_array();
								foreach ($result as $row) {
									$course_name = htmlspecialchars($row['course_name']); // Sanitize output
									$course_id = htmlspecialchars($row['course_id']);
									$selected = ($course_id == $row['course_id']) ? 'selected' : '';
									echo "<li><a class='dropdown-item $selected' href='#' data-id='{$row['course_id']}'>{$row['course_name']}</a></li>";
								}
								?>
							</ul>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				<div class="row mb-3">
					<div class="col-md-6">
						<label class="form-label">CLASS DAYS</label>
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="EditVisit_type" value="1" id="EditnewStatus" required checked>
								<label class="form-check-label" for="EditnewStatus">Daily</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="EditVisit_type" value="2" id="EditexistingStatus" required>
								<label class="form-check-label" for="EditexistingStatus">Weekly</label>
							</div>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				</div>
				<div class="row mb-3">
					<?php
					$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
					foreach ($weekdays as $index => $day) {
						$weekday_id = $index + 1;
						echo "
						<div class='row mb-3 align-items-center weekday-row'>
							<div class='col-md-3'>
								<div class='form-check'>
									<input type='checkbox' class='form-check-input weekday-checkbox' name='Editselected_days[]' id='Editweekday_$weekday_id'  data-id='$weekday_id' value='$weekday_id' disabled>
									<label class='form-check-label' for='weekday_$weekday_id'>$day</label>
								</div>
							</div>
							<div class='col-md-3'>
								<input type='time' class='form-control weekday-input' name='Editstart_time_$weekday_id' id='Editstart_time_$weekday_id' placeholder='Start Time' disabled>
							</div>
							<div class='col-md-3'>
								<input type='time' class='form-control weekday-input' name='Editend_time_$weekday_id' id='EditEnd_time_$weekday_id' placeholder='End Time' disabled>
							</div>
						</div>";
					}
					?>
				</div>           
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>        
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
	});
	});

const newStatusRadio = document.getElementById('newStatus'); // Daily
const existingStatusRadio = document.getElementById('existingStatus'); // Weekly
const weekdayCheckboxes = document.querySelectorAll('.weekday-checkbox');
const weekdayInputs = document.querySelectorAll('.weekday-input'); 

function setDailyMode() {
  newStatusRadio.checked = true; // Ensure "Daily" is selected
  existingStatusRadio.checked = false;

  weekdayCheckboxes.forEach((checkbox) => {
    checkbox.disabled = false;
    checkbox.checked = true;
    toggleTimeInputs({ target: checkbox }); // Enable respective time inputs
  });
}

function setWeeklyMode() {
  existingStatusRadio.checked = true;
  newStatusRadio.checked = false;

  weekdayCheckboxes.forEach((checkbox) => {
    checkbox.disabled = false; // Allow user to choose specific days
  });
}

function toggleWeekdaysInput() {
  if (newStatusRadio.checked) {
    setDailyMode();
  } else {
    setWeeklyMode();
  }
}

function toggleTimeInputs(event) {
  const checkbox = event.target;
  const id = checkbox.getAttribute('data-id');
  const startTime = document.querySelector(`input[name='start_time_${id}']`);
  const endTime = document.querySelector(`input[name='end_time_${id}']`);

  if (checkbox.checked) {
    startTime.disabled = false;
    endTime.disabled = false;
  } else {
    startTime.disabled = true;
    endTime.disabled = true;
    startTime.value = ''; 
    endTime.value = '';

    // If any checkbox is unchecked, switch to Weekly mode
    newStatusRadio.checked = false;
    existingStatusRadio.checked = true;
  }
}

// Ensure Daily mode is set when the page loads
document.addEventListener('DOMContentLoaded', setDailyMode);

newStatusRadio.addEventListener('change', toggleWeekdaysInput);
existingStatusRadio.addEventListener('change', toggleWeekdaysInput);
weekdayCheckboxes.forEach((checkbox) => {
  checkbox.addEventListener('change', toggleTimeInputs);
});


//Daily weekly check For Edit
const EditnewStatus = document.getElementById('EditnewStatus');
const EditexistingStatus = document.getElementById('EditexistingStatus');
const weekdayCheckboxes1 = document.querySelectorAll('.weekday-checkbox');
const weekdayInputs1 = document.querySelectorAll('.weekday-input'); // Includes all weekday inputs (checkboxes and time inputs)

function toggleWeekdaysInput1() {
  if (EditexistingStatus.checked) {
    // Enable all weekday checkboxes
    weekdayCheckboxes1.forEach((checkbox) => {
      checkbox.disabled = false;
    });
  } else {
    // Disable all weekday checkboxes and time inputs
    weekdayCheckboxes1.forEach((checkbox) => {
      checkbox.disabled = true;
      checkbox.checked = false; 
    });
    weekdayInputs1.forEach((input) => {
      input.disabled = true;
      input.value = '';
    });
  }
}

// Function to enable/disable time inputs based on the checkbox state
function toggleTimeInputs1(event) {
  const checkbox = event.target;
  const id = checkbox.getAttribute('data-id'); // Get the corresponding weekday ID
  const startTime1 = document.querySelector(`input[name='Editstart_time_${id}']`);
  const endTime1 = document.querySelector(`input[name='Editend_time_${id}']`);

  if (checkbox.checked) {
    startTime1.disabled = false;
    endTime1.disabled = false;
  } else {
    startTime1.disabled = true;
    endTime1.disabled = true;
    startTime1.value = ''; 
    endTime1.value = '';
  }
}

EditnewStatus.addEventListener('change', toggleWeekdaysInput1);
EditexistingStatus.addEventListener('change', toggleWeekdaysInput1);
weekdayCheckboxes1.forEach((checkbox) => {
  checkbox.addEventListener('change', toggleTimeInputs1);
});

toggleWeekdaysInput1();


   // Dropdown 1: Normal Searchable Dropdown
	const searchInput = document.getElementById('searchInput');
	const masjidIdInput = document.getElementById('masjidId'); // Hidden input for masjid_id
	const dropdownList = document.getElementById('dropdownList');
	const dropdownItems = dropdownList.querySelectorAll('.dropdown-item');

	// Show dropdown when the input is focused
	searchInput.addEventListener('focus', () => {
		dropdownList.classList.add('show');
	});

	// Hide dropdown if clicked outside
	document.addEventListener('click', (e) => {
		if (!e.target.closest('#searchInput') && !e.target.closest('#dropdownList')) {
			dropdownList.classList.remove('show');
		}
	});

	// Filter items in the dropdown
	searchInput.addEventListener('input', () => {
		const filter = searchInput.value.toLowerCase();
		dropdownItems.forEach(item => {
			item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
		});
	});

	// Add functionality to select an item
	dropdownItems.forEach(item => {
		item.addEventListener('click', (e) => {
			const masjidName = e.target.textContent.trim();
			const masjidId = e.target.dataset.id;

			// Set the selected masjid name in the search input
			searchInput.value = masjidName;

			// Set the hidden input with masjid_id
			masjidIdInput.value = masjidId;

			// Hide the dropdown
			dropdownList.classList.remove('show');
		});
	});

	$("#dropdownList").on("click", ".dropdown-item", function (e) {
		e.preventDefault();
		
		let masjidName = $(this).text().trim();
		let masjidId = $(this).data("id");

		$("#searchInput").val(masjidName);
		$("#masjidId").val(masjidId);

		fetchCourses(masjidId); // Fetch courses for selected Masjid

		$("#dropdownList").removeClass("show"); // Hide Masjid dropdown
	});


function fetchCourses(masjidId) {
    fetch('<?= base_url("Student_Controller/get_courses_by_masjid") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'masjid_id=' + encodeURIComponent(masjidId)
    })
    .then(response => response.json())
    .then(data => {
        const dropdownList3 = document.getElementById('dropdownList3');
        dropdownList3.innerHTML = ''; // Clear previous items

        if (data.length > 0) {
            data.forEach(course => {
                let li = document.createElement('li');
                li.innerHTML = `<a class="dropdown-item" href="#" data-id="${course.course_id}">${course.course_name}</a>`;
                dropdownList3.appendChild(li);
            });

            // Attach event listener for selection
            document.querySelectorAll('#dropdownList3 .dropdown-item').forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById('searchInput2').value = this.textContent;
                    document.getElementById('courseid2').value = this.dataset.id;
                    
                    // Hide dropdown after selection
                    dropdownList3.classList.remove('show');
                });
            });
        }
    })
    .catch(error => console.error('Error fetching courses:', error));
}

// Ensure course dropdown only opens on focus
document.getElementById('searchInput2').addEventListener('focus', function () {
    document.getElementById('dropdownList3').classList.add('show');
});

// Hide dropdown if clicked outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('#searchInput2') && !e.target.closest('#dropdownList3')) {
        document.getElementById('dropdownList3').classList.remove('show');
    }
});



// Dropdown 1: Courses Searchable Dropdown
	const searchInput2 = document.getElementById('searchInput2');
	const masjidIdInput2 = document.getElementById('courseid2'); // Hidden input for masjid_id
	const dropdownList3 = document.getElementById('dropdownList3');
	const dropdownItems2 = dropdownList.querySelectorAll('.dropdown-item');

	// Show dropdown when the input is focused
	searchInput2.addEventListener('focus', () => {
		dropdownList3.classList.add('show');
	});

	// Hide dropdown if clicked outside
	document.addEventListener('click', (e) => {
		if (!e.target.closest('#searchInput2') && !e.target.closest('#dropdownList3')) {
			dropdownList3.classList.remove('show');
		}
	});

	// Filter items in the dropdown
	searchInput2.addEventListener('input', () => {
		const filter = searchInput2.value.toLowerCase();
		dropdownItems2.forEach(item => {
			item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
		});
	});

	// Add functionality to select an item
	dropdownItems2.forEach(item => {
		item.addEventListener('click', (e) => {
			const masjidName2 = e.target.textContent.trim();
			const masjidId2 = e.target.dataset.id;

			// Set the selected masjid name in the search input
			searchInput.value = masjidName;

			// Set the hidden input with masjid_id
			masjidIdInput2.value = masjidId2;

			// Hide the dropdown
			dropdownList3.classList.remove('show');
		});
	});

	// Handle masjid selection and fetch courses
	dropdownList3.addEventListener('click', (e) => {
		const item = e.target.closest('.dropdown-item');
		if (item) {
			const masjidName2 = item.textContent.trim();
			const masjidId2 = item.dataset.id;

			// Set selected masjid name to input
			searchInput2.value = masjidName2;

			// Set masjid_id to hidden input
			masjidIdInput2.value = masjidId2;

			// Fetch courses for the selected masjid
			//fetchCourses(masjidId);
		}
	});


// Dropdown 3: Teacher Searchable Dropdown
const teacherSearchInput = document.getElementById('TeachersearchInput');
const teacherIdInput = document.getElementById('teacherId'); // Hidden input for teacher_id
const teacherDropdownList = document.getElementById('dropdownList1');
const teacherDropdownItems = teacherDropdownList.querySelectorAll('.TeachersDropdown');

// Show dropdown when the input is focused
teacherSearchInput.addEventListener('focus', () => {
    teacherDropdownList.classList.add('show');
});

// Hide dropdown if clicked outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('#TeachersearchInput') && !e.target.closest('#dropdownList1')) {
        teacherDropdownList.classList.remove('show');
    }
});

// Filter items in the dropdown
teacherSearchInput.addEventListener('input', () => {
    const filter = teacherSearchInput.value.toLowerCase();
    teacherDropdownItems.forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

// Add functionality to select an item
teacherDropdownItems.forEach(item => {
    item.addEventListener('click', (e) => {
        const teacherName = e.target.textContent.trim();
        const teacherId = e.target.dataset.id;

        // Set the selected teacher name in the search input
        teacherSearchInput.value = teacherName;

        // Set the hidden input with teacher_id
        teacherIdInput.value = teacherId;

        // Hide the dropdown
        teacherDropdownList.classList.remove('show');
    });
});

// Handle teacher selection and additional logic if needed
teacherDropdownList.addEventListener('click', (e) => {
    const item = e.target.closest('.TeachersDropdown');
    if (item) {
        const teacherName = item.textContent.trim();
        const teacherId = item.dataset.id;

        // Set selected teacher name to input
        teacherSearchInput.value = teacherName;

        // Set teacher_id to hidden input
        teacherIdInput.value = teacherId;

        // Additional actions if required (e.g., fetch data)
        console.log(`Teacher selected: ${teacherName} (ID: ${teacherId})`);
    }
});




  // Dropdown 1: Masjid Searchable Dropdown - Edit form
const searchInput1 = document.getElementById('searchInput1');
const masjidIdInput1 = document.getElementById('masjidId1');
const MasjidDropdownList = document.getElementById('MasjidDropdownList');
const dropdownItems1 = MasjidDropdownList.querySelectorAll('.dropdown-item');

// Show dropdown when the input is focused
searchInput1.addEventListener('focus', () => {
    MasjidDropdownList.classList.add('show');
});

// Hide dropdown if clicked outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('#searchInput1') && !e.target.closest('#MasjidDropdownList')) {
        MasjidDropdownList.classList.remove('show');
    }
});

// Filter dropdown items based on input
searchInput1.addEventListener('input', () => {
    const filter = searchInput1.value.toLowerCase();
    dropdownItems1.forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

// Select masjid and fetch courses
dropdownItems1.forEach(item => {
    item.addEventListener('click', (e) => {
        const masjidName1 = e.target.textContent.trim();
        const masjidId1 = e.target.dataset.id;

        searchInput1.value = masjidName1;
        masjidIdInput1.value = masjidId1;
        MasjidDropdownList.classList.remove('show');

        EditfetchCourses(masjidId1);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let masjidId1 = masjidIdInput1.value; // Get selected Masjid ID from the input field
	console.log(masjidId1);
    if (masjidId1) {
        EditfetchCourses(masjidId1); // Fetch courses automatically on page load
    }
});

function EditfetchCourses(masjidId1) {
	console.log(masjidId1);
    if (!masjidId1) return; // Prevent fetching if masjidId1 is empty or undefined

    fetch('<?= base_url("Student_Controller/get_courses_by_masjid") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'masjid_id=' + encodeURIComponent(masjidId1)
    })
    .then(response => response.json())
    .then(data => {
        const dropdownList4 = document.getElementById('dropdownList4');
        dropdownList4.innerHTML = ''; // Clear previous items

        if (data.length > 0) {
            data.forEach(course => {
                let li = document.createElement('li');
                li.innerHTML = `<a class="dropdown-item" href="#" data-id="${course.course_id}">${course.course_name}</a>`;
                dropdownList4.appendChild(li);
            });

            // Attach event listener for selection
            document.querySelectorAll('#dropdownList4 .dropdown-item').forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById('searchInput3').value = this.textContent;
                    document.getElementById('courseid3').value = this.dataset.id;
                    
                    // Hide dropdown after selection
                    dropdownList4.classList.remove('show');
                });
            });
        } else {
            // Show message if no courses are available
            let li = document.createElement('li');
            li.innerHTML = `<a class="dropdown-item disabled" href="#">No courses available</a>`;
            dropdownList4.appendChild(li);
        }
    })
    .catch(error => console.error('Error fetching courses:', error));
}

// Call this function when the form loads to fetch courses automatically
document.addEventListener("DOMContentLoaded", function () {
    let selectedMasjidId = document.getElementById("masjidSelect").value; // Get selected Masjid ID
    if (selectedMasjidId) {
        EditfetchCourses(selectedMasjidId); // Fetch courses automatically
    }
});


// Dropdown 1: Courses Searchable Dropdown
	const searchInput3 = document.getElementById('searchInput3');
	const masjidIdInput3 = document.getElementById('courseid3'); // Hidden input for masjid_id
	const dropdownList4 = document.getElementById('dropdownList4');
	const dropdownItems3 = dropdownList.querySelectorAll('.dropdown-item');

	// Show dropdown when the input is focused
	searchInput3.addEventListener('focus', () => {
		dropdownList4.classList.add('show');
	});

	// Hide dropdown if clicked outside
	document.addEventListener('click', (e) => {
		if (!e.target.closest('#searchInput3') && !e.target.closest('#dropdownList4')) {
			dropdownList4.classList.remove('show');
		}
	});

	// Filter items in the dropdown
	searchInput3.addEventListener('input', () => {
		const filter = searchInput2.value.toLowerCase();
		dropdownItems3.forEach(item => {
			item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
		});
	});

	// Add functionality to select an item
	dropdownItems3.forEach(item => {
		item.addEventListener('click', (e) => {
			const masjidName3 = e.target.textContent.trim();
			const masjidId3 = e.target.dataset.id;

			// Set the selected masjid name in the search input
			searchInput3.value = masjidName3;

			// Set the hidden input with masjid_id
			masjidIdInput3.value = masjidId3;

			// Hide the dropdown
			dropdownList4.classList.remove('show');
		});
	});

	// Handle masjid selection and fetch courses
	dropdownList4.addEventListener('click', (e) => {
		const item = e.target.closest('.dropdown-item');
		if (item) {
			const masjidName3 = item.textContent.trim();
			const masjidId3 = item.dataset.id;

			// Set selected masjid name to input
			searchInput3.value = masjidName3;

			// Set masjid_id to hidden input
			masjidIdInput3.value = masjidId3;
		}
	});
	
// Dropdown 3: Teacher Searchable Dropdown - Edit form
const teacherSearchInput1 = document.getElementById('TeachersearchInput1');
const teacherIdInput1 = document.getElementById('teacherId1'); // Hidden input for teacher_id
const teacherDropdownList1 = document.getElementById('dropdownList2');
const teacherDropdownItems1 = teacherDropdownList1.querySelectorAll('.TeachersDropdown');

// Show dropdown when the input is focused
teacherSearchInput1.addEventListener('focus', () => {
    teacherDropdownList1.classList.add('show');
});

// Hide dropdown if clicked outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('#TeachersearchInput1') && !e.target.closest('#dropdownList2')) {
        teacherDropdownList1.classList.remove('show');
    }
});

// Filter items in the dropdown
teacherSearchInput1.addEventListener('input', () => {
    const filter = teacherSearchInput1.value.toLowerCase();
    teacherDropdownItems1.forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

// Add functionality to select an item
teacherDropdownItems1.forEach(item => {
    item.addEventListener('click', (e) => {
        const teacherName = e.target.textContent.trim();
        const teacherId = e.target.dataset.id;

        // Set the selected teacher name in the search input
        teacherSearchInput1.value = teacherName;

        // Set the hidden input with teacher_id
        teacherIdInput1.value = teacherId;

        // Hide the dropdown
        teacherDropdownList1.classList.remove('show');
    });
});

// Handle teacher selection and additional logic if needed
teacherDropdownList1.addEventListener('click', (e) => {
    const item = e.target.closest('.TeachersDropdown');
    if (item) {
        const teacherName = item.textContent.trim();
        const teacherId = item.dataset.id;

        // Set selected teacher name to input
        teacherSearchInput1.value = teacherName;

        // Set teacher_id to hidden input
        teacherIdInput1.value = teacherId;

        // Additional actions if required (e.g., fetch data)
        console.log(`Teacher selected: ${teacherName} (ID: ${teacherId})`);
    }
});


//Fetch the Details in EDIT form
$(document).on('click', '.edit-btn', function() {
    var classId = $(this).data('id');
    $.ajax({
		url: "<?= base_url('getAssignClassData') ?>",
        type: "POST",
        data: { id: classId },
        success: function(response) {			
            var data = JSON.parse(response);
			//console.log(classId);
			console.log(response);
            $('#editAssignClassCanvas #EditAssignClassId').val(data.class_id);
            $('#editAssignClassCanvas #TeachersearchInput1').val(data.teacherName);
            $('#editAssignClassCanvas #searchInput1').val(data.MasjidName);
            $('#editAssignClassCanvas #searchInput3').val(data.CoursesName);
            $('#editAssignClassCanvas #courseid3').val(data.courses_id);
			$('#editAssignClassCanvas input[name="EditVisit_type"][value="' + data.visit_type + '"]').prop('checked', true);
			
			$('input[name="EditVisit_type"]').prop('disabled', true);
			// Disable all checkboxes and inputs
            $('.weekday-checkbox').prop('checked', false).prop('disabled', true);
            $('.weekday-input').val('').prop('disabled', true);

            // Enable only the fetched weekday and its inputs
            if (data.days) {
                var dayId = data.days;
                var startTime = data.start_time;
                var endTime = data.end_time;

                // Enable and populate only the selected weekday
                $('#Editweekday_' + dayId).prop('checked', true).prop('disabled', false);
                $('#Editstart_time_' + dayId).val(startTime).prop('disabled', false);
                $('#EditEnd_time_' + dayId).val(endTime).prop('disabled', false);
            }
            $('#editAssignClassCanvas').offcanvas('show');
        }
    });
});

</script>
<script>
$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').on('click', function() {
		//alert('dfdf');
        var classId = $(this).data('id');  // Get student ID from data-id attribute
		console.log(classId);

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
                    url: '<?= base_url("AssignClass_Controller/DeleteClass/"); ?>' + classId,  // Adjust controller name if needed
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
