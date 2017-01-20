<?php
    $servername = "mysql.samtinfo.ch";
    $username = "i3ifame";
    $password = "I3_Ifame_Admin";
    $db = "samtinfoch26";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 ?>
