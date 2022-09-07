<?php
require_once "includes/_functions.php";
$title = "Nouvelle tâche";
require_once "includes/_header.php"
?>

<form action="new_task.php" method="post" class="task-form">
    <div class="form-element">
        <label for="task-name">Description</label>
        <input type="text" name="task-name" id="task-name">
    </div>
    <div class="form-element">
        <label for="date_reminder">Date de rappel</label>
        <input type="date" name="date_reminder" id="">
    </div>
    <div class="form-element">
        <label for="priority">Priorité</label>
        <select name="priority" id="priority-lvl">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>

        </select>
    </div>
    <div class="form-element">
        <label for="color">Couleur</label>
        <select name="color" id="color">
            <option value="red">red</option>
            <option value="blue">blue</option>
            <option value="yellow">yellow</option>
            <option value="green">green</option>

        </select>
    </div>
    <input class="submit-btn btn" type="submit" value="Ajoutez">
</form>
<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";
?>

</div>
</body>

</html>