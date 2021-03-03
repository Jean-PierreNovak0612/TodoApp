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

            // Testing if database exists
            try{
                include_once 'databasedata.php';
                self::$con = new PDO('mysql:charset=utf8mb4;host='.$hostName.';port='.$portNumber.';dbname='.$databaseName, $userName, $userPassword);
                self::$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                self::$con->setAttribute( PDO::ATTR_PERSISTENT, false);
            }
            catch (PDOException $e){
                echo('Could not connect to the database');
                exit;
            }
        }

        // Creating database connection
        public static function getConnection(){

            // if instace has not been started, start it
            if(!self::$con){
                new DB();
            }

            // Return the writeable database connection
            return self::$con;
        }

    }
?>