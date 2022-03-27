<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelVerificarSolicitacoesPorCliente.php");	

?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Solicitações Cadastradas</li>
			<li id="drag"><a href="#" onclick="cadastroSolicitacao()">CADASTRAR NOVA SOLICITAÇÃO</a></li>
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Cliente</th>
				<th>Solicitações Abertas</th>
				<th>Atrasadas</th>
			</tr>
			<?php 
				
				for ($i=0; $i < count($totalSolicitacoesPorCliente) ; $i++){
					$nomeCliente = $totalSolicitacoesPorCliente[$i]['nome_cliente_solicitacao']; 
			?>

			<!-- CONDIÇÃO PARA VER APENAS OS CALENDARIOS QUE AINDA
				NÃO FORAM ARQUIVADOS
				TAMBÉM SÃO SEPARADOS OS CALENDÁRIOS QUE IRÃO 
				APARECER SOMENTE NA PÁGINA DE 'GERENCIAR PRAZOS' -->

			<tr>
				<!-- CONDIÇÃO PARA APARECER OS BOTÕES DE EDITAR E
					EXCLUIR O CALENDÁRIO APENAS PARA OS USUARIOS
					'ADM' E 'MASTER' -->

				<td style="text-align: left; padding-left: 40px"><a href="viewSolicitacoesPorCliente.php?cliente=<?php echo $nomeCliente?>"><i class="far fa-eye" style="margin-right: 10px"></i><?php echo $totalSolicitacoesPorCliente[$i]['nome_cliente_solicitacao']?></a></td>

				<?php 
					$nomeCliente = $totalSolicitacoesPorCliente[$i]['nome_cliente_solicitacao'];

					include('../Model/modelVerificaSolicitacaoAberta.php');

					//tentar pegar pela data dos prazos pra ver
					//ver a questão de solicitações atrasadas
				?>

				<td><?php echo count($totalSolicitacoesAbertas)?></td>

				<?php include('../Controller/controllerSolicitacaoAtrasada.php');?>

				<?php if($solicitacoesAtrasadas == 0){?>
				<td><?php echo $solicitacoesAtrasadas?></td>
				<?php }else{?>
				<td><?php echo $solicitacoesAtrasadas?><i class="fas fa-exclamation-circle" style="color: red; margin-left: 2px"></i></td>
				<?php }?>	
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<div class="janela-modal-cadastro">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
		<div class="header-janela-modal">
			<h2>Cadastrar solicitação:</h2>
		</div>

		<div class="info-cadastro-cliente">
			<form method="POST" action="../Model/modelCadastroSolicitacaoAdm.php" enctype="multipart/form-data">

				<div class="form-box-cliente">
					
					<label>Título:</label><br>
					<input type="text" placeholder="Título" name="titulo-solicitacao" style="text-align: center; width: 200px"><br>	

					<label>Cliente:</label><br>
					<select name="nome-cliente">
						<option><?php echo ' '?></option>
						<?php 
							include_once("../Model/modelClientes.php");
							for($i = 0; $i < count($totalClientes); $i++){
						?>
						<option value="<?php echo $totalClientes[$i]['nome_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
						<?php }?>
					</select>
					<br><br>				

					<label>Tipo:</label><br><br>

					<div class="opcoes-solicitacao-cliente">
						<input type="radio" value="web" name="tipo-solicitacao" required>WEB
						<input type="radio" value="midiasocial" name="tipo-solicitacao" required>Midia Social
						<input type="radio" value="outdoor" name="tipo-solicitacao" required>Outdoor
						<input type="radio" value="folder" name="tipo-solicitacao" required>Folder
						<input type="radio" value="outro" name="tipo-solicitacao" required>Outro
					</div>

					<label>Descrição:</label><br><br>
					<textarea name="descricao-solicitacao"></textarea>
					<br><br>
					<label>Informe o prazo:</label><br>
					<input type="date" name="prazo-solicitacao">
				</div>

				<br>

				<!--<div class="anexar-foto">
					<input type="checkbox" name="anexar-foto" value="1" onclick="enviarFoto()"> ANEXAR FOTO?
					<br>
					<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
				</div>-->
				
				<button>CONFIRMAR</button>
			</form>
		</div>
	</div>

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
</script>
<?php }?>