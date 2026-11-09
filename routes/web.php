
<?php

// Home page route
$router->get('/', [HomeController::class, 'index']);

// Alternative home route
$router->get('/home', [HomeController::class, 'index']);
