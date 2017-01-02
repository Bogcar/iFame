<?php
        $servername = 'localhost';
        $username = 'root';
        $password = 'Ciao1234';
        $dbname = 'samtinfoch26';
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die('\n\n\n\n\nConnection failed: '.$conn->connect_error);
        }
?>
