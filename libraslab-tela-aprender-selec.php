<?php
	include("header.html");
?>
<?php 
	session_start();
	 $_SESSION['idUsuario'];

	$link = mysqli_connect("127.0.0.1", "root", "", "libraslab");
	$link->set_charset('utf8');
	$sql = "select * from sinal where topico='saudacao' order by idSinal";

	$resultado = mysqli_query($link, $sql);
	$linha = mysqli_fetch_assoc($resultado);
	
		echo '<a href="libraslab-tela-aprender-sinal.php" class="botaoBonito"> <h1>'.$linha['topico'].'</a>
 		<div style="text-align: center; display:block; padding-top: 1%; padding-left:10px;"> <h1> </div>';
	

	?>
<?php
	include("footer.html");
?>