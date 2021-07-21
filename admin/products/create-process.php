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
    INSERT INTO products(title, price, description, photo, published)
VALUES (:title, :price, :description, :photo, :published);
SQL;

	$data[':title'] = $_POST['title'];
	$data[':price'] = (float) $_POST['price'];
	$data[':description'] = $_POST['description'];
	$data[':published'] = (int) $_POST['publish'];
	$data[':photo'] = '';

	if (isset($_FILES))
	{
	    $target_dir = "../../uploads/";
	    $fileName = basename($_FILES["photo"]["name"]);
	    $target_file = $target_dir . $fileName;

	    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
	        $data[':photo'] = $fileName;
	    }
	}

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