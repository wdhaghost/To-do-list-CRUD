<?php
require_once "includes/_functions.php";
$title = "To Do L";
$done=0;
require_once "includes/_header.php";

if(isset($_GET["id_task"])&& $_GET["action"]==="done" ) {
     taskDone(strip_tags($_GET["id_task"]),$dbCo);
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


</div>
</body>

</html>