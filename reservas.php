<?php

session_start();
include('partials/controle_acesso.php');

include('model/Reservas.php');
include('model/Salas.php');
include('Rules.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'reservas':
        $sala = new Salas();
        $sala = $sala->select(" id = {$_REQUEST['id']} ");
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
        $result['user_session_id'] = $_SESSION['user']['id'];

        echo json_encode($result);
        break;
    case 'reservar':
        $reserva = new Reservas();
        $date = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('Y-m-d') .' '. trim($_REQUEST['hora']).':00';

        if(Rules::is_reservada($date)){
            echo json_encode([
                'status' => false,
                'mensagem' => 'Já existe reserva para esse horário'
            ]);
            exit();
        }

        $id = $reserva->insert([
            'id_sala' => $_REQUEST['id_sala'],
            'id_user' => $_SESSION['user']['id'],
            'data' => $date
        ]);

        if($id){
            echo json_encode([
                'status' => true,
                'mensagem' => 'Reserva realizada com sucesso!'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'mensagem' => 'Não foi possível realizar a reserva da sala'
            ]);
        }
        
        break;

    case 'delete':
        if(Rules::can_delete($_REQUEST)){
            $reserva = new Reservas();
            $reserva->delete(" id = " . Rules::getReserva()['id']);
            echo json_encode([
                'status' => true,
                'mensagem' => 'reserva da sala cancelada com sucesso!'
            ]);
            exit();
        }else{
            echo json_encode([
                'status' => false,
                'mensagem' => 'reserva da sala não pôde ser cancelada '
            ]);
            exit();
        }
        break;

    default:
        break;
}