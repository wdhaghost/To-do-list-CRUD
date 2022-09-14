<?php
require_once "includes/_functions.php";
$title = "Nouvelle tâche";
require_once "includes/_header.php";
?>
<div class="main">
<form action="new_task.php" method="post" class="task-form">
    <div class="form-element">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="nouvelle tâche" class="input">
    </div>
    <div class="form-element">
        <label for="date_reminder">Date de rappel</label>
        <input type="date" name="date_reminder" id=""  class="input">
    </div>
    <div class="form-element">
        <label for="priority">Priorité</label>
        
            
    </div>
    <div class="form-element">
        <label for="color">Couleur</label>
        <select name="color" id="color"  class="input">
            <option value="red">red</option>
            <option value="blue">blue</option>
            <option value="yellow">yellow</option>
            <option value="green">green</option>

        </select>
    </div>
    <input class="submit-btn btn" type="submit" value="Ajoutez">
</form>
</div>
<?php
$task=[];

clearFromTags($_POST);
if((isset($_POST['description'])&&strlen($_POST['description'])>0)){
    $query= $dbCo ->prepare("INSERT INTO `task`( `description`, `date_reminder`, `priority`, `color`, `done`, `id_user`) 
    VALUES (:description,:date_reminder,:priority,:color,0,1) ") ;
    $query->execute([
    "description"=>$_POST['description'],
    "date_reminder"=>empty($_POST['date_reminder'])? NULL:$_POST['date_reminder'],
    "priority"=>getMaxPriority($dbCo)+1,
    "color"=>$_POST['color']
]);
header("location: index.php");
}

?>

<?php
require_once "includes/_footer.php";
?>