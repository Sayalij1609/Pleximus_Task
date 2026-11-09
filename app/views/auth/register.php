<?php
$pageTitle = 'Create Account';
require __DIR__ . '/../layouts/auth_header.php';
?>

<div class="auth-wrapper">
    <!-- Left Showcase -->
    <div class="auth-showcase">
        <div>
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="brand-icon" style="width: 46px; height: 46px; font-size: 1.35rem;">
                    <i class="bi bi-mortarboard-fill"></i>
                </span>
                <div>
                    <div class="fw-bold fs-5">Student MS</div>
                    <div class="small text-white-50">Academic Portal</div>
                </div>
            </div>

            <h2 class="fw-bold mb-3" style="line-height: 1.25;">
                Set up your faculty &amp; admin workspace.
            </h2>
            <p class="text-white-50 mb-0" style="font-size: 0.94rem;">
                Create an account to maintain your own isolated student directory with full CRUD and search tools.
            </p>

            <ul class="auth-feature-list">
                <li>
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Passwords securely hashed &amp; CSRF-protected forms</span>
                </li>
                <li>
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Personal student registry tied directly to your account</span>
                </li>
                <li>
                    <i class="bi bi-speedometer2"></i>
                    <span>Clean dashboard analytics &amp; quick management sidebar</span>
                </li>
            </ul>
        </div>

        <div class="small text-white-50 pt-3 border-top border-white border-opacity-10">
            Student Management System &bull; Account Registration
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="mb-4">
            <span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2 fw-semibold">
                Get Started
            </span>
            <h3 class="fw-bold mb-1">Create your account</h3>
            <p class="text-muted mb-0 small">
                Fill in your details below to register.
            </p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2.5 small" role="alert">
                <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                <div><?= e($error) ?></div>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success d-flex align-items-center gap-2 py-2.5 small" role="alert">
                <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                <div><?= e($success) ?></div>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_PATH ?>/register" method="POST">
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

            <div class="mb-3">
                <label for="registerName" class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-person"></i>
                    </span>
                    <input
                        type="text"
                        id="registerName"
                        name="name"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0 10px 10px 0;"
                        placeholder="Enter your full name"
                        maxlength="100"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input
                        type="email"
                        id="registerEmail"
                        name="email"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0 10px 10px 0;"
                        placeholder="you@example.com"
                        maxlength="150"
                        required
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input
                        type="password"
                        id="registerPassword"
                        name="password"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0;"
                        placeholder="Minimum 8 characters"
                        minlength="8"
                        data-password-strength
                        required
                    >
                    <button
                        type="button"
                        class="btn btn-toggle-password js-toggle-password"
                        data-target="registerPassword"
                        aria-label="Show password"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="password-strength-track">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="form-text text-muted" id="passwordStrengthText">Minimum 8 characters required</div>
            </div>

            <div class="mb-4">
                <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-shield-check"></i>
                    </span>
                    <input
                        type="password"
                        id="registerConfirmPassword"
                        name="confirm_password"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0;"
                        placeholder="Re-enter password"
                        minlength="8"
                        data-password-confirm
                        required
                    >
                    <button
                        type="button"
                        class="btn btn-toggle-password js-toggle-password"
                        data-target="registerConfirmPassword"
                        aria-label="Show password"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="form-text" id="passwordMatchHint"></div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2.5 d-flex align-items-center justify-content-center gap-2">
                <span>Create Account</span>
                <i class="bi bi-person-check-fill"></i>
            </button>
        </form>

        <p class="text-center text-muted small mt-4 mb-0">
            Already have an account?
            <a href="<?= BASE_PATH ?>/login" class="fw-semibold text-decoration-none">Sign in here</a>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../layouts/auth_footer.php'; ?>
