<?php 
	include_once("body/head.php");
	include_once("MVC/Model/modelBancoDeDados.php");
	include_once("MVC/Model/modelLogin.php");
	
	//CONDIÇÃO PARA VERIFICAR SE O USUÁRIO JÁ ESTAVA 
	//LOGADO NO SISTEMA
	//SE TIVER LOGADO, NÃO VAI PRECISAR FAZER LOGIN NOVAMENTE
	if(empty($_SESSION['login'])){
		
	}else{
		$usuarioLogado = $_SESSION['login'];
		
		include_once("MVC/Model/modelVerificaUsuarioLogado.php");

		if($totalUsuarioLogado[0]['logado_usuario'] == 1){
			echo "<script>document.location='MVC/View/viewPainelAdministrativo.php'</script>";
		}
	}
	
?>

<section class="login-sistema">

	<!--<img src="images/logoiSeven3.png">-->

	<div class="login-sistema-box">
		<h2>Olá! Faça seu Login</h2>
		<br><br>
		<form method="POST">
			<label>Usuário</label>
			<div class="input">
				<i style="margin-right: 15px;color: #2B2C30" class="fas fa-user"></i>
				<input type="text" name="login" required><br>
			</div>
			<label>Senha</label>
			<div class="input">
				<i style="margin-right: 15px; color: #2B2C30" class="fas fa-lock"></i>
				<input type="password" name="senha" required>
			</div>
			<br><br>
			<div class="botao-login">
				<button>LOGAR</button>
			</div>
			<br>
			<div class="dados-incorretos">
			<?php 
				include_once("MVC/Controller/controllerLogin.php");
			?>
			</div>
		</form>

		<div class="contato-tela-login">
			<p>Cliente novo?
				<a style="color: #1600EF; text-decoration: underline;" href="https://api.whatsapp.com/send?phone=5532999119095&text=Ol%C3%A1.%20Estou%20entrando%20em%20contato%20para%20falar%20sobre%20a%20plataforma%20de%20projetos%20de%20energia%20solar." target="_blank">Comece aqui</a>
			</p>
		</div>
	</div>

	

</section><!-- FIM DO FILTROS-WRAPPER -->

<?php include_once("body/footer.php");?>