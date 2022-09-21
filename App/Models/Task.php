<?php

namespace App\Models;

class Task extends Model
{

    public function getAllTask(int $done): array
    {
        $query = self::$connection->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE done=$done 
        ORDER BY `priority`ASC");
        $query->execute();
        return $query->fetchAll();
    }

    public function check(string $id)
    {
        
        $task=$this->getTaskById($id);
        $done=$task["done"]==1?0:1;

        $query = self::$connection->prepare(
            "UPDATE`task` 
        SET `done`=:done
        WHERE id_task=:id_task;"
        );
        $query->execute([
            "id_task" => $id,
            "done"=> $done
        ]);
    }

    public function getTaskById( string $id): array|bool
    {
        $query = self::$connection->prepare("SELECT id_task,description,date_reminder,priority,color,done,id_user FROM task WHERE id_task=:id_task ");
        $query->execute([
            "id_task" => $id
        ]);
        return $query->fetch();
    }

    public function delete(int $id){

        $query = self::$connection->prepare(
            "DELETE
            FROM`task` 
            WHERE id_task=:id_task;"
        );
        $query->execute([
            "id_task" => $id
        ]);
        header("location:index.php");
    }
    /**
     * get the highest priority in the database for that are not done
     *
     * @return integer
     */
    public function getMaxPriority():int{
        $query= self::$connection ->prepare("SELECT MAX(priority) FROM task WHERE done=0 ") ;
        $query->execute();
        return  $query->fetchColumn();
    }
    public function updatePriority(int $id,int $priority){
        $query = self::$connection->prepare(
            "UPDATE`task` 
        SET priority=:priority
        WHERE id_task=:id_task ;"
        );
        $query->execute([
            "id_task" => $id,
            "priority" => $priority
        ]);  
    }
    public function switchPriority(int $new_priority,int $priority){
        $query = self::$connection->prepare(
            "UPDATE`task` 
            SET priority=:old_priority
            WHERE priority=:new_priority"
        );
        $query->execute([
            "new_priority" => $new_priority,
            "old_priority" => $priority
        ]);
    }

}
