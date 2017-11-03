<?php

class Rules{

    private static $reserva;

    public static function is_reservada($date){
        $reserva = new Reservas();
        $reserva = $reserva->select(" data Like '%{$date}%'  ");

        if(count($reserva)>0){
            return true;
        }
        
        return false;

    }

    public static function getReserva(){
        return self::$reserva;
    }

    public static function setReserva($reserva){
        self::$reserva = $reserva;
    }

    public static function can_delete($request){
        $reserva = new Reservas();
        $request['data'] =  DateTime::createFromFormat('d/m/Y H:i',$request['data'])->format('Y-m-d H:i');
        $reserva = $reserva->select(" id_user = {$_SESSION['user']['id']}  AND id_sala = {$request['id_sala']} AND  data Like '%{$request['data']}%' ");

        if(count($reserva)>0){
            self::setReserva($reserva[0]);
            return true;
        }
        return false;
    }
}