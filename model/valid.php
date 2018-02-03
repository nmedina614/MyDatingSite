<!--

Author: Nolan Medina
File: valid.php
Last Edited: 2/2/18

-->

<?php


    function validName($first, $last){

        return !is_numeric($first) && !is_numeric($last);

    }

    function validAge($age){

        return is_numeric($age) && $age>=18;

    }

    function validPhone($phone){

        return is_numeric($phone) && strlen(strval($phone))==10;

    }

    function validOutdoor($activity, $array){

        return in_array($activity, $array);

    }

    function validIndoor($activity, $array){

        return in_array($activity, $array);

    }