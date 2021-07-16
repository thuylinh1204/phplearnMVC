<?php
    session_start();
    // validate login
    $errors = [];
    if (isset($_POST))
    {
        if (empty($_POST['email']))
        {
            $errors['email'] = "Email is required!";
        }

        if (empty($_POST['password']))
        {
            $errors['password'] = "Password is required!";
        }

        if ($errors)
        {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $_POST;
            header("location: login.php");
            exit();
        }

        // login
        // check login ok
        unset($_SESSION['errors']);
        unset($_SESSION['data']);
        $_SESSION['user'] = $_POST['email'];

        // redirect
        header("location: index.php");
        exit();
    }

