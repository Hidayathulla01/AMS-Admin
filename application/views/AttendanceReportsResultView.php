<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Attendance Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="./assets/dist/css/bootstrap5.css" rel="stylesheet">
    <link href="./assets/dist/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .attendance-table th, .attendance-table td {
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
            padding: 6px;
        }

        .attendance-table th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .attendance-table td.name-col {
            text-align: left;
            white-space: nowrap;
            font-weight: 500;
        }

        .icon-present { color: green; }
        .icon-absent { color: red; }
        .icon-late { color: orange; }
        .icon-leave { color: blue; }

        .legend i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<?php include('SideBar.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-content pt-3 pb-2">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('DashboardIndex') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Report Result</li>
            </ol>
        </nav>

        <div class="bg-white rounded shadow p-4">
            <h4 class="mb-3 border-bottom pb-2 fs-5 fw-light">Attendance Calendar View</h4>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Masjid Name:</strong> <?= htmlspecialchars($masjid_name) ?></p>
                    <p><strong>Course Name:</strong> <?= htmlspecialchars($course_name) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teacher Name:</strong> <?= htmlspecialchars($report['teacher_name']) ?></p>
                    <p><strong>Date From:</strong> <?= $from ?> <strong>To:</strong> <?= $to ?></p>
                </div>
            </div>

            <div class="legend mb-3">
                <p><strong>NOTE :</strong>
                <i class="fa-solid fa-star text-warning"></i> Holiday
                <i class="fa-solid fa-check-circle icon-present ms-3"></i> Present
                <i class="fa-solid fa-clock icon-late ms-3"></i> Late
                <i class="fa-solid fa-xmark-circle icon-absent ms-3"></i> Absent
                <i class="fa-solid fa-plane-departure icon-leave ms-3"></i> On Leave
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered attendance-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <?php
                            $current = strtotime($from);
                            $end = strtotime($to);
                            while ($current <= $end):
                                $day = date('j', $current);
                                $dow = date('D', $current);
                                echo "<th>$day<br><span style='font-size:12px;'>$dow</span></th>";
                                $current = strtotime('+1 day', $current);
                            endwhile;
                            ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($report['students'] as $student): ?>
                            <tr>
                                <td class="name-col">
                                    <i class="fa-solid fa-user"></i>
                                    <?= htmlspecialchars($student['name']) ?><br>
                                    <small class="text-muted">Student</small>
                                </td>
                                <?php
                                $total = 0;
                                $current = strtotime($from);
                                $end = strtotime($to);
                                $count = 0;
                                while ($current <= $end):
                                    $count++;
                                    $dateStr = date('Y-m-d', $current);
                                    $status = $student['attendance'][$dateStr] ?? '-';
                                    $remarkData = $remarks[$student['student_id']][$dateStr] ?? [];
                                    $remark = $remarkData['remark'] ?? '';


                                    echo "<td><span class='attendance-icon' 
                                        data-name='" . htmlspecialchars($student['name']) . "' 
                                        data-status='" . ucfirst($status) . "' 
                                        data-date='" . $dateStr . "' 
                                        data-remark='" . htmlspecialchars($remark) . "' 
                                        style='cursor:pointer;'>";

                                    switch ($status) {
                                        case 'present':
                                            echo '<i class="fa-solid fa-check-circle icon-present" title="Present"></i>';
                                            $total++;
                                            break;
                                        case 'absent':
                                            echo '<i class="fa-solid fa-xmark-circle icon-absent" title="Absent"></i>';
                                            break;
                                        case 'late':
                                            echo '<i class="fa-solid fa-clock icon-late" title="Late"></i>';
                                            break;
                                        case 'leave':
                                            echo '<i class="fa-solid fa-plane-departure icon-leave" title="Leave"></i>';
                                            break;
                                        case 'holiday':
                                            echo '<i class="fa-solid fa-star text-warning" title="Holiday"></i>';
                                            break;
                                        default:
                                            echo '-';
                                    }

                                    echo "</span></td>";
                                    $current = strtotime('+1 day', $current);
                                endwhile;
                                echo "<td><span class='text-danger fw-bold'>$total/$count</span></td>";
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Attendance Detail Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attendance Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Student Name:</strong> <span id="modalStudentName"></span></p>
        <p><strong>Attendance Status:</strong> <span id="modalAttendanceStatus"></span></p>
        <p><strong>Date:</strong> <span id="modalDate"></span></p>
        <p><strong>Remark:</strong></p>
        <textarea id="modalRemark" class="form-control" rows="3" readonly></textarea>
      </div>
    </div>
  </div>
</div>

<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.attendance-icon').click(function() {
    const name = $(this).data('name');
    const status = $(this).data('status');
    const date = $(this).data('date');
    const remark = $(this).data('remark');

    $('#modalStudentName').text(name);
    $('#modalAttendanceStatus').text(status);
    $('#modalDate').text(date);
   $('#modalRemark').val(remark);

    $('#attendanceModal').modal('show');
  });
});
</script>
</body>
</html>
