
<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->studentModel = new Student($db);
    }

    private function redirect($path)
    {
        header("Location: " . BASE_PATH . $path);
        exit;
    }

    private function csrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    private function verifyCsrf()
    {
        return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
            && hash_equals(
                $_SESSION['csrf_token'],
                $_POST['csrf_token']
            );
    }

    // Display Add Student form.
    public function create()
    {
        AuthMiddleware::handle();

        $csrfToken = $this->csrfToken();
        $errors = [];
        $old = [];

        require __DIR__ . '/../views/students/create.php';
    }

    // Save student details.
    public function store()
    {
        AuthMiddleware::handle();

        if (!$this->verifyCsrf()) {
            http_response_code(403);
            exit("Invalid form submission. Please refresh and try again.");
        }

        $userId = $_SESSION['user_id'];

        $data = [
            'user_id' => $userId,
            'roll_number' => trim($_POST['roll_number'] ?? ''),
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'gender' => trim($_POST['gender'] ?? ''),
            'date_of_birth' => trim($_POST['date_of_birth'] ?? ''),
            'course' => trim($_POST['course'] ?? ''),
            'year' => trim($_POST['year'] ?? ''),
            'address' => trim($_POST['address'] ?? '')
        ];

        $errors = [];

        // Required field validation.
        foreach ([
            'roll_number' => 'Roll number',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'course' => 'Course',
            'year' => 'Academic year'
        ] as $field => $label) {
            if ($data[$field] === '') {
                $errors[$field] = "$label is required.";
            }
        }

        // Email validation.
        if (
            $data['email'] !== '' &&
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = "Enter a valid email address.";
        }

        // Check duplicate roll number.
        if (
            $data['roll_number'] !== '' &&
            $this->studentModel->rollNumberExists(
                $data['roll_number'],
                $userId
            )
        ) {
            $errors['roll_number'] =
                "This roll number already exists.";
        }

        // Date validation.
        if ($data['date_of_birth'] !== '') {
            $date = DateTime::createFromFormat(
                'Y-m-d',
                $data['date_of_birth']
            );

            if (
                !$date ||
                $date->format('Y-m-d') !== $data['date_of_birth'] ||
                $date > new DateTime('today')
            ) {
                $errors['date_of_birth'] =
                    "Enter a valid date of birth.";
            }
        }

        // Gender validation.
        if (
            $data['gender'] !== '' &&
            !in_array($data['gender'], ['Male', 'Female', 'Other'], true)
        ) {
            $errors['gender'] = "Select a valid gender.";
        }

        if (!empty($errors)) {
            $csrfToken = $this->csrfToken();
            $old = $data;

            require __DIR__ . '/../views/students/create.php';
            return;
        }

        $saved = $this->studentModel->create($data);

        if ($saved) {
            $this->redirect('/students/create?success=1');
        }

        $errors['general'] = "Unable to save student details.";
        $csrfToken = $this->csrfToken();
        $old = $data;

        require __DIR__ . '/../views/students/create.php';
    }
}
