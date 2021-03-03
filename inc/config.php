<?php
    // if the variable __CONFIG__ has been defined, the configuration file will load, if not, it won't
    if(defined('__CONFIG__')){

        // Including the file that will allow us to connect to the database
        include_once 'classes/DB.php';

        // Creating database connection
        $con = DB::getConnection();
    }
    else{
        die('Configuration file could not be loaded');
    }
?>