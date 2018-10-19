<?php
class Category {
    //conexão com o banco de dados
    private $conn;
    //tabela
    private $table_name = "categoria";

    // propriedade
    public $id;
    public $nome;
    
    // Construtor passando a conexão
    public function __construct($db) {
        $this->conn = $db;
    }

    function save($name) {
         // query de inserção categoria
        $query = "insert into ".$this->table_name." (nome) values('".$name."')";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()) {
            return true;
        }
        return false;
     }

     function delete($id) {
        // query de exclui categoria
       $query = "delete from ".$this->table_name." where id = ".$id."";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
           return true;
       }
       return false;
    }

     function getByName($name) {
        // query de lista categoria categoria
       $query = "select * from ".$this->table_name." where nome = '".$name."'";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       $stmt->execute();
       $num = $stmt->rowCount();
       
       return $num > 0;
    }

     function listAll() {
        // query de lista categoria categoria
       $query = "select * from ".$this->table_name." ";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       $stmt->execute();
       return $stmt;
    }

}
