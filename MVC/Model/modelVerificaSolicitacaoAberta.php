<?php 
	$verificaSolicitacoesAbertas = $pdo->prepare("SELECT * FROM solicitacao_cliente WHERE nome_cliente_solicitacao = '$nomeCliente' AND status_solicitacao_cliente != 'finalizado' ORDER BY data_modificacao_solicitacao_cliente");
	$verificaSolicitacoesAbertas->execute();
	$totalSolicitacoesAbertas = $verificaSolicitacoesAbertas->fetchAlL(); 


?>