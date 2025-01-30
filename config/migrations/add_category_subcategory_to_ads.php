<?php
use Config\DBConfig;

$host =  DBConfig::host;
$username = DBConfig::username;
$password = DBConfig::password;
$databaseName = DBConfig::database;


try {
    $pdo = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "ALTER TABLE ads 
            ADD COLUMN category INT NOT NULL,
            ADD COLUMN subcategory INT DEFAULT NULL";

    $pdo->exec($sql);

    echo "DONE add_category_subcategory_to_ads.php: 'ads' tablosuna 'category' ve 'subcategory' kolonları başarıyla eklendi.";
} catch (PDOException $e) {
    echo "ERROR add_category_subcategory_to_ads.php: Kolonlar eklenirken bir hata oluştu: " . $e->getMessage();
}
