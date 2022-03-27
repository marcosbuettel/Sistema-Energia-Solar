<?php
	//ARQUIVO PARA BUSCAR O CLIENTE PELO NOME PASSADO

	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$clienteCalendario'");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>