<?php

class Rules{

    public static function is_reservada($date){
        $reserva = new Reservas();
        $reserva = $reserva->select(" data Like '%{$date}%'  ");

        if(count($reserva)>0){
            return true;
        }
        
        return false;

    }
}