<?php
$pageTitle = 'Dashboard';
$pageHeading = 'Dashboard';
$pageSubtitle = 'Overview of your student directory & quick actions';
$activeNav = 'dashboard';

require __DIR__ . '/../layouts/app_header.php';
?>

<!-- Welcome Banner -->
<div class="welcome-banner mb-4">
    <div class="row align-items-center g-3 position-relative" style="z-index: 1;">
        <div class="col-lg-8">
            <span class="badge bg-white bg-opacity-25 text-white mb-2 px-3 py-1.5 rounded-pill fw-semibold">
                <i class="bi bi-sparkles me-1"></i> Workspace Overview
            </span>
            <h2 class="fw-bold mb-1">Welcome back, <?= e($userName) ?>!</h2>
            <p class="mb-0 text-white-50">
                Manage student enrollment, update records, or review your profile security from one place.
            </p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <div class="d-flex gap-2 justify-content-lg-end flex-wrap">
                <a href="<?= BASE_PATH ?>/students/create" class="btn btn-light text-primary fw-bold">
                    <i class="bi bi-person-plus-fill me-1"></i> Add Student
                </a>
                <a href="<?= BASE_PATH ?>/profile" class="btn btn-outline-light">
                    <i class="bi bi-person-circle me-1"></i> My Profile
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-4">
        <div class="stat-card d-flex align-items-center justify-content-between gap-3">
            <div>
                <div class="stat-label">Total Students</div>
                <div class="stat-value"><?= e($totalStudents) ?></div>
                <div class="small text-muted mt-1">Active records in your directory</div>
            </div>
            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="stat-card d-flex align-items-center justify-content-between gap-3">
            <div>
                <div class="stat-label">Recent Additions</div>
                <div class="stat-value"><?= count($recentStudents) ?></div>
                <div class="small text-muted mt-1">Latest student entries shown below</div>
            </div>
            <div class="stat-icon stat-icon-emerald">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="stat-card d-flex align-items-center justify-content-between gap-3">
            <div class="min-width-0">
                <div class="stat-label">Account &amp; Security</div>
                <div class="fw-bold fs-6 text-truncate"><?= e($userName) ?></div>
                <div class="small text-muted text-truncate mb-2">
                    <?= e($_SESSION['user_email'] ?? '') ?>
                </div>
                <a href="<?= BASE_PATH ?>/profile" class="small fw-semibold text-decoration-none">
                    View My Profile &amp; Security <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="stat-icon stat-icon-indigo">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold mb-0">Quick Actions</h5>
        <span class="small text-muted">Student &amp; account shortcuts</span>
    </div>

    <div class="row g-3">
        <div class="col-sm-6 col-xl-3">
            <a href="<?= BASE_PATH ?>/students/create" class="quick-action-tile">
                <span class="quick-action-icon stat-icon-blue">
                    <i class="bi bi-person-plus-fill"></i>
                </span>
                <div>
                    <div class="fw-bold">Add Student</div>
                    <div class="small text-muted">Enroll a new student</div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-3">
            <a href="<?= BASE_PATH ?>/students?action=edit" class="quick-action-tile">
                <span class="quick-action-icon stat-icon-amber">
                    <i class="bi bi-pencil-square"></i>
                </span>
                <div>
                    <div class="fw-bold">Update Student</div>
                    <div class="small text-muted">Modify student info</div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-3">
            <a href="<?= BASE_PATH ?>/students?action=delete" class="quick-action-tile">
                <span class="quick-action-icon bg-danger-subtle text-danger">
                    <i class="bi bi-trash3-fill"></i>
                </span>
                <div>
                    <div class="fw-bold">Delete Student</div>
                    <div class="small text-muted">Remove student record</div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-3">
            <a href="<?= BASE_PATH ?>/profile" class="quick-action-tile">
                <span class="quick-action-icon stat-icon-indigo">
                    <i class="bi bi-person-circle"></i>
                </span>
                <div>
                    <div class="fw-bold">My Profile</div>
                    <div class="small text-muted">Profile &amp; password update</div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Students Table -->
<div class="sms-card">
    <div class="sms-card-header">
        <div>
            <h5 class="fw-bold mb-0">Recently Added Students</h5>
            <div class="small text-muted">Your 5 most recent student entries</div>
        </div>
        <a href="<?= BASE_PATH ?>/students" class="btn btn-outline-primary btn-sm">
            View All Students <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <?php if (!empty($recentStudents)): ?>
        <div class="table-responsive">
            <table class="table sms-table align-middle">
                <thead>
                    <tr>
                        <th>Roll Number</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Academic Year</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentStudents as $student): ?>
                        <?php $fullName = trim($student['first_name'] . ' ' . $student['last_name']); ?>
                        <tr>
                            <td>
                                <span class="roll-badge"><?= e($student['roll_number']) ?></span>
                            </td>
                            <td>
                                <div class="student-name-cell">
                                    <span class="student-mini-avatar"><?= e(userInitials($fullName)) ?></span>
                                    <span class="fw-semibold"><?= e($fullName) ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="course-badge"><?= e($student['course']) ?></span>
                            </td>
                            <td>
                                <span class="year-badge"><?= e($student['year']) ?></span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?= BASE_PATH ?>/students/show?id=<?= (int)$student['id'] ?>"
                                       class="btn btn-sm btn-light border"
                                       title="View Details">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <a href="<?= BASE_PATH ?>/students/edit?id=<?= (int)$student['id'] ?>"
                                       class="btn btn-sm btn-light border"
                                       title="Edit Student">
                                        <i class="bi bi-pencil text-warning"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-light border js-delete-student-btn"
                                            data-student-id="<?= (int)$student['id'] ?>"
                                            data-student-name="<?= e($fullName) ?>"
                                            data-student-roll="<?= e($student['roll_number']) ?>"
                                            title="Delete Student">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-5 px-3">
            <div class="stat-icon stat-icon-blue mx-auto mb-3" style="width: 56px; height: 56px;">
                <i class="bi bi-journal-plus fs-4"></i>
            </div>
            <h6 class="fw-bold mb-1">No student records yet</h6>
            <p class="text-muted small mb-3">
                Get started by adding your first student to the system.
            </p>
            <a href="<?= BASE_PATH ?>/students/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Your First Student
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
