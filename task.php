<?php
require_once "includes/_functions.php";
$task = [];
if (isset($_GET["id_task"]) && !empty($_GET["id_task"])) {
    $task = getTaskById($dbCo, strip_tags($_GET["id_task"]));
    echo "get";
    if ($task === false) {
        header("location: index.php");
        exit;
    }
} elseif(isset($_POST["id_task"]) && !empty($_POST["id_task"])){
    $task = $_POST;
    echo "post";
}
$title = $task["description"];
require_once "includes/_header.php";

?>
<div class="main">
    <form action="task.php" method="post" class="task-form">
        <div class="form-element">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="nouvelle tâche" value="<?php echo $task["description"] ?>" class="input">
        </div>
        <div class="form-element">
            <label for="date_reminder">Date de rappel</label>
            <input type="date" name="date_reminder" id="" required class="input" value="<?php echo $task["date_reminder"] ?>">
        </div>
        <div class="form-element">
            <label for="priority">Priorité</label>
            <select name="priority" id="priority-lvl" required class="input" value="<?php echo $task["priority"] ?>">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="form-element">
            <label for="color">Couleur</label>
            <select name="color" id="color" required class="input" value="<?php echo $task["color"] ?>">
                <option value="red">red</option>
                <option value="blue">blue</option>
                <option value="yellow">yellow</option>
                <option value="green">green</option>
            </select>
        </div>
        <input name="id_task" id="id_task" type="hidden" value="<?php echo $task["id_task"]?>">
        <input class="submit-btn btn" type="submit" value="Modifier">
    </form>
</div>

<?php

preVarDump($_POST);

if (isset($_POST['description']) && strlen($_POST['description']) > 0 && isset($_POST['date_reminder'])){
    $query = $dbCo->prepare(
    "UPDATE`task` 
    SET `description`=:description,`date_reminder`=:date_reminder,`priority`=:priority,`color`=:color 
    WHERE id_task=:id_task ;");
    $query->execute([
        "id_task" => strip_tags($_POST["id_task"]),
        "description" => strip_tags($_POST['description']),
        "date_reminder" => strip_tags($_POST['date_reminder']),
        "priority" => strip_tags($_POST['priority']),
        "color" => strip_tags($_POST['color'])
    ]);
    header("location: index.php");
}

?>

</div>
</body>

</html>