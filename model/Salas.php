<?php
class Salas
{

    private $table = 'salas';
    private $db;

    public function __construct(){
        $_SESSION['erros'] = [];
        $this->db = new PDO('mysql:host=localhost;port=3306;dbname=ditech', 'root', '102030');
    }

    private function valid($dados){

        if(!filter_var($dados['numero'], FILTER_VALIDATE_INT )){
            $_SESSION['erros'][] = 'número da sala deve ser uma valor inteiro';
        }

        if(!filter_var($dados['nome'], FILTER_SANITIZE_STRING)){
            $_SESSION['erros'][] = 'nome não informado ou incorreto';
        }

        if( count($_SESSION['erros']) > 0){
            return false;
        }

        return true;
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

        if($where){
            return $q->fetch();
        }else{
            return $q->fetchAll();
        }


    }

    public function insert(array $dados){

        if($this->valid($dados)){
            $campos = implode(",", array_keys($dados));
            $valores = "'".implode("','", array_values($dados))."'";

            $sql = " INSERT INTO {$this->table} ({$campos}) values ({$valores}) ";

            $this->db->query($sql);
            return ($this->db->lastInsertId());

        }

        return false;
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