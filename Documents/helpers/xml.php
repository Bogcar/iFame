<?php
        include 'Recipe.php';

        class xml {
                private $XML_DEFAULT = [
                        "start" => "<?xml version='1.0' encoding='UTF-8'?>",
                        "title" => "<recipes>",
                        "endTitle" => "</recipes>",
                        "recipe" => "<recipe>",
                        "endRecipe" => "</recipe>",
                        "rTitle" => "<title>",
                        "endRTitle" => "</title>",
                        "description" => "<description>",
                        "endDescription" => "</description>",
                        "time" => "<time>",
                        "endTime" => "</time>",
                        "text" => "<text>",
                        "endText" => "</text>"
                ];

                private $recipe = "";

                private $filepath = "";

                public function __construct($recipe, $filename) {
                        $this->recipe = $recipe;
                        $this->filepath = "usersData/" . $filename . ".xml";
                }

                private function createRecipesXML() {
                        if (!file_exists($this->filepath)) {
                                $txt = $this->XML_DEFAULT["start"] .
                                        "\n" . $this->XML_DEFAULT["title"] .
                                        "\n" . $this->XML_DEFAULT["endTitle"];

                                $file = fopen($this->filepath, "w");
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

                        $txt = "\t" . $this->XML_DEFAULT["recipe"] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["rTitle"] . $this->recipe->getTitle() . $this->XML_DEFAULT["endRTitle"] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["time"] . $this->recipe->getTime() . $this->XML_DEFAULT["endTime"] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["description"] . $this->recipe->getDescription() . $this->XML_DEFAULT['endDescription'] . "\n" .
                                "\t\t" . $this->XML_DEFAULT["text"] . $this->recipe->getText() . $this->XML_DEFAULT["endText"] . "\n" .
                                "\t" . $this->XML_DEFAULT["endRecipe"] . "\n" .
                                $this->XML_DEFAULT["endTitle"];

                        $textBefore = $textBefore . $txt;

                        $myFile = fopen($this->filepath, "w");
                        fwrite($myFile, $textBefore);

                }
        }
 ?>
