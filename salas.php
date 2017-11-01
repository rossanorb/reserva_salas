<?php
session_start();

$action = isset($_REQUEST['action']) ?? $_REQUEST['action'];


switch ($action){
    case 'opcao':
        break;

    default:
        include('views/salas.php');
        break;
}