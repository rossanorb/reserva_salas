<?php

session_start();

include('model/Reservas.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'reservar':
        include('views/reservar.php');
        break;

    case 'consultar':
        $date = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('Y-m-d');
        $reserva = new Reservas();
        $hrs_reservados = $reserva->select(" data LIKE '%{$date}%' ");
        $result = $reserva->filtraHorarios($hrs_reservados);
        echo json_encode($result);
        break;

    default:
        break;
}