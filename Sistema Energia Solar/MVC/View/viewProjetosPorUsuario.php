<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA
	
	include_once("../View/viewHead.php");
	include_once("../Controller/controllerFormatarData.php");
	include_once("../Model/modelBancoDeDados.php");	

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$idUsuarioEscolhido = $idUsuarioLogado;

	include_once("../Model/modelProjetosPorUsuario.php");	
	include_once("../Model/modelVerificarUsuario.php");

	if(isset($totalProjetosPorUsuario[0]['id_usuario'])){
		$verificaId = $totalProjetosPorUsuario[0]['id_usuario'];
	}else{
		$verificaId = 0;
	}	
?>

<?php if($_SESSION['id-usuario-logado'] == $verificaId){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Projetos</li>
		</ul>

	</section>

	<section class="filtros-projetos">
		<p>Filtros:</p>

		<div class="filtros-projetos-box">
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=0"><button>AGUARDANDO</button></a>
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=1"><button style="background-color: #D24E37">PENDÊNCIAS</button></a>
			<a  href="viewProjetosFiltradosPorUsuario.php?filtro=2"><button style="background-color: #3790D2">AGUARDANDO PAGAMENTO</button></a>
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=3"><button style="background-color: #3790D2">PAGAMENTO EFETUADO</button></a>
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=4"><button style="background-color: #FFC300">EM ELABORAÇÃO</button></a>
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=5"><button style="background-color: #FF5733">EM ANÁLISE</button></a>
			<a href="viewProjetosFiltradosPorUsuario.php?filtro=6"><button style="background-color: #11BB3B">APROVADO</button></a>
		</div>
	</section>

	<section class="projetos-wrapper separador ">

		<form method="POST" action="viewProjetoBuscadoCliente.php">
			<div class="pesquisar-projetos">
				
				<input type="text" name="pesquisar-projetos" placeholder="Buscar projeto...">
				<div class="icon-pesquisar-projetos">
					<button><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
				
			</div>
		</form>

		<br>

		<?php for($i = 0; $i < count($totalUsuarioEscolhido); $i++){?>

		<?php if($totalUsuarioEscolhido[$i]['tipo_usuario'] != 'master'){?>
		<div class="projetos-header" onclick="abrirListaProjetos(<?php echo $totalUsuarioEscolhido[$i]['id_usuario']?>)">
			<h2><i class="fas fa-sort-down"></i> <?php echo strtoupper($totalUsuarioEscolhido[$i]['nome_usuario'])?></h2>
			<?php 
				$idUsuario = $totalUsuarioEscolhido[$i]['id_usuario'];
				include("../Model/modelProjetosPorUsuario.php");
			?>
			<h2>Projetos: <?php echo count($totalProjetosPorUsuario)?></h2>
		</div>

		<div class="lista-projetos-wrapper">
			<div class="lista-projetos" id="lista-projetos<?php echo $totalUsuarioEscolhido[$i]['id_usuario']?>">
				<table>
					<tr>
						<th>Nome:</th>
						<th>Data:</th>
						<th>Status:</th>
						<th>Dados do projeto:</th>
						<th></th>
					</tr>

					<?php 
						$idUsuario = $totalUsuarioEscolhido[$i]['id_usuario'];
						include("../Model/modelProjetosPorUsuario.php");
						for($j = 0; $j < count($totalProjetosPorUsuario); $j++){

					?>
					
					<tr>
						<td><?php echo $totalProjetosPorUsuario[$j]['nome_projeto']?></td>
						<td><?php echo formatarData($totalProjetosPorUsuario[$j]['data_projeto'])?></td>

						<td style="display: flex; justify-content: center; align-items: center">
							
								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando'){?>
								<div class="status-projeto" style="background-color: black">
									<i class="fas fa-clock"></i>
									<?php echo 'AGUARDANDO CONFIRMAÇÃO DOS DOCUMENTOS'?>

								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aprovado'){?>
								<div class="status-projeto">
									<i class="fas fa-check-circle"></i>
									<?php echo strtoupper($totalProjetosPorUsuario[$j]['status_projeto'])?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando-pagamento'){?>
								<div class="status-projeto" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'AGUARDANDO PAGAMENTO'?>
									<?php echo '<br>PIX CPF: 083.323.166-93'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-aprovado'){?>
								<div class="status-projeto" style="background-color: #FFC300">	
									<i class="fas fa-running"></i>
									<?php echo 'PROJETO SENDO ELABORADO'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'reprovado'){?>
								<div class="status-projeto" style="background-color: #D24E37">
									<i class="fas fa-times-circle"></i>
									<?php echo 'DOCUMENTOS PENDENTES'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-feito'){?>
								<div class="status-projeto" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PAGAMENTO EFETUADO'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'analise'){?>
								<div class="status-projeto" style="background-color: #FF5733 ">
									<i class="fas fa-search"></i>
									<?php echo 'PROJETO EM ANÁLISE'?>	
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'finalizado'){?>
								<div class="status-projeto" id="status-projeto-aprovado<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PROJETO APROVADO'?>	
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'vistoria-solicitada'){?>
								<div class="status-projeto" style="background-color: #FFC300">
									<i class="fas fa-search"></i>
									<?php echo 'VISTORIA SOLICITADA'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'em-vistoria'){?>
								<div class="status-projeto" id="status-vistoria-andamento<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">
									<i class="fas fa-running"></i>
									<?php echo 'VISTORIA EM ANDAMENTO'?>
								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'gd-conectada'){?>
								<div class="status-projeto" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'GD CONECTADA'?>	
								<?php }?>
							</div>		

							<div class="status-projeto status-projeto-hide" id="status-vistoria-solicitada<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">
									<i class="fas fa-search"></i>
									<?php echo 'VISTORIA SOLICITADA'?>
							</div>



							<div class="status-projeto status-projeto-hide" id="status-gd-conectada<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'GD CONECTADA'?>
							</div>


						</td>

						<td>
							<a href="viewVisualizarProjeto.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>&idU=<?php echo $totalProjetosPorUsuario[$j]['id_usuario']?>">
								<i class="far fa-eye"></i> VER PROJETO
							</a>
						</td>

						<td>
							<div class="botao-acao-wrapper">

								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-feito'){?>
								<div class="botao-acao" onclick="verComprovantePagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-search-dollar"></i> VER COMPROVANTE
								</div>
								<?php }?>

								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando-pagamento'){?>
								<div class="botao-acao" onclick="enviarComprovantePagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>)">
									<i class="fas fa-plus-circle"></i> ADICIONAR COMPROVANTE
								</div>
								<?php }?>

								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'finalizado'){?>
								<div class="botao-acao" id="botao-solicitar-vistoria<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="solicitarVistoria(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-search"></i> SOLICITAR VISTORIA
								</div>
								<?php }?>

								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'em-vistoria'){?>
								<div class="botao-acao" id="botao-gd-conectada<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="gdConectada(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> GD CONECTADA
								</div>
								<?php }?>

								<div class="botao-acao" onclick="comentariosProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="far fa-eye"></i> VER COMENTÁRIOS
								</div>
							</div>
						</td>
					</tr>

					<!-- JANELA PRA VER O COMPROVANTE DE PAGAMENTO DO PROJETO -->
					<div class="janela-modal-cadastro ver-comprovante-pagamento" id="janela-ver-comprovante<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Comprovante de pagamento:</h2>
						</div>

						<div class="janela-modal-info-container ver-comprovante-pagamento-img">
							<br>
							<a style="background-color: black; color: white; padding: 10px;" href="<?php echo $totalProjetosPorUsuario[$j]['img_pagamento_projeto']?>">BAIXAR ARQUIVO</a><br><br><br>
							<?php 

								if(!empty($totalProjetosPorUsuario[$j]['img_pagamento_projeto'])){


								$arquivo = explode('.', $totalProjetosPorUsuario[$j]['img_pagamento_projeto']);

								$nomeArquivo = explode('/', $totalProjetosPorUsuario[$j]['img_pagamento_projeto']);

								if(strtoupper($arquivo[4]) == 'PDF'){
								

							?>

							<img src="../../images/pdf.png">

							<?php }else{?>
							
							<img src="<?php echo $totalProjetosPorUsuario[$j]['img_pagamento_projeto']?>">	

							<?php } }?>
						</div>
					</div>
					<!-- FIM DA JANELA PRA VER COMPROVANTE -->

					<!-- JANELA PRA ENVIAR O COMPROVANTE DE PAGAMENTO DO PROJETO -->
					<div class="janela-modal-cadastro comprovante-pagamento" id="janela-enviar-comprovante<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Enviar comprovante de pagamento:</h2>
						</div>

						<div class="janela-modal-info-container">
							<form method="POST" action="../Model/modelEnviarComprovantePagamento.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>" enctype="multipart/form-data">		
								
								<div class="janela-modal-info-box">	
									<label>Envie um print ou uma foto do seu comprovante de pagamento (PIX, Transferência, Depósito).</label><br>
									<input type="file" name="fileToUploadComprovante" id="fileToUploadComprovante" required>	
								</div>	

								<div class="botao-janela-modal">
									<button>ENVIAR</button>
								</div>
							</form>
						</div>
					</div>
					<!-- FIM DA JANELA PRA ENVIAR COMPROVANTE -->

					<!-- JANELA PRA REPROVAR PROJETO -->
					<div class="janela-modal-cadastro cadastro-usuario" id="janela-reprovar-projeto<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Motivo da reprovação:</h2>
						</div>

						<div class="janela-modal-info-container">
							<form method="POST" action="../Model/modelReprovarProjeto.php?id=<?php echo $idUsuario?>&idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">		
								
								<div class="janela-modal-info-box">	
									<textarea name="comentario-projeto"></textarea>
								</div>	

								<div class="botao-janela-modal">
									<button>ENVIAR</button>
								</div>
							</form>
						</div>
					</div>
					<!-- FIM DA JANELA PRA EDITAR O USUARIO -->


					<!-- JANELA COM COMENTÁRIOS DO PROJETO -->
					<div class="janela-modal-cadastro cadastro-usuario cadastro-comentario" id="janela-comentarios-projeto<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Comentários do projeto:</h2>
						</div>

						<?php 
							$idProjetoComentario = $totalProjetosPorUsuario[$j]['id_projeto'];

							$verificaComentarios = $pdo->prepare("SELECT * FROM comentario_projeto WHERE id_projeto = $idProjetoComentario");
							$verificaComentarios->execute();
							$totalComentarios = $verificaComentarios->fetchAlL(); 
						?>

						<div style="max-height: 400px; overflow-y: scroll;">
							<div class="comentarios-projeto-wrapper">
								<?php for($l = 0; $l < count($totalComentarios); $l++){?>
								
								<div class="comentarios-projeto-box">
									<p><?php echo strtoupper($totalComentarios[$l]['nome_usuario_comentario_projeto'])?></p>
									<p><b>Data:</b> <?php echo formatarData($totalComentarios[$l]['data_comentario_projeto'])?></p>
									<p style="margin-top: 10px"><?php echo $totalComentarios[$l]['descricao_comentario_projeto']?></p>
								</div>

								<?php }?><!-- FIM DO FOR 'l' -->
							</div>
							
						</div>

						<div class="janela-modal-info-container janela-modal-comentario-projeto-wrapper">
							<form method="POST" action="../Model/modelCadastrarComentarioProjeto.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>&leitor=1">		
								
								<div class="janela-modal-comentario-projeto">	
									<textarea placeholder="Enviar comentário..." name="comentario-projeto" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1'></textarea>
									<button><i class="fas fa-paper-plane"></i></button>
								</div>
							</form>
						</div>
					</div>
					<!-- FIM DA JANELA PRA EDITAR O USUARIO -->
					
					<?php } ?><!-- FIM DO FOR 'j' -->

				</table>
			</div>
		</div>

		<?php }?><!-- FIM DO IF PRA VER O TIPO -->

		

		<?php }?><!-- FIM DO FOR 'i' -->
		

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<?php 
		if(isset($_GET['abrirJanela']) && isset($_GET['idP'])){
			$abrirJanela = $_GET['abrirJanela'];
			$idPComentario = $_GET['idP'];	

			if($abrirJanela == 1){
				echo "<script>$('.lista-projetos').css('display', 'block')</script>";
				echo '<script>var idProjeto = '.$idPComentario.';</script>';
				echo "<script>$('#janela-comentarios-projeto'+idProjeto).css('display', 'block')</script>";
			}
		}
	?>

	<script type="text/javascript">
		function abrirListaProjetos(id){
			$('#lista-projetos'+id).slideToggle();
		}
		
		function reprovarProjeto(id){
			$('#janela-reprovar-projeto'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function comentariosProjeto(id){
			$('#janela-comentarios-projeto'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function verComprovantePagamento(id){
			$('#janela-ver-comprovante'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function enviarComprovantePagamento(id){
			$('#janela-enviar-comprovante'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function solicitarVistoria(id){
			var id_projeto = id;
			$.ajax({
				method: 'post',
				data:{'id': id_projeto},
				url: '../Model/modelSolicitarVistoria.php'
			}).done(function(){
				$('#botao-solicitar-vistoria'+id_projeto).css('display', 'none');
				$('#status-projeto-aprovado'+id_projeto).css('display', 'none');
				$('#status-vistoria-solicitada'+id_projeto).slideToggle();
				
			});
		}

		function gdConectada(id){
			var id_projeto = id;
			$.ajax({
				method: 'post',
				data:{'id': id_projeto},
				url: '../Model/modelGdConectada.php'
			}).done(function(){
				$('#botao-gd-conectada'+id_projeto).css('display', 'none');
				$('#status-vistoria-andamento'+id_projeto).css('display', 'none');
				$('#status-gd-conectada'+id_projeto).slideToggle();
				
			});
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