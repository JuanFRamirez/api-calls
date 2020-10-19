<?php

class Task{
    private $id;
    private $name;
    private $description;

public function __construct($id,$name,$description){
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
}

    public function saveUserTask(){
        $content = file_get_contents('./task.json');
        $tasks = json_decode($content,true);
        $tasks[] = array(
            "id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description
        );
        $file = fopen('./task.json','w');
        fwrite($file,json_encode($tasks));
        fclose($file);
    }

    public static function getUserTask(){
        $content = file_get_contents('task.json');
        echo $content;
    }

    public static function getOneUserTask($index){
        $content = file_get_contents('task.json');
        $user = json_decode($content,true);
        echo json_encode($user[$index]);
    }

    public function updateTask($index){
        $content = file_get_contents('task.json');
        $users = json_decode($content,true);
        //$user = $users[$index];
        $user = array(
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description
        );
        $users[$index] = $user;
        $file = fopen('./task.json','w');
        fwrite($file,json_encode($users));
        fclose($file);
        echo json_encode($user);
    }

    public static function deleteTask($index){
        $content = file_get_contents('task.json');
        $users = json_decode($content,true);
        array_splice($users,$index,1);
        $file = fopen('./task.json','w');
        fwrite($file,json_encode($users));
        fclose($file);
    }
}