<?php
	//ARQUIVO PARA BUSCAR OS CLIENTES

	$verificaClientes = $pdo->prepare("SELECT * FROM clientes");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>