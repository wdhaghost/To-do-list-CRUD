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


function getTask($data,$done){
    $query= $data ->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE done=$done ") ;
    $query->execute();
    return $query->fetchAll();
}


function taskToHtml(array $array):string {
$html="";
foreach($array as $task){
    $html.="<li id=".$task["id_task"]." class=\"task\"> <label for=\"task-".$task["id_task"]."\"></label>";
    $html.="<input type=\"checkbox\" name=\"task-".$task["id_task"]."\" id=\"".$task["id_task"]."\">";
    $html.="<div class=\"task-description\">";
    $html.="<h3>".$task["description"]."</h3>";
    $html.="<p>Rappel : ".$task["date_reminder"]."</p></div>";
    $html.="<div class=\"manage-section\"><a class=\"icon\" href=\"\"><i class=\"fa-solid fa-pen\"></i></a></div></li>";
}
return $html;


}

?>