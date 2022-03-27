<?php 
	//ARQUIVO PARA CADASTRAR NOVA NOTIFICAÇÕES

	$procurarTipoUsuario = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = '$idUsuarioLogado'");
	$procurarTipoUsuario->execute();
	$totalProcurarTipoUsuario = $procurarTipoUsuario->fetchAlL(); 

	if($totalProcurarTipoUsuario[0]['tipo_usuario'] == 'leitor'){
		$idUsuario = '1';
	}

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (nome_projeto_notificacao, id_remetente, id_destinatario, tipo_notificacao, data_notificacao) VALUES ('$nomeProjeto', '$idUsuarioLogado','$idUsuario', '$tipoNotificacao', '$dataAtual')");
	$novaNotificacao->execute();
?>