<?php
    session_start();
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

        <script src="../js/script.js"></script>
</head>
<body>
        <div class="container">
                <div class="page-header">
                        <?php
                        if (isset($_GET['search'])) {
                            echo '<h1>Search results:</h1>';
                        } else {
                            echo '<h1>Recipes:</h1>';
                        }
                        ?>
                </div>
                <?php
                    include '../db.php';
                    if (isset($_GET['search'])) {
                        _findRecipes();
                    } else {
                        $sql = "SELECT * FROM Recipes";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sql = "SELECT avg(evaluation) as eval FROM Evaluation WHERE recipe_id = " . $row['id'];

                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    while ($r = $res->fetch_assoc()) {
                                        printTab($row['id'], $row['title'], $row['time'], $row['description'], $r['eval']);
                                    }
                                }
                            }
                        }
                    }

                ?>
        </div>
</body>
</html>

<?php
    function _findRecipes()
    {
        include "../db.php";

        $search = $_GET['search'];

        if (is_numeric($search)) {
            $sql = "SELECT * FROM Recipes WHERE time = " . $search . " OR id IN" .
            " (SELECT recipe_id FROM Evaluation HAVING avg(Evaluation) >= " .
            $search - 0.5 . " OR avg(Evaluation) <= " . $search + 0.5 . ")";
        } else {
            $sql = "SELECT * FROM Recipes WHERE title LIKE '%" . $search . "%' OR" .
            " description LIKE '%" . $search . "%'";
        }

        if ($result = $conn->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $sql = "SELECT avg(evaluation) as eval FROM Evaluation WHERE recipe_id = " . $row['id'];

                    if ($res = $conn->query($sql)) {
                        if($res->num_rows > 0) {
                            while($r = $res->fetch_assoc()) {
                                printTab($row['id'], $row['title'], $row['time'], $row['description'], $r['eval']);
                            }
                        }
                    }
                }
            }
        } else {
            echo $conn->query($sql);
        }
    }

    function printTab($id, $title, $time, $description, $eval)
    {
        echo '<div class="panel panel-default">
                <div class="panel-heading"><a href="recipe.php?recipe_id=' . $id . '"><h1>' . $title . '</h1></a><span>' . $time . ' minuti<span></div>
                <div class="panel-body">' . $description . '</div>
                <div class="panel-footer" style="text-align: right; font-size: 20px;">
                        <input id="input-id" name="input-name" type="number" class="rating"
                                min=0 max=5 step=0.1 data-size="xs" data-show-clear="false"
                                data-readonly="true" value="' . $eval . '">
                </div>
              </div>';
    }
?>
