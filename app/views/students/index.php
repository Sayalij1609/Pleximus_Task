<?php
$actionMode = in_array($_GET['action'] ?? '', ['edit', 'delete'], true) ? $_GET['action'] : '';

if ($actionMode === 'edit') {
    $pageTitle = 'Update Student';
    $pageHeading = 'Update Student';
    $pageSubtitle = 'Select a student from the list below to edit their details';
    $activeNav = 'students_edit';
} elseif ($actionMode === 'delete') {
    $pageTitle = 'Delete Student';
    $pageHeading = 'Delete Student';
    $pageSubtitle = 'Select a student from the list below to remove their record';
    $activeNav = 'students_delete';
} else {
    $pageTitle = 'All Students';
    $pageHeading = 'All Students';
    $pageSubtitle = 'Browse, search, and manage student records';
    $activeNav = 'students_index';
}

require __DIR__ . '/../layouts/app_header.php';

$buildPageQuery = function ($targetPage) use ($search, $actionMode) {
    $params = ['page' => $targetPage];
    if ($search !== '') {
        $params['search'] = $search;
    }
    if ($actionMode !== '') {
        $params['action'] = $actionMode;
    }
    return http_build_query($params);
};

$startRecord = $totalStudents > 0 ? ($offset + 1) : 0;
$endRecord = min($offset + count($students), $totalStudents);
?>

<?php if ($actionMode === 'edit'): ?>
    <div class="mode-banner mode-banner-edit mb-4">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square fs-5"></i>
            <div>
                <strong>Update Student Mode:</strong>
                Search or browse below and click <strong>Edit</strong> on the student you want to update.
            </div>
        </div>
        <a href="<?= BASE_PATH ?>/students" class="btn btn-sm btn-outline-dark">
            Show Standard View
        </a>
    </div>
<?php elseif ($actionMode === 'delete'): ?>
    <div class="mode-banner mode-banner-delete mb-4">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-trash3-fill fs-5"></i>
            <div>
                <strong>Delete Student Mode:</strong>
                Select a student below and click <strong>Delete</strong> to remove their record (confirmation required).
            </div>
        </div>
        <a href="<?= BASE_PATH ?>/students" class="btn btn-sm btn-outline-danger">
            Show Standard View
        </a>
    </div>
<?php endif; ?>

