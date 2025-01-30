<?php
use Config\DBConfig;

$host =  DBConfig::host;
$username = DBConfig::username;
$password = DBConfig::password;
$databaseName = DBConfig::database;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        phone_number VARCHAR(20),
        email_verified_at DATETIME DEFAULT NULL,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";


    $pdo->exec($sql);

    echo "DONE create_users.php: users tablosu başarıyla oluşturuldu.";
} catch (PDOException $e) {
    echo "ERROR create_users.php: Tablo oluşturulurken bir hata oluştu: " . $e->getMessage();
}
