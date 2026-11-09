<?php
$pageTitle = 'Home';
require __DIR__ . '/layouts/auth_header.php';
?>

<div class="container" style="max-width: 560px;">
    <div class="sms-card p-4 p-md-5 text-center shadow-lg">
        <div class="brand-icon mx-auto mb-3" style="width: 56px; height: 56px; font-size: 1.6rem;">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <h2 class="fw-bold mb-2">Student Management System</h2>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="text-muted mb-3">
                Welcome back, <strong class="text-dark"><?= e($_SESSION['user_name']) ?></strong>!
            </p>
            <div class="bg-light rounded-3 p-3 mb-4 small text-muted">
                Signed in as <strong class="text-dark"><?= e($_SESSION['user_email']) ?></strong>
            </div>

            <div class="d-grid gap-2">
                <a href="<?= BASE_PATH ?>/dashboard" class="btn btn-primary">
                    <i class="bi bi-speedometer2 me-1"></i> Go to Dashboard
                </a>
                <form action="<?= BASE_PATH ?>/logout" method="POST" class="m-0">
                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-muted mb-4">
                Please sign in or register to manage your student directory.
            </p>
            <div class="d-grid gap-2">
                <a href="<?= BASE_PATH ?>/login" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                </a>
                <a href="<?= BASE_PATH ?>/register" class="btn btn-outline-primary">
                    <i class="bi bi-person-plus me-1"></i> Create Account
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/layouts/auth_footer.php'; ?>
