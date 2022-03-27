<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Usuários Cadastrados</li>
			<li><a href="#" onclick="cadastroCliente()">CADASTRAR NOVO USUÁRIO</a></li>
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

	<section class="clientes-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Nome do Usuário</th>
				<th>Senha</th>
				<th>Tipo</th>
			</tr>
			<?php 
				include_once("../Model/modelUsuarios.php");
				for ($i=0; $i < count($totalUsuarios) ; $i++){
					$idUsuario = $totalUsuarios[$i]['id_usuario'];				 
			?>

			<tr>
				<td>
					<?php if($totalUsuarios[$i]['imagem_usuario'] != null){?>	
						<div class="imagem-perfil-usuario" style="background-image: url('<?php echo $totalUsuarios[$i]['imagem_usuario'] ?>'); position: relative; left: 0px"></div>
						
					<?php }else{?>
						<img style="border-radius: 50%; width: 30px; top: 10px;right: 5px; position: relative" src="../../images/profile-black.png">
					<?php }?>
					<?php echo $totalUsuarios[$i]['nome_usuario']?>
					<div class="botao-editaExclui-cliente2 primeira-coluna-tabela">					
						<i onclick="editarUsuario(<?php echo $idUsuario?>)" onmouseover="exibeFuncao('editar', <?php echo $idUsuario?>)" class="far fa-edit"></i>
						<div class="icones-acao" id="editar<?php echo $idUsuario?>">EDITAR</div>
						
						<i onmouseover="exibeFuncao('excluir', <?php echo $idUsuario?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idUsuario?>)">
							<div class="icones-acao" id="excluir<?php echo $idUsuario?>">EXCLUIR</div>
						</i>
					</div>
				</td>
				<td><?php echo $totalUsuarios[$i]['senha_usuario']?></td>
				<td><?php echo $totalUsuarios[$i]['tipo_usuario']?></td>
			</tr>


			<!-- JANELA PRA EDITAR O USUARIO -->
			<div class="janela-modal-cadastro cadastro-usuario" id="janela-edit-usuario<?php echo $idUsuario?>">
				<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
				<div class="header-janela-modal">
					<h2>Cadastro de novo usuário</h2>
				</div>

				<div class="janela-modal-info-container">
					<form method="POST" action="../Model/modelEditarUsuario.php?id=<?php echo $idUsuario?>" enctype="multipart/form-data">		
						
						<div class="janela-modal-info-box">	
							<div>					
								<label>Nome do usuário:</label>								
								
								<div style="display: flex; flex-direction: column">
									<input type="text" placeholder="Nome do usuário" name="nome-usuario" required pattern="[\w]{1,30}" value="<?php echo $totalUsuarios[$i]['nome_usuario']?>">
									<p style="font-size: 10px; margin-top: 5px;">(Apenas letras e números, sem espaços)</p>
								</div>					
							</div>

							<div>
								<label>Senha:</label><br>
								<input type="text" placeholder="Senha" name="senha-usuario" required value="<?php echo $totalUsuarios[$i]['senha_usuario']?>">
							</div>
						</div>	

						<div class="janela-modal-info-box">
							<div>
								<label>Escolha uma das opções:</label><br>
								<input type="radio" name="tipo-pessoa" class="pessoa-fisica">Pessoa Física				
								<input type="radio" name="tipo-pessoa" class="pessoa-juridica">Pessoa Jurídica

								<div class="cpf-usuario">
									<label>CPF:</label><br>
									<input type="text" name="cpf-usuario" placeholder="___.___.___-__" class="frmCpf" value="<?php echo $totalUsuarios[$i]['cpf_cnpj_usuario']?>">
								</div>

								<div class="cnpj-usuario">
									<label>CNPJ:</label><br>
									<input type="text" name="cnpj-usuario" placeholder="__.___.___/____-__" class="frmCnpj" value="<?php echo $totalUsuarios[$i]['cpf_cnpj_usuario']?>">
								</div>
							</div>				
						</div>

						<div class="janela-modal-info-box">
							<div>
								<label>Telefone:</label><br>
								<input type="text" name="telefone-usuario" class="frmTel" placeholder="(  ) _____-____" value="<?php echo $totalUsuarios[$i]['telefone_usuario']?>">
							</div>

							<div>
								<label>Email:</label><br>
								<input type="text" name="email-usuario" value="<?php echo $totalUsuarios[$i]['email_usuario']?>">
							</div>
						</div>

						<div class="janela-modal-info-box">
							<div>
								<label>Cidade:</label><br>
								<input type="text" name="cidade-usuario" value="<?php echo $totalUsuarios[$i]['cidade_usuario']?>">
							</div>

							<div>
								<label>Estado:</label><br>
								<input type="text" name="estado-usuario" value="<?php echo $totalUsuarios[$i]['estado_usuario']?>">
							</div>
						</div>
						
						<div class="janela-modal-info-box">
							<div>
								<label>Foto de perfil:</label><br>					
								<input type="file" name="fileToUpload2" id="fileToUpload2">			
							</div>

							<?php if($totalUsuarios[$i]['imagem_usuario'] != null){?>
								<div class="imagem-perfil-usuario-edit" style="background-image: url('<?php echo $totalUsuarios[$i]['imagem_usuario'] ?>')"></div>
							<?php }else{?>
								<img src="../../images/profile-black.png">
							<?php }?>
						</div>

						<div class="botao-janela-modal">
							<button>CONFIRMAR</button>
						</div>
					</form>
				</div>
			</div>
			<!-- FIM DA JANELA PRA EDITAR O USUARIO -->
		
			<?php } ?><!-- FIM DO FOR 'i' CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro cadastro-usuario">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo usuário</h2>
			</div>

			<div class="janela-modal-info-container">
				<form method="POST" action="../Model/modelCadastroUsuario.php" enctype="multipart/form-data">		
					
					<div class="janela-modal-info-box">	
						<div>					
							<label>Nome do usuário:</label>								
							
							<div style="display: flex; flex-direction: column">
								<input type="text" placeholder="Nome do usuário" name="nome-usuario" required pattern="[\w]{1,30}">
								<p style="font-size: 10px; margin-top: 5px;">(Apenas letras e números, sem espaços)</p>
							</div>					
						</div>

						<div>
							<label>Senha:</label><br>
							<input type="text" placeholder="Senha" name="senha-usuario" required>
						</div>
					</div>	

					<div class="janela-modal-info-box">
						<div>
							<label>Escolha uma das opções:</label><br>
							<input type="radio" name="tipo-pessoa" class="pessoa-fisica">Pessoa Física				
							<input type="radio" name="tipo-pessoa" class="pessoa-juridica">Pessoa Jurídica

							<div class="cpf-usuario">
								<label>CPF:</label><br>
								<input type="text" name="cpf-usuario" placeholder="___.___.___-__" class="frmCpf">
							</div>

							<div class="cnpj-usuario">
								<label>CNPJ:</label><br>
								<input type="text" name="cnpj-usuario" placeholder="__.___.___/____-__" class="frmCnpj">
							</div>
						</div>				
					</div>

					<div class="janela-modal-info-box">
						<div>
							<label>Telefone:</label><br>
							<input type="text" name="telefone-usuario" class="frmTel" placeholder="(  ) _____-____">
						</div>

						<div>
							<label>Email:</label><br>
							<input type="text" name="email-usuario">
						</div>
					</div>

					<div class="janela-modal-info-box">
						<div>
							<label>Cidade:</label><br>
							<input type="text" name="cidade-usuario">
						</div>

						<div>
							<label>Estado:</label><br>
							<input type="text" name="estado-usuario">
						</div>
					</div>
					
					<div class="janela-modal-info-box">
						<div>
							<label>Foto de perfil:</label><br>					
							<input type="file" name="fileToUpload2" id="fileToUpload2">			
						</div>
						<img src="../../images/profile-black.png">
					</div>

					<div class="botao-janela-modal">
						<button>CONFIRMAR</button>
					</div>
				</form>
			</div>
		</div>	

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		
		function cadastroCliente(){
			$('.janela-modal-cadastro').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function editarUsuario(id){
			$('#janela-edit-usuario'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


		function fecharJanelaModalEditar(){
			$('.janela-modal-editar').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function confirmarExcluir(idUsuario){
			var idUsuario = idUsuario;
	        var doc; 
	        var result = confirm("Confirmar exclusão do usuário?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirUsuario.php?id="+idUsuario; 
	        } else { 
	            doc = "viewUsuarios.php"; 
	        } 

	        window.location.replace(doc);
		}

		function exibeFuncao(funcao, id){
			if(funcao == 'view'){
				$('#view'+id).css('display', 'block');
			}else if(funcao == 'arquivar'){
				$('#arquivar'+id).css('display', 'block');
			}else if(funcao == 'editar'){
				$('#editar'+id).css('display', 'block');
			}else{
				$('#excluir'+id).css('display', 'block');
			}	
		}

		$('.botao-editaExclui-cliente2 i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});

		$('.pessoa-fisica').click(function(){
			$('.cpf-usuario').css('display', 'block');
			$('.cnpj-usuario').css('display', 'none');
		});

		$('.pessoa-juridica').click(function(){
			$('.cpf-usuario').css('display', 'none');
			$('.cnpj-usuario').css('display', 'block');
		});


		//MÁSCARAS PARA CPF, CNPJ E TELEFONE
		$(".frmCpf").inputmask({
		  mask: "999.999.999-99"
		});

		$(".frmCnpj").inputmask({
		  mask: "99.999.999/9999-99"
		});

		$(".frmTel").inputmask({
		  mask: "(99)99999-9999"
		});

	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>