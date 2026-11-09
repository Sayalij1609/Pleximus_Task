<?php
require_once __DIR__ . '/../../helpers/view.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$pageTitle = $pageTitle ?? 'Student Management System';
$pageHeading = $pageHeading ?? $pageTitle;
$pageSubtitle = $pageSubtitle ?? '';
$activeNav = $activeNav ?? '';
$layoutCsrfToken = $csrfToken ?? $_SESSION['csrf_token'];

$currentUserName = $_SESSION['user_name'] ?? ($userName ?? 'User');
$currentUserEmail = $_SESSION['user_email'] ?? '';
$currentUserInitials = userInitials($currentUserName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> - Student MS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= BASE_PATH ?>/assets/css/app.css" rel="stylesheet">
</head>
<body>

<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<div class="app-shell">
    <!-- Sidebar -->
    <aside class="app-sidebar" id="appSidebar" aria-label="Primary Navigation">
        <div class="sidebar-brand">
            <a href="<?= BASE_PATH ?>/dashboard" class="brand-link">
                <span class="brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </span>
                <div>
                    <div class="brand-title">Student MS</div>
                    <div class="brand-subtitle">Academic Portal</div>
                </div>
            </a>
            <button type="button" class="btn btn-sm text-secondary d-lg-none p-1" id="sidebarCloseBtn" aria-label="Close sidebar">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">Overview</div>
            <a href="<?= BASE_PATH ?>/dashboard"
               class="sidebar-link <?= $activeNav === 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-label">Student Management</div>
            <a href="<?= BASE_PATH ?>/students"
               class="sidebar-link <?= $activeNav === 'students_index' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i>
                <span>All Students</span>
            </a>
            <a href="<?= BASE_PATH ?>/students/create"
               class="sidebar-link <?= $activeNav === 'students_create' ? 'active' : '' ?>">
                <i class="bi bi-person-plus-fill"></i>
                <span>Add Student</span>
            </a>
            <a href="<?= BASE_PATH ?>/students?action=edit"
               class="sidebar-link <?= $activeNav === 'students_edit' ? 'active-warning' : '' ?>">
                <i class="bi bi-pencil-square"></i>
                <span>Update Student</span>
            </a>
            <a href="<?= BASE_PATH ?>/students?action=delete"
               class="sidebar-link <?= $activeNav === 'students_delete' ? 'active-danger' : '' ?>">
                <i class="bi bi-trash3-fill"></i>
                <span>Delete Student</span>
            </a>

            <div class="sidebar-section-label">Account</div>
            <a href="<?= BASE_PATH ?>/profile"
               class="sidebar-link <?= $activeNav === 'profile' ? 'active' : '' ?>">
                <i class="bi bi-person-circle"></i>
                <span>My Profile</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= BASE_PATH ?>/profile" class="sidebar-user-card" title="View My Profile">
                <span class="avatar-circle"><?= e($currentUserInitials) ?></span>
                <div class="sidebar-user-meta">
                    <div class="sidebar-user-name"><?= e($currentUserName) ?></div>
                    <div class="sidebar-user-email"><?= e($currentUserEmail !== '' ? $currentUserEmail : 'Account Settings') ?></div>
                </div>
                <i class="bi bi-chevron-right text-secondary small"></i>
            </a>

            <form action="<?= BASE_PATH ?>/logout" method="POST" class="m-0">
                <input type="hidden" name="csrf_token" value="<?= e($layoutCsrfToken) ?>">
                <button type="submit" class="btn-sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="app-main">
        <header class="app-topbar">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-outline-secondary btn-sm d-lg-none" id="sidebarOpenBtn" aria-label="Open menu">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="topbar-title-group">
                    <h1><?= e($pageHeading) ?></h1>
                    <?php if ($pageSubtitle !== ''): ?>
                        <p class="d-none d-sm-block"><?= e($pageSubtitle) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="topbar-actions">
                <?php if ($activeNav !== 'students_create'): ?>
                    <a href="<?= BASE_PATH ?>/students/create" class="btn btn-primary btn-sm d-none d-md-inline-flex align-items-center gap-1">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add Student</span>
                    </a>
                <?php endif; ?>

                <a href="<?= BASE_PATH ?>/profile" class="topbar-profile-pill" title="Open My Profile">
                    <span class="avatar-circle"><?= e($currentUserInitials) ?></span>
                    <span class="d-none d-sm-inline"><?= e($currentUserName) ?></span>
                </a>
            </div>
        </header>

        <main class="app-content">
