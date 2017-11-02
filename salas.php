<?php

include('model/Salas.php');

session_start();

$action = isset($_REQUEST['action']) ?? $_REQUEST['action'];


switch ($action){
    case 'opcao':
        break;

    default:
        $model = new Salas();
        $salas = $model->select();
        include('views/salas.php');
        break;
}