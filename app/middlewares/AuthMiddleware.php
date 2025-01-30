<?php
namespace App\Middlewares;

use App\Models;

class AuthMiddleware {
    public static function index(){
        return User::hasLoggedIn();
    }
}