<?php 
	//ARQUIVO PARA BUSCAR AS INFORMAÇÕES DA NOTIFICAÇÃO
	//E EXIBIR NO BARRA DE NOTIFICAÇÕES

	$idBlocoCalendario = $totalNotificacao[$i]['id_bloco_calendario'];
	$idUsuarioNotificacao = $totalNotificacao[$i]['id_usuario'];

	//BUSCAR ID_BLOCO_CALENDARIO
	$blocoCalendario = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendario'");
	$blocoCalendario->execute();
	$totalBlocoCalendario = $blocoCalendario->fetchAlL();

	//BUSCAR ID_CLIENTE
	$buscaCliente = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = '$idUsuarioNotificacao'");
	$buscaCliente->execute();
	$totalBuscaCliente = $buscaCliente->fetchAlL();

?>