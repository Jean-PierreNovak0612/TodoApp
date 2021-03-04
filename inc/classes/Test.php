<?php

    // Checking if the file can be loaded or not
    if(!defined("__CONFIG__")){
        exit("Could not load configuration file");
    }

    // Creating the Test class
    class Test{

        // This function checks if the project table exists, and if it doesn't, it creates it
        static function ProjectTable(){

            // Check if the table exists, and if not, create it
            try{
                $con = DB::getConnection();
                $test = $con->prepare("SELECT 1 FROM projects LIMIT 1");
                $test->execute();
            }
            catch(PDOException $e){

                // Including the database data file
                include 'databasedata.php';
                $con = new PDO('mysql:charset=utf8mb4;host='.$hostName.';port='.$portNumber.';dbname='.$databaseName, $userName, $userPassword);
                
                // Set PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Create the table 
                $sql = 'CREATE TABLE projects (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) UNIQUE NOT NULL,
                done TINYINT(1) NOT NULL
                )';

                // Using the exex() function because no results are returned
                $con->exec($sql);
            }
        }

        // This function checks if the project table exists, and if it doesn't, it creates it
        static function TaskTableExists(){

            // Check if the table exists, and if not, create it
            try{
                $con = DB::getConnection();
                $test = $con->prepare("SELECT 1 FROM tasks LIMIT 1");
                $test->execute();
            }
            catch(PDOException $e){

                // Including the database data file
                include 'databasedata.php';
                $con = new PDO('mysql:charset=utf8mb4;host='.$hostName.';port='.$portNumber.';dbname='.$databaseName, $userName, $userPassword);
                
                // Set PDO error mode to exception
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Create the table 
                $sql = 'CREATE TABLE tasks (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                project VARCHAR(255) UNIQUE NOT NULL,
                task VARCHAR(255) UNIQUE NOT NULL,
                done TINYINT(1) NOT NULL
                )';

                // Using the exex() function because no results are returned
                $con->exec($sql);
            }
        }

        // This function checks if the project name already exists in the project table
        static function ProjectName($name){

            // Getting the database connection
            $con = DB::getConnection();

            // Check if the project name exists in the project table
            $test = $con->prepare("SELECT name FROM projects WHERE name = :name");
            $test->bindParam(':name', $name, PDO::PARAM_STR);
            $test->execute();

            // Returning the rowcount
            return $test->rowCount();
        }
    }
?>