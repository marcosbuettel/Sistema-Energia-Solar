<?php
	//ARQUIVO PARA BUSCAR PROJETOS POR ID

	$verificaProjetosPorUsuario = $pdo->prepare("SELECT * FROM projetos WHERE id_projeto = '$idProjeto'");
	$verificaProjetosPorUsuario->execute();
	$totalProjetosPorUsuario = $verificaProjetosPorUsuario->fetchAlL(); 
?>