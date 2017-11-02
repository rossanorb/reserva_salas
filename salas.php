<?php

include('model/Salas.php');

session_start();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'new':
        include('views/sala_new.php');
        break;

    case 'save':
        $salas = new Salas();
        $status = $salas->insert([
            'nome' => $_REQUEST['nome'],
            'numero' => $_REQUEST['numero']
        ]);
        header("Location:salas.php");
        break;

    default:
        $model = new Salas();
        $salas = $model->select();
        include('views/salas_list.php');
        break;
}