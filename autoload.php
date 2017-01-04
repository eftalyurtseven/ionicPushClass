<?php

    function __autoload ( $className ) {

        $file = realpath('.') . "/src/" . $className . ".class.php";

        if ( is_file ($file) ) {
            require $file;
        } else {
            die ( $file . " is not found" );
        }


    }

?>