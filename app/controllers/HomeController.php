
<?php

class HomeController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {

            header("Location: " . BASE_PATH . "/dashboard");

        } else {

            header("Location: " . BASE_PATH . "/login");

        }

        exit;
    }
}
