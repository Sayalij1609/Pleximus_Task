<?php
$errors = $errors ?? [];
$submittedData = $data ?? null;

$fieldValue = function ($key) use ($submittedData, $student) {
    if (is_array($submittedData) && array_key_exists($key, $submittedData)) {
        return $submittedData[$key];
    }
    return $student[$key] ?? '';
};

$studentFullName = trim(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? ''));

$pageTitle = 'Update Student';
$pageHeading = 'Update Student Details';
$pageSubtitle = 'Editing record for ' . $studentFullName;
$activeNav = 'students_edit';

require __DIR__ . '/../layouts/app_header.php';
?>

<div class="mx-auto" style="max-width: 920px;">
    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div><?= e($errors['general']) ?></div>
        </div>
    <?php endif; ?>

    <div class="sms-card">
        <div class="sms-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="stat-icon stat-icon-amber" style="width: 38px; height: 38px; font-size: 1.05rem;">
                    <i class="bi bi-pencil-square"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0"><?= e($studentFullName) ?></h5>
                    <div class="small text-muted">
                        Roll Number: <strong><?= e($student['roll_number']) ?></strong>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= BASE_PATH ?>/students/show?id=<?= (int)$student['id'] ?>" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye me-1"></i> View Details
                </a>
                <a href="<?= BASE_PATH ?>/students" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> All Students
                </a>
            </div>
        </div>

        <div class="sms-card-body">
            <form action="<?= BASE_PATH ?>/students/update" method="POST">
                <input type="hidden" name="id" value="<?= (int)$student['id'] ?>">
                <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

                <div class="form-section-title">
                    <i class="bi bi-person-vcard text-warning"></i>
                    <span>Personal &amp; Contact Information</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="roll_number" class="form-label">Roll Number *</label>
                        <input
                            type="text"
                            id="roll_number"
                            name="roll_number"
                            class="form-control <?= !empty($errors['roll_number']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('roll_number')) ?>"
                            required
                        >
                        <?php if (!empty($errors['roll_number'])): ?>
                            <div class="invalid-feedback"><?= e($errors['roll_number']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input
                            type="date"
                            id="date_of_birth"
                            name="date_of_birth"
                            class="form-control <?= !empty($errors['date_of_birth']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('date_of_birth')) ?>"
                        >
                        <?php if (!empty($errors['date_of_birth'])): ?>
                            <div class="invalid-feedback"><?= e($errors['date_of_birth']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="form-control <?= !empty($errors['first_name']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('first_name')) ?>"
                            required
                        >
                        <?php if (!empty($errors['first_name'])): ?>
                            <div class="invalid-feedback"><?= e($errors['first_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="form-control <?= !empty($errors['last_name']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('last_name')) ?>"
                            required
                        >
                        <?php if (!empty($errors['last_name'])): ?>
                            <div class="invalid-feedback"><?= e($errors['last_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select
                            id="gender"
                            name="gender"
                            class="form-select <?= !empty($errors['gender']) ? 'is-invalid' : '' ?>"
                        >
                            <option value="">Select Gender</option>
                            <?php $currentGender = $fieldValue('gender'); ?>
                            <?php foreach (['Male', 'Female', 'Other'] as $gender): ?>
                                <option value="<?= $gender ?>" <?= $currentGender === $gender ? 'selected' : '' ?>>
                                    <?= $gender ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['gender'])): ?>
                            <div class="invalid-feedback"><?= e($errors['gender']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('email')) ?>"
                        >
                        <?php if (!empty($errors['email'])): ?>
                            <div class="invalid-feedback"><?= e($errors['email']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            class="form-control"
                            value="<?= e($fieldValue('phone')) ?>"
                        >
                    </div>
                </div>

                <div class="form-section-title">
                    <i class="bi bi-book text-warning"></i>
                    <span>Academic &amp; Address Information</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="course" class="form-label">Course *</label>
                        <input
                            type="text"
                            id="course"
                            name="course"
                            class="form-control <?= !empty($errors['course']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('course')) ?>"
                            required
                        >
                        <?php if (!empty($errors['course'])): ?>
                            <div class="invalid-feedback"><?= e($errors['course']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="year" class="form-label">Academic Year *</label>
                        <input
                            type="text"
                            id="year"
                            name="year"
                            class="form-control <?= !empty($errors['year']) ? 'is-invalid' : '' ?>"
                            value="<?= e($fieldValue('year')) ?>"
                            required
                        >
                        <?php if (!empty($errors['year'])): ?>
                            <div class="invalid-feedback"><?= e($errors['year']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea
                            id="address"
                            name="address"
                            class="form-control"
                            rows="3"
                        ><?= e($fieldValue('address')) ?></textarea>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                    <a href="<?= BASE_PATH ?>/students" class="btn btn-light border">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-warning d-inline-flex align-items-center gap-1">
                        <i class="bi bi-check2-circle"></i>
                        <span>Update Student</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
