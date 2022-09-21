<?php
namespace App\Controllers;

use App\Models\Task;
use App\Views\Tasklist;

class TaskController {

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