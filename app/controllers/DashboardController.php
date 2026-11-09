
<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Dashboard.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DashboardController
{
    private $dashboardModel;

    public function __construct()
    {
        $database = new Database();

        $db = $database->connect();

        $this->dashboardModel = new Dashboard($db);
    }

    // Display dashboard
    public function index()
    {
        // Protect dashboard
        AuthMiddleware::handle();

        // Get logged-in user details
        $userId = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];

        // Get dashboard information
        $totalStudents =
            $this->dashboardModel->getTotalStudents($userId);

        $recentStudents =
            $this->dashboardModel->getRecentStudents($userId);

        // Load dashboard view
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
