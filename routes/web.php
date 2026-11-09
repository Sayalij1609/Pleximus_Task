
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


// Student routes
$router->get('/students', [StudentController::class, 'index']);
$router->get('/students/show', [StudentController::class, 'show']);

// Update student details
$router->get('/students/edit', [StudentController::class, 'edit']);
$router->post('/students/update', [StudentController::class, 'update']);

// Delete Student 
$router->post('/students/delete', [StudentController::class, 'destroy']);