<?php 
	$verificaSolicitacoes = $pdo->prepare("SELECT DISTINCT (nome_cliente_solicitacao) FROM solicitacao_cliente");
	$verificaSolicitacoes->execute();
	$totalSolicitacoesPorCliente = $verificaSolicitacoes->fetchAlL(); 
?>