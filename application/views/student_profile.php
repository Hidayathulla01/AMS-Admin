<?php
// student_profile.php
$default_image = 'assets/images/StudentImages/default.png';
$profile_picture_path = !empty($student->profile_picture) && file_exists(FCPATH . $student->profile_picture)
    ? base_url($student->profile_picture)
    : base_url($default_image);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="<?= base_url('assets/dist/css/bootstrap5.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/dist/css/dashboard.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .card-box {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 1rem;
            color: #6c757d;
        }
        .stat-value {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php include('SideBar.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="dashboard-content pt-3 pb-2">
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('DashboardIndex'); ?>">Dashboardtsrjsj</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Attendance Reports</li>
                    </ol>
                </nav>

                <div class="pt-4">
                    <div class="bg-white rounded shadow p-4">
                        <h4 class="mb-4">Student Details</h4>
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="<?= $profile_picture_path ?>" class="profile-img" alt="Profile Picture">
                            </div>
                            <div class="col-md-10">
                                <h5><?= htmlspecialchars($student->fullname) ?></h5>
                                <p class="mb-1">ID: <?= $student->student_id ?></p>
                                <p class="mb-1">Roll Number: <?= htmlspecialchars($student->roll_number) ?></p>
                                <p class="mb-1">Mobile: <?= htmlspecialchars($student->mobile_no) ?></p>
                                <p class="mb-1">Email: <?= htmlspecialchars($student->email) ?></p>
                                <p class="mb-1">Address: <?= htmlspecialchars($student->address) ?></p>
                            </div>
                        </div>

                        <div class="row text-center mb-4">
                            <div class="col-md-3">
                                <div class="card-box bg-light">
                                    <div class="stat-icon text-primary"><i class="fas fa-calendar-check"></i></div>
                                    <div class="stat-value"><?= array_sum($attendance_summary) ?> Days</div>
                                    <div class="stat-label">Total Attendance</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-box bg-light">
                                    <div class="stat-icon text-warning"><i class="fas fa-clock"></i></div>
                                    <div class="stat-value"><?= $attendance_summary['late'] ?> Days</div>
                                    <div class="stat-label">Late Attendance</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-box bg-light">
                                    <div class="stat-icon text-danger"><i class="fas fa-times-circle"></i></div>
                                    <div class="stat-value"><?= $attendance_summary['absent'] ?> Days</div>
                                    <div class="stat-label">Total Absent</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-box bg-light">
                                    <div class="stat-icon text-info"><i class="fas fa-plane-departure"></i></div>
                                    <div class="stat-value"><?= $attendance_summary['leave'] ?> Days</div>
                                    <div class="stat-label">Leave</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <canvas id="presentChart"></canvas>
                            </div>
                            <div class="col-md-4">
                                <canvas id="absentChart"></canvas>
                            </div>
                            <div class="col-md-4">
                                <canvas id="lateChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Scripts -->
<script>
const ctxPresent = document.getElementById('presentChart').getContext('2d');
const ctxAbsent = document.getElementById('absentChart').getContext('2d');
const ctxLate = document.getElementById('lateChart').getContext('2d');

new Chart(ctxPresent, {
    type: 'doughnut',
    data: {
        labels: ['Present', 'Others'],
        datasets: [{
            data: [<?= $attendance_summary['present'] ?>, <?= array_sum($attendance_summary) - $attendance_summary['present'] ?>],
            backgroundColor: ['#28a745', '#e0e0e0']
        }]
    }
});
new Chart(ctxAbsent, {
    type: 'doughnut',
    data: {
        labels: ['Absent', 'Others'],
        datasets: [{
            data: [<?= $attendance_summary['absent'] ?>, <?= array_sum($attendance_summary) - $attendance_summary['absent'] ?>],
            backgroundColor: ['#dc3545', '#e0e0e0']
        }]
    }
});
new Chart(ctxLate, {
    type: 'doughnut',
    data: {
        labels: ['Late', 'Others'],
        datasets: [{
            data: [<?= $attendance_summary['late'] ?>, <?= array_sum($attendance_summary) - $attendance_summary['late'] ?>],
            backgroundColor: ['#ffc107', '#e0e0e0']
        }]
    }
});
</script>

</body>
</html>
