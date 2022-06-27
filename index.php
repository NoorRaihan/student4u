<?php

    include './model/database.php';

    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    var_dump($conn);
    echo strftime('%Y-%m-%d %H:%M:%S');

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div><a href="./view/register.php">Register</a></div>
        <div><a href="./view/login.php">Login</a></div>
        
        <script src="" async defer></script>
    </body>
</html>