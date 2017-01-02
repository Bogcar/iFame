<?php
        class Recipe {
                private  $title = "";

                private $time = 0;

                private $description = "";

                private $text = "";

                public function __construct($title, $time, $description, $text, $ingredients) {
                        $this->title = $title;
                        $this->time = $time;
                        $this->description = $description;
                        $this->text = $text;
                        $this->
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

                public function getText() {
                        return $this->text;
                }
        }
 ?>
