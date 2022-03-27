<?php 
	//PÁGINA PARA EDIÇÃO DO CLIENTE
	
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<section class="nav-painel separador">
		
		<ul>		
			<li>Clientes Cadastrados</li>
			<li><a href="#">CADASTRAR NOVO CLIENTE</a></li>
		</ul>

	</section>

	<section class="clientes-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Nome do Cliente</th>
				<th>Calendários Cadastrados</th>
			</tr>
			<?php 
				include_once("../Model/modelClientes.php");

				if(isset($_POST['nome-cliente'])){
					$idCliente = $_GET['id'];
					
					$nomeCliente = $_POST['nome-cliente'];
					

					$editarCliente = $pdo->prepare("UPDATE clientes SET nome_cliente = '$nomeCliente' WHERE id_cliente = '$idCliente'");

					$editarCliente->execute();

					echo "<script>document.location='viewClientes.php'</script>";
				}
				for ($i=0; $i < count($totalClientes) ; $i++){
					$idCliente = $totalClientes[$i]['id_cliente'];				 
			?>

			<tr>
				<td><?php echo $totalClientes[$i]['nome_cliente']?>
					<div class="botao-editaExclui-cliente2 primeira-coluna-tabela">	
						<a href="#"><i class="far fa-edit"></i></a>
						<i class="far fa-trash-alt"></i>
					</div>
				</td>
				<td><?php echo "10"?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-editar">
			<img src="../../images/cancel.png" onclick="fecharJanelaModalEditar()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo cliente</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST">
					<label>Nome do cliente:</label><br>
					<?php 
						$idCliente = $_GET['id'];
						include_once("../Model/modelEditarClientePorId.php");
					?>
					<input type="text" value="<?php echo $totalClientes[0]['nome_cliente']?>" name="nome-cliente">
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
			document.location = "viewClientes.php";
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