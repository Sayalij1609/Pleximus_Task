
<?php

class AuthMiddleware
{
    public static function handle()
    {
        // Check whether the user is logged in
        if (!isset($_SESSION['user_id'])) {

            // Store an error message
            $_SESSION['auth_error'] =
                "Please login to access the dashboard.";

            // Redirect to login page
            header("Location: " . BASE_PATH . "/login");
            exit;
        }
    }
}
