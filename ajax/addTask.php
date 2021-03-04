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

        // Storing the data from the ajax form into a variables
        $taskName = $_POST['tskname'];
        $projectName = $_POST['prname'];

        // Getting the database connection
        $con = DB::getConnection();
        $addProject = $con->prepare("INSERT INTO tasks (project, task, done) VALUES (?, ?, ?)");
        $addProject->execute([
            $projectName,
            $taskName,
            false,
        ]);
        $return['success'] = 'The project has been succesfully added to the list!';
        // Returning data as JSON
        echo json_encode($return, JSON_PRETTY_PRINT);
    }
?>