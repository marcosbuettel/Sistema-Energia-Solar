<?php
	//ARQUIVO PARA BUSCAR TODOS OS USUÁRIOS
	//ORDENANDO POR NÚMERO DE PROJETOS
	
	$verificaUsuarios = $pdo->prepare("SELECT * FROM usuarios INNER JOIN projetos ON usuarios.id_usuario = projetos.id_usuario GROUP BY usuarios.id_usuario ORDER BY COUNT(projetos.id_projeto) DESC");


	//$verificaUsuarios = $pdo->prepare("SELECT * FROM usuarios");
	$verificaUsuarios->execute();
	$totalUsuarios = $verificaUsuarios->fetchAlL(); 
?>