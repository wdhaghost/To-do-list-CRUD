<?php
namespace App\Controllers;

use App\Models\Task;
use App\Views\TaskForm;
use App\Views\Tasklist;

class TaskController {
    public function sessionStarter(){
        session_start();
    }
    public function createToken(){
        
        $_SESSION["myToken"]=md5(uniqid(mt_rand(), true));
    }
    public function index(){
        //create connection to PDO
        $tasks=new Task;
        
        //Create view 
        $view=new Tasklist(
            [
                "ttl"=>"To Do L",
                "headerTtl"=>"Taches à effectuer"
            ],
            $tasks->getAllTask(0)
        );

        $view->display();

    }
    public function taskdone(){
        //create connection to PDO
        $tasks=new Task;
        
        //Create view 
        $view=new Tasklist(
            [
                "ttl"=>"To Do L",
                "headerTtl"=>"Taches à effectuer"
            ],
            $tasks->getAllTask(1)
        );

        $view->display();

    }
    public function delete(int $id){
        $taskModel=new Task;
        $taskModel->delete($id);
        header("location:index.php");
    }

    public function check(int $id){
        $taskModel=new Task;
        $taskModel->check($id);
        header("location:index.php");
    }
    public function edit(int $id){
    
        $this->createToken();
        $taskModel=new Task;
        
        $data=array_merge($taskModel->getTaskById($id),[
            "ttl"=>"Modifier",
            "headerTtl"=>"Modifier la tache",
            "myToken"=>$_SESSION["myToken"]]);
        // preVarDump($data);
        $view= new TaskForm($data);
        $view->display();
        
    }
    public function sendForm(){
        $this->sessionStarter();
        preVarDump($_SESSION);
    
        if(isset($_SESSION["myToken"])&&$_POST["token"]===$_SESSION["myToken"]){
        $taskModel=new Task;
        $taskModel->updateTask();
        }
    }

    public function move(string $action,int $id){
        $taskModel=new Task;
        
            $task=$taskModel->getTaskById($id);
            $priority = $task["priority"];
            if (($action === "up" && $priority > 1)||($action === "down"&&$priority < $taskModel->getMaxPriority())) {
                $newPriority=$action==="up"? $priority-1:$priority+1;
                $taskModel->switchPriority($newPriority,$priority);
                $taskModel->updatePriority($id,$newPriority);
            }
            header("location:index.php");
    }
    

}