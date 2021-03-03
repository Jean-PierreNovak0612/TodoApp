<?php
    // Defining the variable which will allow the config file to load
    define('__CONFIG__', true);
    
    // Including the config file
    require_once 'inc/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection menu</title>
</head>
<body>
    <!-- Creating the GUI for adding project -->
    <form id="addproject">
        <label for="projectName"><h3>Enter the name of the project</h3></label>
        <input type="text" id="projectName" placeholder="MyProject">
        <button type="submit">Enter project</button>
    </form>
</body>
</html>