<html>
<head>
        <title>Recipe</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/style.css"/>

        <script src="js/script.js"></script>
</head>
<body>

        <?php
                if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
                        if(isset($_POST['submit'])) {
                                _addRecipe();
                        }
                }
        ?>

	<h1 style="font-weight:bold;margin-left:40px;">Create your recipe:</h1>
	<br>
	<div align="center">
                <form method="post" action="">
                        <input type="text" class="form-control" id="title" placeholder="Title"
                        style="width:400px;height:100px;text-align:center;font-size:28px;"
                        name="title"><br><br>

                	<span style="font-size:15px;font-weight:bold">Time (minutes):
                        </span><input type="number" min="1" placeholder="1" class="form-control"
                        id="time" name="time" placeholder="Time" style="font-size:15px;width:70px;height:30px;align:center;vertical-align:top;"><br><br>

                	<textarea class="form-control" id="description" placeholder="Description"
                        name="description" style="font-size:15px;width:500px;height:125px;align:center;vertical-align:top;"
                        value="">
                        </textarea><br><br>

                	<textarea class="form-control" id="ingredients" placeholder="Insert the ingredients"
                        name="ingredients" style="font-size:15px;width:500px;height:125px;align:center;vertical-align:top;">
                        </textarea><br><br>

                	<textarea class="form-control" id="procedure" placeholder="Insert the direction"
                        style="font-size:15px;width:500px;height:150px;align:center;vertical-align:top;"
                        name="text"></textarea><br><br>

                	<input type="submit" class="btn btn-primary" name="submit">
                </form>
	</div>
</body>

<?php
        //include '../helpers/xml.php';

        function _addRecipe() {
                
        }
 ?>
