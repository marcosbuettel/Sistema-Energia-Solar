<?php
	//ARQUIVO PARA BUSCAR OS CLIENTES

	$verificaNotificacao = $pdo->prepare("SELECT * FROM notificacao WHERE id_destinatario = '$idUsuarioLogado' ORDER BY id_notificacao DESC");
	$verificaNotificacao->execute();
	$totalNotificacao = $verificaNotificacao->fetchAlL(); 

	
?>