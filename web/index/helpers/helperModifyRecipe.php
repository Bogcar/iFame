<?php
    include '../db.php';
    include '../helpers/xml.php';

    function _getRecipe() {
        include '../db.php';

        $id = $_GET['recipe_id'];

        $sql = "SELECT * FROM Recipes WHERE id = " . $id;

        if ($result = $conn->query($sql)) {
            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $userId = $row['user_id'];
                    $title = $row['title'];
                    $time = $row['time'];
                    $description = $row['description'];
                }
            }
        }

        $sql = "SELECT * FROM Users WHERE id = " . $userId;

        if ($result = $conn->query($sql)) {
            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $username = $row['username'];
                }
            }
        }

        $xml = simplexml_load_file("../usersData/" . $username . ".xml") or
            die("Error: Cannot open file");

        foreach ($xml->children() as $recipes) {
            if ($recipes['title'] == $title) {

                foreach($recipes->ingredients->ingredient as $ing) {
                    $ingredients = $ingredients . $ing . "\n";
                }

                foreach($recipes->procedures->procedure as $pro) {
                    $procedures = $procedures . $pro . "\n";
                }

                $r = new Recipe($title, $time, $description, $ingredients, $procedures);

                return $r;
            }
        }
    }

    function _modifyRecipe() {
        _removeRecipe();
        _addRecipe();
    }

    function _removeRecipe() {
        include '../db.php';
        session_start();

        $recipeId = $_POST['recipe_id'];

        $sql = "SELECT title FROM Recipes WHERE id = " . $recipeId;

        if($result = $conn->query($sql)) {
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $recipeTitle = $row['title'];
                }
            }
        }

        $filepath = "../usersData/" . $_SESSION['login_user'] . ".xml";

        $doc = new DOMDocument;
        $doc->load($filepath);

        $theDocument = $doc->documentElement;

        $list = $theDocument->getElementsByTagName('recipe');

        foreach ($list as $domElement) {
            $attrValue = $domElement->getAttribute('title');
            if ($attrValue == $recipeTitle) {
                $nodeToRemove = $domElement;
            }
        }

        if ($nodeToRemove != null) {
            $theDocument->removeChild($nodeToRemove);

            $file = fopen($filepath, "w");
            fwrite($file,$doc->saveXml());
            fclose($file);
        }
    }

    function _addRecipe() {
        session_start();
        include '../db.php';

        $title = $_POST['title'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $ingredients = $_POST['ingredients'];
        $procedure = $_POST['procedure'];

        $sql = "SELECT id FROM Users WHERE username = '" . $_SESSION['login_user'] . "'";

        if($result = $conn->query($sql)) {
            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                }

                $sql = "SET FOREIGN_KEY_CHECKS=0";
                $conn->query($sql);

                $sql = "UPDATE Recipes SET title = '" . $title . "', description = '" .
                    $description . "', time = " . $time . " WHERE id = " . $_POST['recipe_id'];

                if ($conn->query($sql)) {
                    $rec = new Recipe($title, $time, $description, $ingredients, $procedure);

                    $xml = new xml($rec, $_SESSION['login_user']);
                    $xml->writeRecipe();
                }

                $sql = "SET FOREIGN_KEY_CHECKS=1";
                $conn->query($sql);

                header("Location: recipe.php?recipe_id=" . $_POST['recipe_id']);
            }
        }
    }
?>
