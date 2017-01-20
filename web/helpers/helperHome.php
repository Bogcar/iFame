<?php
    function _getStorico() {
        include 'db.php';
        session_start();

        $sql = "SELECT * FROM Recipes WHERE user_id = (SELECT id FROM Users " .
            "WHERE username = '" . $_SESSION['login_user'] . "')";

        if($result = $conn->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $sql = "SELECT avg(Evaluation) AS eval FROM Evaluation " .
                        "WHERE recipe_id = " . $row['id'];

                    if($res = $conn->query($sql)) {
                        if($res->num_rows == 1) {
                            while($r = $res->fetch_assoc()) {
                                _printTab($row['id'], $row['title'],
                                    $row['time'], $row['description'], $r['eval']);
                            }
                        }
                    }
                }
            }
        }
    }

    function _printTab($id, $title, $time, $description, $eval)
    {
        echo '<div class="panel panel-default">
                <div class="panel-heading"><a href="index/recipe.php?recipe_id=' . $id . '"><h1>' . $title . '</h1></a><span>' . $time . ' minuti<span></div>
                <div class="panel-body">' . $description . '</div>
                <div class="panel-footer" style="text-align: right; font-size: 20px;">
                        <input id="input-id" name="input-name" type="number" class="rating"
                                min=0 max=5 step=0.1 data-size="xs" data-show-clear="false"
                                data-readonly="true" value="' . $eval . '">
                </div>
              </div>';
    }
?>
