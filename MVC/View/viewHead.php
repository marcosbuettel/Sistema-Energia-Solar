<?php 
	//PÁGINA ONDE TEM TODAS AS INFORMAÇÕES DO CABEÇALHO DE CA
	//PÁGINA DO SISTEMA
	//QUALQUER ALTERAÇÃO NO CABEÇALHO, DEVE SER FEITA AQUI,
	//POIS IRÁ SER ALTERADO EM TODAS AS PÁGINAS

	session_start();

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	
	include_once("../Model/modelBancoDeDados.php");
	include_once("../Model/modelNotificacao.php");
	include_once("../Model/modelContadorNotificacaoAtiva.php");
	include_once("../Controller/controllerFormatarData.php");

	//SE UM USUARIO QUE NÃO FEZ O LOGIN TENTAR ENTRAR DIRETAMENTE
	//NESSA PÁGINA, ESSA CONDIÇÃO IRÁ RETORNAR ELE PARA A TELA
	//DE LOGIN
	if(empty($_SESSION['login'])){
		echo "<script>document.location = '../../index.php'</script>";
	}	
?>

<!DOCTYPE html>

<html lang="pt-BR">

	<head>
		<title>Projetos de Energia Solar</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="../../js/main.js"></script>	
		<link href="../../css/fontawesome.min.css" rel="stylesheet">
		<link href="../../css/all.css" rel="stylesheet">
		<link href="../../css/style-pa.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
 		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
 		<script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
	</head>

	<body>		

		<header>

			<!-- DIV QUE CONTEM A BARRA SUPERIOR, ONDE FICA O SINO
				COM AS NOTIFICAÇÕES -->
			<div class="nav-superior">	
				<!--<img src="../../images/logoiSeven2.png">-->
				<div class="img-sino">
					<div style="position: relative;top: 10px; right: 50px; display: flex">
						<span>OLÁ <?php echo strtoupper($_SESSION['login'])?></span>
						<?php if($_SESSION['imagem-usuario'] != null){?>
							<div class="imagem-perfil-usuario-nav" style="background-image: url('<?php echo $_SESSION['imagem-usuario']?>')"></div>
							
						<?php }else{?>
							<img style="border-radius: 50%; position: relative; top: -10px; left: 5px" src="../../images/profile.png">
						<?php }?>
					</div>


					<?php if($verificaNotificacaoAtiva == true){?>
						<div class="aviso-notificacao"></div>
					<?php }?>


					<img src="../../images/sino.png" onclick="abrirNotificacao()">
					<!-- ESSA CONDIÇÃO MOSTRA TODAS AS NOTIFICAÇÕES
						QUE AINDA NÃO FORAM VISTAS -->
						
					<div class="barra-notificacao">

						<p onclick="marcarNotificacao(<?php echo $idUsuarioLogado ?>)" style="text-align: center; background-color: black; color: white; padding: 5px; cursor: pointer;">MARCAR TODAS COMO LIDAS</p>

						<!-- 
							VERIFICANDO TODAS AS NOTIFICAÇÕES QUE PERTENCEM
							AO USUÁRIO QUE ESTÁ LOGADO
						-->
						<?php for($i = 0; $i < count($totalNotificacao); $i++){?>

							<?php if($totalNotificacao[$i]['vista_notificacao'] == '1'){ ?>

							<div style="background-color: #DFE9F8; padding: 10px;">

							<?php }else{ ?>

							<div style="padding: 10px;">	

							<?php } ?>
								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'novo-comentario'){ ?>
								<p><i class="fas fa-comment-dots"></i> Novo comentário no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>	

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'novo-projeto'){ ?>
								<p><i class="fas fa-clipboard"></i> Novo projeto cadastrado: <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'pagamento-feito'){ ?>
								<p><i class="fas fa-dollar-sign"></i> Pagamento realizado no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'documentos-aprovados'){ ?>
								<p><i class="fas fa-file-alt"></i> Os documentos estão ok no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'documentos-reprovados'){ ?>
								<p><i class="fas fa-file-excel"></i> Documentos pendentes no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'analise'){ ?>
								<p><i class="fas fa-file-import"></i> Projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?> enviado para análise</p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'pagamento-aprovado'){ ?>
								<p><i class="fas fa-running"></i> Projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?> está sendo elaborado</p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'finalizado'){ ?>
								<p><i class="fas fa-check-circle"></i> Projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?> aprovado pela concessionária</p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'vistoria-solicitada'){ ?>
								<p><i class="fas fa-search"></i> Vistoria solicitada no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>

								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'vistoria-confirmada'){ ?>
								<p><i class="fas fa-running"></i> Vistoria em andamento no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>


								<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'gd-conectada'){ ?>
								<p><i class="fas fa-check-circle"></i> GD Conectada no projeto <?php echo $totalNotificacao[$i]['nome_projeto_notificacao']?></p>	
								<?php } ?>
								
								
								<p><?php echo formatarData($totalNotificacao[$i]['data_notificacao'])?></p>

								<hr>

							</div>
						<?php }?><!-- FIM DO FOR 'i' -->
					</div>	
					
				</div>

			</div>			

			<!-- DIV DA BARRA (MENU) LATERAL -->
			<div class="nav-left">	
				<div class="ico-menu">			
					<i style="color: white;" class="fas fa-bars"></i>
				</div>
				
				<!--<h2>Painel Administrativo</h2>--><br><br><br>
				
				<a href="viewPainelAdministrativo.php"><i class="fas fa-house-user"></i>Início</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewUsuarios.php"><i class="fas fa-user"></i>Usuários Cadastrados</a><br><br>
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<!--<a href="viewFormularios.php"><i class="fab fa-wpforms"></i>Controle de Formulários</a><br><br>-->
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php"><i class="fas fa-clipboard-list"></i>Visualizar Projetos</a><br><br>
				<?php }else{?>
					<a href="viewProjetosPorUsuario.php"><i class="fas fa-clipboard-list"></i>Visualizar Projetos</a><br><br>
				<?php }?>

				<!--<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>
				<?php }else{?>
					<a href="viewProjetosPorCliente.php"><i class="fas fa-paste"></i>Projetos</a><br><br>
				<?php }?>-->


				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=6"><i class="fas fa-clipboard-check"></i>Projetos Aprovados</a><br><br>
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=6"><i class="fas fa-clipboard-check"></i>Projetos Aprovados</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=7"><i class="fas fa-running"></i>Projetos em Andamento</a><br><br>
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=7"><i class="fas fa-running"></i>Projetos em Andamento</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=8"><i class="fas fa-file-excel"></i>Projetos com Pendências</a><br><br>
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=8"><i class="fas fa-file-excel"></i>Projetos com Pendências</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
					<a href="viewAnexos.php"><i class="fas fa-file-archive"></i>Ver Anexos</a><br><br>
				<?php }?>

				
				
				<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->

				<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
			</div>

			<!-- DIV DA BARRA (MENU) LATERAL -->
			<div class="nav-left-mini">	
				<div class="ico-menu-mini">			
					<i style="color: white" class="fas fa-bars" onmouseover="exibeInfoMenu('abrir-menu')"></i>
					<div class="info-ico-menu" id="abrir-menu">ABRIR MENU</div>
				</div>

				<br><br><br>
				<a href="viewPainelAdministrativo.php">
					<i class="fas fa-house-user" onmouseover="exibeInfoMenu('inicio')"></i>
					<div class="info-ico-menu" id="inicio">INÍCIO</div>
				</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewUsuarios.php">
						<i class="fas fa-user" onmouseover="exibeInfoMenu('usuarios')"></i>
						<div class="info-ico-menu" id="usuarios">USUÁRIOS</div>
					</a><br><br>
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<!--<a href="viewFormularios.php"><i class="fab fa-wpforms"></i>Controle de Formulários</a><br><br>-->
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php">
						<i class='fas fa-clipboard-list' onmouseover="exibeInfoMenu('clientes')"></i>
						<div class="info-ico-menu" id="clientes">PROJETOS</div>
					</a><br><br>
				<?php }else{?>
					<a href="viewProjetosPorUsuario.php">
						<i class='fas fa-clipboard-list' onmouseover="exibeInfoMenu('clientes')"></i>
						<div class="info-ico-menu" id="clientes">PROJETOS</div>
					</a><br><br>
				<?php }?>	
				

				<!--<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php">
						<i class="fas fa-paste" onmouseover="exibeInfoMenu('projetos')"></i>
						<div class="info-ico-menu" id="projetos">PROJETOS</div>
					</a><br><br>
				<?php }else{?>
					<a href="viewProjetosPorCliente.php">
						<i class="fas fa-paste" onmouseover="exibeInfoMenu('projetos')"></i>
						<div class="info-ico-menu" id="projetos">PROJETOS</div>
					</a><br><br>
				<?php }?>-->

				

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=6">
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=6">
				<?php }?>
						<i class="fas fa-clipboard-check" onmouseover="exibeInfoMenu('solicitacoes')"></i>
						<div class="info-ico-menu" id="solicitacoes">APROVADOS</div>
					</a><br><br>
				

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=7">
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=7">
				<?php }?>	
					<i class="fas fa-running" onmouseover="exibeInfoMenu('prazos')"></i>
						<div class="info-ico-menu" id="prazos">ANDAMENTO</div>
					</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetosFiltrados.php?filtro=8">
				<?php }else{?>
					<a href="viewProjetosFiltradosPorUsuario.php?filtro=8">
				<?php }?>	
					<i class="fas fa-file-excel" onmouseover="exibeInfoMenu('pendencias')"></i>
						<div class="info-ico-menu" id="pendencias">PENDÊNCIAS</div>
					</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
					<a href="viewAnexos.php">
					<i class="fas fa-file-archive" onmouseover="exibeInfoMenu('anexos')"></i>
						<div class="info-ico-menu" id="anexos">ANEXOS</div>
					</a><br><br>
				<?php } ?>	
					
				
				<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->

				<a href="../Controller/controllerLogout.php">
					<i class="fas fa-door-open" onmouseover="exibeInfoMenu('sair')"></i>
					<div class="info-ico-menu" id="sair">SAIR</div>
				</a>
			</div>
			
			<!-- DIV DA BARRA (MENU) LATERAL PARA O MOBILE -->
			<div class="nav-left-mobile">
				<div class="sub-header-mobile">
					<!--<img src="../../images/logoiSeven2.png">
					<h2>Painel Administrativo</h2>
					<p>OLÁ <?php echo strtoupper($_SESSION['login'])?>!</p><br><br>-->
					<i class="fas fa-bars" id="icone-menu"></i>
				</div>

				<div class="menu-mobile">
					<a href="viewPainelAdministrativo.php"><i class="fas fa-house-user"></i>Início</a><br><br>

					<?php if($_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewUsuarios.php"><i class="fas fa-user"></i>Usuários Cadastrados</a><br><br>
					<?php } ?>

					<?php if($_SESSION['tipo-usuario'] == 'master'){?>
						<!--<a href="viewFormularios.php"><i class="fab fa-wpforms"></i>Controle de Formulários</a><br><br>-->
					<?php } ?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewProjetos.php"><i class="fas fa-clipboard-list"></i>Visualizar Projetos</a><br><br>
					<?php }else{?>
						<a href="viewProjetosPorUsuario.php"><i class="fas fa-clipboard-list"></i>Visualizar Projetos</a><br><br>
					<?php }?>

					<!--<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>
					<?php }else{?>
						<a href="viewProjetosPorCliente.php"><i class="fas fa-paste"></i>Projetos</a><br><br>
					<?php }?>-->


					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewProjetosFiltrados.php?filtro=6"><i class="fas fa-clipboard-check"></i>Projetos Aprovados</a><br><br>
					<?php }else{?>
						<a href="viewProjetosFiltradosPorUsuario.php?filtro=6"><i class="fas fa-clipboard-check"></i>Projetos Aprovados</a><br><br>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewProjetosFiltrados.php?filtro=7"><i class="fas fa-running"></i>Projetos em Andamento</a><br><br>
					<?php }else{?>
						<a href="viewProjetosFiltradosPorUsuario.php?filtro=7"><i class="fas fa-running"></i>Projetos em Andamento</a><br><br>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewProjetosFiltrados.php?filtro=8"><i class="fas fa-file-excel"></i>Projetos com Pendências</a><br><br>
					<?php }else{?>
						<a href="viewProjetosFiltradosPorUsuario.php?filtro=8"><i class="fas fa-file-excel"></i>Projetos com Pendências</a><br><br>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
						<a href="viewAnexos.php"><i class="fas fa-file-excel"></i>Ver Anexos</a><br><br>
					<?php }?>

					<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
				</div>
			</div>

		</header><!-- FIM DO HEADER -->

		<script>
			//ABRIR A BARRA DO MENU MOBILE
			$('#icone-menu').click(function(){
			  $('.menu-mobile').slideToggle();
			});

			//ABRIR A BARRA DAS NOTIFICAÇÕES
			function abrirNotificacao(){
				$('.barra-notificacao').slideToggle();				
			}

			//QUANDO CLICAR NA NOTIFICAÇÃO, LEVAR PARA O BLOCO
			//ONDE ELA ESTÁ LIGADA E MARCAR ELA COMO LIDA NO BANCO
			function visualizarNotificacao(idCalendario, idBlocoCalendario,idNotificacaoAtiva){
				document.location = '../Model/modelDesativarNotificacao.php?id='+idCalendario+'&idB='+idBlocoCalendario+'&idN='+idNotificacaoAtiva;
			}

			function visualizarNotificacaoSolicitacao(idCliente, idNotificacao){
				document.location = '../Model/modelVerificaClienteSolicitacao.php?id='+idCliente+'&idN='+idNotificacao;
			}

			function visualizarNotificacaoCalendario(idCalendario, idNotificacaoAtiva){
				document.location = '../Model/modelDesativarNotificacao.php?id='+idCalendario+'&idB=false&idN='+idNotificacaoAtiva;
			}

			$( ".ico-menu-mini" ).click(function() {
				$('.nav-left-mini').css('display', 'none');
				$( ".nav-left" ).animate({
			    width: "toggle"
			  }, 500, function() {
			  	$('.separador').css('width', '70%'); 
				$('.separador').css('margin-left', '300px'); 
				
			  });
			});

			$( ".ico-menu" ).click(function() {
				$('.nav-left-mini').css('display', 'block');
				$( ".nav-left" ).animate({
			    width: "toggle"
			  }, 500, function() {
			  	$('.separador').css('width', '90%'); 
				$('.separador').css('margin-left', '100px'); 
				
			  });
			});

			function exibeInfoMenu(icone){
				$('#'+icone).css('display', 'block');
			}

			$('.nav-left-mini i').mouseleave(function(){
				$('.info-ico-menu').css('display', 'none');
			});

			function marcarNotificacao(id){
				document.location = '../Model/modelDesativarNotificacao.php?id='+id;
			}

			/*$('.ico-menu').click(function() {
			   $('.nav-left').css({
			      'width': $('.nav-left').width(),
			      'height': $('.nav-left').height()
			});
				$('.separador').css('width', '90%'); 
				$('.separador').css('margin-left', '100px'); 
				$('.nav-left').animate({'width': 'toggle'});
				$('.nav-left-mini').css('display', 'block');
			});


			$('.ico-menu-mini').click(function(){
				$('.nav-left').css({
			      'width': $('.nav-left').width(),
			      'height': $('.nav-left').height()
			});
				$('.separador').css('width', '70%'); 
				$('.separador').css('margin-left', '300px'); 
				$('.nav-left').animate({'width': 'toggle'});
				$('.nav-left-mini').css('display', 'none');
				$('.nav-left').css('width', '300px');
			});*/

			
		</script>	