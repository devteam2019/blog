<?php
class Post {
    //conexão com o banco de dados
    private $conn;
    //tabela
    private $table_name = "post";

    // propriedade
    public $id;
    public $titulo;
    public $conteudo;
    public $data;
    public $usuario_id;
    public $categoria_id;

    // Construtor passando a conexão
    public function __construct($db) {
        $this->conn = $db;
    }

    function listAllPosts() {
         // query de listar usuários
        $query = "SELECT * FROM ".$this->table_name." ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
     }
}
