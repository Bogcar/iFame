<?php
    function _getXMLData($userId, $title) {
        include "../db.php";
        include "../helpers/Recipe.php";

        if (isset($_GET['recipe_id'])) {
            $id = $_GET['recipe_id'];
        }

        $sql = "SELECT * FROM Recipes WHERE id = " . $id;

        if ($result = $conn->query($sql)) {
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
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

        $sql = "SELECT avg(Evaluation) as eval FROM Evaluation WHERE recipe_id = " . $id;

        if($result = $conn->query($sql)) {
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $eval = $row['eval'];
                }
            }
        }

        $xml = simplexml_load_file("../usersData/" . $username . ".xml");

        foreach ($xml->children() as $recipe) {
            if ($recipe['title'] == $title) {
                foreach ($recipe->ingredients->ingredient as $ing) {
                    $ingredients = $ingredients . $ing . "\n";
                }

                foreach ($recipe->procedures->procedure as $pro) {
                    $procedure = $procedure . $pro . "\n";
                }
            }
        }

        $r = new Recipe($title, $time, $description, $ingredients, $procedure);
        return array($r, $eval);
    }

    function _printRecipe($data){
        include "../db.php";

        $r = $data[0];

        echo '<h1>' . $r->getTitle() . '</h1>';

        echo '<h4>' . $r->getTime() . ' minuti</h4>';

        echo '<input id="eval" type="number" class="rating"
                min=0 max=5 step=0.5 data-size="xs" data-show-clear="false"
                data-readonly="true" value="' . $data[1] . '">';

        echo '<h3>' . $r->getDescription() . '</h3>';

        echo $r->getIngredients()[0];

        foreach ($r->getIngredients() as $ing) {
            echo $ing . "<br>";
        }

        foreach ($r->getProcedure() as $pro) {
            echo $pro . "<br>";
        }
    }

    function _deleteRecipe() {
        session_start();
        echo $_SESSION['login_user'];

        include '../db.php';

        $sql = "SELECT * FROM Recipes WHERE id = " . $_GET['recipe_id'];

        if($result = $conn->query($sql)) {
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $title = $row['title'];
                }
            }
        }

        $doc = new DOMDocument();
        $doc->load("../usersData/" . $_SESSION['login_user'] . ".xml");

        $thedocument = $doc->documentElement;

        $list = $thedocument->getElementsByTagName('recipe');

        $nodeToRemove = null;

        foreach ($list as $domElement) {
            $attrValue = $domElement->getAttribute('title');
            if($attrValue == $title) {
                $nodeToRemove = $domElement;
            }
        }

        if($nodeToRemove != null) {
            $sql = "DELETE FROM Recipes WHERE id = " . $_GET['recipe_id'];

            if (!$conn->query($sql)) {
                echo $conn->error;
            }

            $thedocument->removeChild($nodeToRemove);
            $file = fopen("../usersData/" . $_SESSION['login_user'] . ".xml", "w");
            fwrite($file, $doc->saveXML());
            fclose($file);
        }
    }

    function _insertEvaluation($userId, $title) {
        include 'db.php';

        $eval = $_GET['value'];
        $recipeId = $_GET['recipe_id'];

        $sql = "INSERT INTO Evaluation VALUES(" . $recipe_id . ", " . $eval . ")";

        if(!$conn->query($sql)) {
            echo $conn->error;
        }
    }
?>
