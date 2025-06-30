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
		  <li class="breadcrumb-item active" aria-current="page">Students</li>
		</ol>
	  </nav>
	  <!-- <p class="fs-5">Dashboard / Adminstartors</p> -->
	  <div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fs-5">Students List</h4>
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#addAdminCanvas" aria-controls="addAdminCanvas">
        + Add Student</button>
    </div>
    <hr class="dropdown-divider">
    <div class="table-responsive">
        <table id="example" class="table table-striped display nowrap">
            <thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Student Name</th>
				<th scope="col">Course Name</th>
				<th scope="col">Gender</th>
				<th scope="col">Parent Email</th>
				<th scope="col">Action</th>
			  </tr>
            </thead>
			<tbody>
				<?php 
					$i = 1;
					foreach ($StudentList as $Data) { ?>
					<tr>
						<td scope="col"><?php echo $i; ?></td>
						<td scope="col"><?php echo $Data['fullname']; ?></td>
						<td scope="col"><?php echo $Data['course_name']; ?></td>
						<td scope="col"><?php echo $Data['gender']; ?></td>
						<td scope="col"><?php echo $Data['email']; ?></td>
						<td class="action-btns">
							<a type="button" class="view-btn btn btn-sm me-2" title="View" data-bs-toggle="offcanvas" data-bs-target="#viewAdminCanvas">
								<i class="fas fa-eye"></i>
							</a>
							<a  type="button" data-id="<?= $Data['student_id']; ?>" class="edit-btn btn btn-sm me-2" title="Edit" data-bs-toggle="offcanvas" data-bs-target="#editStudentCanvas"><i class="fas fa-pen"></i></a>
							<a type="button" class="delete-btn btn btn-sm me-2" title="delete" data-id="<?= $Data['student_id']; ?>">
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
    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="addAdminCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Add Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('Student_Controller/AddStudent');?>" class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
						<div class="col-md-12">							
                        <label class="form-label">GENDER </label>
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
                </div>
				<div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" id="fullname2" name="fullname" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control"  name="dob">
					</div>
				</div>
                <div class="row mb-3">
					<div class="col-md-6">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="profile_picture">
					 </div>
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No">
                    </div>
                </div>
				<div class="row mb-3">
						<div class="position-relative col-md-6 required-label">
							<label class="form-label">SELECT MASJID</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="masjid_id1" id="searchInput" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								<div class="invalid-feedback">Please enter Valid Details.</div>
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
						<div class="position-relative col-md-6 required-label">
							<label class="form-label">SELECT COURSE</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="course_id1" id="searchInput2" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								<div class="invalid-feedback">Please enter Valid Details.</div>
								 <input type="hidden" name="selected_courses" id="courseid2">
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
					</div>
				<div class="">
				<div class="row mb-3">
					<h5>Parent Details</h5>
				</div>
				<div class="row mb-3">
					<div class="col-md-6">
						<!--<label class="form-label">STATUS</label> -->
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="status" value="Existing" id="existingStatus">
								<label class="form-check-label" for="existingStatus">Existing</label>
							</div>
						</div>
					</div>
				</div>
                <div class="row mb-3">
					<div class="col-md-6 required-label" id="newInputField" style="display: none;">
						<label for="firstName" class="form-label">PARENT'S NAME</label>
						<input type="text" class="form-control" name="Parentfullname_new" id="Parentfullname_new" placeholder="Enter full name">
					</div>					
					<div class="position-relative col-md-6 required-label" id="existingDropdown">
						<label class="form-label">SELECT PARENT NAME</label>
						<div class="position-relative">
							<!-- Input Field for Search -->
							<input type="text" class="form-control pe-5 parentSearchInput" name="Parentfullname_display" id="parentSearchInput" autocomplete="off" spellcheck="false" placeholder="SELECT PARENT NAME">
							<input type="hidden" name="Parentfullname_existing" id="parentId12"> <!-- Hidden input -->
							<!-- Dropdown Icon -->
							<i class="fas fa-angle-down position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
						</div>
						<ul class="dropdown-menu w-100 mt-1 parentDropdownList" id="parentDropdownList">
							<?php
							$query = $this->db->select('fullname, parent_id')
											  ->from('tbl_parents')
											  ->where('delete_status', '1')
											  ->order_by('parent_id', 'ASC')
											  ->get();
							$result = $query->result_array();
							foreach ($result as $row) {
								$fullname = htmlspecialchars($row['fullname']); // Sanitize output
								$parent_id = htmlspecialchars($row['parent_id']);
								echo "<li>
										<a class='dropdown-item dropdown-item-parent' href='#' data-id='$parent_id'>$fullname</a>
										
									  </li>";
							}
							?>
						</ul>
					</div>
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">RELATIONSHIP</label>
                        <input type="text" class="form-control" name="relation" placeholder="Enter Relation To the Student" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
				</div> 
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">EMAIL</label>
                        <input type="email" class="form-control readonly-input" name="email" id="email" placeholder="Enter email" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control readonly-input" name="password" id="password" placeholder="Enter password" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
				</div>  
                <div class="row mb-3">			
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PARENT'S MOBILE NO </label>
						<input type="text" class="form-control readonly-input" name="parent_mobile" id="parent_mobile" placeholder="ENTER MOBILE" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					<div class="col-md-6  mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control readonly-input"  name="address" id="address" rows="1" placeholder="Enter address"
						 required></textarea>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">PAYMENT METHOD</label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="payment_method" id="online"  value="1" required>
						   <label class="form-check-label" for="online">Online</label>
						   </div>
						<div class="form-check form-check-inline">
						   <input class="form-check-input" type="radio" name="payment_method" id="offline"  value="2" required>
						   <label class="form-check-label" for="offline">Offline</label>
						</div>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
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
    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="editStudentCanvas" aria-labelledby="editAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="editAdminCanvasLabel">Edit Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo ('UpdateStudentData');?>" class="needs-validation" novalidate>
			<input type="hidden" name="EditStudentId" id="EditStudentId">
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
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
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                </div>
				<div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">FULL NAME </label>
                        <input type="text" class="form-control" name="EditFullname" id="EditFullname" placeholder="Enter first name" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                   <div class="col-md-6">
						<label for="dob" class="form-label">DATE OF BIRTH</label>
						<input type="date" class="form-control" name="EditDob" id="EditDob">
					</div>
				</div>
                <div class="row mb-3">
					<div class="col-md-6">
							<label for="file" class="form-label">PROFILE PICTURE</label>
							<input type="file" class="form-control" name="EditProfilePicture" id="EditProfilePicture">
					 </div>
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="EditMobile" id="EditMobile" placeholder="Enter Mobile No">
                    </div>
                </div>
					<div class="row mb-3">
						<div class="position-relative col-md-6 required-label">
							<label class="form-label">SELECT MASJID</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="masjid_id1" id="searchInput1" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								<div class="invalid-feedback">Please enter Valid Details.</div>
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
						<div class="position-relative col-md-6 required-label">
							<label class="form-label">SELECT COURSE</label>
							<div class="position-relative">
								<!-- Input Field for Search -->
								<input type="text" class="form-control pe-5" name="Editcourse_id" id="searchInput3" autocomplete="off" spellcheck="false" placeholder="Search for options..." required>
								<div class="invalid-feedback">Please enter Valid Details.</div>
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
					</div>
				<div class="">
				<div class="row mb-3">
					<h5>Parent Details</h5>
				</div>
				<div class="row mb-3">
					<div class="col-md-6">
						<!--<label class="form-label">STATUS</label> -->
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" class="existingStatus" type="checkbox" name="EditExistingstatus" value="Existing" id="existingStatus1">
								<label class="form-check-label" for="existingStatus1">Existing</label>
							</div>
						</div>
					</div>
				</div>
                <div class="row mb-3">
					<div class="col-md-6 required-label" id="newInputField1" style="display: none;">
						<label for="firstName" class="form-label">PARENT'S NAME</label>
						<input type="text" class="form-control" name="EditParentfullname_new" id="EditParentfullname_new" placeholder="Enter full name">
					</div>					
					<div class="position-relative col-md-6 required-label" id="existingDropdown1">
						<label class="form-label">SELECT PARENT NAME</label>
						<div class="position-relative">
							<!-- Input Field for Search -->
							<input type="text" class="form-control pe-5 parentSearchInput searchInput" name="EditParentfullname" id="parentSearchInput1" autocomplete="off" spellcheck="false" placeholder="SELECT PARENT NAME">
							<input type="hidden" name="EditParentfullname_existing" id="parentId1" value="<?= isset($parent_id) ? htmlspecialchars($parent_id) : '' ?>"> <!-- Hidden input -->
							<i class="fas fa-angle-down position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
						</div>

						<!-- Dropdown List -->
						<ul class="dropdown-menu w-100 mt-1 parentDropdownList dropdownList" id="parentDropdownList1">
							<?php
							$query = $this->db->select('fullname, parent_id')
											  ->from('tbl_parents')
											  ->where('delete_status', '1')
											  ->order_by('parent_id', 'ASC')
											  ->get();
							$result = $query->result_array();

							foreach ($result as $row) {
								$fullname = htmlspecialchars($row['fullname']); // Sanitize output
								$parent_id = htmlspecialchars($row['parent_id']);
									  $selected = ($parent_id == $row['parent_id']) ? 'selected' : '';
									echo "<li><a class='dropdown-item dropdown-item-parent $selected' href='#' data-id='{$row['parent_id']}'>{$row['fullname']}</a></li>";
							}
							?>
						</ul>
					</div>
                    <div class="col-md-6 mb-3 required-label">
                        <label for="firstName" class="form-label">RELATIONSHIP</label>
                        <input type="text" class="form-control" name="EditRelation" id="EditRelation" placeholder="Enter Relation To the Student" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
				</div> 
                <div class="row mb-3">
                    <div class="col-md-6 required-label">
                        <label for="firstName" class="form-label">EMAIL</label>
                        <input type="email" class="form-control readonly-input1" name="EditEmail" id="EditEmail" placeholder="Enter email" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PASSWORD </label>
						<input type="password" class="form-control readonly-input1" name="EditPassword" id="EditPassword" placeholder="Enter password" readonly>
					</div>
				</div>  
                <div class="row mb-3">			
                   <div class="col-md-6 required-label">
						<label for="password" class="form-label">PARENT'S MOBILE NO </label>
						<input type="text" class="form-control readonly-input1" name="EditParentMobile" id="EditParent_mobile" placeholder="ENTER MOBILE" required>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
					<div class="col-md-6  mb-3">
						 <label for="address" class="form-label">ADDRESS</label>
						 <textarea class="form-control readonly-input1"  name="EditAddress" id="EditAddress" rows="1" placeholder="Enter address"required></textarea>
						<div class="invalid-feedback">Please enter Valid Details.</div>
					</div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">PAYMENT METHOD</label>
						<div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="EditPaymentMethod" id="EditPaymentOnline"  value="1" required>
						   <label class="form-check-label" for="EditPaymentOnline">Online</label>
						   </div>
						<div class="form-check form-check-inline">
						   <input class="form-check-input" type="radio" name="EditPaymentMethod" id="EditPaymentOffline"  value="2" required>
						   <label class="form-check-label" for="EditPaymentOffline">Offline</label>
						</div>
						</div>
						<div class="invalid-feedback">Please enter Valid Details.</div>
                    </div>
				</div>              
				</div>              
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
	});
	});
	
	 // Get elements
	const existingStatusRadio = document.getElementById('existingStatus');
	const newInputField = document.getElementById('newInputField');
	const existingDropdown = document.getElementById('existingDropdown');

	const inputFields = document.querySelectorAll('.readonly-input');
		
	// Set initial state
	existingStatusRadio.checked = false; 
	newInputField.style.display = 'block'; 
	existingDropdown.style.display = 'none';

	existingStatusRadio.addEventListener('change', () => {
		if (existingStatusRadio.checked) {
			newInputField.style.display = 'none';
			existingDropdown.style.display = 'block';
			inputFields.forEach(input => input.setAttribute('readonly', true));
		} else {
			newInputField.style.display = 'block';
			existingDropdown.style.display = 'none';
			inputFields.forEach(input => {
				input.removeAttribute('readonly');
				input.setAttribute('required', '');
				input.value = '';
			});
		}
	});
	
	
	//auto fetching for parent Details
	$(document).ready(function () {
		$('#parentDropdownList').on('click', '.dropdown-item-parent', function (e) {
			
			e.preventDefault();
			// Get selected parent's ID and Name
			const parentId = $(this).data('id');
			const parentName = $(this).text();
			
			$('#parentSearchInput').val(parentName);
			$('#parentId12').val(parentId);
			
			fetch_select(parentId);
			
		});
	});

	function fetch_select(parentId) {
		var url = '<?php echo base_url('GetParentData') ?>'; 
		$.ajax({
			type: "POST",
			url: url,
			data: { ParentId: parentId },
			dataType: "json",
			success: function (data) {
				if (data && data.length > 0) {
					const { email, password, parent_mobile, address } = data[0];
					$("#email").val(email || ''); 
					$("#password").val(password || ''); 
					$("#parent_mobile").val(parent_mobile || ''); 
					$("#address").val(address || ''); 
				} else {
					alert('No data found for the selected parent.');
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', error);
				alert('Unable to fetch parent data.');
			}
		});
	}
	
	 // Get elements
	const existingStatusRadio1 = document.getElementById('existingStatus1');
	const newInputField1 = document.getElementById('newInputField1');
	const existingDropdown1 = document.getElementById('existingDropdown1');

	const inputFields1 = document.querySelectorAll('.readonly-input1');
		
	// Set initial state
	existingStatusRadio1.checked = true; 
	newInputField1.style.display = 'none'; 
	existingDropdown1.style.display = 'block';
	
	inputFields1.forEach(input => input.setAttribute('readonly', true));

	existingStatusRadio1.addEventListener('change', () => {
		if (existingStatusRadio1.checked) {
			newInputField1.style.display = 'none';
			existingDropdown1.style.display = 'block';
			inputFields1.forEach(input => input.setAttribute('readonly', true));
		} else {
			newInputField1.style.display = 'block';
			existingDropdown1.style.display = 'none';
			inputFields1.forEach(input => {
				input.removeAttribute('readonly');
				input.setAttribute('required', '');
				input.value = '';
			});
		}
	});
	
	
$(document).ready(function () {
		$('#parentDropdownList1').on('click', '.dropdown-item-parent', function (e) {
			e.preventDefault();
			// Get selected parent's ID and Name
			const parentId = $(this).data('id');
			const parentName = $(this).text();
			//alert(parentId);
			$('#parentSearchInput1').val(parentName);
			$('#parentId1').val(parentId);
			console.log(parentId);
			Editfetch_select(parentId);
		});
	});



	function Editfetch_select(parentId) {
		var url = '<?php echo base_url('GetParentData') ?>'; 
		$.ajax({
			type: "POST",
			url: url,
			data: { ParentId: parentId },
			dataType: "json",
			success: function (data) {
				if (data && data.length > 0) {					
					console.log(data);
					const { email, password, parent_mobile, address } = data[0];
					$("#EditEmail").val(email || ''); 
					$("#EditPassword").val(password || ''); 
					$("#EditParent_mobile").val(parent_mobile || ''); 
					//$('#EditParent_mobile').val('1234567890');
					$("#EditAddress").val(address || ''); 
				} else {
					alert('No data found for the selected parent.');
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', error);
				alert('Unable to fetch parent data.');
			}
		});
	}
	
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



document.addEventListener("DOMContentLoaded", function () {
    // Select all dropdown input fields and lists
    const parentSearchInputs = document.querySelectorAll('.parentSearchInput');
    const parentDropdownLists = document.querySelectorAll('.parentDropdownList');
    const parentIdInputs = document.querySelectorAll('input[name="EditParentfullname_existing"]'); // Correcting the selection

    parentSearchInputs.forEach((searchInput, index) => {
        const dropdownList = parentDropdownLists[index]; // Get corresponding dropdown list
        const parentIdInput = parentIdInputs[index]; // Get corresponding hidden input

        // Show dropdown when input is focused
        searchInput.addEventListener('focus', () => {
            dropdownList.classList.add('show');
        });

        // Hide dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.parentSearchInput') && !e.target.closest('.parentDropdownList')) {
                dropdownList.classList.remove('show');
            }
        });

        // Filter items in the dropdown
        searchInput.addEventListener('input', () => {
            const filter = searchInput.value.toLowerCase();
            const dropdownItems = dropdownList.querySelectorAll('.dropdown-item'); // Fix class name
            dropdownItems.forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });

        // Handle dropdown item selection
        dropdownList.addEventListener('click', (e) => {
            const clickedItem = e.target.closest('.dropdown-item'); // Fix class name
            if (clickedItem) {
                const parentName = clickedItem.textContent.trim();
                const parentId = clickedItem.getAttribute('data-id');

                searchInput.value = parentName;
                parentIdInput.value = parentId;

                // Hide the dropdown immediately after selection
                dropdownList.classList.remove('show');
            }
        });
    });
});


