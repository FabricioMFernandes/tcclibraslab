<?php
	include("header.html");
?>
<div class="flow-text"> 
<?php 
// prox 3 linhas p o email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$con = mysqli_connect("127.0.0.1", "root", "", "libraslab") or die
 ("Sem conexão com o servidor"); 
// A variavel $result pega as varias $email e $password, faz uma 
//pesquisa na tabela de usuarios
$email = $_POST['tEmail'];
$nome = $_POST['tNome'];
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{3})$/";
$senha = $_POST['tSenha'];
$sql = "SELECT * FROM usuario 
WHERE email = '$email'";
$result = mysqli_query($con,$sql);
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi 
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do 
resultado ele redirecionará para a página site.php ou retornara  para a página 
do formulário inicial para que se possa tentar novamente realizar o login */ 
if(mysqli_num_rows ($result) > 0 )
{
header('location:libraslab-tela-login.php?msg=Email já cadastrado!');
} else if(!preg_match($emailValidation,$email)){
header('location:telaCadastro.php?msg=Email inválido!');
	} else if(strlen($senha) < 6 ){
header('location:telaCadastro.php?msg=A senha deve ter no mínimo 6 caracteres!');
	}

else{
$hash = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuario (email, nome, senha) VALUES ('$email', '$nome','$hash')";
$result = mysqli_query($con,$sql);

// info do email
$email = "infolibraslab@gmail.com";
$senha = $_POST['senha'];
$to_id = $_POST['email'];
$message = "Boas vindas ao LibrasLab! Comece a aprender logando em sua conta com os dados abaixo.<br> Dados da sua conta: <br> Email:" . $_POST['email'] . "<br> Senha:" . $_POST['password'] . "<br> Até mais!" ;
$subject = "Boas vindas ao LibrasLab";

// Configuring SMTP server settings
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $email;
$mail->Password = 'lablibras2019';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

// Email Sending Details
 $mail->setFrom('infolibraslab@gmail.com', 'LibrasLab');
$mail->addAddress($to_id);
$mail->Subject = $subject;
$mail->msgHTML($message);

// Success or Failure
if (!$mail->send()) {
$error = "Mailer Error: " . $mail->ErrorInfo;
echo '<p id="para">'.$error.'</p>';
}
else {
echo '<p id="para"> Cheque sua caixa de entrada ou de spam <br> para ver o email recebido!</p>';

//header('location:index.php?msg=Usuário criado, faça seu login!');
}
  }
?>
<div style="text-align: center;"> <a class='btn' href="libraslab-tela-login.php?msg=Cadastro concluído, faça seu login!">Voltar</a> </div>
</div>
<?php
	include("footer.html");
?>



