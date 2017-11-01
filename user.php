<?php
session_start();

include ('model/User.php');

$action = $_REQUEST['action'] ?? $_REQUEST['action'];

switch ($action){
    case 'register':
        include('views/register.php');
        session_destroy();
        break;

    case 'do_register':

        $user = new User();
        $status = $user->insert('usuarios',[
           'nome' => $_REQUEST['nome'],
           'username' => $_REQUEST['username'],
           'password' => $_REQUEST['password']
        ]);

        if(!$status){
            $_SESSION['user'] = $_REQUEST['username'];
            header("Location:User.php?action=register");
        }else{
            header("Location:salas.php");
        }

        break;
    default:
        include('views/user_lista.php');
        break;
}