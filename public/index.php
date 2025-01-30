<?php

require("../vendor/autoload.php");

use Core\Router;
use Core\Session;
use App\Controllers\UserController;
use App\Controllers\AdController;
use App\Middlewares\AuthMiddleware;
use Config\AppConfig;

// // // include(AppConfig::__ROOT_DIR__ . "/config/migrations/create_subcategories.php");



Router::view("/", "welcome", []);



Router::view("/login", "login");
Router::controller("/authenticate", "POST", UserController::class, "authenticate");
Router::view("/signup", "signup");
Router::controller("/register", "POST", UserController::class, "register");
Router::controller("/logout", "GET", UserController::class, "logout");




Router::controller("/category", "GET", AdController::class, "getByCategory");
Router::controller("/paginate", "GET", AdController::class, "paginate");



Router::controller("/dashboard", "GET", UserController::class, "logout");





echo "404" . 
"<style>body{font-size:100px;display: flex;flex-direction:column;align-items:center}</style>";

// SQL injection

// auth middleware admin role only
