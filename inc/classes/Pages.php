<?php 

    // Check if the configuration file can be loaded
    if(!defined('__CONFIG__')){
        exit('Could not load the configuration file!');
    }

    // Creating the Pages class
    class Pages{

        // This function will create a new page for each project
        public function NewPage($name){
            $filePath = '../projectData/'.$name.'.php';

            // Checking if the file already exists
            if(!file_exists($filePath)){

                // Creating the new file
                touch($filePath);

                // Opening the file to write in it
                $insert = fopen($filePath, 'w') or die ("Can't open the file");

                // Creating the variable that will contain the data that will be displayed on the page
                $data = '<?php ';
                $data .= 'define("__CONFIG__", true); ';
                $data .= 'require_once "../inc/config.php"; ';
                $data .= 'Test::TaskTableExists(); ';
                $data .= '?> ';
                $data .= '<!DOCTYPE html> ';
                $data .= '<html lang="en"> ';
                $data .= '<head> ';
                $data .= '<?php ';
                $data .= 'include_once "../inc/header.php"; ';
                $data .= '?> ';
                $data .= '<title>'.$name.'</title> ';
                $data .= '</head> ';
                $data .= '<body>';
                $data .= '<form class="addtolist"> ';
                $data .= '<label for="listItem"><h3>Enter the next task</h3></label> ';
                $data .= '<input type="text" id="listItem" placeholder="I need to do...." required="required"> ';
                $data .= '<button type="submit">Enter project</button> ';
                $data .= '<div class="success" style="display:none;"></div> ';
                $data .= '<div class="error" style="display:none"></div> ';
                $data .= '</form> ';
                $data .= '<table> ';
                $data .= '<tr> ';
                $data .= '<th>Task priority</th> ';
                $data .= '<th>Task</th> ';
                $data .= '<th>Task completion</th> ';
                $data .= '</tr> ';
                $data .= '<?php ';
                $data .= '$con = DB::getConnection(); ';
                $data .= '$projectName = "'.$name.'"; ';
                $data .= '$getTask = $con->prepare("SELECT id, task, done FROM tasks WHERE project = :project"); ';
                $data .= '$getTask->bindParam(":project", $projectName, PDO::PARAM_STR); ';
                $data .= '$getTask->execute(); ';
                $data .= '$iteration = 1; ';
                $data .= 'while($data = $getTask->fetch()) : ?> ';
                $data .= '<tr> ';
                $data .= '<td><?php echo $iteration; $iteration++; ?></td> ';
                $data .= '<td><?php echo $data["task"]; ?></td> ';
                $data .= '<td><?php $id = $data["id"]; if($data["done"] == 0) : ?> ';
                $data .= '<input type="checkbox" id="<?php echo $id; ?>"> ';
                $data .= '<?php else : ?> ';
                $data .= '<input type="checkbox" checked id="<?php echo $id; ?>"> ';
                $data .= '<?php endif ?> ';
                $data .= '</tr> ';
                $data .= '<?php endwhile ?> ';
                $data .= '</table> ';
                $data .= '</body> ';
                $data .= '<?php ';
                $data .= 'require_once "../inc/footer.php"; ';
                $data .= '?> ';
                $data .= '</html> ';
                fwrite($insert, $data);
                fclose($insert);
            }
        }
    }

?>