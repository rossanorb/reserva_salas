<?php
session_start();

include ('model/User.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action) {
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
            header("Location:index.php?action=register");
        }else{
            $user = new User();
            $user = $user->select('usuarios', " username = '{$_REQUEST['username']}' and password = '{$_REQUEST['password']}' ");
            if($user){
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nome' => $user['nome'],
                    'username' => $user['username']
                ];
                header("Location:salas.php");
                exit();
            }
        }

        break;

    case 'login':
        if($_REQUEST['username'] && $_REQUEST['password']){
            $user = new User();
            $user = $user->select('usuarios', " username = '{$_REQUEST['username']}' and password = '{$_REQUEST['password']}' ");
            if($user){
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nome' => $user['nome'],
                    'username' => $user['username']
                ];
                header("Location:salas.php");
                exit();
            }
        }
        session_destroy();
        header("Location:index.php");
        break;
    default:
        include('views/login.php');
        break;
}