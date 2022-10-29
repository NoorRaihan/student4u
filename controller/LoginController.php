<?php

    include_once '../model/database.php';
    include_once '../model/User.php';
    include_once '../model/AssignRole.php';

    //get a DB connection
    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    $matrix = $conn->real_escape_string($_POST['matrix']);
    $password = $conn->real_escape_string($_POST['password']);
    $role = $conn->real_escape_string($_POST['role']);

    $user = User::get_user_role(NULL, $matrix, $role);
    //var_dump($user['user_password']);
    session_start();
    if(!empty($user)) {

        if(password_verify($password, $user['user_password'])) {

            //get the role
            if($user['role_id'] == $role) {
                session_start();
                $session_id = session_create_id();

                $_SESSION['log_in'] = True;
                $_SESSION['matrix_no'] = $user['matrix_no'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role_id'];
                $_SESSION['id'] = $session_id;

                echo "<script>window.location.href = '../view/index.php'</script>";
                exit();
            } else {
                //echo "<script>alert('Not Authorized!'); window.location.href = '../view/login.php'</script>";
                $_SESSION['error'] = "Not Authorized";
                echo "<script>window.location.href = history.back()</script>";
            }
            
        } else {
            $_SESSION['error'] = "Wrong Password";
            echo "<script>window.location.href = history.back()</script>";
        }

    } else {
        //echo "<script>alert('Matric number not exist in current role'); window.location.href = '../view/login.php'</script>";
        $_SESSION['error'] = "ID does not exist in the current role";
        echo "<script>window.location.href = history.back()</script>";
    }
?>