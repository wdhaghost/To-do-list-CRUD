<?php
require_once "includes/_functions.php";
$title = "Taches Effectués";
$done=1;
require_once "includes/_header.php";

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