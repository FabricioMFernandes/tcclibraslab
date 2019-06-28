<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "", "libraslab") or die
 ("Sem conexão com o servidor");

$idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);
$idSinal = mysqli_real_escape_string($con, $_REQUEST['idSinal']);

$sql = "INSERT INTO usuario_sinal (idUsuario, idSinal) VALUES ( '$idUsuario', '$idSinal' )";
$result = mysqli_query($con,$sql);
header('location:' .$_REQUEST['url']);
?>