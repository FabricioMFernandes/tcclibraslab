<?php

session_start();
function __autoload($class_name)
{
    require_once '../classes/'.$class_name . '.php';
}

$email = $_POST['email'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$senha2 = $_POST['resenha'];
if ($senha != $senha2) {
    header('Location: ../register.php');
}//Verificar se os dados foram enviados
$senha = password_hash("$senha", PASSWORD_DEFAULT);


$user = new User('localhost', 'root', '', 'libraslab');
$user->existeUser($nome);

if ($user->exiteUser > 0) {
    header('Location: ../register.php');
} else {
    $user->createUser($nome, $email, $senha);
    $_SESSION['user'] = $nome;
    header('Location: ../index.php');
}
