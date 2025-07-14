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
      <!-- Fonts & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .attendance-table th,
        .attendance-table td {
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

        .text-danger {
            color: #198754 !important;
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
                    <li class="breadcrumb-item active" aria-current="page">Attendance Report</li>
                </ol>
            </nav>

            <div class="bg-white rounded shadow p-4">
                <h4 class="mb-3 border-bottom pb-2 fs-5 fw-light">Attendance Reports</h4>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Masjid Name:</strong> <?= htmlspecialchars($masjid_name) ?></p>
                        <p><strong>Course Name:</strong> <?= htmlspecialchars($course_name) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Teacher Name:</strong> <?= htmlspecialchars($report['teacher_name']) ?></p>
                        <?php if ($from === $to): ?>
                            <p><strong>Date:</strong> <?= date('d-m-Y', strtotime($from)) ?></p>
                        <?php else: ?>
                            <p><strong>Date From:</strong> <?= date('d-m-Y', strtotime($from)) ?> <strong>To:</strong> <?= date('d-m-Y', strtotime($to)) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center mb-2 mb-md-0">
                        <label for="entriesPerPage" class="me-2 mb-0 small text-muted">Show entries per page:</label>
                        <select id="entriesPerPage" class="form-select form-select-sm" style="width: auto;">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="legend mb-0">
                        <strong>NOTE :</strong>
                        <i class="fa-solid fa-star text-warning"></i> Holiday
                        <i class="fa-solid fa-check-circle icon-present ms-3"></i> Present
                        <i class="fa-solid fa-clock icon-late ms-3"></i> Late
                        <i class="fa-solid fa-xmark-circle icon-absent ms-3"></i> Absent
                        <i class="fa-solid fa-plane-departure icon-leave ms-3"></i> On Leave
                    </div>
                    <form method="post" action="<?= base_url('AttendanceReportsController/export_excel') ?>" target="_blank" class="mb-0">
                        <input type="hidden" name="masjid_id" value="<?= htmlspecialchars($this->input->post('masjid_id')) ?>">
                        <input type="hidden" name="course_id" value="<?= htmlspecialchars($this->input->post('course_id')) ?>">
                        <input type="hidden" name="attendance_filter" value="<?= htmlspecialchars($this->input->post('attendance_filter')) ?>">
                        <input type="hidden" name="date_mode" value="<?= htmlspecialchars($this->input->post('date_mode')) ?>">
                        <input type="hidden" name="date_single" value="<?= htmlspecialchars($this->input->post('date_single')) ?>">
                        <input type="hidden" name="date_range" value="<?= htmlspecialchars($this->input->post('date_range')) ?>">
                        <input type="hidden" name="month" value="<?= htmlspecialchars($this->input->post('month')) ?>">
                        <input type="hidden" name="year" value="<?= htmlspecialchars($this->input->post('year')) ?>">
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <i class="fa fa-download"></i> Export Excel
                        </button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered attendance-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <?php
                                $count = 0;
                                foreach ($report['filtered_dates'] as $date):
                                    $count++;
                                    $day = date('j', strtotime($date));
                                    $dow = date('D', strtotime($date));
                                    echo "<th data-col='{$count}'>$day<br><span style='font-size:12px;'>$dow</span></th>";
                                endforeach;
                                ?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($report['students'] as $student): ?>
                                <tr>
                                    <?php
                                    // Prepare attendance counts for the pie chart
                                    $present = $absent = $late = $leave = $holiday = 0;
                                    foreach ($report['filtered_dates'] as $date) {
                                        $status = strtolower($student['attendance'][$date] ?? '-');
                                        if ($status == 'present') $present++;
                                        elseif ($status == 'absent') $absent++;
                                        elseif ($status == 'late') $late++;
                                        elseif ($status == 'leave') $leave++;
                                        elseif ($status == 'holiday') $holiday++;
                                    }
                                    ?>
                                    <td class="name-col">
                                        <i class="fa-solid fa-user"></i>
                                        <a href="<?= base_url('AttendanceReportsController/student_view/' . $student['student_id']) ?>">
                                            <?= htmlspecialchars($student['name']) ?>
                                        </a>
                                        <br>
                                        <small class="text-muted">Student</small>
                                    </td>

                                    <?php
                                    $total = 0;
                                    $count = 0;
                                    $filter = strtolower(trim($this->input->post('attendance_filter')));
                                    if ($filter === '' || $filter === 'all') {
                                        $filter = 'present';
                                    }

                                    foreach ($report['filtered_dates'] as $date):
                                        $count++;
                                        $status = $student['attendance'][$date] ?? '-';
                                        $remarkData = $remarks[$student['student_id']][$date] ?? [];
                                        $remark = $remarkData['remark'] ?? '';

                                        // Get profile picture, use default if missing
                                        $profilePic = !empty($student['profile_picture']) ? $student['profile_picture'] : './assets/images/StudentImages/default.png';

                                        echo "<td data-col='{$count}'>
<span class='attendance-icon'
    data-name='" . htmlspecialchars($student['name']) . "'
    data-status='" . strtolower($status) . "'
    data-date='" . $date . "'
    data-remark='" . htmlspecialchars($remark) . "'
    data-image='" . htmlspecialchars($profilePic) . "'
    style='cursor:pointer;'>";

                                        switch ($status) {
                                            case 'present':
                                                echo '<i class="fa-solid fa-check-circle icon-present" title="Present"></i>';
                                                if ($filter == 'present' || $filter == 'all') $total++;
                                                break;
                                            case 'absent':
                                                echo '<i class="fa-solid fa-xmark-circle icon-absent" title="Absent"></i>';
                                                if ($filter == 'absent' || $filter == 'all') $total++;
                                                break;
                                            case 'late':
                                                echo '<i class="fa-solid fa-clock icon-late" title="Late"></i>';
                                                if ($filter == 'late' || $filter == 'all') $total++;
                                                break;
                                            case 'leave':
                                                echo '<i class="fa-solid fa-plane-departure icon-leave" title="Leave"></i>';
                                                if ($filter == 'leave' || $filter == 'all') $total++;
                                                break;
                                            case 'holiday':
                                                echo '<i class="fa-solid fa-star text-warning" title="Holiday"></i>';
                                                if ($filter == 'holiday' || $filter == 'all') $total++;
                                                break;
                                            default:
                                                echo '-';
                                        }

                                        echo "</span></td>";
                                    endforeach;

                                    echo "<td><span class='text-danger fw-bold'>$total/$count</span></td>";

                                    ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="columnPagination" class="d-flex justify-content-end mb-2"></div>
                <?php if (empty($report['students'])): ?>
                    <div class="alert alert-warning text-center mt-4">
                        No students found for the selected attendance status.
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- Attendance Modal -->
    <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-start mb-3">
                        <img id="modalProfilePic" src="" alt="Profile Picture"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc; margin-right: 15px;">
                        <div>
                            <p><strong>Student Name:</strong> <span id="modalStudentName"></span></p>
                            <p><strong>Attendance Status:</strong> <span id="modalAttendanceStatus"></span></p>
                            <p><strong>Date:</strong> <span id="modalDate"></span></p>
                        </div>
                    </div>
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
                $('#modalStudentName').text($(this).data('name'));
                $('#modalAttendanceStatus').text($(this).data('status'));
                $('#modalDate').text($(this).data('date'));
                $('#modalRemark').val($(this).data('remark'));
                $('#modalProfilePic').attr('src', $(this).data('image')); // set image
                $('#attendanceModal').modal('show');
            });

            const columnsPerPage = 10;
            let currentPage = 1;

            function paginateColumns(page) {
                const totalColumns = $('thead th[data-col]').length;
                const totalPages = Math.ceil(totalColumns / columnsPerPage);
                currentPage = Math.max(1, Math.min(page, totalPages));

                $('thead th[data-col]').each(function() {
                    const index = parseInt($(this).data('col'));
                    $(this).toggle(index > (currentPage - 1) * columnsPerPage && index <= currentPage * columnsPerPage);
                });

                $('tbody tr').each(function() {
                    $(this).find('td[data-col]').each(function() {
                        const index = parseInt($(this).data('col'));
                        $(this).toggle(index > (currentPage - 1) * columnsPerPage && index <= currentPage * columnsPerPage);
                    });
                });

                renderPagination(totalPages);
            }
            // Student Row Pagination (entries per page)
            let studentsPerPage = parseInt($('#entriesPerPage').val());
            let currentStudentPage = 1;

            function paginateStudentRows() {
                const rows = $('table tbody tr');
                const totalRows = rows.length;
                const totalPages = Math.ceil(totalRows / studentsPerPage);

                rows.hide();
                rows.slice((currentStudentPage - 1) * studentsPerPage, currentStudentPage * studentsPerPage).show();

                // Optional: update pagination UI for student rows if needed
            }

            $('#entriesPerPage').change(function() {
                studentsPerPage = parseInt($(this).val());
                currentStudentPage = 1;
                paginateStudentRows();
            });

            paginateStudentRows(); // Initial call

            function renderPagination(totalPages) {
                let pagination = '';
                if (totalPages <= 1) {
                    $('#columnPagination').html('');
                    return;
                }

                pagination += `<ul class="pagination pagination-sm">`;
                pagination += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="paginateColumns(${currentPage - 1})">&laquo;</a></li>`;

                for (let i = 1; i <= totalPages; i++) {
                    pagination += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="paginateColumns(${i})">${i}</a></li>`;
                }

                pagination += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="paginateColumns(${currentPage + 1})">&raquo;</a></li>`;
                pagination += `</ul>`;

                $('#columnPagination').html(pagination);
            }

            // make it globally callable
            window.paginateColumns = paginateColumns;
            paginateColumns(1);
        });
    </script>
<script src="<?= base_url('assets/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>