<?php
	//PÁGINA INICIAL DO SISTEMA. DEPOIS DO LOGIN VEM PRA CA 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");

	$nomeCliente = $_SESSION['nome-cliente'];
?>

<!-- DEPENDENDO DO TIPO DO USUARIO, SERÁ DIFERENTE 
	A VISÃO DESSA PÁGINA-->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="dashboard-wrapper separador">

		<a href="viewUsuarios.php">
			<div class="dashboard-box dashboard-box-2">
				<i class="fas fa-user"></i>
				<p>Usuários<br>Cadastrados</p>
			</div>
		</a>

		<a href="viewProjetos.php">
			<div class="dashboard-box dashboard-box-3">
				<i class="fas fa-clipboard-list"></i>
				<p>Visualizar<br>Projetos</p>
			</div>
		</a>

		<a href="viewProjetosFiltrados.php?filtro=6">
			<div class="dashboard-box dashboard-box-4">
				<i class="fas fa-clipboard-check"></i>
				<p>Projetos<br>Aprovados</p>
			</div>
		</a>

		<a href="viewProjetosFiltrados.php?filtro=7">
			<div class="dashboard-box dashboard-box-5">
				<i class="fas fa-running"></i>
				<p>Projetos<br>em Andamento</p>
			</div>
		</a>

		<a href="viewProjetosFiltrados.php?filtro=8">
			<div class="dashboard-box dashboard-box-6">
				<i class="fas fa-file-excel"></i>
				<p>Projetos<br>com Pendências</p>
			</div>
		</a>

		<!--<a href="viewEnviarEmail.php">
			<div class="dashboard-box dashboard-box-6">
				<i class="fas fa-file-excel"></i>
				<p>ENVIAR EMAIL</p>
			</div>
		</a>-->


	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

<?php }else{?>
	<section class="nav-painel">
		
		<!-- 

		AQUI VÃO ENTRAR OS BLOCOS PARA O CLIENTE VER AS OPÇÕES QUE ELE TEM 
		PARA USAR O SISTEMA

		POR ENQUANTO SERÃO 3 BLOCOS:

		*FAZER SOLICITAÇÃO (request)

		*ACOMPANHAR SOLICITAÇÕES (VAI LEVAR PARA UMA PLANILHA) (clock)
		
		*VER CALENDÁRIOS (calendar)

		-->

		<!--<ul>		
			<li><a href="">Seus calendários</a></li>
		</ul>-->

	</section>

	<section class="dashboard-wrapper separador">

		<a href="viewCadastrarProjeto.php">
			<div class="dashboard-box dashboard-box-2">
				<i class="fas fa-plus-circle"></i>
				<p>Novo<br>Projeto</p>
			</div>
		</a>

		<a href="viewProjetosPorUsuario.php">
			<div class="dashboard-box dashboard-box-3">
				<i class="fas fa-clipboard-list"></i>
				<p>Visualizar<br>Projetos</p>
			</div>
		</a>

		<a href="viewProjetosFiltradosPorUsuario.php?filtro=6">
			<div class="dashboard-box dashboard-box-4">
				<i class="fas fa-clipboard-check"></i>
				<p>Projetos<br>Aprovados</p>
			</div>
		</a>

		<a href="viewProjetosFiltradosPorUsuario.php?filtro=7">
			<div class="dashboard-box dashboard-box-5">
				<i class="fas fa-running"></i>
				<p>Projetos<br>em Andamento</p>
			</div>
		</a>

		<a href="viewProjetosFiltrados.php?filtro=8">
			<div class="dashboard-box dashboard-box-6">
				<i class="fas fa-file-excel"></i>
				<p>Projetos<br>com Pendências</p>
			</div>
		</a>


	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<!-- JANELA PARA CADASTRO DE UMA SOLICITAÇÃO PELO CLIENTE -->
	<div class="janela-modal-cadastro">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
		<div class="header-janela-modal">
			<h2>Cadastrar solicitação:</h2>
		</div>

		<div class="janela-modal-info-container">
			<form>
				<div class="janela-modal-info-box">
					<label>CAMPO 1</label>
					<input type="text" name="">

					<label>CAMPO 2</label>
					<input type="text" name="">

					<label>CAMPO 3</label>
					<input type="text" name="">
				</div>

				<div class="janela-modal-info-box">
					<label>CAMPO 1</label>
					<input type="text" name="">

					<label>CAMPO 2</label>
					<input type="text" name="">

					<label>CAMPO 3</label>
					<input type="text" name="">
				</div>
			</form>
		</div>
	</div>


<?php }?>

<script type="text/javascript">
		
	function cadastroSolicitacao(){
		$('.janela-modal-cadastro').css('display', 'block');
		$('body').css('background-color', 'rgba(0,0,0,0.5)');
		$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
	}


	function fecharJanelaModal(){
		$('.janela-modal-cadastro').css('display', 'none');	
		$('body').css('background-color', '#F5F5F5');
		$('tr:nth-child(2n)').css('background-color', 'white');
	}

	function confirmarExcluir(idCalendario){
		var idCalendario = idCalendario;
        var doc; 
        var result = confirm("Confirmar exclusão do calendário?"); 

        if (result == true) { 
            doc = "../Model/modelExcluirCalendario.php?id="+idCalendario; 
        } else { 
            doc = "viewCalendarios.php"; 
        } 

        window.location.replace(doc);
	}

	function enviarFoto(){
		$('#fileToUpload').toggle( "slow", function(){});
	}
</script>

<?php 
	include_once("../View/viewFooter.php");	
?>