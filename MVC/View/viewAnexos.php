<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Anexos</li>
		</ul>		

	</section>

	<section class="anexos-wrapper separador ">
		
		<div class="anexos-box">
			<h2>PROCURAÇÃO PESSOA JURÍDICA</h2>
			<br>
			<a href="../../images/documentos/pJuridica.pdf" download>BAIXAR</a>
			<br>
		</div>
		<br><br><br>
		<div class="anexos-box">
			<h2>PROCURAÇÃO PESSOA FÍSICA</h2>
			<br>
			<a href="../../images/documentos/pFisica.pdf" download>BAIXAR</a>
			<br>
		</div>

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		
		function janelaAjuda(){
			$('.janela-ajuda-projeto').slideToggle();
		}

	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>