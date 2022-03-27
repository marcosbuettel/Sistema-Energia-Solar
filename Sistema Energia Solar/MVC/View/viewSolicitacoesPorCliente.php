<?php 
	//PÁGINA PARA O CLIENTE PODER ACOMPANHAR SUAS SOLICITAÇÕES

	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	
	$nomeCliente = $_GET['cliente'];	

	include_once("../Model/modelVerificarSolicitacoes.php");

	if(count($totalSolicitacoes) == 0){
	
?>

<section class="head-quadro-solicitacao">
	<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<a href="viewSolicitacoes.php">
	<?php }else{?>	
	<a href="viewPainelAdministrativo.php">
	<?php }?>
		<div class="voltar-solicitacao">
			<i class="fas fa-arrow-circle-left" style="font-size: 22px; color: #2D323E; margin-top: 2px; margin-right: 5px"></i>
			<h2 style="color: #2D323E">VOLTAR</h2>
		</div>
	</a>

	<div>
		<i class="fas fa-clipboard-list"></i>
		<span><?php echo $nomeCliente?></span>
	</div>

</section><!-- FIM HEAD QUADRO SOLICITACAO -->

<div class="separador">
	<h2 style="margin-left: 20px">Sem solicitações registradas.</h2>
</div>

<?php }else{?>

<?php 

	if(rtrim($totalSolicitacoes[0]['nome_cliente_solicitacao']) == $nomeCliente or $_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
?>

<section class="head-quadro-solicitacao">
	<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<a href="viewSolicitacoes.php">
	<?php }else{?>	
	<a href="viewPainelAdministrativo.php">
	<?php }?>
		<div class="voltar-solicitacao">
			<i class="fas fa-arrow-circle-left" style="font-size: 22px; color: #2D323E; margin-top: 2px; margin-right: 5px"></i>
			<h2 style="color: #2D323E">VOLTAR</h2>
		</div>
	</a>

	<div>
		<i class="fas fa-clipboard-list"></i>
		<span><?php echo $nomeCliente?></span>
	</div>

</section><!-- FIM HEAD QUADRO SOLICITACAO -->

<section class="quadro-solicitacao-wrapper">
	<div class="quadro-solicitacao">
	<?php 
		//AS SOLICITAÇÕES IRÃO FICAR NAS COLUNAS QUE ELAS PERTENCEM
		$fasesSolicitacao = array('SOLICITAÇÕES', 'EM ANDAMENTO', 'AGUARDANDO APROVAÇÃO', 'APROVADO', 'POSTAR', 'FINALIZADO');
		for($i = 0; $i < 6; $i++){ 	
	?> 
		<div class="colunas-quadro-solicitacao" id="drop<?php echo $i?>">
			<h2><?php echo $fasesSolicitacao[$i]?></h2>
			<?php 
				for($j = 0; $j < count($totalSolicitacoes); $j++){
					$prazo = explode('-', $totalSolicitacoes[$j]['prazo_solicitacao_cliente']);

					$prazoFormatado = $prazo[2].'/'.$prazo[1].'/'.$prazo[0];		
			?>

			<!-- AQUI COMEÇAM AS CONDIÇÕES PARA VERIFICAR QUAL O STATUS QUE A SOLICITAÇÃO SE ENCONTRA, PARA PODER ENCAIXÁ-LA NA SUA COLUNA 
				ESTOU USANDO A VARIÁVEL '$i' PARA VER A POSIÇÃO
			ATUAL DA COLUNA -->
			
			<!-- TALVEZ COLOCAR ESSES IFS NUMA FUNÇÃO SEPARADA -->
			<?php if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'solicitado' && $i == 0){			

				include("../Controller/controllerExibirSolicitacao.php");
			?>			

			<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'producao' && $i == 1){
				include("../Controller/controllerExibirSolicitacao.php");
			?>			

			<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'aguardando' && $i == 2){
				include("../Controller/controllerExibirSolicitacao.php");
			?>

			<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'aprovado' && $i == 3){
				include("../Controller/controllerExibirSolicitacao.php");
			?>

			<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'postar' && $i == 4){
				include("../Controller/controllerExibirSolicitacao.php");
			?>

		<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'finalizado' && $i == 5){
			include("../Controller/controllerExibirSolicitacao.php");
		?>				
			<?php }?><!-- FIM DO IF -->

			<?php }?><!-- FIM DO FOR j -->
		</div>
	<?php }?><!-- FIM DO FOR i -->
	</div>
</section><!-- FIM QUADRO SOLICITACAO -->

<?php }else{?>
	<div class="separador">
		<h2>Desculpe, página não encontrada.</h2>
	</div>
<?php }}?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<script type="text/javascript">

	//FUNÇÃO PARA EXIBIR UMA CAIXA ESCRITO "REMOVER"
	//QUANDO PASSAR O MOUSE POR CIMA DO ÍCONE DA LIXEIRA
	function removerSolicitacao(idRemover){
		$('#'+idRemover).css('display', 'block');
	}

	//FUNÇÃO PARA FAZER SUMIR A MESMA CAIXA ESCRITO "REMOVER"
	//QUANDO TIRAR O MOUSE DE CIMA DO ÍCONE DA "LIXEIRA"
	$('.bloco-solicitacao i').mouseleave(function(){
		$('.remover-solicitacao').css('display', 'none');	
	})


	//FUNÇÕES PARA ARRASTAR E SOLTAR E TROCAR O STATUS DA TAREFA

	/*function arrastarBox(id){
		$('#arrastar'+id).draggable();
	}

	$('#drop0').droppable({
		drop: function(event, ui){
			$(this).css('background-color', 'black');
		} 

	});*/


	function exibirTrocaStatus(id){
		$('#status'+id).css('display', 'block');
	}

	$('.modificar-status-solicitacao').mouseleave(function(){
		$('.modificar-status-solicitacao').css('display', 'none');
	});
	
</script>


<?php include_once("../../body/footerCalendario.php");?>