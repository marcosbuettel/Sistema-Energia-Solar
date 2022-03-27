<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Controller/controllerFormatarData.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelProjetos.php");	
	include_once("../Model/modelUsuarios.php");	

	$idUsuarioProjeto = $_GET['idU'];
	$idProjeto = $_GET['idP'];

	include_once("../Model/modelComentariosProjeto.php");
	include_once("../Model/modelProjetoPorId.php");
?>

<?php if($_SESSION['tipo-usuario'] == 'master' or $_SESSION['id-usuario-logado'] == $idUsuarioProjeto){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Dados do Projeto: <?php echo $totalProjetosPorUsuario[0]['nome_projeto']?></li>

			<?php if($_SESSION['tipo-usuario'] == 'master'){?>
			<li><a href="viewProjetos.php" onclick="cadastroCliente()"><i class="fas fa-chevron-circle-left"></i> VOLTAR </a></li>
			<?php }else{?>
			<li><a href="viewProjetosPorUsuario.php" onclick="cadastroCliente()"><i class="fas fa-chevron-circle-left"></i> VOLTAR </a></li>
			<?php }?>
		</ul>

	</section>

	<section class="botao-aprovar-reprovar">
		<?php if($_SESSION['tipo-usuario'] == 'master'){?>

		<?php if($totalProjetosPorUsuario[0]['status_projeto'] == 'aguardando'){?>
		<div class="botao-janela-modal">
			<a href="../Model/modelAprovarDocumentosProjeto.php?idP=<?php echo $idProjeto?>"><button><i class="fas fa-check-circle"></i> CONFIRMAR DOCUMENTOS</button></a>
		</div>		

		<div class="botao-janela-modal" style="margin-left: 20px">
			<button onclick="reprovarProjeto(<?php echo $idProjeto?>)"><i class="fas fa-times-circle"></i> PENDÊNCIAS</button>
		</div>
		<?php }?>

		<?php }?>
		
	</section>

	<section class="projeto-wrapper separador dados-projetos">	

		<div class="img-visualizar-projeto-wrapper">
			<?php 
				
				$imagensProjeto = array('Conta de Energia', 'Procuração Assinada', 'Foto Ampla do Padrão', 'Foto do Disjuntor', 'Localização', 'Descrição dos Equipamentos', 'Extra 1', 'Extra 2', 'Extra 3', 'Projeto Elétrico','Parecer de Acesso Aprovado');

				$imagensProjetoBanco = array('img_conta_projeto', 'img_procuracao_projeto', 'img_padrao_projeto', 'img_disjuntor_projeto', 'img_locacao_projeto', 'img_descricao_projeto', 'img_extra1_projeto', 'img_extra2_projeto', 'img_extra3_projeto', 'img_diagrama_projeto','img_parecer_projeto');

				$idInputFile = array('Conta', 'Procuracao', 'Padrao', 'Disjuntor', 'Locacao', 'Descricao', 'ImgExtra1', 'ImgExtra2', 'ImgExtra3', 'ImgDiagrama','ImgParecer');
			?>

			<?php for($i = 0; $i < count($imagensProjeto); $i++){?>

			<div class="img-visualizar-projeto">
				<div>
					<div>
						<p><?php echo $imagensProjeto[$i].':';?></p>

						<?php if($i == 0){?>
						<form method="POST" action="../Model/modelEditarImagemConta.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">					
						<?php }else if($i == 1){?>
						<form method="POST" action="../Model/modelEditarImagemProcuracao.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">	
						<?php }else if($i == 2){?>
						<form method="POST" action="../Model/modelEditarImagemPadrao.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">				
						<?php }else if($i == 3){?>
						<form method="POST" action="../Model/modelEditarImagemDisjuntor.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">		
						<?php }else if($i == 4){?>
						<form method="POST" action="../Model/modelEditarImagemLocacao.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">		
						<?php }else if($i == 5){?>
						<form method="POST" action="../Model/modelEditarImagemDescricao.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">	
						<?php }else if($i == 6){?>
						<form method="POST" action="../Model/modelEditarImgExtra1.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">
						<?php }else if($i == 7){?>
						<form method="POST" action="../Model/modelEditarImgExtra2.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">
						<?php }else if($i == 8){?>
						<form method="POST" action="../Model/modelEditarImgExtra3.php?idP=<?php echo $idProjeto?>" enctype="multipart/form-data">		
						<?php }?>

						<?php if($totalProjetosPorUsuario[0]['status_projeto'] == 'reprovado'){ ?>	
							<?php if($i != 9 && $i != 10) {?>
							<input type="file" name="fileToUpload<?php echo $idInputFile[$i]?>" id="fileToUpload<?php echo $idInputFile[$i]?>" value="TROCAR IMAGEM"><br>
							<button>ENVIAR</button>
							<?php } ?>
						<?php } ?>
						</form>
					</div>

					<!-- 
						NESSA PARTE ESTOU VERIFICANDO O TIPO DE ARQUIVO QUE ESTÁ
						SALVO NO BANCO DE DADOS
						SE FOR UM ARQUIVO TIPO PDF, IRÁ MOSTRAR APENAS
						O NOME DO ARQUIVO, SENÃO, VAI MOSTRAR A IMAGEM
					-->

					<?php 

						if(!empty($totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]])){


						$arquivo = explode('.', $totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]]);

						$nomeArquivo = explode('/', $totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]]);
						
						if(strtoupper($arquivo[count($arquivo)-1]) == 'PDF'){
						

					?>
					<br>
					<h3>ARQUIVO PDF: <br><?php echo $nomeArquivo[5] ?></h3>
					<br>
					<a href="<?php echo $totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]] ?>" style="background-color: black; color: white; padding: 5px 10px; font-weight: bold">BAIXAR ARQUIVO</a>
					<img src="../../images/pdf.png">
					<?php }else{ ?>
						<br>
					<a href="<?php echo $totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]] ?>" style="background-color: black; color: white; padding: 5px 10px; font-weight: bold">BAIXAR ARQUIVO</a>
					<img src="<?php echo $totalProjetosPorUsuario[0][$imagensProjetoBanco[$i]] ?>">

					<?php } }?>
				</div>
			</div>

			<?php }?>
		</div>

		<div class="comentarios-projeto-wrapper ">
			<div class="visualizar-projeto-comentario">				
			
				<div class="comentarios-projeto-header">
					<p>Comentários:</p>
				</div>

				<?php for($j = 0; $j < count($totalComentarios); $j++){?>
				<div class="comentarios-projeto-box">
					<h4><?php echo strtoupper($totalComentarios[$j]['nome_usuario_comentario_projeto'])?></h4>
					<p><b>Data: </b><?php echo formatarData($totalComentarios[$j]['data_comentario_projeto'])?></p>
					<p style="margin-top: 10px"><?php echo $totalComentarios[$j]['descricao_comentario_projeto']?></p>
				</div>
				<?php }?>

			</div>			
			
			<form method="POST" action="../Model/modelCadastrarComentarioProjeto.php?idP=<?php echo $idProjeto?>&tipo=1">		
				
				<div class="janela-modal-comentario-projeto janela-modal-comentario-projeto-wrapper">	
					<textarea placeholder="Enviar comentário..." name="comentario-projeto" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1'></textarea>
					<button><i class="fas fa-paper-plane"></i></button>
				</div>
			</form>			

		</div>
		

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		function abrirListaProjetos(id){
			$('#lista-projetos'+id).slideToggle();
		}

		function reprovarProjeto(id){
			document.location = '../Model/modelReprovarProjeto.php?idP='+id+'&tipo=0';
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