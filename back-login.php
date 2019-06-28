
<?php
	include("header.html"); 
?>
<?php 
// session_start inicia a sessão
session_start();
$email = $_POST['tLogin'];
$senha = $_POST['tSenha'];
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
$con = mysqli_connect("127.0.0.1", "root", "", "libraslab") or die
 ("Sem conexão com o servidor");
 
// A variavel $result pega as varias $email e $password, faz uma 
//pesquisa na tabela de usuarios
$sql = "SELECT * FROM usuario WHERE email = '$email'";
$result = mysqli_query($con,$sql);
//password_verify ( string $password , string $hash );
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi 
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do 
resultado ele redirecionará para a página site.php ou retornara  para a página 
do formulário inicial para que se possa tentar novamente realizar o login */ 
$usuario = mysqli_fetch_assoc($result);
$numlinha = mysqli_num_rows ($result);
if($numlinha > 0 && password_verify($senha,$usuario['senha'])) // verifica se o usuario existe e se a senha é correta
{
$_SESSION['email'] = $email;
$_SESSION['senha'] = $senha;
$_SESSION['idUsuario']=$usuario['idUsuario'];
$result = mysqli_fetch_array($result);

header('location:libraslab-tela-menu.php');
}
else{
  unset ($_SESSION['email']);
  unset ($_SESSION['senha']);
  header('location:libraslab-tela-login.php?msg=Login inválido.');
  }
?>
<?php
	include("footer.html");
?>