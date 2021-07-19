<?php
require_once 'config.php';
try {
    $dns = "mysql:host=" . $config['db_host'];
    $dns .= ";dbname=" . $config['db_name'];
    $conn = new PDO($dns,
        $config['db_user'], $config['db_password']);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    di("Connection failed: " . $e->getMessage());
}