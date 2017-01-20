<?php
function _signIn()
{
    include 'db.php';
    session_start();

    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM Users WHERE password = '" . $pass . "' AND (username = '" . $user . "' OR email = '" . $user . "')";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['login_user'] = $user;
        header('Location: home.php');
    } else {
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Login errato</strong><br /> Dati inseriti sbagliati.
            </div>';
    }
}

function _signUp()
{
    include 'db.php';
    $user  = $_POST['username'];
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);
    $cPass = md5($_POST['confirmPassword']);

    if (_controlData($user, $email, $pass, $cPass)) {
        $sql = "SELECT *
            FROM Users
            WHERE username =  '" . $user . "' OR
            email = '" . $email . "'
            UNION ALL
            SELECT *
            FROM Confirmation
            WHERE username =  '" . $user . "' OR
            email = '" . $email . "'";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO Confirmation(username, password, email, hash) VALUES('" . $user . "', '" . $pass . "', '" . $email . "', '" . md5($user) . "')";

            if ($conn->query($sql)) {
                $to      = $email;
                $subject = "Account activation";
                $txt     = "Hello,\nto confirm the new account click on the link below:\nLink: http://www.samtinfo.ch/i3_ifame/index.php?activation=" . md5($user);
                $headers = "From: no-reply@ifame.ch";

                mail($to, $subject, $txt, $headers);

                echo "<script>
                        $( document ).ready(function() {

                        $('#confirmationLink').modal('show');
                        });
                        </script>";

                echo '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <br /> User correctly created!
                        </div>';
            } else {
                echo '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failure!</strong> <br />
                    User not created.' . $conn->error . '
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> <br />
                Use another username or email.
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failure!</strong> <br />
            Password and Confirm Password doesn\'t matches!
            </div>';
    }
}

function _controlData($user, $email, $pass, $cPass)
{
    if ($pass != $cPass) {
        return false;
    }
    return true;
}

function _active()
{
    include 'db.php';

    $activation = $_GET['activation'];

    $sql = "SELECT * FROM Confirmation WHERE hash = '" . $activation . "';";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $sql = "INSERT INTO Users(username, password, email, admin) VALUES ('" . $row['username'] . "', '" . $row['password'] . "', '" . $row['email'] . "', false)";

            if ($conn->query($sql)) {
                echo "<script>
                        $( document ).ready(function() { $('#actived').modal('show'); });
                        </script>";

                $sql = "DELETE FROM Confirmation WHERE id=" . $row['id'] . ";";

                $conn->query($sql);
            } else {
                echo '<br /><br />:(' . $conn->error;
            }
        }
    }
}
