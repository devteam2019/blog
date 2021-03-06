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
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $_SESSION['id'] = $row['id'];
      $_SESSION['login'] = $row['login'];
      $_SESSION['password'] = $row['senha'];
    }

  header('location:/admin/');
//echo "deu certo";
}
 else {
   unset ($_SESSION['id']);
   unset ($_SESSION['login']);
   unset ($_SESSION['password']);
   header('location:/admin/login.php?error=1');
  //echo "errou!!!";
}

?>
