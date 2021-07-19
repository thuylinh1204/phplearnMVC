<?php
include_once 'connect_db.php';
$sql  = <<<SQL
    CREATE TABLE products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(80) NOT NULL,
        price DECIMAL(8,2) NOT NULL,
        quantity INT(6),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        description TEXT,
        photo VARCHAR(200),
        category INT(6) UNSIGNED
    );
SQL;

try{
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table MyGuests created successfully";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;