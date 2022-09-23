<?php


require_once "includes/_functions.php";
// $title = "To Do L";
// $done=0;
// require_once "includes/_header.php";

// if(isset($_GET["id_task"]) && isset($_GET["action"])){
//     movePriority(strip_tags($_GET["action"]),strip_tags($_GET["id_task"]),$dbCo);
// }


// if(!empty(isForToday($dbCo))){
//     echo "<div id=\"pop-up\" class=\"pop-up\"> <p>Tache(s) du jour</p><ul></ul></div>";
// }

spl_autoload_register();

use App\Controllers\TaskController;
use App\Models\Task;

use App\Views\Tasklist;

$controller = new TaskController;

if(isset($_POST["action"])){
    if (isset($_POST["id_task"]) && $_POST["action"] == "sendForm") {
    
          $controller->sendForm();
        exit;
    }
}elseif (isset($_GET["action"])){   
    if (isset($_GET["id_task"]) && $_GET["action"] === "check") {
        $controller->check(strip_tags($_GET["id_task"]));
        exit;
    }elseif (isset($_GET["id_task"]) && $_GET["action"] === "delete") {
        $controller->delete(strip_tags($_GET["id_task"]));
        exit;
    }elseif ($_GET["action"] === "taskdone") {
        $controller->taskdone();
        exit;
    }elseif (isset($_GET["id_task"]) && ($_GET["action"] === "up"||$_GET["action"] === "down")) {
        $controller->move($_GET["action"],strip_tags($_GET["id_task"]));
        exit;
    }elseif (isset($_GET["id_task"]) && $_GET["action"] === "update") {
        $controller->edit(strip_tags($_GET["id_task"]));
        preVarDump($_POST,$_SESSION);

        exit;
    }
}
$controller->index();


?>
