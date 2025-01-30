<?php
use Config\DBConfig;

$host =  DBConfig::host;
$username = DBConfig::username;
$password = DBConfig::password;
$databaseName = DBConfig::database;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS ads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        images_folder VARCHAR(100) NOT NULL,
        description TEXT,
        user_id INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL CHECK (price >= 0),
        on_sale BOOLEAN DEFAULT TRUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT NULL
    )";

    $pdo->exec($sql);

    echo "DONE create_ads.php: ads tablosu başarıyla oluşturuldu.";
} catch (PDOException $e) {
    echo "ERROR create_ads.php: Tablo oluşturulurken bir hata oluştu: " . $e->getMessage();
}