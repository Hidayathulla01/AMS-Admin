<?php
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
 <!-- Fonts & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-wrapper {
            padding: 20px 30px;
        }

        .profile-header {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-card .icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .remarks-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .icon-present {
            color: green;
        }

        .icon-absent {
            color: red;
        }

        .icon-late {
            color: orange;
        }

        .icon-leave {
            color: blue;
        }

        .legend i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php include('SideBar.php'); ?>   <!-- Load Sidebar.php at body level -->

    <div class="container-fluid main-wrapper">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="<?= $profile_picture_path ?>" class="profile-img" alt="Profile Picture">
                        </div>
                        <div class="col">
                            <div class="row mb-1">
                                <div class="col-md-4 fw-semibold text-dark">
                                    <?= htmlspecialchars($student->fullname) ?>
                                </div>
                                <div class="col-md-4 text-muted">
                                    ID: <?= $student->student_id ?>
                                </div>
                                <div class="col-md-4 text-muted">
                                    Roll: <?= $student->roll_number ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-muted">
                                    <?= $student->email ?>
                                </div>
                                <div class="col-md-4 text-muted">
                                    <?= $student->mobile_no ?>
                                </div>
                                <div class="col-md-4 text-muted">
                                    <?= $student->address ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="icon text-success"><i class="fas fa-calendar-check"></i></div>
                            <h6 class="mb-0"><?= $attendance_summary['present'] ?> Days</h6>
                            <small class="text-muted">Present</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="icon icon-absent"><i class="fas fa-times-circle"></i></div>
                            <h6 class="mb-0"><?= $attendance_summary['absent'] ?> Days</h6>
                            <small class="text-muted">Absent</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="icon text-warning"><i class="fas fa-clock"></i></div>
                            <h6 class="mb-0"><?= $attendance_summary['late'] ?> Days</h6>
                            <small class="text-muted">Late</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="icon icon-leave"><i class="fas fa-plane-departure"></i></div>
                            <h6 class="mb-0"><?= $attendance_summary['leave'] ?> Days</h6>
                            <small class="text-muted">Leave</small>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="chart-card">
                            <h6>Overall Attendance Summary</h6>
                            <canvas id="attendancePie"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-card">
                            <h6>Weekly Attendance Trend</h6>
                            <canvas id="attendanceLine"></canvas>
                        </div>
                    </div>
                </div>

                <div class="remarks-box">
                    <h6 class="mb-3">Remarks History</h6>

                    <?php if (!empty($remarks_history)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($remarks_history as $remark):
                                        // Map numeric status to string
                                        $status_map = [
                                            '1' => 'present',
                                            '2' => 'absent',
                                            '3' => 'leave',
                                            '4' => 'late',
                                            '5' => 'holiday'
                                        ];

                                        $status_code = (string)$remark->attendance_status;
                                        $status = isset($status_map[$status_code]) ? $status_map[$status_code] : strtolower($remark->attendance_status);

                                        // Choose icon based on status
                                        switch ($status) {
                                            case 'present':
                                                $icon = '<i class="fas fa-calendar-check text-success"></i>';
                                                break;
                                            case 'absent':
                                                $icon = '<i class="fas fa-times-circle icon icon-absent"></i>';
                                                break;
                                            case 'late':
                                                $icon = '<i class="fas fa-clock icon-late"></i>';
                                                break;
                                            case 'leave':
                                                $icon = '<i class="fa-solid fa-plane-departure icon-leave"></i>';
                                                break;
                                            case 'holiday':
                                                $icon = '<i class="fa-solid fa-star text-warning"></i>';
                                                break;
                                            default:
                                                $icon = '<i class="fas fa-question-circle text-secondary"></i>';
                                                break;
                                        }
                                    ?>
                                        <tr>
                                            <td><?= date('d M Y', strtotime($remark->created_date)) ?></td>
                                            <td><?= $icon ?></td>
                                            <td>
                                                <?= htmlspecialchars($remark->remark) ?>
                                                <?php if ($status === 'late' && !empty($remark->late_time)): ?>
                                                    <span class="text-warning">(Late by <?= htmlspecialchars($remark->late_time) ?>)</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No remarks available.</p>
                    <?php endif; ?>
                </div>



            </main>
        </div>
    </div>

    <script>
        const attendancePie = document.getElementById('attendancePie').getContext('2d');
        new Chart(attendancePie, {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent', 'Late', 'Leave'],
                datasets: [{
                    label: 'Attendance Summary',
                    data: [
                        <?= $attendance_summary['present'] ?>,
                        <?= $attendance_summary['absent'] ?>,
                        <?= $attendance_summary['late'] ?>,
                        <?= $attendance_summary['leave'] ?>
                    ],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107', '#3f12e2ff']
                }]
            }
        });

        const attendanceLine = document.getElementById('attendanceLine').getContext('2d');
        new Chart(attendanceLine, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Weekly Attendance',
                    data: [5, 4, 5, 4, 5, 3, 2], // Sample data
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            }
        });
    </script>
<script src="<?php base_url('assets/dist/js/bootstrap.bundle.min.js')?>"></script>


</body>

</html>