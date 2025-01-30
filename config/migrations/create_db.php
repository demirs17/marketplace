<?php

use Config\DBConfig;

$host =  DBConfig::host;
$username = DBConfig::username;
$password = DBConfig::password;

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $databaseName = 'sahibinden_php';
    $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

    $pdo->exec($sql);

    echo "DONE create_db.php";
} catch (PDOException $e) {
    echo "ERROR create_db.php: Veritabanı oluşturulurken bir hata oluştu: " . $e->getMessage();
}
