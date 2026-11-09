<?php
$pageTitle = 'Login';
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
                Manage student records with clarity & speed.
            </h2>
            <p class="text-white-50 mb-0" style="font-size: 0.94rem;">
                Centralize enrollment details, academic progress, search, and account security in one modern workspace.
            </p>

            <ul class="auth-feature-list">
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Fast student creation, updates, and verified deletions</span>
                </li>
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Instant search by roll number, name, email, or course</span>
                </li>
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Protected session handling &amp; profile password control</span>
                </li>
            </ul>
        </div>

        <div class="small text-white-50 pt-3 border-top border-white border-opacity-10">
            Student Management System &bull; Secure Workspace
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="mb-4">
            <span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2 fw-semibold">
                Welcome Back
            </span>
            <h3 class="fw-bold mb-1">Sign in to your account</h3>
            <p class="text-muted mb-0 small">
                Enter your credentials to access your dashboard.
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

        <form action="<?= BASE_PATH ?>/login" method="POST">
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input
                        type="email"
                        id="loginEmail"
                        name="email"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0 10px 10px 0;"
                        placeholder="you@example.com"
                        maxlength="150"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-4">
                <label for="loginPassword" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input
                        type="password"
                        id="loginPassword"
                        name="password"
                        class="form-control border-start-0 ps-1"
                        style="border-radius: 0;"
                        placeholder="Enter your password"
                        required
                    >
                    <button
                        type="button"
                        class="btn btn-toggle-password js-toggle-password"
                        data-target="loginPassword"
                        aria-label="Show password"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2.5 d-flex align-items-center justify-content-center gap-2">
                <span>Sign In</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        <p class="text-center text-muted small mt-4 mb-0">
            Don't have an account?
            <a href="<?= BASE_PATH ?>/register" class="fw-semibold text-decoration-none">Create an account</a>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../layouts/auth_footer.php'; ?>
