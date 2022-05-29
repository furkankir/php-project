<?php
    define('DB_HOST','');
    define('DB_USER','');
    define('DB_PASS','');
    define('DB_NAME','');

    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    if($conn->connect_error){
        die('connection failed'.$conn->connect_error);
    }

    echo 'CONNECTED!';
