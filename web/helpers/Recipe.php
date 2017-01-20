<?php

    include '../helpers/StringToArray.php';

    class Recipe {
            private $title = "";

            private $time = 0;

            private $description = "";

            private $procedure = array();

            private $ingredients = array();

            public function __construct($title, $time, $description, $ingredients, $procedure) {
                    $this->title = $title;
                    $this->time = $time;
                    $this->description = $description;

                    $ita = new StringToArray();
                    $this->procedure = $ita->convert($procedure);
                    $this->ingredients = $ita->convert($ingredients);
            }

            public function getTitle() {
                    return $this->title;
            }

            public function getTime() {
                    return $this->time;
            }

            public function getDescription() {
                    return $this->description;
            }

            public function getIngredients() {
                    return $this->ingredients;
            }

            public function getProcedure() {
                    return $this->procedure;
            }
    }
?>
