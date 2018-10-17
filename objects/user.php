<?php
class User {
    //conexão com o banco de dados
    private $conn;
    //tabela
    private $table_name = "usuario";

    // propriedade
    public $id;
    public $login;
    public $senha;

    // Construtor passando a conexão
    public function __construct($db) {
        $this->conn = $db;
    }

    function listUsers() {
         // query de listar usuários
        $query = "SELECT * FROM usuario";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
     }
}
