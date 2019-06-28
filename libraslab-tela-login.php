<?php
	include("header.html");
?>
<body>
	<header id=cabecalho> 
	</header>
	<div id="divLog">
	<h1 style="text-align: center;">Boas vindas ao LibrasLab!</h1>
	 <div id="divDados">
<form method="post" action="back-login.php">
	 <p>Email:<input type="email" name="tLogin" id="cLogin" required><br></p>
	 <p>Senha:<input type="password" name="tSenha" id="cSenha" required><br></p>
	 </div>
	 <div>
	 <input type="submit" class="botaoBonito"  value="Entrar" /><br>
	 </form>
	 <a href="https://github.com/FabricioMFernandes" id="esqueci">Esqueci minha senha</a>
	<nav id="log">
	<ul>
	<p style="text-align: center;">Não possui uma conta?</span> <br></p>

	 <li><a class="botaoBonito" href="libraslab-tela-cadastro.php">Cadastrar</a></li>
   </ul>
	</div>
	</nav>
	</div>
<?php
if (isset($_REQUEST['msg'])){
	echo $_REQUEST['msg'];
	}
	include("footer.html");
?>