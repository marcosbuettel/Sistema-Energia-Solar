<?php 
	//ARQUIVO PARA EDIÇÃO DOS CLIENTES

	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = '$idCliente'");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>