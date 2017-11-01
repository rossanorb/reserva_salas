<?php

class User{

    public function __construct(){
        $_SESSION['erros'] = [];
        $this->db = new PDO('mysql:host=localhost;port=3306;dbname=ditech', 'root', '102030');
    }

    public function getErros(){
        return $_SESSION['erros'];
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
}