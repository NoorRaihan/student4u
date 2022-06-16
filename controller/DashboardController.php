<?php

    session_start();
    
    include '../model/database.php';
    include '../model/User.php';

    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    $curr_user = User::get_user($_SESSION['user_id']);
?>