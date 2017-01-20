<?php
        include '../helpers/Recipe.php';

        class xml {
                private $XML_DEFAULT = [
                        "start" => "<?xml version='1.0' encoding='UTF-8'?>",
                        "recipes" => "<recipes>",
                        "endRecipes" => "</recipes>",
                        "recipe" => "<recipe",
                        "endRecipe" => "</recipe>",
                        "description" => "<description>",
                        "endDescription" => "</description>",
                        "time" => "<time>",
                        "endTime" => "</time>",
                        "procedures" => "<procedures>",
                        "endProcedures" => "</procedures>",
                        "procedure" => "<procedure>",
                        "endProcedure" => "</procedure>",
                        "ingredients" => "<ingredients>",
                        "endIngredients" => "</ingredients>",
                        "ingredient" => "<ingredient>",
                        "endIngredient" => "</ingredient>"
                ];

                private $recipe = "";

                private $filepath = "";

                public function __construct($recipe, $filename) {
                        $this->recipe = $recipe;
                        $this->filepath = "../usersData/" . $filename . ".xml";
                }

                public function createRecipesXML() {
                    if (!file_exists($this->filepath)) {
                        $file = fopen($this->filepath, "x+");
                        $txt = $this->XML_DEFAULT["start"] . "\n" .
                            $this->XML_DEFAULT["recipes"] . "\n" .
                            $this->XML_DEFAULT["endRecipes"];
                        fwrite($file, $txt);
                        fclose($file);
                    }
                }

                public function writeRecipe() {
                        $this->createRecipesXML();
                        $lines = file($this->filepath);

                        for ($x = 0; $x <= count($lines) - 2; $x++) {
                                $textBefore = $textBefore . $lines[$x];
                        }

                        $txt = "\t" . $this->XML_DEFAULT["recipe"] . " title='" . $this->recipe->getTitle() . "'>\n" .
                                "\t\t" . $this->XML_DEFAULT["time"] . $this->recipe->getTime() . $this->XML_DEFAULT["endTime"] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["ingredients"] . "\n";

                        foreach ($this->recipe->getIngredients() as $ing) {
                            $txt = $txt . "\t\t\t" . $this->XML_DEFAULT["ingredient"] . $ing . $this->XML_DEFAULT["endIngredient"] . "\n";
                        }

                        $txt = $txt . "\t\t" . $this->XML_DEFAULT["endIngredients"] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["description"] . $this->recipe->getDescription() . $this->XML_DEFAULT['endDescription'] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["procedures"] . "\n";

                        foreach ($this->recipe->getProcedure() as $pro) {
                            $txt = $txt . "\t\t\t" . $this->XML_DEFAULT["procedure"] . $pro . $this->XML_DEFAULT["endProcedure"] . "\n";
                        }
                        $txt = $txt . "\t\t" . $this->XML_DEFAULT["endProcedures"] . "\n" .
                                "\t" . $this->XML_DEFAULT["endRecipe"] . "\n" .
                                $this->XML_DEFAULT["endRecipes"];

                        $textBefore = $textBefore . $txt;

                        $myFile = fopen($this->filepath, "r+");
                        fwrite($myFile, $textBefore);

                }
        }
 ?>
