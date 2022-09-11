<?php 
try {
$dbCo = new PDO(
'mysql:host=localhost:8889;dbname=to_do_list;charset=utf8',
'php',
'password'
);
$dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (Exception $e) {
    die("Unable to connect to the database.".$e->getMessage());
}


function getAllTask($data,$done){
    $query= $data ->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE done=$done ") ;
    $query->execute();
    return $query->fetchAll();
}


function taskToHtml(array $array):string {
$html="";
foreach($array as $task){
    $html.="<li id=".$task["id_task"]." class=\"task\"> <div><label for=\"task-".$task["id_task"]."\"></label>";
    $html.="<input class=\"checkbox\" type=\"checkbox\" name=\"task-".$task["id_task"]."\" id=\"".$task["id_task"]."\"></div>";
    $html.="<div class=\"task-description\">";
    $html.="<h3>".$task["description"]."</h3>";
    $html.="<p>Rappel : ".$task["date_reminder"]."</p></div>";
    $html.="<div class=\"manage-section\"><a class=\"icon\" href=\"task.php?id_task=".$task["id_task"]."\">modifier<i class=\"fa-regular fa-pen\"></i></a></div></li>";
}
return $html;

}
function getTaskById(PDO $db,int $id):array|bool {
    $query= $db ->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE id_task=:id_task ") ;
    $query->execute([
        "id_task"=>$id
    ]);
    return $query->fetch();
}

?>