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
        $taskId = $_POST['id'];
        $checked = $_POST['check'];
        $projectName = $_POST['prname'];

        // Getting the database connection
        $con = DB::getConnection();
        $done = $con->prepare("UPDATE tasks SET done = :done WHERE id = :id");
        $done->bindParam(':done', $checked, PDO::PARAM_STR);
        $done->bindParam(':id', $taskId, PDO::PARAM_STR);
        $done->execute();
        $return['success'] = 'The project has been succesfully added to the list!';

        // Checking if all the tasks have been completed
        $checkIfDone = $con->prepare('SELECT done FROM tasks WHERE project = :project');
        $checkIfDone->bindParam(':project', $projectName, PDO::PARAM_STR);
        $checkIfDone->execute();
        $notdone = 0;
        while($data = $checkIfDone->fetch()){
            if($data['done'] == 0){
                $notdone++;
            }
        }
        if($notdone == 0){
            $done = $con->prepare('UPDATE projects SET done = 1 WHERE name = :name');
            $done->bindParam(':name', $projectName, PDO::PARAM_STR);
            $done->execute();
        }
        else{
            $done = $con->prepare('UPDATE projects SET done = 0 WHERE name = :name');
            $done->bindParam(':name', $projectName, PDO::PARAM_STR);
            $done->execute();
        }
        // Returning data as JSON
        echo json_encode($return, JSON_PRETTY_PRINT);
    }
?>