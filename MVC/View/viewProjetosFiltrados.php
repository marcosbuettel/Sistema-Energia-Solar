<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Controller/controllerFormatarData.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelProjetos.php");	
	//include_once("../Model/modelUsuarios.php");	
	include_once("../Model/modelVerificarUsuarioPorProjeto.php");	

	if($_GET['filtro'] == 0){
		$filtro = 'aguardando';
	}else if($_GET['filtro'] == 1){
		$filtro = 'reprovado';
	}else if($_GET['filtro'] == 2){
		$filtro = 'aguardando-pagamento';
	}else if($_GET['filtro'] == 3){
		$filtro = 'pagamento-feito';
	}else if($_GET['filtro'] == 4){
		$filtro = 'pagamento-aprovado';
	}else if($_GET['filtro'] == 5){
		$filtro = 'analise';
	}else if($_GET['filtro'] == 6){
		$filtro = 'finalizado';
	}else if($_GET['filtro'] == 7){
		$filtro = 'andamento';
	}else if($_GET['filtro'] == 8){
		$filtro = 'pendencias';
	}
?>

<?php if($_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Projetos</li>
		</ul>

	</section>

	<section class="filtros-projetos">
		<p>Filtros:</p>

		<div class="filtros-projetos-box">
			<a href="viewProjetos.php"><button>LIMPAR FILTROS</button></a>
			<a href="viewProjetosFiltrados.php?filtro=0"><button>AGUARDANDO</button></a>
			<a href="viewProjetosFiltrados.php?filtro=1"><button style="background-color: #D24E37">PENDÊNCIAS</button></a>
			<a  href="viewProjetosFiltrados.php?filtro=2"><button style="background-color: #3790D2">AGUARDANDO PAGAMENTO</button></a>
			<a href="viewProjetosFiltrados.php?filtro=3"><button style="background-color: #3790D2">PAGAMENTO EFETUADO</button></a>
			<a href="viewProjetosFiltrados.php?filtro=4"><button style="background-color: #FFC300">EM ELABORAÇÃO</button></a>
			<a href="viewProjetosFiltrados.php?filtro=5"><button style="background-color: #FF5733">EM ANÁLISE</button></a>
			<a href="viewProjetosFiltrados.php?filtro=6"><button style="background-color: #11BB3B">APROVADO</button></a>
		</div>
	</section>

	<section class="projetos-wrapper separador ">
		
		<form method="POST" action="viewProjetoBuscado.php">
			<div class="pesquisar-projetos">
				
				<input type="text" name="pesquisar-projetos" placeholder="Buscar projeto...">
				<div class="icon-pesquisar-projetos">
					<button><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
				
			</div>
		</form>

		<br>

		<?php for($i = 0; $i < count($totalUsuarios); $i++){?>

		<?php if($totalUsuarios[$i]['tipo_usuario'] != 'master'){?>
		<div class="projetos-header" onclick="abrirListaProjetos(<?php echo $totalUsuarios[$i]['id_usuario']?>)">
			<h2><i class="fas fa-sort-down"></i> <?php echo strtoupper($totalUsuarios[$i]['nome_usuario'])?></h2>
			<?php 
				$idUsuario = $totalUsuarios[$i]['id_usuario'];
				include('../Model/modelVerificarProjetos.php');
			?>
			<h2>Projetos: <?php echo count($totalProjetosPorUsuario)?></h2>
		</div>

		<div class="lista-projetos-wrapper">
			<div class="lista-projetos" id="lista-projetos<?php echo $totalUsuarios[$i]['id_usuario']?>" style="display: block">
				<table>
					<tr>
						<th>Nome:</th>
						<th>Data:</th>
						<th>Status:</th>
						<th>Dados do projeto:</th>
						<th></th>
					</tr>

					<?php 
						$idUsuario = $totalUsuarios[$i]['id_usuario'];
						include('../Model/modelVerificarProjetosFiltrados.php');
						for($j = 0; $j < count($totalProjetosPorUsuario); $j++){

					?>
					
					<tr>
						<td><?php echo $totalProjetosPorUsuario[$j]['nome_projeto']?></td>
						<td><?php echo formatarData($totalProjetosPorUsuario[$j]['data_projeto'])?></td>

						<td style="display: flex; justify-content: center; align-items: center">
							
								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando'){?>
								<div class="status-projeto" id="aguardando-confirmacao<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: black">
									<i class="fas fa-clock"></i>
									<?php echo 'AGUARDANDO CONFIRMAÇÃO DOS DOCUMENTOS'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando-pagamento'){?>
								<div class="status-projeto" id="aguardando-pagamento<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'AGUARDANDO PAGAMENTO'?>
									<?php echo '<br>PIX CPF: 083.323.166-93'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-aprovado'){?>
								<div class="status-projeto" id="em-elaboracao<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">	
									<i class="fas fa-running"></i>
									<?php echo 'PROJETO SENDO ELABORADO'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'reprovado'){?>
								<div class="status-projeto" id="pendencias<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #D24E37">
									<i class="fas fa-times-circle"></i>
									<?php echo 'DOCUMENTOS PENDENTES'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-feito'){?>
								<div class="status-projeto" id="pagamento-feito<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PAGAMENTO EFETUADO'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'analise'){?>
								<div class="status-projeto" id="em-analise<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FF5733 ">
									<i class="fas fa-search"></i>
									<?php echo 'PROJETO EM ANÁLISE'?>	


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'finalizado'){?>
								<div class="status-projeto" id="projeto-aprovado<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PROJETO APROVADO'?>	


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'vistoria-solicitada'){?>
								<div class="status-projeto" id="vistoria-solicitada<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">
									<i class="fas fa-search"></i>
									<?php echo 'VISTORIA SOLICITADA'?>	



								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'em-vistoria'){?>
								<div class="status-projeto" id="projeto-aprovado<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">
									<i class="fas fa-running"></i>
									<?php echo 'VISTORIA EM ANDAMENTO'?>


								<?php }else if($totalProjetosPorUsuario[$j]['status_projeto'] == 'gd-conectada'){?>
								<div class="status-projeto" id="projeto-aprovado<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'GD CONECTADA'?>	


								<?php }?>




								</div>

								<!-- 
									NESSA PARTE EU ESTOU COLOCANDO TODOS OS STATUS QUE EXISTEM
									MAS ELES ESTÃO COM 'DISPLAY: NONE' PARA NÃO APARECEREM
									QUANDO UM STATUS É ALTERADO, UTILIZO AJAX PARA MODIFICAR
									O STATUS NO BANCO DE DADOS SEM ATUALIZAR A PÁGINA
									E FAÇO COM QUE O STATUS ANTIGO SUMA E O NOVO APAREÇA
								-->	

								<div class="status-projeto status-projeto-hide" id="aguardando-confirmacao-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: black">
									<i class="fas fa-clock"></i>
									<?php echo 'AGUARDANDO CONFIRMAÇÃO DOS DOCUMENTOS'?>
								</div>

								<div class="status-projeto status-projeto-hide" id="aguardando-pagamento-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'AGUARDANDO PAGAMENTO'?>
									<?php echo '<br>PIX CPF: 083.323.166-93'?>
								</div>

								<div class="status-projeto status-projeto-hide" id="em-elaboracao-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">	
									<i class="fas fa-running"></i>
									<?php echo 'PROJETO SENDO ELABORADO'?>
								</div>

								<div class="status-projeto status-projeto-hide" id="pendencias-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #D24E37">
									<i class="fas fa-times-circle"></i>
									<?php echo 'DOCUMENTOS PENDENTES'?>
								</div>

								<div class="status-projeto status-projeto-hide" id="pagamento-feito-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #3790D2">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PAGAMENTO EFETUADO'?>
								</div>

								<div class="status-projeto status-projeto-hide" id="em-analise-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FF5733 ">
									<i class="fas fa-search"></i>
									<?php echo 'PROJETO EM ANÁLISE'?>	
								</div>

								<div class="status-projeto status-projeto-hide" id="projeto-aprovado-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #11BB3B">
									<i class="fas fa-check-circle"></i>
									<?php echo 'PROJETO APROVADO'?>
								</div>


								<div class="status-projeto status-projeto-hide" id="em-vistoria-hide<?php echo  $totalProjetosPorUsuario[$j]['id_projeto'] ?>" style="background-color: #FFC300">
									<i class="fas fa-running"></i>
									<?php echo 'VISTORIA EM ANDAMENTO'?>
								</div>

								<!-- 
									AQUI TERMINAM TODOS OS STATUS QUE ESTÃO ESCONDIDOS
									ELES VÃO APARECENDO DE ACORDO COM A ALTERAÇÃO
									DOS STATUS PELO USUÁRIO
								-->

						</td>

						<td>
							<a href="viewVisualizarProjeto.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>&idU=<?php echo $totalProjetosPorUsuario[$j]['id_usuario']?>">
								<i class="far fa-eye"></i> VER PROJETO
							</a>
						</td>

						<td>
							<div class="botao-acao-wrapper">


								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando'){?>
								<div class="botao-acao" id="botao-confirmar-documentos<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="aprovarDocumentos(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> CONFIRMAR DOCUMENTOS
								</div>
								<?php }?>



								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-feito'){?>
								<div class="botao-acao" id="botao-ver-comprovante<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="verComprovantePagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-search-dollar"></i> VER COMPROVANTE
								</div>

								<div class="botao-acao" id="botao-confirmar-pagamento<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="aprovarPagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> CONFIRMAR PAGAMENTO
								</div>
								<?php }?>


																
								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'aguardando'){?>
								<div class="botao-acao" id="botao-pendencias<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="reprovarProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-times-circle"></i> PENDÊNCIAS
								</div>
								<?php }?>




								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'pagamento-aprovado'){?>
								<div class="botao-acao" id="botao-enviar-analise<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="projetoAnalise(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> ENVIAR PARA ANÁLISE
								</div>
								<?php }?>



								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'analise'){?>
								<div class="botao-acao" id="botao-projeto-aprovado<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="finalizarProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> PROJETO APROVADO
								</div>
								<?php }?>



								<?php if($totalProjetosPorUsuario[$j]['status_projeto'] == 'vistoria-solicitada'){?>
								<div class="botao-acao" id="botao-confirmar-vistoria<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="confirmarVistoria(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> CONFIRMAR VISTORIA
								</div>
								<?php }?>


								<div class="botao-acao" onclick="comentariosProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="far fa-eye"></i> VER COMENTÁRIOS
								</div>




								<!-- 
									NESSA PARTE TAMBÉM CRIEI BOTÕES COM OUTROS ID'S
									PARA QUE QUANDO O AJAX ATIVASSE NA MUDANÇA DE STATUS
									O BOTÃO ANTIGO SUMISSE DE ACORDO COM O STATUS NOVO
								-->


								<div class="botao-acao botao-acao-hide" id="botao-confirmar-documentos-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="aprovarDocumentos(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> CONFIRMAR DOCUMENTOS
								</div>	


								<!---------------------------------------------------------->
								<div class="botao-acao botao-acao-hide" id="botao-ver-comprovante-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="verComprovantePagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-search-dollar"></i> VER COMPROVANTE
								</div>

								<div class="botao-acao botao-acao-hide" id="botao-confirmar-pagamento-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="aprovarPagamento(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> CONFIRMAR PAGAMENTO
								</div>
								<!---------------------------------------------------------->


								<div class="botao-acao botao-acao-hide" id="botao-pendencias-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="reprovarProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-times-circle"></i> PENDÊNCIAS
								</div>



								<div class="botao-acao botao-acao-hide" id="botao-enviar-analise-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="projetoAnalise(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> ENVIAR PARA ANÁLISE
								</div>



								<div class="botao-acao botao-acao-hide" id="botao-projeto-aprovado-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="finalizarProjeto(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-check-circle"></i> PROJETO APROVADO
								</div>


								<div class="botao-acao botao-acao-hide" id="botao-anexar-nome-hide<?php echo $totalProjetosPorUsuario[$j]['id_projeto'] ?>" onclick="anexarNome(<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>)">
									<i class="fas fa-file-alt"></i> ANEXAR NOME
								</div>



								<!-- 
									AQUI TERMINAM TODOS OS BOTÕES QUE UTILIZAM O AJAX
								-->
							</div>
						</td>

						
					</tr>

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

					<!-- JANELA PRA ANEXAR ARQUIVO NA HORA DE ENVIAR PARA ANALISE -->
					<div class="janela-modal-cadastro anexar-diagrama-unifilar" id="janela-anexar-diagrama-unifilar<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Projeto Elétrico:</h2>
						</div>

						<div class="janela-modal-info-container">
							<form method="POST" action="../Model/modelEnviarProjetoAnalise.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>" enctype="multipart/form-data">		
								
								<div class="janela-modal-info-box" style="flex-direction: column">	
									<label>Enviar arquivo:</label>
									<input type="file" name="fileToUploadDiagramaUnifilar" id="fileToUploadDiagramaUnifilar" required>	
								</div>	

								<div class="botao-janela-modal">
									<button>ENVIAR</button>
								</div>
							</form>
						</div>
					</div>
					<!-- FIM DA JANELA PRA ANEXAR ARQUIVO NA HORA DE ENVIAR PARA ANALISE -->

					<!-- JANELA PRA ANEXAR ARQUIVO NA HORA DE APROVAR O PROJETO -->
					<div class="janela-modal-cadastro anexar-arquivo-projeto-finalizado" id="janela-anexar-arquivo-projeto-finalizado<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Parecer de Acesso Aprovado:</h2>
						</div>

						<div class="janela-modal-info-container">
							<form method="POST" action="../Model/modelFinalizarProjeto.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>" enctype="multipart/form-data">		
								
								<div class="janela-modal-info-box" style="flex-direction: column">	
									<label>Enviar arquivo:</label>
									<input type="file" name="fileToUploadParecerAcesso" id="fileToUploadParecerAcesso" required>	
								</div>	

								<div class="botao-janela-modal">
									<button>ENVIAR</button>
								</div>
							</form>
						</div>
					</div>
					<!-- FIM DA JANELA PRA VER COMPROVANTE -->


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
							<form method="POST" action="../Model/modelCadastrarComentarioProjeto.php?idP=<?php echo $totalProjetosPorUsuario[$j]['id_projeto']?>">		
								
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
				echo '<script>var idProjeto = 2;</script>';
				echo "<script>$('#janela-comentarios-projeto2').css('display', 'block')</script>";
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

		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		/*function aprovarDocumentos(id){
			document.location = '../Model/modelAprovarDocumentosProjeto.php?idP='+id+'&tipo=0';
		}*/

		/*function aprovarPagamento(id){
			document.location = '../Model/modelAprovarPagamentoProjeto.php?idP='+id;
		}*/

		/*function projetoAnalise(id){
			document.location = '../Model/modelEnviarProjetoAnalise.php?idP='+id;	
		}*/

		/*function finalizarProjeto(id){
			document.location = '../Model/modelFinalizarProjeto.php?idP='+id;		
		}*/


		//PARTE DE AJAX PARA MUDAR OS STATUS DA TAREFA

		function aprovarDocumentos(id){

			var result = confirm("Confirmar documentos?"); 

		    if (result == true) { 
				var id_projeto = id;
				$.ajax({
					method: 'post',
					data:{'id': id_projeto},
					url: '../Model/modelAprovarDocumentosProjeto.php'
				}).done(function(){
					$('#aguardando-confirmacao'+id_projeto).css('display', 'none');
					$('#aguardando-pagamento-hide'+id_projeto).slideToggle();

					$('#botao-confirmar-documentos'+id_projeto).css('display', 'none');
					$('#botao-pendencias'+id_projeto).css('display', 'none');
				});
			}
		}

		function aprovarPagamento(id){

			var result = confirm("Confirmar pagamento?"); 

		    if (result == true) { 
				var id_projeto = id;
				$.ajax({
					method: 'post',
					data:{'id': id_projeto},
					url: '../Model/modelAprovarPagamentoProjeto.php'
				}).done(function(){				
					$('#pagamento-feito'+id_projeto).css('display', 'none');
					$('#em-elaboracao-hide'+id_projeto).slideToggle();

					$('#botao-confirmar-pagamento'+id_projeto).css('display', 'none');
					$('#botao-ver-comprovante'+id_projeto).css('display', 'none');
					$('#botao-enviar-analise-hide'+id_projeto).slideToggle();
				});
			}
		}

		function projetoAnalise(id){
			$('#janela-anexar-diagrama-unifilar'+id).css('display', 'block');
		}

		/*function projetoAnalise(id){
			var result = confirm("Enviar projeto para análise?"); 

		    if (result == true) { 
				var id_projeto = id;
				$.ajax({
					method: 'post',
					data:{'id': id_projeto},
					url: '../Model/modelEnviarProjetoAnalise.php'
				}).done(function(){
					$('#em-elaboracao'+id_projeto).css('display', 'none');
					$('#em-analise-hide'+id_projeto).slideToggle();

					$('#botao-enviar-analise'+id_projeto).css('display', 'none');
					$('#botao-projeto-aprovado-hide'+id_projeto).slideToggle();

					$('#em-elaboracao-hide'+id_projeto).css('display', 'none');
					$('#botao-enviar-analise-hide'+id_projeto).css('display', 'none');
				});
			}
		}*/

		function finalizarProjeto(id){
			$('#janela-anexar-arquivo-projeto-finalizado'+id).css('display', 'block');
		}

		/*function finalizarProjeto(id){

			var id_projeto = id;
			$.ajax({
				method: 'post',
				data:{'id': id_projeto},
				url: '../Model/modelFinalizarProjeto.php'
			}).done(function(){
				$('#em-analise'+id_projeto).css('display', 'none');
				$('#projeto-aprovado-hide'+id_projeto).slideToggle();
				
				$('#botao-projeto-aprovado'+id_projeto).slideToggle();

				$('#botao-projeto-aprovado-hide'+id_projeto).slideToggle();
				$('#em-analise-hide'+id_projeto).css('display', 'none');
			});
		}*/



		function confirmarVistoria(id){
			var result = confirm("Confirmar vistoria?"); 

	        if (result == true) { 
				var id_projeto = id;
				$.ajax({
					method: 'post',
					data:{'id': id_projeto},
					url: '../Model/modelConfirmarVistoria.php'
				}).done(function(){
					$('#vistoria-solicitada'+id_projeto).css('display', 'none');
					$('#em-vistoria-hide'+id_projeto).slideToggle();
					
					$('#botao-confirmar-vistoria'+id_projeto).css('display', 'none');
				});
			}
		}

		//PARTE DE AJAX PARA MUDAR OS STATUS DA TAREFA

	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>