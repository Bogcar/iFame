<?php
include 'db.php';
include 'helpers/helperIndex.php';
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
                        <form action="index/search.php" method="get" target="frame" class="navbar-form navbar-left">
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signin'])) {
        _signIn();
    } else {
        _signUp();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['activation'])) {
        _active();
    }
}
?>

    <div class="container">
        <div class="row">
            <iframe name="frame" class="col-md-12" id="frame" src="index/search.php" style="border: 0px">
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
