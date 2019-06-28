<?php
	include("header.html");
?>
<?php 
	session_start();
	$idUsuario = $_SESSION['idUsuario'];

	$link = mysqli_connect("127.0.0.1", "root", "", "libraslab");
	$link->set_charset('utf8');
	$sql = "select * from sinal s where not exists (select * from usuario_sinal us where s.idSinal = us.idSinal and us.idUsuario = $idUsuario) order by idSinal";

	$resultado = mysqli_query($link, $sql);
		$linha = mysqli_fetch_array($resultado);
		$nomeVideo = "imagens/" . $linha['palavra'] . '.mp4';
 ?>
	 <div class="tituloBonito"> <h1><?=$linha['palavra']?> </div>
	 	<div style="text-align: left; display: block; padding-top: 1%; padding-left:10px;"> <h1> </div>
<!-- VIDEO-->

 <a id="video" > <video controls src="<?=$nomeVideo ?>" border="0"width="600" height="300"> </video> </a>
<br> <br>
  <a id="menu" style=" font-size: 30px; width: 120px; align-content: right; margin-right: 20px;" class="botaoBonito"; href="libraslab-tela-menu.php">Voltar ao menu</a>
  <a id="continue" style=" font-size: 30px; width: 120px; align-content: right;" class="botaoBonito"; href="usuario_sinal.php?idSinal=<?=$linha['idSinal']?>&url=libraslab-tela-memorizar.php">Continuar</a>


<?php
	include("footer.html");
?>