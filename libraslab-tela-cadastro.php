<?php
	include("header.html");
?>
<form method="post" action="back-cadastro.php" id="formlogin" name="formlogin" >
	<h1>Crie sua conta!</h1>
	<p>Nome:<input type="text" name="tNome" id="cNome" required><br></p>
	<p>Email:<input type="email" name="tEmail" id="cEmail" required><br></p>
	<p>Senha:<input type="password" name="tSenha" id="cSenha" required><br></p>
	 <input type="submit" class="botaoBonito"  value="Concluir cadastro" />
	 </form>
</nav>
<?php
if (isset($_REQUEST['msg'])){
	echo $_REQUEST['msg'];
	}
	include("footer.html");
?>