<?php
// cabeçalho de resposta
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../../config/database.php');
include_once('../../objects/user.php');

$database = new Database();
$db = $database->getConnection();

// inicia objeto usuário
$user = new User($db);

// query usuário
$stmt = $user->listUsers();
$num = $stmt->rowCount();

// se existir algum resultado mostra
if($num > 0) {

    $user_arr = array();
    $user_arr["users"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        //extract($row);

        $user_item = array(
            "id" => $row['id'],
            "login" => $row['login'],
            "senha" => $row['senha']
        );

        array_push($user_arr["users"], $user_item);
    }

    // coloca no response 200 de ok
    http_response_code(200);
    // formata para json
    echo json_encode($user_arr);
}
 else {

    // coloca 404 para listagem não encontrada
    http_response_code(404);

    // resposta de não encontrado
    echo json_encode(
        array("message" => "Nenhum usuário encontrado.")
    );
}

?>
