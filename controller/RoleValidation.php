<?php

    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    include_once '../model/database.php';
    include_once '../model/User.php';

    $curr_user = User::get_user($_SESSION['user_id']);
    $role = $curr_user['role_id'];
?>