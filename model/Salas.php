<?php
class Salas
{

    private $table = 'salas';
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

        if($where){
            return $q->fetch();
        }else{
            return $q->fetchAll();
        }


    }

}