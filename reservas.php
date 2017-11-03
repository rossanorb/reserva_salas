<?php

session_start();

include('model/Reservas.php');
include('model/Salas.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'reservar':
        include('views/reservar.php');
        break;

    case 'consultar':
        $date = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('Y-m-d');
        $reserva = new Reservas();
        $hrs_reservados = $reserva->select(" data LIKE '%{$date}%' ");
        $result['salas_reservadas'] = $reserva->filtraHorarios($hrs_reservados);

        $sala = new Salas();
        $salas_reservadas = [];

        foreach ($hrs_reservados as $hrs_reservado){
            $salas_reservadas[$hrs_reservado['id_sala']] = $sala->select(" id = {$hrs_reservado['id_sala']} ");
        }

        $result['info_salas'] = $salas_reservadas;

        echo json_encode($result);
        break;

    default:
        break;
}