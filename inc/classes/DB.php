<?php
 
    // If the variable __CONFIG__ is not defined, do not load this file
    if(!defined('__CONFIG__')){
        die('The configuration file could not be loaded');
    }

    // Creating the class DB
    class DB{
        
        protected static $con;

        // This function will create a connection with the database
        private function __construct(){

            // Testing if database exists, and if it does, connect to it
            try{
                self::$con = new PDO()
            }
        }
    }
?>