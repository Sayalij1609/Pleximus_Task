<?php
$fullName = trim(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? ''));

$pageTitle = 'Student Details';
$pageHeading = 'Student Profile';
$pageSubtitle = 'Detailed academic and personal information';
$activeNav = 'students_index';

require __DIR__ . '/../layouts/app_header.php';
?>

<div class="mx-auto" style="max-width: 920px;">
    <!-- Top Student Banner Card -->
    <div class="sms-card mb-4">
        <div class="sms-card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <span class="avatar-circle avatar-circle-lg">
                        <?= e(userInitials($fullName)) ?>
                    </span>
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <h3 class="fw-bold mb-0"><?= e($fullName) ?></h3>
                            <span class="roll-badge"><?= e($student['roll_number']) ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="course-badge"><?= e($student['course']) ?></span>
                            <span class="year-badge"><?= e($student['year']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= BASE_PATH ?>/students/edit?id=<?= (int)$student['id'] ?>" class="btn btn-warning btn-sm d-inline-flex align-items-center gap-1">
                        <i class="bi bi-pencil-square"></i>
                        <span>Edit Student</span>
                    </a>
                    <button type="button"
                            class="btn btn-outline-danger btn-sm js-delete-student-btn d-inline-flex align-items-center gap-1"
                            data-student-id="<?= (int)$student['id'] ?>"
                            data-student-name="<?= e($fullName) ?>"
                            data-student-roll="<?= e($student['roll_number']) ?>">
                        <i class="bi bi-trash3"></i>
                        <span>Delete</span>
                    </button>
                    <a href="<?= BASE_PATH ?>/students" class="btn btn-light border btn-sm d-inline-flex align-items-center gap-1">
                        <i class="bi bi-arrow-left"></i>
                        <span>All Students</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="sms-card h-100">
                <div class="sms-card-header">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i>Personal &amp; Contact Information
                    </h6>
                </div>
                <div class="sms-card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">First Name</div>
                                <div class="detail-item-value"><?= e($student['first_name']) ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Last Name</div>
                                <div class="detail-item-value"><?= e($student['last_name']) ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Email Address</div>
                                <div class="detail-item-value"><?= !empty($student['email']) ? e($student['email']) : '<span class="text-muted fw-normal">Not provided</span>' ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Phone Number</div>
                                <div class="detail-item-value"><?= !empty($student['phone']) ? e($student['phone']) : '<span class="text-muted fw-normal">Not provided</span>' ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Gender</div>
                                <div class="detail-item-value"><?= !empty($student['gender']) ? e($student['gender']) : '<span class="text-muted fw-normal">Not specified</span>' ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Date of Birth</div>
                                <div class="detail-item-value"><?= formatDisplayDate($student['date_of_birth'] ?? '') ?></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="detail-item">
                                <div class="detail-item-label">Address</div>
                                <div class="detail-item-value"><?= !empty($student['address']) ? nl2br(e($student['address'])) : '<span class="text-muted fw-normal">No address recorded</span>' ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="sms-card h-100">
                <div class="sms-card-header">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-mortarboard-fill text-primary me-2"></i>Academic &amp; System Info
                    </h6>
                </div>
                <div class="sms-card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="detail-item">
                                <div class="detail-item-label">Student ID</div>
                                <div class="detail-item-value">#<?= (int)$student['id'] ?></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="detail-item">
                                <div class="detail-item-label">Roll Number</div>
                                <div class="detail-item-value"><?= e($student['roll_number']) ?></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="detail-item">
                                <div class="detail-item-label">Course</div>
                                <div class="detail-item-value"><?= e($student['course']) ?></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="detail-item">
                                <div class="detail-item-label">Academic Year</div>
                                <div class="detail-item-value"><?= e($student['year']) ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Created At</div>
                                <div class="detail-item-value small"><?= formatDisplayDate($student['created_at'] ?? '', 'M d, Y h:i A') ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-item">
                                <div class="detail-item-label">Last Updated</div>
                                <div class="detail-item-value small"><?= formatDisplayDate($student['updated_at'] ?? '', 'M d, Y h:i A') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
