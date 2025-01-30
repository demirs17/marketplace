<?php
use Config\DBConfig;

$host =  DBConfig::host;
$username = DBConfig::username;
$password = DBConfig::password;
$databaseName = DBConfig::database;


try {
    $pdo = new PDO("mysql:host=$host;dbname=$databaseName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        CREATE TABLE IF NOT EXISTS subcategories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            subcategory_name VARCHAR(100) NOT NULL,
            category INT
        );
    ";

    $pdo->exec($sql);
    echo "DONE create_subcategories.php: Kategoriler tablosu başarıyla oluşturuldu.";
} catch (PDOException $e) {
    echo "ERROR create_subcategories.php: " . $e->getMessage();
}