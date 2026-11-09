
<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->userModel = new User($db);
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

    // Display registration page
    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home');
        }

        $csrfToken = $this->csrfToken();
        $error = $this->getFlash('auth_error');
        $success = $this->getFlash('auth_success');

        require __DIR__ . '/../views/auth/register.php';
    }

    // Process registration
    public function store()
    {
        if (!$this->verifyCsrf()) {
            $_SESSION['auth_error'] = "Invalid request. Please try again.";
            $this->redirect('/register');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validate name
        if ($name === '' || strlen($name) > 100) {
            $_SESSION['auth_error'] = "Please enter a valid name.";
            $this->redirect('/register');
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
            strlen($email) > 150) {
            $_SESSION['auth_error'] = "Please enter a valid email.";
            $this->redirect('/register');
        }

        // Validate password
        if (strlen($password) < 8) {
            $_SESSION['auth_error'] =
                "Password must contain at least 8 characters.";

            $this->redirect('/register');
        }

        // Check password confirmation
        if ($password !== $confirmPassword) {
            $_SESSION['auth_error'] =
                "Passwords do not match.";

            $this->redirect('/register');
        }

        // Check duplicate email
        if ($this->userModel->findByEmail($email)) {
            $_SESSION['auth_error'] =
                "This email is already registered.";

            $this->redirect('/register');
        }

        // Hash password
        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // Create user
        $created = $this->userModel->create(
            $name,
            $email,
            $hashedPassword
        );

        if ($created) {
            $_SESSION['auth_success'] =
                "Registration successful! Please log in.";

            $this->redirect('/login');
        }

        $_SESSION['auth_error'] =
            "Registration failed. Please try again.";

        $this->redirect('/register');
    }

    // Display login page
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home');
        }

        $csrfToken = $this->csrfToken();
        $error = $this->getFlash('auth_error');
        $success = $this->getFlash('auth_success');

        require __DIR__ . '/../views/auth/login.php';
    }

    // Authenticate user
    public function authenticate()
    {
        if (!$this->verifyCsrf()) {
            $_SESSION['auth_error'] = "Invalid request. Please try again.";
            $this->redirect('/login');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
            strlen($email) > 150 ||
            $password === '') {

            $_SESSION['auth_error'] =
                "Please enter valid login credentials.";

            $this->redirect('/login');
        }

        // Find user
        $user = $this->userModel->findByEmail($email);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {

            // Prevent session fixation
            session_regenerate_id(true);

            // Store authenticated user details
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Generate a fresh CSRF token
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            // Temporary redirect until dashboard is implemented
            $this->redirect('/home');
        }

        $_SESSION['auth_error'] =
            "Invalid email or password.";

        $this->redirect('/login');
    }

    // Logout user
    public function logout()
    {
        if (!$this->verifyCsrf()) {
            http_response_code(403);
            exit("Invalid logout request.");
        }

        // Clear session data
        $_SESSION = [];

        // Remove session cookie
        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        $this->redirect('/login');
    }
}
