
<?php

// Start PHP session
session_start();

// Define project base path
define('BASE_PATH', '/student-management-system');

// Load Router
require_once __DIR__ . '/../core/Router.php';

// Load Controllers
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

// Create Router
$router = new Router();

// Load routes
require_once __DIR__ . '/../routes/web.php';

// Dispatch request
$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);
