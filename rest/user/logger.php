<?php

include_once('../../config/database.php');
include_once('../../objects/user.php');

// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$password = $_POST['password'];

//echo $login;
//echo $password;

$database = new Database();
$db = $database->getConnection();

// inicia objeto usuário
$user = new User($db);

// query usuário
$stmt = $user->logger($login, $password);
$num = $stmt->rowCount();

// se existir algum resultado mostra
if($num > 0) {
  $_SESSION['login'] = $login;
  $_SESSION['password'] = $password;
  header('location:/blog/admin/');
//echo "deu certo";
}
 else {
   unset ($_SESSION['login']);
   unset ($_SESSION['password']);
   header('location:/blog/admin/login.php?error=1');
  //echo "errou!!!";
}

?>
