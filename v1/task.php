<?php

    include_once './userTask.php';

    header('Content-type:application/json');

    //echo 'informacion' .file_get_contents('php://input');
    $serverMethod = $_SERVER['REQUEST_METHOD'];

         
    switch($serverMethod){

        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $task = new Task($_POST['id'],$_POST['name'],$_POST['description']);
            $task->saveUserTask();
            echo 'obtenido los datos';
            $resultado['mensaje'] = 'Guardado los datos del usuario '. json_encode($_POST);
            echo json_encode($resultado);
        break;

        case 'GET':
            if(isset($_GET['id'])){
                Task::getOneUserTask($_GET['id']);
            }else{
                Task::getUserTask();     
            }

        break;

        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $task = new Task($_PUT['id'],$_PUT['name'],$_PUT['description']);
            $task->updateTask($_GET['id']);
            $resultado['mensaje'] = 'editando los datos del usuario '.$_GET['id'].'<br>'.
                                    'Editado el usuario '. json_encode($_PUT);

            echo json_encode($resultado);
        break;

        case 'DELETE':
            $_DELETE = json_encode(file_get_contents('php://input'),true);
            Task::deleteTask($_GET['id']);
            $resultado['mensaje'] = 'Eliminado el usuario '.$_GET['id'];
            echo json_encode($resultado);
            
        break;
        default: break;
    }