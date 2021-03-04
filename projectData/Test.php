<?php define("__CONFIG__", true); require_once "../inc/config.php"; Test::TaskTableExists(); ?> <!DOCTYPE html> <html lang="en"> <head> <?php include_once "../inc/header.php"; ?> <title>Test</title> </head> <body class="w-75 mx-auto mt-5"><form class="addtolist"> <label for="listItem" class="mb-5"><h3>Enter the next task</h3></label> <input type="text" id="listItem" placeholder="I need to do...." required="required" class="form-control form-control-lg mb-5"> <button type="submit" class="btn btn-dark py-3 px-5">Enter project</button> <div class="success alert alert-success mt-5" style="display:none;"></div> </form> <table class="w-100 mt-5"> <tr> <th class="w-25 py-3 px-5">Task priority</th> <th class="w-50 py-3 px-5">Task</th> <th class="w-25 py-3 px-5">Task completion</th> </tr> <?php $con = DB::getConnection(); $projectName = "Test"; $getTask = $con->prepare("SELECT id, task, done FROM tasks WHERE project = :project"); $getTask->bindParam(":project", $projectName, PDO::PARAM_STR); $getTask->execute(); $iteration = 1; while($data = $getTask->fetch()) : ?> <tr> <td class="w-25 py-3 px-5"><?php echo $iteration; $iteration++; ?></td> <td class="w-50 py-3 px-5"><?php echo $data["task"]; ?></td> <td class="w-25 py-3 px-5 text-center"><?php $id = $data["id"]; if($data["done"] == 0) : ?> <input class="form-check-input" type="checkbox" id="<?php echo $id; ?>"> <?php else : ?> <input type="checkbox" checked id="<?php echo $id; ?>"> <?php endif ?> </tr> <?php endwhile ?> </table> </body> <?php require_once "../inc/footer.php"; ?> </html> 