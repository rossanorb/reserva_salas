<?php
session_start();
include('partials/controle_acesso.php');

include ('model/User.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;


switch ($action){
    case 'new':
        include('views/user_new.php');
        break;

    case 'save':
        $user = new User();
        $status = $user->insert('usuarios',[
            'nome' => $_REQUEST['nome'],
            'username' => $_REQUEST['username'],
            'password' => $_REQUEST['password']
        ]);
        header("Location:user.php");
        break;

    case 'edit':
        if($_REQUEST['id']) {
            $user = new User();
            $usuario = $user->select('usuarios', " id = {$_REQUEST['id']} ");
            if(!$usuario) header("Location:user.php");
            include('views/user_edit.php');
        }else{
            header("Location:user.php");
        }
        break;

    case 'update':
        if($_REQUEST['id']) {
            $dados = [
                'nome' => $_REQUEST['nome'],
                'username' => $_REQUEST['username'],
            ];
            if($_REQUEST['password']) $dados['password'] =  $_REQUEST['password'];
            $user = new User();
            $user->update('usuarios', $dados, " id = {$_REQUEST['id']} ");
            header("Location:user.php?action=edit&id={$_REQUEST['id']}");
        }else{
            header("Location:user.php");
        }
        break;

    case 'delete':
        if($_REQUEST['id']) {
            $user = new User();
            $user->delete('usuarios', " id = {$_REQUEST['id']} ");
        }
        header("Location:user.php");
        break;

    default:
        $user = new User();
        $usuarios = $user->select('usuarios');
        include('views/user_list.php');
        break;
}