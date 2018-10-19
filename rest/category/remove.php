<?php
// cabeçalho de resposta
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../../config/database.php');
include_once('../../objects/category.php');


// recebe nome da categoria
$_POST = json_decode(file_get_contents("php://input"),true);
$categoryId = $_POST['id'];

if(!isset($categoryId)) {
  
  http_response_code(200);
  echo json_encode(
      array(
          "message" => "Não existe ID para excluir.",
          "error" => true)
      );
exit();  
}
   
$database = new Database();
$db = $database->getConnection();

// inicia objeto de categoria
$category = new Category($db);

// query categoria
$isDelete = $category->delete($categoryId);

if($isDelete) {
    // coloca no response 200 de ok
    http_response_code(200);
    // formata para json
    echo json_encode( 
        array("message" => "Categoria excluída com sucesso.",
        "error" => false)
    );
}
else {
  
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "Erro ao excluír categoria de id: ".$categoryId."",
            "error" => true)
        );
    }
       
?>
