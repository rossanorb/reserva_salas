<?php

session_start();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'reservar':
        include('views/reservar.php');
        break;

    default:
        break;
}