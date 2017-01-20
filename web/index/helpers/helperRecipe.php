<?php
    function _getXMLData() {
        if (isset($_GET['recipe_id'])) {
            $id = $_GET['recipe_id'];
        }

        $sql = "SELECT user_id FROM Evaluation WHERE id = " . $id;

        if ($result = $conn->query($sql)) {
            if($result->num_rows = 1) {
                while($row = $result->fetch_assoc) {
                    $username = 
                }
            }
        }

        $xml = simplexml_load_file("../usersData/" . $_SESSION['login_user'])
    }

    function _printRecipe()
?>
