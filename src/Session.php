<?php

namespace Core;

class Session
{
    public static function start(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        };
    }

    public static function set($key,$value){
        self::start();
        $_SESSION[$key] = $value;
    }
    public static function get($key){
        self::start();
        return $_SESSION[$key] ?? null;
    }
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }
}