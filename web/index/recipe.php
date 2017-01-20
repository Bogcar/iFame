<?php
    session_start();
    include "helpers/helperRecipe.php";
?>
<!DOCTYPE html>
<html>
<head>
        <title>Settings | iFame</title>
        <meta charset="utf-8">
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
        <link href="../css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
        <script src="../js/star-rating.js" type="text/javascript"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="js/script.js"></script>
        <link rel="stylesheet" href="css/recipe.css">
</head>
<body style="text-align: center">
    <div class="container">
        <?php
            if($_SERVER['REQUEST_METHOD'] == "GET") {
                if(isset($_GET['action'])) {
                    if ($_GET['action'] == "delete") {
                        _deleteRecipe();
                    }
                }
            }
            include '../db.php';

            $sql = "SELECT title, user_id FROM Recipes WHERE id = " . $_GET['recipe_id'];

            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $userId = $row['user_id'];
                    $title = $row['title'];
                }
            }


            $sql = "SELECT id FROM Users WHERE username = '" . $_SESSION['login_user'] . "'";

            if ($result = $conn->query($sql)) {
                if ($result->num_rows == 1) {
                    while($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                    }
                }
            }

            if (isset($_GET['value'])) {
                _insertEvaluation($userId, $title);
            } else {
                _printRecipe(_getXMLData($userId, $title));
            }

            echo '<input id="eval" type="number" class="rating"
                    min=0 max=5 step=0.5 data-size="xs" data-show-caption="false"
                    data-show-clear="false">';

            if ($userId == $id) {
                echo '<a href="modifyRecipe.php?recipe_id=' . $_GET['recipe_id'] . '" class="btn btn-primary">MODIFICA</a>';
                echo '<a href="recipe.php?recipe_id=' . $_GET['recipe_id'] . '&action=delete" class="btn btn-danger">DELETE</a>';
            }
        ?>
        <input id="shopping" type="button" class="btn btn-primary" value="LISTA SPESA">

    </div>
</body>
</html>
