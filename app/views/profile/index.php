<?php
$errors = $errors ?? [];
$hasPasswordError = !empty($error) || !empty($errors);

$pageTitle = 'My Profile';
$pageHeading = 'My Profile';
$pageSubtitle = 'View your profile details and update your account password';
$activeNav = 'profile';

require __DIR__ . '/../layouts/app_header.php';
?>

<div class="mx-auto" style="max-width: 820px;">
    <?php if (!empty($success)): ?>
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5 flex-shrink-0"></i>
            <div><?= e($success) ?></div>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-circle-fill fs-5 flex-shrink-0"></i>
            <div><?= e($error) ?></div>
        </div>
    <?php endif; ?>

    <!-- Profile Details Card -->
    <div class="sms-card mb-4">
        <div class="sms-card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="stat-icon stat-icon-blue" style="width: 38px; height: 38px; font-size: 1.05rem;">
                    <i class="bi bi-person-badge"></i>
                </span>
                <div>
                    <h5 class="fw-bold mb-0">Profile Details</h5>
                    <div class="small text-muted">Your registered account information</div>
                </div>
            </div>

            <span class="badge rounded-pill text-bg-success bg-opacity-10 text-success px-3 py-2 fw-semibold">
                <i class="bi bi-check-circle-fill me-1"></i> Active Account
            </span>
        </div>

        <div class="sms-card-body">
            <div class="d-flex flex-column flex-sm-row align-items-center gap-3 pb-4 mb-4 border-bottom">
                <span class="avatar-circle avatar-circle-lg">
                    <?= e(userInitials($user['name'] ?? '')) ?>
                </span>
                <div class="text-center text-sm-start">
                    <h4 class="fw-bold mb-1"><?= e($user['name'] ?? '') ?></h4>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-envelope me-1"></i><?= e($user['email'] ?? '') ?>
                    </div>
                    <span class="course-badge">
                        <i class="bi bi-people-fill me-1"></i><?= (int)$totalStudents ?> Students Managed
                    </span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-item-label">Full Name</div>
                        <div class="detail-item-value"><?= e($user['name'] ?? '') ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-item-label">Email Address</div>
                        <div class="detail-item-value"><?= e($user['email'] ?? '') ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-item-label">Account ID</div>
                        <div class="detail-item-value">#<?= (int)($user['id'] ?? 0) ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="detail-item-label">Students Managed</div>
                        <div class="detail-item-value">
                            <a href="<?= BASE_PATH ?>/students" class="text-decoration-none">
                                <?= (int)$totalStudents ?> Student<?= (int)$totalStudents === 1 ? '' : 's' ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if (!empty($user['created_at'])): ?>
                    <div class="col-12">
                        <div class="detail-item">
                            <div class="detail-item-label">Member Since</div>
                            <div class="detail-item-value"><?= formatDisplayDate($user['created_at']) ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-3 border-top">
                <a href="<?= BASE_PATH ?>/dashboard" class="btn btn-light border">
                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                </a>

                <button
                    type="button"
                    class="btn btn-primary d-inline-flex align-items-center gap-2"
                    data-bs-toggle="collapse"
                    data-bs-target="#updatePasswordSection"
                    aria-expanded="<?= $hasPasswordError ? 'true' : 'false' ?>"
                    aria-controls="updatePasswordSection"
                >
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Update Password</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Collapsible Password Update Card -->
    <div class="collapse <?= $hasPasswordError ? 'show' : '' ?>" id="updatePasswordSection">
        <div class="sms-card">
            <div class="sms-card-header">
                <div class="d-flex align-items-center gap-2">
                    <span class="stat-icon stat-icon-indigo" style="width: 38px; height: 38px; font-size: 1.05rem;">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <div>
                        <h5 class="fw-bold mb-0">Change Password</h5>
                        <div class="small text-muted">Verify your current password and confirm your new password</div>
                    </div>
                </div>
            </div>

            <div class="sms-card-body">
                <form action="<?= BASE_PATH ?>/profile/password" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password *</label>
                        <div class="input-group has-validation">
                            <input
                                type="password"
                                id="currentPassword"
                                name="current_password"
                                class="form-control <?= !empty($errors['current_password']) ? 'is-invalid' : '' ?>"
                                placeholder="Enter your current password"
                                required
                            >
                            <button
                                type="button"
                                class="btn btn-toggle-password js-toggle-password"
                                data-target="currentPassword"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (!empty($errors['current_password'])): ?>
                                <div class="invalid-feedback"><?= e($errors['current_password']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password *</label>
                        <div class="input-group has-validation">
                            <input
                                type="password"
                                id="newPassword"
                                name="new_password"
                                class="form-control <?= !empty($errors['new_password']) ? 'is-invalid' : '' ?>"
                                placeholder="Enter new password (min 8 characters)"
                                minlength="8"
                                data-password-strength
                                required
                            >
                            <button
                                type="button"
                                class="btn btn-toggle-password js-toggle-password"
                                data-target="newPassword"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (!empty($errors['new_password'])): ?>
                                <div class="invalid-feedback"><?= e($errors['new_password']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="password-strength-track">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="form-text text-muted" id="passwordStrengthText">Minimum 8 characters required</div>
                    </div>

                    <div class="mb-4">
                        <label for="confirmNewPassword" class="form-label">Confirm Password *</label>
                        <div class="input-group has-validation">
                            <input
                                type="password"
                                id="confirmNewPassword"
                                name="confirm_password"
                                class="form-control <?= !empty($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                                placeholder="Re-enter your new password"
                                minlength="8"
                                data-password-confirm
                                required
                            >
                            <button
                                type="button"
                                class="btn btn-toggle-password js-toggle-password"
                                data-target="confirmNewPassword"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (!empty($errors['confirm_password'])): ?>
                                <div class="invalid-feedback"><?= e($errors['confirm_password']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-text" id="passwordMatchHint"></div>
                    </div>

                    <div class="p-3 rounded-3 bg-light border small text-muted mb-4">
                        <div class="fw-semibold text-dark mb-1">
                            <i class="bi bi-info-circle text-primary me-1"></i> Password Guidelines
                        </div>
                        <ul class="mb-0 ps-3">
                            <li>Must be at least 8 characters long.</li>
                            <li>Combine uppercase, lowercase, numbers, and symbols for better protection.</li>
                            <li>Must be different from your current password.</li>
                        </ul>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-toggle="collapse"
                            data-bs-target="#updatePasswordSection"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-1">
                            <i class="bi bi-check2-circle"></i>
                            <span>Confirm Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/app_footer.php'; ?>
