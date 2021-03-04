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
<body>
    <!-- Creating the GUI for adding project -->
    <form class="addproject">
        <label for="projectName"><h3>Enter the name of the project</h3></label>
        <input type="text" id="projectName" placeholder="MyProject" required="required">
        <button type="submit">Enter project</button>
        <div class="success" style="display:none;"></div>
        <div class="error" style="display:none"></div>
    </form>

    <!-- This table will display all currentaly existing projects in the database -->
    <table>
        <tr>
            <th>Project priority</th>
            <th>Project name</th>
            <th>Project completion</th>
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
            <td><?php echo $iteration; $iteration++; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php if($data['done'] == 0) : ?>
            Project is not complete yet! <button class="continue">Complete Project</button>
            <?php else : ?>
            Project has been completed!
            <?php endif ?></td>
        </tr>
        <?php endwhile ?>
    </table>
</body>
<?php
    require_once 'inc/footer.php';
?>
<script src="assets/js/addProject.js"></script>
</html>