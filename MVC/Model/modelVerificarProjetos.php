<?php
	//ARQUIVO PARA BUSCAR PROJETOS POR USUARIO

	$verificaProjetosPorUsuario = $pdo->prepare("SELECT * FROM projetos WHERE id_usuario = $idUsuario");
	$verificaProjetosPorUsuario->execute();
	$totalProjetosPorUsuario = $verificaProjetosPorUsuario->fetchAlL(); 
?>