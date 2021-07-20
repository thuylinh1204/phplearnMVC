<?php
session_start();
include_once '../inc/connect_db.php';
// validate login
$errors = [];
if (isset($_POST['product_id']))
{
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $sql = <<<SQL
    DELETE FROM products WHERE id=?;
SQL;

    $data[] = $_POST['product_id'];
    try{
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
    }
    catch(PDOException $e) {
        die( $sql . "<br>" . $e->getMessage());
    }
    $conn = null;
}

// redirect
header("location: /admin/products");
exit();