<?php 
	//ARQUIVO PARA BUSCAR AS NOTIFICAÇÕES POR USUÁRIO
	//QUE AINDA NÃO FORAM VISUALIZADAS
	//ESTÁ BUSCANDO APENAS AS NOTIFICAÇÕES DO USUARIO LOGADO

	$contadorNotificacaoAtiva = $pdo->prepare("SELECT * FROM notificacao WHERE vista_notificacao = 1 AND id_destinatario = '$idUsuarioLogado' ORDER BY id_notificacao DESC");
	$contadorNotificacaoAtiva->execute();
	$totalContadorNotificacaoAtiva = $contadorNotificacaoAtiva->fetchAlL(); 

	$verificaNotificacaoAtiva = false;

	for($r = 0; $r < count($totalContadorNotificacaoAtiva); $r++){
		if($totalContadorNotificacaoAtiva[$r]['vista_notificacao'] == 1){
			$verificaNotificacaoAtiva = true;
		}
	}

?>