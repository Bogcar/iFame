<?php
    include 'helpers/helperModifyRecipe.php';

    if (isset($_GET['recipe_id'])) {
        $recipeId = $_GET['recipe_id'];
        $recipe = _getRecipe();
        foreach ($recipe->getIngredients() as $ing) {
            $ingredients = $ingredients . $ing . "\n";
        }
        foreach ($recipe->getProcedure() as $pro) {
            $procedure = $procedure . $pro . "\n";
        }
    }
?>
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

        <link rel="stylesheet" href="css/new.css"/>

        <script src="js/script.js"></script>
</head>
<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['submit'])) {
            _modifyRecipe();
        }
    }
?>
	<h1 style="font-weight:bold;margin-left:40px;">Create your recipe:</h1>
	<br>
	<div align="center" class="container">
        <form method="post" action="">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title"
            value="<?php echo $recipe->getTitle();?>">

            <label for="time">Time:</label>
            <input type="number" class="form-control" id="time" name="time" min="0"
            value="<?php echo $recipe->getTime();?>">

            <label for="description">Description:</label>
            <textarea type="text" class="form-control" id="description"
            name="description"><?php echo $recipe->getDescription();?></textarea>

            <label for="ingredients">Ingredients:</label>
            <textarea class="form-control" id="ingredients"
            name="ingredients"><?php echo $ingredients;?></textarea>

            <label for="procedure">Procedure:</label>
            <textarea class="form-control" id="procedure"
            name="procedure"><?php echo $procedure;?></textarea>

            <?php
                if (isset($_GET['recipe_id'])) {
                    echo '<input type="number" name="recipe_id" value="' .
                        $_GET['recipe_id'] . '"><br>';
                }
            ?>

        	<input type="submit" class="btn btn-primary" name="submit">



        </form>
	</div>
</body>
