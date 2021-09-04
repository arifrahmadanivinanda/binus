<?php
    # YOU CAN SET THE DATABASE CONNECTION HERE
    $server = 'localhost';  
    $user = 'root';  
    $password = '';  
    $database = 'assessmentdb';  

    # connection process
    $conn = new mysqli($server, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "error";
    } 
?>