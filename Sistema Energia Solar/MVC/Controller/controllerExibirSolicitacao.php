<?php 
	//COLOCAR UMA DIV SÓ PRA EXIBIR AS INFORMAÇÕES 
	//DA SOLICITAÇÃO, MAS PEGAR OS PARÂMETROS DA FUNÇÃO
	//PRA VER QUAL INFORMAÇÃO SERÁ MOSTRADA

?>
<div class="bloco-solicitacao">
	<div style="display: flex; justify-content: space-between;">
		<h3><?php echo $totalSolicitacoes[$j]['titulo_solicitacao_cliente']?></h3>
		<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
			<a href="../Model/modelExcluirSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&cliente=<?php echo $nomeCliente?>"><i onmouseover="removerSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"class="far fa-trash-alt" class="lixeira"></i></a>
			<div class="remover-solicitacao" id="<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<p>REMOVER SOLICITAÇÃO</p>
			</div>
		<?php }?>
	</div>
	<h3>Tipo: <?php echo ucfirst($totalSolicitacoes[$j]['tipo_solicitacao_cliente'])?></h3>
	<h3><?php echo $totalSolicitacoes[$j]['descricao_solicitacao_cliente']?></h3>

	<div class="bloco-solicitacao-footer">
		<div class="bloco-solicitacao-prazo">
			
			<h2>Prazo: <?php echo $prazoFormatado?></h2>
		</div>
		<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
		
			<i class="fas fa-ellipsis-v" onmouseover="exibirTrocaStatus(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"></i>

			<div class="modificar-status-solicitacao" id="status<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<ul>
					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=0&cliente=<?php echo $nomeCliente?>">
						<li>SOLICITADO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=1&cliente=<?php echo $nomeCliente?>">
						<li>ANDAMENTO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=2&cliente=<?php echo $nomeCliente?>">
						<li>AGUARDANDO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=3&cliente=<?php echo $nomeCliente?>">
						<li>APROVADO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=4&cliente=<?php echo $nomeCliente?>">
						<li>POSTAR</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=5&cliente=<?php echo $nomeCliente?>">
						<li>FINALIZADO</li>
					</a>
				</ul>
			</div>








		<!--<div class="arrow-mudar-coluna">
			<?php if($i != 0 && $i != 5){?>
				<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=<?php echo $i?>&direcao=left&cliente=<?php echo $nomeCliente?>">
					<i class="fas fa-chevron-circle-left"></i>
				</a>
			<?php }?>

			<?php if($i != 5){?>
				<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=<?php echo $i?>&direcao=right&cliente=<?php echo $nomeCliente?>">
					<i class="fas fa-chevron-circle-right"></i>
				</a>
			<?php }?>
		</div>-->
		<?php }?>
	</div>
</div><!-- FIM DO BLOCO SOLICITACAO -->
	