<div class="sms-card">
    <div class="sms-card-header">
        <div>
            <h5 class="fw-bold mb-0">Student Directory</h5>
            <div class="small text-muted">
                <?php if ($totalStudents > 0): ?>
                    Showing <strong><?= (int)$startRecord ?>&ndash;<?= (int)$endRecord ?></strong> of <strong><?= (int)$totalStudents ?></strong> matching student<?= $totalStudents === 1 ? '' : 's' ?>
                <?php else: ?>
                    0 matching students
                <?php endif; ?>
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="<?= BASE_PATH ?>/students/create" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
                <i class="bi bi-plus-lg"></i>
                <span>Add Student</span>
            </a>
            <a href="<?= BASE_PATH ?>/dashboard" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Dashboard
            </a>
        </div>
    </div>

    <div class="sms-card-body">
        <!-- Search Form -->
        <form method="GET" action="<?= BASE_PATH ?>/students" class="row g-2 align-items-center mb-4">
            <?php if ($actionMode !== ''): ?>
                <input type="hidden" name="action" value="<?= e($actionMode) ?>">
            <?php endif; ?>

            <div class="col-md-8 col-lg-9">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input
                        type="text"
                        name="search"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0 10px 10px 0;"
                        placeholder="Search by roll number, name, email, or course..."
                        value="<?= e($search) ?>"
                    >
                </div>
            </div>

            <div class="col-md-4 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    Search
                </button>
                <a href="<?= BASE_PATH ?>/students<?= $actionMode !== '' ? '?action=' . e($actionMode) : '' ?>"
                   class="btn btn-light border">
                    Reset
                </a>
            </div>
        </form>

        <!-- Student Table / Empty State -->
        <?php if (empty($students)): ?>
            <div class="text-center py-5 px-3 bg-light rounded-4 border border-dashed">
                <div class="stat-icon stat-icon-blue mx-auto mb-3" style="width: 56px; height: 56px;">
                    <i class="bi bi-search fs-4"></i>
                </div>
                <h5 class="fw-bold mb-1">No students found</h5>
                <p class="text-muted small mb-3">
                    <?= $search !== '' ? 'No records matched "' . e($search) . '". Try clearing your search filter.' : 'Your student directory is currently empty.' ?>
                </p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <?php if ($search !== ''): ?>
                        <a href="<?= BASE_PATH ?>/students<?= $actionMode !== '' ? '?action=' . e($actionMode) : '' ?>"
                           class="btn btn-outline-secondary btn-sm">
                            Clear Search
                        </a>
                    <?php endif; ?>
                    <a href="<?= BASE_PATH ?>/students/create" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Add Student
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="table-responsive border rounded-3">
                <table class="table sms-table align-middle">
                    <thead>
                        <tr>
                            <th>Roll Number</th>
                            <th>Student Name</th>
                            <th>Contact</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <?php $fullName = trim($student['first_name'] . ' ' . $student['last_name']); ?>
                            <tr>
                                <td>
                                    <span class="roll-badge"><?= e($student['roll_number']) ?></span>
                                </td>
                                <td>
                                    <div class="student-name-cell">
                                        <span class="student-mini-avatar"><?= e(userInitials($fullName)) ?></span>
                                        <div>
                                            <div class="fw-semibold text-dark"><?= e($fullName) ?></div>
                                            <?php if (!empty($student['gender'])): ?>
                                                <div class="small text-muted"><?= e($student['gender']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <?php if (!empty($student['email'])): ?>
                                            <div class="text-dark"><i class="bi bi-envelope text-muted me-1"></i><?= e($student['email']) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($student['phone'])): ?>
                                            <div class="text-muted"><i class="bi bi-telephone text-muted me-1"></i><?= e($student['phone']) ?></div>
                                        <?php endif; ?>
                                        <?php if (empty($student['email']) && empty($student['phone'])): ?>
                                            <span class="text-muted">&mdash;</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="course-badge"><?= e($student['course']) ?></span>
                                </td>
                                <td>
                                    <span class="year-badge"><?= e($student['year']) ?></span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1 align-items-center">
                                        <a href="<?= BASE_PATH ?>/students/show?id=<?= (int)$student['id'] ?>"
                                           class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1"
                                           title="View Student Details">
                                            <i class="bi bi-eye text-primary"></i>
                                            <span class="d-none d-xl-inline">View</span>
                                        </a>

                                        <a href="<?= BASE_PATH ?>/students/edit?id=<?= (int)$student['id'] ?>"
                                           class="btn btn-sm <?= $actionMode === 'edit' ? 'btn-warning btn-focus-ring-edit' : 'btn-light border' ?> d-inline-flex align-items-center gap-1"
                                           title="Update Student">
                                            <i class="bi bi-pencil-square <?= $actionMode === 'edit' ? '' : 'text-warning' ?>"></i>
                                            <span>Edit</span>
                                        </a>

                                        <button type="button"
                                                class="btn btn-sm <?= $actionMode === 'delete' ? 'btn-danger btn-focus-ring-delete' : 'btn-light border' ?> js-delete-student-btn d-inline-flex align-items-center gap-1"
                                                data-student-id="<?= (int)$student['id'] ?>"
                                                data-student-name="<?= e($fullName) ?>"
                                                data-student-roll="<?= e($student['roll_number']) ?>"
                                                title="Delete Student">
                                            <i class="bi bi-trash3 <?= $actionMode === 'delete' ? '' : 'text-danger' ?>"></i>
                                            <span class="<?= $actionMode === 'delete' ? '' : 'd-none d-xl-inline text-danger' ?>">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Student pagination" class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="small text-muted">
                        Page <strong><?= (int)$page ?></strong> of <strong><?= (int)$totalPages ?></strong>
                    </div>

                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= BASE_PATH ?>/students?<?= e($buildPageQuery(max(1, $page - 1))) ?>">
                                <i class="bi bi-chevron-left"></i> Previous
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="<?= BASE_PATH ?>/students?<?= e($buildPageQuery($i)) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= BASE_PATH ?>/students?<?= e($buildPageQuery(min($totalPages, $page + 1))) ?>">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
