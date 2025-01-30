<?php
namespace Core;

use Config\AppConfig;

include_once(AppConfig::__ROOT_DIR__ . "/src/helpers/router.php");
include_once(AppConfig::__ROOT_DIR__ . "/src/helpers/controller.php");

class Router {
    public static function view(string $path,string $view,array $data = []){
        if(static::check($path, "GET")){
            foreach($data as $key=>$d){
                $$key = $d;
            }
            include(AppConfig::view_dir . "\\" . $view . ".php");
            exit;
        }
    }

    // CSRF
    public static function controller(string $path, string $request_method,string $controller,string $method, string $middleware = null){
        if(static::check($path, $request_method)){
            $next = true;
            // echo "<br><br>REQUEST<br>"."path: ".$path."<br>".
            // $controller."::".$method."<br>".
            // "mw: ".$middleware."<br><br>";
            if(!empty($middleware)){
                $next = false;
                $next = $middleware::index();
            }
            if($next === true){
                $ctrl = new $controller;
                $response = $ctrl->$method($_REQUEST);

                if(in_array(gettype($response), ["string", "integer", "boolean"])){
                    echo $response;
                }else if(gettype($response) == "object"){
                    var_dump($response);
                }else{
                    "frm error 0x001";
                }
                exit;
            }
            else{
                redirect("/access_denied");
            }
        }
    }

    private static function check(string $path, string $method){
        if(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) == $path && $_SERVER["REQUEST_METHOD"] == $method){
            return true;
        }
        return false;
    }
}
