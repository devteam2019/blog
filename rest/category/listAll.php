<?php
// cabeçalho de resposta
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../../config/database.php');
include_once('../../objects/category.php');

$database = new Database();
$db = $database->getConnection();

// inicia objeto de categoria
$category = new Category($db);

// query post
$stmt = $category->listAll();
$num = $stmt->rowCount();

// se existir algum resultado mostra
if($num > 0) {

    $category_arr = array();
    $category_arr["categorys"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $category_item = array(
            "id" => $row['id'],
            "name" => $row['nome']
        );

        array_push($category_arr["categorys"], $category_item);
    }

    // coloca no response 200 de ok
    http_response_code(200);
    // formata para json
    echo json_encode($category_arr);
}
 else {
 
    http_response_code(200);
    // resposta de não encontrado
    echo json_encode(
        array("message" => "Nenhuma categoria encontrada.",
              "error" => true)
    );
}

?>
