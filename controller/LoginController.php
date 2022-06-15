<?php

    include_once '../model/database.php';
    include_once '../model/User.php';

    //get a DB connection
    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    $matrix = $conn->real_escape_string($_POST['matrix']);
    $password = $conn->real_escape_string($_POST['password']);

    $user = User::get_user(NULL, $matrix);
    //var_dump($user['user_password']);
    if(!empty($user)) {

        if(password_verify($password, $user['user_password'])) {

            session_start();
            $session_id = session_create_id();

            $_SESSION['log_in'] = True;
            $_SESSION['matrix_no'] = $user['matrix_no'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['id'] = $session_id;

            echo "<script>alert('Success!'); window.location.href = '../view/index.php'</script>";
            exit();
        } else {
            echo "<script>alert('Wrong password')</script>";
        }

    } else {
        echo "<script>alert('Wrong matrix number')</script>";
    }
?>