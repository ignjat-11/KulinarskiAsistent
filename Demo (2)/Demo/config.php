<?php

    session_start();
    
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "db_recipes";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if($conn->connect_error) 
    {
        die("Greška pri povezivanju sa bazom: " . $conn->connect_error);
    }

?>