<?php

    include './model/database.php';

    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    var_dump($conn);
?>