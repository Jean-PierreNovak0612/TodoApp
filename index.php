<?php
    // Defining the variable which will allow the config file to load
    define('__CONFIG__', true);
    
    // Including the config file
    require_once 'inc/config.php';

    // Checking if the project table exists
    Test::ProjectTable();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'inc/header.php';
    ?>
    <title>Selection menu</title>
</head>
<body class="w-75 mx-auto mt-5">
    <!-- Creating the GUI for adding project -->
    <form class="addproject">
        <label for="projectName" class="mb-5"><h3>Enter the name of the project</h3></label>
        <input type="text" id="projectName" placeholder="MyProject" required="required" class="form-control form-control-lg mb-5">
        <button type="submit" class="btn btn-dark py-3 px-5">Enter project</button>
        <div class="success alert alert-success mt-5" style="display:none;"></div>
        <div class="error alert alert-danger mt-5" style="display:none"></div>
    </form>

    <!-- This table will display all currentaly existing projects in the database -->
    <table class="w-100 mt-5">
        <tr>
            <th class="w-25 py-3 px-5">Project priority</th>
            <th class="w-25 py-3 px-5">Project name</th>
            <th class="w-50 py-3 px-5">Project completion</th>
        </tr>
        <?php
            // Getting all project names and their completion levels from database
            $con = DB::getConnection();
            $getProjects = $con->prepare("SELECT name, done FROM projects");
            $getProjects->execute();
            $iteration = 1;
            // Display all the projects and their comptetion levels
            while($data = $getProjects->fetch()) :
        ?>
        <tr>
            <td class="w-25 py-3 px-5"><?php echo $iteration; $iteration++; ?></td>
            <td class="w-25 py-3 px-5"><?php $projectName = $data['name']; echo $projectName; ?></td>
            <td class="w-50 py-3 px-5"><?php if($data['done'] == 0) : ?>
            Project is not complete yet! <button class="continue btn btn-danger ms-3" onclick="getName('<?php echo $projectName ?>')">Complete Project</button>
            <?php else : ?>
            Project has been completed! <button class="continue btn btn-success ms-3" onclick="getName('<?php echo $projectName ?>')">See tasks</button>
            <?php endif ?></td>
        </tr>
        <?php endwhile ?>
    </table>
</body>
<script src="assets/js/addProject.js"></script>
<script src="assets/js/linkPage.js"></script>
</html>