<?php
	//ARQUIVO PARA BUSCAR PROJETOS POR USUARIO
	
	if($filtro == 'andamento'){
		$verificaProjetosPorUsuario = $pdo->prepare("SELECT * FROM projetos WHERE id_usuario = $idUsuario AND (status_projeto = 'pagamento-aprovado' OR status_projeto = 'analise')");
	}else if($filtro == 'pendencias'){

		$verificaProjetosPorUsuario = $pdo->prepare("SELECT * FROM projetos WHERE id_usuario = $idUsuario AND (status_projeto = 'reprovado' OR status_projeto = 'aguardando-pagamento')");
	}else{
		$verificaProjetosPorUsuario = $pdo->prepare("SELECT * FROM projetos WHERE id_usuario = $idUsuario AND status_projeto = '$filtro'");
	}

	$verificaProjetosPorUsuario->execute();
	$totalProjetosPorUsuario = $verificaProjetosPorUsuario->fetchAlL(); 
?>