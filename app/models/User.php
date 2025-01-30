<?php

namespace App\Models;

use Core\Model;
use Core\Session;

class User extends Model{
    public static $table = "users";

    public static function hasLoggedIn(){
        return Session::has("user_id");
    }
}
