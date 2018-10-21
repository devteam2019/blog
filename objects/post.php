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
        $query = "SELECT p.id, p.titulo, p.conteudo, p.data, p.img, p.subtitulo, p.usuario_id, p.categoria_id, p.publicar, 
                         u.login userName, ct.nome categoryName   
                        FROM ".$this->table_name." p 
                            inner join usuario u on u.id = p.usuario_id 
                            inner join categoria ct on ct.id = p.categoria_id order by p.data desc";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
     }

     function listPostsPublics() {
        // query de listar usuários
       $query = "SELECT p.id, p.titulo, p.conteudo, p.data, p.img, p.subtitulo, p.usuario_id, p.categoria_id, p.publicar, 
                        u.login userName, ct.nome categoryName   
                       FROM ".$this->table_name." p 
                           inner join usuario u on u.id = p.usuario_id 
                           inner join categoria ct on ct.id = p.categoria_id 
                where
                  p.publicar = 1
                  order by p.data desc";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       $stmt->execute();
       return $stmt;
    }

    function listPostsByCategory($nameCategory) {
        // query de listar posts
       $query = "SELECT p.id, p.titulo, p.conteudo, p.data, p.img, p.subtitulo, p.usuario_id, p.categoria_id, p.publicar, 
                        u.login userName, ct.nome categoryName   
                       FROM ".$this->table_name." p 
                           inner join usuario u on u.id = p.usuario_id 
                           inner join categoria ct on ct.id = p.categoria_id 
                where
                  p.publicar = 1 and
                  ct.nome = '".$nameCategory."'
                  order by p.data desc";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       $stmt->execute();
       return $stmt;
    }

     function save($title, $date, $content, $image, $subTitle,$userId, $categoryId) {
        // query de listar usuários
       $query = "insert into ".$this->table_name." (titulo, conteudo, data, img, subtitulo, usuario_id, categoria_id) 
       values('".$title."','".$content."', '".$date."', '".$image."', '".$subTitle."',".$userId.", ".$categoryId.")";
       // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
          return true;
       }
       return false;
    }

    function update($id, $content) {
        // query altera conteudo artigo
       $query = "update ".$this->table_name." set conteudo = '".$content."' where id = ".$id.""; 
        // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
          return true;
       }
       return false;
    }

    function delete($id) {
        // query altera conteudo artigo
       $query = "delete from ".$this->table_name." where id = ".$id.""; 
        // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
          return true;
       }
       return false;
    }

    function publicArticle($id, $public) {
        // query altera conteudo artigo
       $query = "update ".$this->table_name." set publicar = '".$public."' where id = ".$id.""; 
        // prepare query statement
       $stmt = $this->conn->prepare($query);
       // execute query
       if($stmt->execute()) {
          return true;
       }
       return false;
    }

     
}
