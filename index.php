<?php
    // Defining the variable which will allow the config file to load
    define('__CONFIG__', true);
    
    // Including the config file
    require_once 'inc/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'inc/header.php';
    ?>
    <title>Selection menu</title>
</head>
<body>
    <!-- Creating the GUI for adding project -->
    <form class="addproject">
        <label for="projectName"><h3>Enter the name of the project</h3></label>
        <input type="text" id="projectName" placeholder="MyProject" required="required">
        <button type="submit">Enter project</button>
    </form>
</body>
<?php
    require_once 'inc/footer.php';
?>
</html>