
<?php

// Home routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

// Registration routes
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'store']);

// Login routes
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);

// Logout route
$router->post('/logout', [AuthController::class, 'logout']);
