<?php
	//ARQUIVO PARA BUSCAR O CLIENTE QUE ESTÁ LOGADO NO SISTEMA

	$nomeCliente = $_SESSION['nome-cliente'];

	$verificaBlocoCalendario = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$verificaBlocoCalendario->execute();
	$totalCalendarios = $verificaBlocoCalendario->fetchAlL(); 
?>