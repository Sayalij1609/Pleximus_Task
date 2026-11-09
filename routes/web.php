
<?php

// Home routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

// Authentication routes
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'store']);

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);

$router->post('/logout', [AuthController::class, 'logout']);

// Dashboard route
$router->get('/dashboard', [DashboardController::class, 'index']);

// Add Student
$router->get('/students/create', [StudentController::class, 'create']);
$router->post('/students', [StudentController::class, 'store']);