<?php
	//ARQUIVO PARA BUSCAR TODOS OS USUÁRIOS

	$verificaUsuarios = $pdo->prepare("SELECT * FROM usuarios");
	$verificaUsuarios->execute();
	$totalUsuarios = $verificaUsuarios->fetchAlL(); 
?>