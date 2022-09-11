<?php
require_once "includes/_functions.php";
$task=[];
$task=getTaskById($dbCo,strip_tags($_GET["id_task"]));
if($task===false){
header("location: index.php");
exit;
}
// echo "<pre>";
// var_dump($task);
// var_dump($task["description"]);
// echo "</pre>";
$title=$task["description"];
require_once "includes/_header.php";

?>
<div class="main">
<form action="task.php" method="post" class="task-form">
    <div class="form-element">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="nouvelle tâche" value="<?php echo $task["description"]?>" class="input">
    </div>
    <div class="form-element">
        <label for="date_reminder">Date de rappel</label>
        <input type="date" name="date_reminder" id="" required class="input" value="<?php echo $task["date_reminder"]?>">
    </div>
    <div class="form-element">
        <label for="priority">Priorité</label>
        <select name="priority" id="priority-lvl" required class="input" value="<?php echo $task["priority"]?>">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="form-element">
        <label for="color">Couleur</label>
        <select name="color" id="color" required class="input" value="<?php echo $task["color"]?>">
            <option value="red">red</option>
            <option value="blue">blue</option>
            <option value="yellow">yellow</option>
            <option value="green">green</option>
        </select>
    </div>
    <input class="submit-btn btn" type="submit" value="Modifier">
</form>
</div>

<?php



if((isset($_POST['description'])&&strlen($_POST['description'])>0)){
    $query= $dbCo ->prepare("UPDATE`task`( `description`, `date_reminder`, `priority`, `color`, `done`, `id_user`) 
    VALUES (:description,:date_reminder,:priority,:color,0,1) ") ;
    $query->execute([
    "description"=>$_POST['description'],
    "date_reminder"=>$_POST['date_reminder'],
    "priority"=>$_POST['priority'],
    "color"=>$_POST['color']
]);
}

?>

</div>
</body>

</html>