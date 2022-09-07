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

function getTask($data){
    $query= $data ->prepare("SELECT * FROM `task` WHERE 'done' =0 ") ;
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
}
return $html;
}
function sendTaskTo($array,$data){
    $query = $data->prepare("INSERT INTO `product`(`name_product`,`price`) VALUES (:name, :price)");
}
?>