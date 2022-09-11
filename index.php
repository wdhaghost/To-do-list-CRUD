<?php
require_once "includes/_functions.php";
$title = "To Do L";
$done=0;
require_once "includes/_header.php"
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