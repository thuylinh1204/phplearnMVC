<?php
session_start();
include_once '../inc/connect_db.php';
// validate login
$errors = [];
if (isset($_POST))
{
    if (empty($_POST['title']))
    {
        $errors['title'] = "Title is required!";
    }

    if (empty($_POST['price']))
    {
        $errors['price'] = "Price is required!";
    }

    if ($errors)
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $_POST;
        header("location: /admin/products/create.php");
        exit();
    }

    // login
    // check login ok
    unset($_SESSION['errors']);
    unset($_SESSION['data']);

    $sql = <<<SQL
    INSERT INTO products(title, price, description) VALUES (?, ?, ?);
SQL;
	
	$data[] = $_POST['title'];
	$data[] = $_POST['price'];
	$data[] = $_POST['description'];
	try{
		$stmt= $conn->prepare($sql);
		$stmt->execute($data);
	} 
	catch(PDOException $e) {
		die( $sql . "<br>" . $e->getMessage());
	}
	$conn = null;
    // redirect
    header("location: /admin/products");
    exit();
}