<?php
	//ARQUIVO PARA BUSCAR AS SOLICITAÇÕES POR ID

	$verificaSolicitacoesPorId = $pdo->prepare("SELECT * FROM solicitacao_cliente WHERE id_solicitacao_cliente = '$idSolicitacao'");
	$verificaSolicitacoesPorId->execute();
	$totalSolicitacoesPorId = $verificaSolicitacoes->fetchAlL(); 
?>