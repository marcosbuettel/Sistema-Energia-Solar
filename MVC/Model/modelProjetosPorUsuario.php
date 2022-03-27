<?php
	//ARQUIVO PARA BUSCAR TODOS OS PROJETOS DO USUARIO

	$verificaProjetos = $pdo->prepare("SELECT * FROM projetos WHERE id_usuario = '$idUsuarioLogado'");
	$verificaProjetos->execute();
	$totalProjetosPorUsuario = $verificaProjetos->fetchAlL(); 
?>