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
    public $img;
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

     function save($title, $date, $content, $image, $userId, $categoryId) {
        // query de listar usuários
       $query = "insert into ".$this->table_name." (titulo, conteudo, data, img, usuario_id, categoria_id) 
       values('".$title."','".$content."', '".$date."', '".$image."', ".$userId.", ".$categoryId.")";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
          return true;
       }
       return false;
    }

     
}
