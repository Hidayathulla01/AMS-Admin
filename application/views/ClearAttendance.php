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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

</head>
  <body>
    <!-- SideBar and Navbar -->
	<?php include('SideBar.php'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 ">
      </div>
     <!--  <h2>Section title</h2> -->
	<div class="dashboard-content">
	
    <div class="" tabindex="-1" id="addAdminCanvas" aria-labelledby="addAdminCanvasLabel" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addAdminCanvasLabel">Delete Attendance</h5>
        </div>
        <div class="offcanvas-body position-sticky">
            <form method="POST"  enctype="multipart/form-data" action="<?php echo base_url('ClearAttendance_Controller/DeleteAttendanceData');?>" class="needs-validation" novalidate>
					<div class="row mb-3">
						<div class="position-relative col-md-6 required-label">
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
						<div class="position-relative col-md-6 required-label">
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
						<label for="start_date" class="form-label"> ATTENDANCE DATE</label> 
						<input type="date" class="form-control"  name="attendance_date" id="start_date" max="<?= date('Y-m-d'); ?>" required>
						<div id="dateError" class="invalid-feedback" style="display: none;"></div>
					</div>
                </div>				          
                <div class="d-flex justify-content-left">
                    <input type="submit" name="Addsubmit" class="btn btn-custom me-2" value="Save">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="offcanvas">Close</button>
                </div>
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
        dropdownList3.innerHTML = ''; // Clear previous courses

        if (data.length > 0) {
            data.forEach(course => {
                let li = document.createElement('li');
                li.innerHTML = `<a class="dropdown-item" href="#" data-id="${course.course_id}">${course.course_name}</a>`;
                dropdownList3.appendChild(li);
            });

            // Reattach event listeners for the newly added course items
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
			searchInput.value = masjidName2;

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
    $(document).ready(function() {
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
		
		<?php if ($this->session->flashdata('S')): ?>
            toastr.error("<?= $this->session->flashdata('error'); ?>");
        <?php endif; ?>
    });
</script>
</body>
</html>
