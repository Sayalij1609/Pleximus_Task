<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Dashboard.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class ProfileController
{
    private $userModel;
    private $dashboardModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->userModel = new User($db);
        $this->dashboardModel = new Dashboard($db);
    }

    // Redirect helper
    private function redirect($path)
    {
        header("Location: " . BASE_PATH . $path);
        exit;
    }

    // Generate CSRF token
    private function csrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    // Verify CSRF token
    private function verifyCsrf()
    {
        $token = $_POST['csrf_token'] ?? '';

        return isset($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }

    // Get and clear flash message
    private function getFlash($key)
    {
        $message = $_SESSION[$key] ?? null;

        unset($_SESSION[$key]);

        return $message;
    }

    // Display user profile page
    public function index()
    {
        AuthMiddleware::handle();

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);

        if (!$user) {
            $_SESSION['auth_error'] = "User account not found. Please log in again.";
            $this->redirect('/login');
        }

        $totalStudents = $this->dashboardModel->getTotalStudents($userId);
        $csrfToken = $this->csrfToken();
        $error = $this->getFlash('profile_error');
        $success = $this->getFlash('profile_success');
        $errors = $this->getFlash('profile_errors') ?? [];

        require __DIR__ . '/../views/profile/index.php';
    }

    // Process password update
    public function updatePassword()
    {
        AuthMiddleware::handle();

        if (!$this->verifyCsrf()) {
            $_SESSION['profile_error'] = "Invalid request. Please try again.";
            $this->redirect('/profile');
        }

        $userId = $_SESSION['user_id'];
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $errors = [];

        // Validate current password presence
        if ($currentPassword === '') {
            $errors['current_password'] = "Current password is required.";
        }

        // Validate new password length
        if (strlen($newPassword) < 8) {
            $errors['new_password'] = "New password must contain at least 8 characters.";
        }

        // Check password confirmation
        if ($newPassword !== $confirmPassword) {
            $errors['confirm_password'] = "New passwords do not match.";
        }

        // Fetch authenticated user record
        $user = $this->userModel->findById($userId);

        if (!$user) {
            $_SESSION['auth_error'] = "User account not found. Please log in again.";
            $this->redirect('/login');
        }

        // Verify current password against stored hash
        if ($currentPassword !== '' && !password_verify($currentPassword, $user['password'])) {
            $errors['current_password'] = "Current password is incorrect.";
        } elseif ($currentPassword !== '' && $newPassword !== '' && password_verify($newPassword, $user['password'])) {
            $errors['new_password'] = "New password must be different from your current password.";
        }

        if (!empty($errors)) {
            $_SESSION['profile_errors'] = $errors;
            $_SESSION['profile_error'] = "Please fix the errors below and try again.";
            $this->redirect('/profile');
        }

        // Hash and update password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updated = $this->userModel->updatePassword($userId, $hashedPassword);

        if ($updated) {
            // Rotate CSRF token after security-sensitive update
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['profile_success'] = "Password updated successfully!";
            $this->redirect('/profile');
        }

        $_SESSION['profile_error'] = "Unable to update password. Please try again.";
        $this->redirect('/profile');
    }
}
