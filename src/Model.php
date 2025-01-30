<?php

namespace Core;

use PDO;
use Config\DBConfig;

class Model {
    private static $db = null;
    private static $table = null;
    public static function connect(){
        if(static::$table !== null){
            if(static::$db === null){
                $db = new PDO("mysql:host=". DBConfig::host .";dbname=".DBConfig::database, DBConfig::username, DBConfig::password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                static::$db = $db;
            }
        }
    }
    public static function disconnect(){
        static::$db = null;
    }

    public static function all(){
        try {
            static::connect();
            $sql = "select * from " . static::$table;
            $stmt = static::$db->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            static::disconnect();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            echo "sql error 0x01";
        }
    }
    public static function where(array $array){
        $sql = "select * from " . static::$table . " where ";
        for($i = 0;$i<count($array);$i++) {
            $key = array_keys($array)[$i];
            $val = $array[$key];
            $sql .= $i!=0 ? " and " : "";
            $sql .= $key . " = ";
            // $sql .= gettype($val) == "string" ? "" : "";
            $sql .= var_export($val, true);
            // $sql .= gettype($val) == "string" ? "" : "";
        }
        try {
            static::connect();
            $stmt = static::$db->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            static::disconnect();
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            echo "sql error 0x02";
        }
    }

    public static function new(array $array){
        $sql = "insert into " . static::$table . " (";
        for($i = 0;$i<count($array);$i++){
            $key = array_keys($array)[$i];
            $sql .= $i != 0 ? ", " . $key : $key;
        }
        $sql .= ") values(";
        for($i = 0;$i<count($array);$i++){
            $val = $array[array_keys($array)[$i]];
            $sql .= $i != 0 ? ", " : "";
            $sql .= var_export($val, true);
        }
        $sql .= ")";
        
        try {
            static::connect();
            return static::$db->exec($sql);
        } catch (\Throwable $th) {
            echo "sql error 0x03" . $th;
        }
    }

    public static function select($sql){
        try {
            static::connect();
            $stmt = static::$db->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            static::disconnect();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            echo "sql error 0x04";
        }
    }
}