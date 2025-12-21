<?php

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "fas_db";

    try {
        $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    }

    catch(mysqli_sql_exception $e) {
        echo "Connection failed: ";
    }

    if($conn) {
         echo "Connected successfully";
    }

?>
