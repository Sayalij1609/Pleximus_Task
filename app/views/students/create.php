<?php
$old = $old ?? [];
$errors = $errors ?? [];

$pageTitle = 'Add Student';
$pageHeading = 'Add New Student';
$pageSubtitle = 'Enroll a new student into your directory';
$activeNav = 'students_create';

require __DIR__ . '/../layouts/app_header.php';
?>

<div class="mx-auto" style="max-width: 920px;">
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>
                    <strong>Success!</strong> Student record has been added to your directory.
                </div>
            </div>
            <a href="<?= BASE_PATH ?>/students" class="btn btn-sm btn-success">
                View All Students
            </a>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div><?= e($errors['general']) ?></div>
        </div>
    <?php endif; ?>

    <div class="sms-card">
        <div class="sms-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="stat-icon stat-icon-blue" style="width: 38px; height: 38px; font-size: 1.05rem;">
                    <i class="bi bi-person-plus-fill"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0">Student Enrollment Form</h5>
                    <div class="small text-muted">Fields marked with * are required</div>
                </div>
            </div>

            <a href="<?= BASE_PATH ?>/students" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Students
            </a>
        </div>

        <div class="sms-card-body">
            <form action="<?= BASE_PATH ?>/students" method="POST">
                <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

                <div class="form-section-title">
                    <i class="bi bi-person-vcard text-primary"></i>
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
                            placeholder="e.g. CS2026001"
                            value="<?= e($old['roll_number'] ?? '') ?>"
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
                            value="<?= e($old['date_of_birth'] ?? '') ?>"
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
                            placeholder="Enter first name"
                            value="<?= e($old['first_name'] ?? '') ?>"
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
                            placeholder="Enter last name"
                            value="<?= e($old['last_name'] ?? '') ?>"
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
                            <?php foreach (['Male', 'Female', 'Other'] as $gender): ?>
                                <option value="<?= $gender ?>" <?= ($old['gender'] ?? '') === $gender ? 'selected' : '' ?>>
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
                            placeholder="student@example.com"
                            value="<?= e($old['email'] ?? '') ?>"
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
                            placeholder="e.g. +91 9876543210"
                            value="<?= e($old['phone'] ?? '') ?>"
                        >
                    </div>
                </div>

                <div class="form-section-title">
                    <i class="bi bi-book text-primary"></i>
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
                            placeholder="e.g. B.Tech AIML"
                            value="<?= e($old['course'] ?? '') ?>"
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
                            placeholder="e.g. Final Year"
                            value="<?= e($old['year'] ?? '') ?>"
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
                            placeholder="Enter residential address"
                        ><?= e($old['address'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                    <a href="<?= BASE_PATH ?>/dashboard" class="btn btn-light border">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-1">
                        <i class="bi bi-check2-circle"></i>
                        <span>Save Student</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
