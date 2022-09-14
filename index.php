<?php
require_once "includes/_functions.php";
$title = "To Do L";
$done=0;
require_once "includes/_header.php";

if(isset($_GET["id_task"])&& $_GET["action"]==="done" ) {
     taskDone(strip_tags($_GET["id_task"]),$dbCo);
}
if(isset($_GET["id_task"]) && isset($_GET["action"])){
    movePriority(strip_tags($_GET["action"]),strip_tags($_GET["id_task"]),$dbCo);
}
if(isset($_GET["id_task"])&& $_GET["action"]==="delete" ) {
    deleteTask(strip_tags($_GET["id_task"]),$dbCo);
}

if(!empty(isForToday($dbCo))){
    echo "<div id=\"pop-up\" class=\"pop-up\"> <p>Tache(s) du jour</p><ul></ul></div>";
}

?>

    <a class="" href="new_task.php">
        <button class="add-task btn">
        NEW
</button>
    </a>
    <ul class="task-list">

        <?php
        $result = getAllTask($dbCo,$done);
        
        echo taskToHtml($result)
        ?>

    </ul>
    <?php
require_once "includes/_footer.php";
?>