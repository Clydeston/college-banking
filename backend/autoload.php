<?php

    // registering autoload function
    spl_autoload_register("autoload_func");

    //autload function designed to preload all necessary classes
    function autoload_func($classname) {
        $path =  "classes/";
        $extension = ".class.php";
        $full_path = $path . $classname . $extension;

        /*if(!file_exists(($full_path))) {
            return false;
        }*/

        include_once $full_path;
    }
?>