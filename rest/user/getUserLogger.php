<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../../config/logged.php');

http_response_code(200);
// resposta de não encontrado
echo json_encode(
    array("userId" => $userId)
);


?>