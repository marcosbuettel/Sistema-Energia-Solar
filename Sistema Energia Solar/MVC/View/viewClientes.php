<?php 
	//PÁGINA PARA VER TODOS OS CLIENTES CADASTRADOS NO SISTEMA
	
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Clientes</li>
			<!--<li><a href="#" onclick="cadastroCliente()">CADASTRAR NOVO CLIENTE</a></li>-->
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

	<section class="clientes-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Nome do Cliente</th>
				<th>Calendários Cadastrados</th>
			</tr>
			<?php 
				include_once("../Model/modelClientes.php");
				for ($i=0; $i < count($totalClientes) ; $i++){
					$idCliente = $totalClientes[$i]['id_cliente'];			 
			?>

			<tr>
				<td><?php echo $totalClientes[$i]['nome_cliente']?>
					<div class="botao-editaExclui-cliente2 primeira-coluna-tabela">					
						<a href="viewEditarCliente.php?id=<?php echo $idCliente?>"><i onmouseover="exibeFuncao('editar', <?php echo $idCliente?>)" class="far fa-edit"></i>
							<div class="icones-acao" id="editar<?php echo $idCliente?>">EDITAR</div>
						</a>
						<i onmouseover="exibeFuncao('excluir', <?php echo $idCliente?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idCliente?>)">
							<div class="icones-acao" id="excluir<?php echo $idCliente?>">EXCLUIR</div>
						</i>
					</div>
				</td>

				<?php 
					$idCliente = $totalClientes[$i]['id_cliente'];
					include("../Model/modelClienteCalendario.php");
				?>

				<td><?php echo count($totalClienteCalendario)?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo cliente</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="GET" action="../Model/modelCadastroCliente.php">
					<label>Nome do cliente:</label><br>
					<input type="text" placeholder="Nome do cliente" name="nome-cliente" required>
					<button>CONFIRMAR</button>
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

		function editarCliente(){
			$('.janela-modal-editar').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


		function fecharJanelaModalEditar(){
			$('.janela-modal-editar').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function confirmarExcluir(idCliente){
			var idCliente = idCliente;
	        var doc; 
	        var result = confirm("Confirmar exclusão do cliente?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirCliente.php?id="+idCliente; 
	        } else { 
	            doc = "viewClientes.php"; 
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

	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>