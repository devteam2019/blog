<?php
// cabeçalho de resposta
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../../config/database.php');
include_once('../../objects/post.php');

// recebe parametros
$_POST = json_decode(file_get_contents("php://input"),true);

$nameCategory = $_POST['nameCategory'];

$database = new Database();
$db = $database->getConnection();

// inicia objeto de post
$post = new Post($db);

// query post
$stmt = $post->listPostsByCategory($nameCategory);
$num = $stmt->rowCount();

// se existir algum resultado mostra
if($num > 0) {

    $post_arr = array();
    $post_arr["posts"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $post_item = array(
            "id" => $row['id'],
            "title" => $row['titulo'],
            "content" => html_entity_decode($row['conteudo']),
            "date" => $row['data'],
            "image" => $row['img'],
            "subTitle" => $row['subtitulo'],
            "userId" => $row['usuario_id'],
            "categoryId" => $row['categoria_id'],
            "public" => $row['publicar'],
            "userName" => $row['userName'],
            "categoryName" => $row['categoryName']
        );

        array_push($post_arr["posts"], $post_item);
        // array_push($post_arr["error"], false);
    }

    // coloca no response 200 de ok
    http_response_code(200);
    // formata para json
    echo json_encode($post_arr);
}
 else {
    // coloca 404 para listagem não encontrada
    http_response_code(200);

    // resposta de não encontrado
    echo json_encode(
        array("message" => "Estamos sem artigos com essa categoria no momento, pesquise outra categoria.",
              "error" => true)
    );
}

?>
