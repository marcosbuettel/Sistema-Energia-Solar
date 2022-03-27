<?php
	//ARQUIVO PARA BUSCAR AS SOLICITAÇÕES DO CLIENTE SOLICITADO

	$verificaSolicitacoes = $pdo->prepare("SELECT * FROM solicitacao_cliente WHERE nome_cliente_solicitacao = '$nomeCliente' ORDER BY prazo_solicitacao_cliente");
	$verificaSolicitacoes->execute();
	$totalSolicitacoes = $verificaSolicitacoes->fetchAlL(); 
?>