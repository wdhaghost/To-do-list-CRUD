<?php

namespace App\Views;

class Tasklist extends View
{

    protected static string $filename = "App/Templates/TaskList.html";
    private array $tasks = [];


    public function __construct(array $data,array $tasks)
    {
        $this->tasks = $tasks; 
        $data["taskList"]=$this->taskToLi();
        parent::__construct($data);
        
    }

    //Getter et Setter 
    public function getTasks(){
        return $this->tasks;
    }


    private function taskToLi()
    {
        $html = "";
        foreach ($this->getTasks() as $task) {
            $li = new TaskItem($task);
            $html .= $li->getHtml();
            
        }
        return $html;
        // preVarDump($this->data["taskList"]);
    }
}
