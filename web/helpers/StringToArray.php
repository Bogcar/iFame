<?php
    /**
     * Classe che converte una stringa di ingredienti in un array.
     */
    class StringToArray
    {
        public function convert($s)
        {
            $arr = array();

            foreach (preg_split("/\n/", $s) as $line) {
                array_push($arr, $line);
            }

            return $arr;
        }
    }
