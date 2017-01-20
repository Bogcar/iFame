 <?php
include 'db.php';
session_start();
include 'helpers/helperHome.php';

if (isset($_SESSION['login_user'])) {
    $sql = "SELECT id FROM Users where username = '".$_SESSION['login_user']."'";



    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home | iFame</title>
    <meta charset="utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/style.css" />
    <script src="js/script.js"></script>
</head>

<body>
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
                    <li><button id="add" class="btn btn-success navbar-btn">ADD</button></li>
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
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="glyphicon glyphicon-user"></span>
                            <?php echo $_SESSION['login_user']; ?><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="settings.html"><span class="glyphicon glyphicon-briefcase"></span> Settings</a>
                            </li>
                            <li>
                                <a href="logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4" id="storico">
                <h1>Storico</h1>
                <hr>
                <?php
                    _getStorico();
                ?>
            </div>
            <iframe name="frame" class="col-md-8" id="frame" src="index/search.php">

            </iframe>
        </div>
    </div>
</body>

</html>
