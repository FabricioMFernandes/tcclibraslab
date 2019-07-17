<?php
	include("header.html");
?>
<?php 
	session_start();
	$idUsuario = $_SESSION['idUsuario'];

	$link = mysqli_connect("127.0.0.1", "root", "", "libraslab");
	$link->set_charset('utf8');
	$sql = "select * from sinal where topico='saudacao' order by idSinal";

	$resultado = mysqli_query($link, $sql);
	while($linha = mysqli_fetch_assoc($resultado))
	{
		echo '<a href="libraslab-tela-memorizar.php" class="tituloBonito"> <h1>'.$linha['palavra'].'</a>
 		<div style="text-align: left; display:block; padding-top: 1%; padding-left:10px;"> <h1> </div>
		<!-- VIDEO-->

			<a id="video" > <video controls src="imagens/'.$linha['palavra'].'.mp4" border="0"width="300" height="150"> </video> </a>';
	}
 ?>
<br> <br>
  <a id="menu" style=" font-size: 30px; width: 120px; align-content: right; margin-right: 20px;" class="botaoBonito"; href="libraslab-tela-menu.php">Voltar ao menu</a>
  <br>

<a href=""></a>
<?php
	include("footer.html");
?>