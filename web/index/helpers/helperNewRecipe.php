<?php
    function _addRecipe(){
        session_start();
        include "../helpers/xml.php";
        include '../db.php';

        $title = $_POST['title'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $ingredients = $_POST['ingredients'];
        $procedure = $_POST['procedure'];

        $sql = "SELECT id FROM Users WHERE username = '" . $_SESSION['login_user'] . "'";

        if ($result = $conn->query($sql)) {
            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                }

                $sql = "SET FOREIGN_KEY_CHECKS=0";
                $conn->query($sql);

                $sql = "INSERT INTO Recipes(title, description, time, user_id) VALUES('" . $title . "', '" . $description . "', " . $time . ", " . $id . ")";

                if ($conn->query($sql)) {
                    $rec = new Recipe($title, $time, $description, $ingredients, $procedure);

                    $xml = new xml($rec, $_SESSION['login_user']);
                    $xml->writeRecipe();
                } else {
                    echo $conn->error;
                }

                $sql = "SET FOREIGN_KEY_CHECKS=1";
                $conn->query($sql);
            }
        }
    }
?>
