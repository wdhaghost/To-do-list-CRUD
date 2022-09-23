<?php
try {
    $dbCo = new PDO(
        'mysql:host=localhost:8889;dbname=to_do_list;charset=utf8',
        'php',
        'password'
    );
    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Unable to connect to the database." . $e->getMessage());
}


function getAllTask($data, $done)
{
    $query = $data->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE done=$done 
    ORDER BY `priority`ASC");
    $query->execute();
    return $query->fetchAll();
}


function taskToHtml(array $array): string
{
    $html = "";
    foreach ($array as $task) {
        $state = $task["done"] == 1 ? "undone" : "done";
        $html .= "<li id=" . $task["id_task"] . " class=\"task\"><div class=\"state\"><a class=\"check\" href=\"index.php?action=" . $state . "&id_task=" . $task["id_task"] . "\"></a></div>";
        $html .= "<div class=\"task-description\">";
        $html .= "<h3>" . $task["description"] . "</h3>";
        $html .= "<p>Rappel : " . $task["date_reminder"] . "</p></div>";
        $html .= "<div class=\"priority-section\"><div class=\"priority-btn\"><a class=\"icon\"href=\"index.php?action=up&id_task=" . $task["id_task"] . "\"><i class=\"fa-solid fa-chevron-up\"></i></a></div><p>" . $task["priority"] . "</p><div class=\"priority-btn\"><a class=\"icon\" href=\"index.php?action=down&id_task=" . $task["id_task"] . "\"><i class=\"fa-solid fa-chevron-down\"></i></a></div></div><div class=\"manage-section\"><a class=\"icon\" href=\"task.php?id_task=" . $task["id_task"] . "\"><i class=\"fa-solid fa-pen\"></i></a><a class=\"icon delete-btn\" href=\"index.php?action=delete&id_task=" . $task["id_task"] . "\"><i class=\"fa-solid fa-trash\"></i></a></div></li>";
    }
    return $html;
}
function getTaskById($db, string $id): array|bool
{
    $query = $db->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE id_task=:id_task ");
    $query->execute([
        "id_task" => $id
    ]);
    return $query->fetch();
}

function preVarDump(...$value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}
function taskDone($id, $dbCo)
{

    $query = $dbCo->prepare(
        "UPDATE`task` 
        SET `done`=1
        WHERE id_task=:id_task;"
    );
    $query->execute([
        "id_task" => $id
    ]);
    header("location:index.php");
}

function getMaxPriority(PDO $dbCO):int{
    $query= $dbCO ->prepare("SELECT MAX(priority) FROM task WHERE done=0 ") ;
    $query->execute();
    return  $query->fetchColumn();
}
function movePriority($action, $id, $dbCo){
    
    $task = getTaskById($dbCo, $id);
    $priority = $task["priority"];
    if ($action === "up" && $priority > 1) {
        $new_priority = $priority - 1;
        $query = $dbCo->prepare(
            "UPDATE`task` 
            SET priority=:old_priority
            WHERE priority=:new_priority"
        );
        $query->execute([
            "new_priority" => $new_priority,
            "old_priority" => $priority
        ]);
        $query = $dbCo->prepare(
            "UPDATE`task` 
        SET priority=:priority
        WHERE id_task=:id_task ;"
        );
        $query->execute([
            "id_task" => $id,
            "priority" => $new_priority
        ]);

        header("location:index.php");
    } elseif ($action === "down"&&$priority === getMaxPriority($dbCo)) {
        $new_priority = $priority + 1;
        $query = $dbCo->prepare(
            "UPDATE`task` 
            SET priority=:old_priority
            WHERE priority=:new_priority"
        );
        $query->execute([
            "new_priority" => $new_priority,
            "old_priority" => $priority
        ]);
        $query = $dbCo->prepare(
            "UPDATE`task` 
            SET priority=:priority
            WHERE id_task=:id_task ;"
        );
        $query->execute([
            "id_task" => $id,
            "priority" => $new_priority
        ]);
    }
}
$items = [
    [
        "link" => "index.php",
        "nav_title" => "To do List"
    ],
    [
        "link" => "new_task.php",
        "nav_title" => "Nouvelle Tache"
    ],
    [
        "link" => "task_done.php",
        "nav_title" => "Taches effetuées"
    ]

];

function getItmFromArray(array $array): string
{
    $links = "";
    foreach ($array as $itm) {
        $links .= "<li class=\"nav-item\"><a class=\"main-nav-link\" href=" . $itm["link"] . ">" . $itm["nav_title"] . "</a></li>";
    }
    return $links;
};

function deleteTask(int $id,$dbCo){

    $query = $dbCo->prepare(
        "DELETE
        FROM`task` 
        WHERE id_task=:id_task;"
    );
    $query->execute([
        "id_task" => $id
    ]);
    header("location:index.php");
}

function clearFromTags(array $array) :array {
return array_map("strip_tags",$array);
}

function isForToday(PDO $dbCo) :array|bool{
    $query = $dbCo->prepare("SELECT description,date_reminder FROM task 
    WHERE date_reminder= CURDATE() and done=0") ;
    $query->execute();
    return $query->fetchAll();
}
function displayPopUp($array){

}