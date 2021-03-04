<?php
    // Defining the variable that allows the configuration file to load
    define('__CONFIG__', true);

    // Including the configuration file
    require_once '../inc/config.php';

    // Checking if the request method is a POST method, if it is, accept it
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Defining that the content that will be returned to ajax will be in JSON format
        header('Content-Type: application/json');

        // Creating the variable in which the data that will be returned will be stored
        $return = [];

        // Storing the data from the ajax form into a variable
        $projectName = $_POST['prname'];

        // Getting the database connection
        $con = DB::getConnection();
        
        // Checking if the project table exists
        $existsTable = Test::PojectTable();

        // Checking if the project with the same name exists

        $exists = Test::ProjectName($projectName);

        if($exists){
            $addProject = $con->prepare("INSERT INTO projects (name, done) VALUES (?, ?)");
            $addProject->execute([
                $projectName,
                true,
            ]);
            $return['success'] = 'The project has been succesfully added to the list!';
        }
        else{
            $return['error'] = 'A project with the exact same name already exists!';
        }
        // Returning data as JSON
        echo json_encode($return, JSON_PRETTY_PRINT);
    }
?>