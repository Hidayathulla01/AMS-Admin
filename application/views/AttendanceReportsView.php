<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Attendance Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Bootstrap -->
    <link href="./assets/dist/css/bootstrap5.css" rel="stylesheet">
    <link href="./assets/dist/css/dashboard.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

<?php include('SideBar.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-content pt-3 pb-2">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('DashboardIndex'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Reports</li>
            </ol>
        </nav>

        <div class="form-container bg-white rounded shadow p-4 mb-4">
            <h4 class="fs-5 mb-3">Filter Attendance Reports</h4>

<form method="post" action="<?= base_url('AttendanceResult') ?>">

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Masjid</label>
        <div class="col-sm-10">
            <select class="form-select" name="masjid_id" id="masjidDropdown" required>
                <option value="">Select Masjid</option>
                <?php foreach ($masjids as $masjid): ?>
                    <option value="<?= $masjid->masjid_id ?>"><?= $masjid->masjid_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Course</label>
        <div class="col-sm-10">
            <select class="form-select" name="course_id" id="courseDropdown" required>
                <option value="">Select Course</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Attendance Status</label>
        <div class="col-sm-10">
            <select class="form-select" name="attendance_filter">
                <option value="all">All</option>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
                <option value="leave">Leave</option>
                <option value="holiday">Holiday</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Date</label>
        <div class="col-sm-10 d-flex align-items-center gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="date_mode" value="single" checked>
                <label class="form-check-label">Single</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="date_mode" value="multi">
                <label class="form-check-label">Multi</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="date_mode" value="month">
                <label class="form-check-label">Month</label>
            </div>
        </div>
    </div>

    <div class="row mb-3" id="dateInputs">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <input type="text" name="date_single" class="form-control" id="singleDate">
        </div>
    </div>

<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-secondary" onclick="location.reload();">
        <i class="fas fa-sync-alt"></i> Reset
    </button>
    <button type="submit" class="btn btn-primary">Search</button>
</div>

</form>
        </div>

        <!-- Placeholder for attendance table if needed later -->

    </div>
</main>

<script>
$(document).ready(function() {
    flatpickr("#singleDate", {
    defaultDate: new Date(),
    dateFormat: "Y-m-d"
});

$('#masjidDropdown').on('change', function() {
    const masjidId = $(this).val();

    $('#courseDropdown').html('<option value="">Loading...</option>');

    if (masjidId) {
        $.ajax({
            url: '<?= base_url('AttendanceReportsController/get_courses_by_masjid') ?>',
            type: 'POST',
            data: { masjid_id: masjidId },
            dataType: 'json',
            success: function(response) {
                let options = '<option value="">Select Course</option>';
                response.forEach(function(course) {
                    options += `<option value="${course.course_id}">${course.course_name}</option>`;
                });
                $('#courseDropdown').html(options);
            },
            error: function() {
                $('#courseDropdown').html('<option value="">Error loading courses</option>');
            }
        });
    } else {
        $('#courseDropdown').html('<option value="">Select Course</option>');
    }
});

    $('input[name="date_mode"]').on('change', function () {
        const mode = $(this).val();
        let html = '';

        if (mode === 'single') {
            html = `<input type="text" name="date_single" class="form-control" id="singleDate">`;
        } else if (mode === 'multi') {
           html = `
    <input type="text" name="date_range" class="form-control" id="multiDateRange">
`;
        } else if (mode === 'month') {
            html = `
                <div class="row g-2">
                    <div class="col">
                        <select name="month" class="form-select">
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                               <option value="<?= $m ?>" <?= $m == date('n') ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 10)) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="year" class="form-select">
                            <?php $currentYear = date('Y'); for ($y = $currentYear - 5; $y <= $currentYear + 2; $y++): ?>
                               <option value="<?= $y ?>" <?= $y == date('Y') ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>`;
        }

        $('#dateInputs .col-sm-10').html(html);
       setTimeout(() => {
    if (mode === 'multi') {
        flatpickr("#multiDateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: [new Date(), new Date()]
        });
    } else if (mode === 'single') {
        flatpickr("#singleDate", {
            dateFormat: "Y-m-d",
            defaultDate: new Date()
        });
    }
}, 50);

    });
});
</script>


<script src="./assets/dist/js/dashboard.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
