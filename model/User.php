<?php

class User{

    private $name = 'usuarios';

    public function __construct(){
        $_SESSION['erros'] = [];
        $this->db = new PDO('mysql:host=localhost;port=3306;dbname=ditech', 'root', '102030');
    }

    private function valid($dados){

        if(!filter_var($dados['username'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['erros'][] = 'username deve ser um email válido';
        }

        if(!filter_var($dados['nome'], FILTER_SANITIZE_STRING)){
            $_SESSION['erros'][] = 'nome não informado ou incorreto';
        }

        if(!$dados['password']){
            $_SESSION['erros'][] = 'password não informado ou incorreto';
        }

        if( count($_SESSION['erros']) > 0){
            return false;
        }

        return true;
    }

    public function insert($tabela, array $dados){

        if($this->valid($dados)){
            $campos = implode(",", array_keys($dados));
            $valores = "'".implode("','", array_values($dados))."'";

            $sql = " INSERT INTO {$tabela} ({$campos}) values ({$valores}) ";

            $this->db->query($sql);
            return ($this->db->lastInsertId());

        }

        return false;
    }

    public function select($tabela, $where = NULL, array $columns = array() ){

        if(count($columns)> 0 ){
            foreach ($columns as $inds => $column ){
                $cols[] = $column;
            }
            $columns = implode(', ', $cols);

        }else{
            (string) $columns = '*';
        }

        $where = ($where == NULL)? NULL: " WHERE {$where} ";
        $sql = " SELECT {$columns} FROM {$tabela} {$where} ";
        $q = $this->db->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        if($where){
            return $q->fetch();
        }else{
            return $q->fetchAll();
        }


    }

    public function update($tabela, array $dados , $where ){
        if(is_string($where)){
            foreach ($dados as $inds => $val){
                $campos[]  = "  $inds = '$val' ";

            }
            $campos = implode(', ', $campos);

            $sql = " UPDATE {$tabela} SET $campos  WHERE {$where} ";

            $update = $this->db->query($sql);

            if($update)
                return true;
            else
                return false;
        }else{
            return false;
        }

    }

    public function delete($tabela, $where){
        $sql = " DELETE FROM  $tabela WHERE $where ";
        $delete = $this->db->query($sql);
        if($delete)
            return true;
        else {
            return false;
        }
    }
}