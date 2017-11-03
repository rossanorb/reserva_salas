<?php
class Reservas{

    private $table = 'reservas';
    private $db;

    public function __construct(){
        $_SESSION['erros'] = [];
        $this->db = new PDO('mysql:host=localhost;port=3306;dbname=ditech', 'root', '102030');
    }

    public function select($where = NULL, array $columns = array() ){

        if(count($columns)> 0 ){
            foreach ($columns as $inds => $column ){
                $cols[] = $column;
            }
            $columns = implode(', ', $cols);

        }else{
            (string) $columns = '*';
        }

        $where = ($where == NULL)? NULL: " WHERE {$where} ";
        $sql = " SELECT {$columns} FROM {$this->table} {$where} ";
        $q = $this->db->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q->fetchAll();
    }

    public function filtraHorarios($hrs_reservados){
        $horarios_ocupados = [];
        foreach ($hrs_reservados as $hrs_reservado) {
            $h = substr($hrs_reservado['data'], 11, 2);
            $hrs_reservado['data'] = $h;

            $horarios_ocupados[] =  $hrs_reservado;
        }
        return $horarios_ocupados;
    }

    public function update(array $dados , $where ){
        if(is_string($where)){
            foreach ($dados as $inds => $val){
                $campos[]  = "  $inds = '$val' ";
            }
            $campos = implode(', ', $campos);

            $sql = " UPDATE {$this->table} SET $campos  WHERE {$where} ";

            $update = $this->db->query($sql);

            if($update)
                return true;
            else
                return false;
        }else{
            return false;
        }

    }

}