<?php
session_start();
include('partials/controle_acesso.php');

include('model/Salas.php');

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

    case 'edit':
        if($_REQUEST['id']) {
            $sala = new Salas();
            $sala = $sala->select(" id = {$_REQUEST['id']} ");
            if(!$sala) header("Location:salas.php");
            include('views/sala_edit.php');
        }else{
            header("Location:salas.php");
        }
        break;

    case 'update':
        if($_REQUEST['id']) {
            $dados = [
                'nome' => $_REQUEST['nome'],
                'numero' => $_REQUEST['numero'],
            ];
            $sala = new Salas();
            $sala->update($dados, " id = {$_REQUEST['id']} ");
            header("Location:salas.php?action=edit&id={$_REQUEST['id']}");
        }else{
            header("Location:salas.php");
        }
        break;

    case 'delete':
        if($_REQUEST['id']) {
            $sala = new Salas();
            $sala->delete(" id = {$_REQUEST['id']} ");
        }
        header("Location:salas.php");
        break;

    default:
        $model = new Salas();
        $salas = $model->select();
        include('views/salas_list.php');
        break;
}