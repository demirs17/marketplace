<?php
namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Session;

class UserController extends Controller{

    public function authenticate($request){
        $user = User::where([
            "email" => $request["email"],
        ])[0];
        //print_r($user);
        if(password_verify($request["password"], $user["password"])){
            Session::set("user_id", $user["id"]);
            Session::set("user_email", $user["email"]);
            redirect("/");
        }else{
            echo "şifre yanlış";
        }
    }

    public function register($request){
        $array = [
            "name" => $request["name"],
            "email" => $request["email"],
            "phone_number" => $request["phone_number"],
            "password" => password_hash($request["password"],PASSWORD_DEFAULT),
        ];
        if(User::new($array)){
            redirect("/");
        }else{
            echo "kayıt yapılamadı";
        }
    }

    public function logout(){
        Session::destroy();
        redirect("/");
    }
}
