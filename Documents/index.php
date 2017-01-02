<?php
  include 'db.php';
  session_start();

  if (isset($_SESSION['login_user'])) {
      $sql = "SELECT id FROM Users where username = '" . $_SESSION['login_user'] . "'";

      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
          header('Location: home.php');
      }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
        <title>Home | iFame</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/style.css" />
        <script src="js/script.js"></script>



</head>
<body onload="setUp()">
        <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="">iFame</a>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                        <li class="active"><a href="">Home</a></li>
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                        <li>
                                                <form class="navbar-form navbar-left">
                                                        <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Search" name="search">
                                                        </div>
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                </form>
                                        </li>
                                        <li><a href="#" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#signinModal"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
                                </ul>
                        </div>
                </div>
        </nav>

        <div class="container">
                <div class="row">
                        <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        if (isset($_POST['signin'])) {
                                                _signIn();
                                        }  else {
                                                _signUp();
                                        }
                                } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                                        if (isset($_GET['activation'])) {
                                                _active("signin");
                                        }
                                }
                        ?>
                        <iframe class="col-md-12" id="frame" src="index/search.html" style="border: 0px">
                        </iframe>
                </div>
        </div>

        <!-- Signin Modal -->
        <div id="signinModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Sign In</h4>
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="">
                                                <div class="form-group">
                                                        <label for="username">Username or email:</label>
                                                        <input type="text" class="form-control" id="username" name="username">
                                                </div>
                                                <div class="form-group">
                                                        <label for="password">Password:</label>
                                                        <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                                <span name="confirmationLink"></span>
                                                <input type="submit" class="btn btn-default" name="signin">
                                        </form>
                                </div>
                        </div>
                </div>
                </form>
        </div>
        <!--/SignInModal-->

        <!--signupModal-->
        <div id="signupModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Sign Up</h4>
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="">
                                                <div class="form-group">
                                                        <label for="username">Username:</label>
                                                        <input type="text" class="form-control" id="username" name="username">
                                                </div>
                                                <div class="form-group">
                                                        <label for="email">E-mail:</label>
                                                        <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                                <div class="form-group">
                                                        <label for="password">Password:</label>
                                                        <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                                <div class="form-group">
                                                        <label for="confirmPassword">Confirm password:</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                                </div>
                                                <input type="submit" class="btn btn-default" name="signup">
                                        </form>
                                </div>
                        </div>
                </div>
                </form>
        </div>
        <!--/SignupModal-->
        <!--confirmationLink-->
        <div id="confirmationLink" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Confirmation link sent</h4>
                                </div>
                        </div>
                </div>
                </form>
        </div>
        <!--/confirmationLink-->
        <!--actived-->
        <div id="actived" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Account successfully created!</h4>
                                </div>
                        </div>
                </div>
                </form>
        </div>
        <!--/actived-->
</body>
</html>

<?php
        function _signIn($ciao) {
                include 'db.php';
                session_start();

                $user = $_POST['username'];
                $pass = md5($_POST['password']);

                $sql = "SELECT * FROM Users WHERE password = '".$pass."' AND (username = '".$user."' OR email = '".$user."')";

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

        function _signUp() {
                include 'db.php';
                $user = $_POST['username'];
                $email = $_POST['email'];
                $pass = md5($_POST['password']);
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
                                $sql = "INSERT INTO Confirmation(username, password, email, hash) VALUES('".$user."', '".$pass."', '".$email."', '".md5($user)."')";

                                if ($conn->query($sql)) {

                                        $to = $email;
                                        $subject = "Account activation";
                                        $txt = "Hello,\nto confirm the new account click on the link below:\nLink: http://www.samtinfo.ch/i3_ifame/index.php?activation=".md5($user);
                                        $headers = "From: no-reply@ifame.ch";

                                        mail($to,$subject,$txt,$headers);

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
                                        User not created.
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

        function _controlData($user, $email, $pass, $cPass) {
                if ($pass != $cPass) {
                        return false;
                }
                return true;
        }

        function _active() {
                include 'db.php';

                $activation = $_GET['activation'];

                $sql = "SELECT * FROM Confirmation WHERE hash = '" . $activation . "';";

                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                        while ($row = $result->fetch_assoc()) {
                                $sql = "INSERT INTO Users(username, password, email, admin) VALUES ('" . $row['username'] . "', '" . $row['password'] . "', '" . $row['email'] . "', false)";

                                if ($conn->query($sql)) {

                                        echo "<script>
                                        $( document ).ready(function() {

                                                $('#actived').modal('show');
                                        });
                                        </script>";

                                        $sql = "DELETE FROM Confirmation WHERE id=" . $row['id'] . ";";

                                        $conn->query($sql);
                                } else {
                                        echo '<br /><br />:(';
                                }
                        }
                }
        }
 ?>