<?php
// cabeçalho de resposta
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../../config/database.php');
include_once('../../objects/post.php');


// recebe nome da categoria
$_POST = json_decode(file_get_contents("php://input"),true);

$id = $_POST['id'];
$content = $_POST['content'];

if(!isset($content)) {
  http_response_code(200);
  echo json_encode(
      array(
          "message" => "O campo de conteúdo não pode ser vazio!",
          "error" => true)
      );
  exit();  
}
   
$database = new Database();
$db = $database->getConnection();

// inicia objeto de post
$post = new Post($db);

// query categoria
$isUpdate = $post->update($id, $content);

if($isUpdate) {
    // coloca no response 200 de ok
    http_response_code(200);
    // formata para json
    echo json_encode( 
        array("message" => "Artigo alterado com sucesso.",
        "error" => false)
    );
}

else {
    // coloca 500 erro ao criar categoria
    http_response_code(200);
    
    echo json_encode(
        array(
            "message" => "Ocorreu um erro ao alterar o artigo",
            "error" => true)
        );
    }
       
        
?>
