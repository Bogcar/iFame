<!DOCTYPE html>
<html>
<head>
        <title>Home | iFame</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/star-rating.js" type="text/javascript"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                                        <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                        <span class="glyphicon glyphicon-user"></span> Username<span class="caret"></span>
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
                        <div class="col-md-2" id="storico">
                                <div class="container">
                                        <h1>Storico</h1>
                                        <hr />
                                </div>
                        </div>
                        <iframe class="col-md-10" id="frame" src="index/search.html">

                        </iframe>
                </div>
        </div>
</body>
</html>
