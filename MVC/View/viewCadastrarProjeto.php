<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Novo Projeto</li>
			<li><a href="#" onclick="janelaAjuda()">AJUDA <i class="fas fa-question-circle"></i></a></li>
		</ul>

		<div class="janela-ajuda-projeto">
			<h2>DOCUMENTOS NECESSÁRIOS:</h2>
			<br>
			<div class="imagens-ajuda-projeto">
				<div>
					<h3>Conta de energia</h3>
					<img src="../../images/documentos/conta.jpeg">
				</div>
				<br>
				<hr>
				<br>
				<div>
					<h3>Procuração Reconhecida em Cartório</h3>
					<img src="../../images/documentos/procuracao.jpeg">
				</div>
				<br>
				<hr>
				<br>
				<div>
					<h3>Foto da Vista Geral do Padrão</h3>
					<img src="../../images/documentos/padrao.jpeg">
				</div>
				<br>
				<hr>
				<br>
				<div>
					<h3>Foto do Disjuntor</h3>
					<img src="../../images/documentos/disjuntor.jpeg">
				</div>
				<br>
				<hr>
				<br>
				<div>
					<h3>Localização do Cliente no GPS</h3>
					<img src="../../images/documentos/localizacao.jpeg">
				</div>
				<br>
				<hr>
				<br>
				<div>
					<h3>Descrição dos Equipamentos</h3>
					<img src="../../images/documentos/descricao.jpeg">
				</div>
			</div>
		</div>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

	<section class="cadastro-projeto separador ">
		<form method="POST" action="../Model/modelCadastroProjeto.php" enctype="multipart/form-data">

			<div class="janela-modal-info-box">
				<div>
					<label>Nome do Cliente:</label><br>
					<label style="font-size: 12px">Igual descrito na conta de energia</label><br>
					<input type="text" name="nome-projeto"><br><br><br>
					<label>Tipos de arquivos aceitos: JPG, JPEG, PNG e PDF</label>
				</div>
			</div>

			<div class="janela-modal-info-box">
				<div>

					<label>Conta de Energia:</label><br>
					<input type="file" name="fileToUploadConta" id="fileToUploadConta" required>	
				</div>

				<div>
					<label>Procuração Reconhecida em Cartório:</label><br>
					<input type="file" name="fileToUploadProcuracao" id="fileToUploadProcuracao" required>
				</div>
			</div>

			<div class="janela-modal-info-box">
				<div>
					<label>Foto da Vista Geral do Padrão:</label><br>
					<input type="file" name="fileToUploadPadrao" id="fileToUploadPadrao" required>	
				</div>

				<div>
					<label>Foto do Disjuntor do Padrão:</label><br>
					<input type="file" name="fileToUploadDisjuntor" id="fileToUploadDisjuntor" required>
				</div>
			</div>

			<div class="janela-modal-info-box">
				<div>
					<label>Localização do Cliente no GPS:</label><br>
					<input type="file" name="fileToUploadLocacao" id="fileToUploadLocacao" required>	
				</div>

				<div>
					<label>Descrição dos Equipamentos:</label><br>
					<input type="file" name="fileToUploadDescricao" id="fileToUploadDescricao" required>	
				</div>
			</div>

			<div class="janela-modal-info-box">
				<div>
					<label>Imagem Extra 1:</label><br>
					<input type="file" name="fileToUploadImgExtra1" id="fileToUploadImgExtra1">	
				</div>

				<div>
					<label>Imagem Extra 2:</label><br>
					<input type="file" name="fileToUploadImgExtra2" id="fileToUploadImgExtra2">	
				</div>
			</div>

			<div class="janela-modal-info-box">
				<div>
					<label>Imagem Extra 3:</label><br>
					<input type="file" name="fileToUploadImgExtra3" id="fileToUploadImgExtra3">	
				</div>
			</div>

			<div class="botao-janela-modal">
				<button class="botao-cadastro-projeto" onclick="cadastrarProjeto()">CADASTRAR PROJETO</button>

				<progress class="progresso-cadastrar-projeto"><h3>CARREGANDO, AGUARDE...</h3></progress>
				
			</div>

		</form>
		

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		
		function janelaAjuda(){
			$('.janela-ajuda-projeto').slideToggle();
		}

		function cadastrarProjeto(){
			$('.botao-cadastro-projeto').css('display', 'none');
			$('.progresso-cadastrar-projeto').css('display', 'block');
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