//Fetch the Details in EDIT form
$(document).on('click', '.edit-btn', function() {
    var StudentId = $(this).data('id');

    $.ajax({
		url: "<?= base_url('getStudentData') ?>",
        type: "POST",
        data: { id: StudentId },
        success: function(response) {			
            var data = JSON.parse(response);
			console.log(StudentId);
			console.log(response);
            $('#editStudentCanvas #EditStudentId').val(data.student_id);
            $('#editStudentCanvas #EditFullname').val(data.StudentName);
            $('#editStudentCanvas #searchInput1').val(data.MasjidName);
            //$('#editStudentCanvas #masjidId2').val(data.masjid_id);
            $('#editStudentCanvas #searchInput3').val(data.CoursesName);
            $('#editStudentCanvas #courseid3').val(data.course_id);
            $('#editStudentCanvas #EditDob').val(data.dob);
			$('#editStudentCanvas input[name="EditGender"][value="' + data.gender + '"]').prop('checked', true);
			$('#editStudentCanvas input[name="EditPaymentMethod"][value="' + data.payment_method + '"]').prop('checked', true);
            $('#editStudentCanvas #EditRelation').val(data.relation);
            $('#editStudentCanvas #EditEmail').val(data.email);
            $('#editStudentCanvas #EditPassword').val(data.password);
            $('#editStudentCanvas #EditParent_mobile').val(data.parent_mobile);
            $('#editStudentCanvas #EditMobile').val(data.mobile_no);
            $('#editStudentCanvas #EditAddress').val(data.address);
            //$('#editStudentCanvas #Parentfullname_new').val(data.ParentName);
			$('#editStudentCanvas input[name="EditParentfullname"]').val(data.ParentName);			
            $('#editStudentCanvas').offcanvas('show');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').on('click', function() {
		//alert('dfdf');
        var adminId = $(this).data('id');  // Get student ID from data-id attribute
		//console.log(adminId);

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
                    url: '<?= base_url("Student_Controller/DeleteStudent/"); ?>' + adminId,  // Adjust controller name if needed
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
</body>
</html>
