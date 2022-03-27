<?php 
	//ARQUIVO PARA CADASTRO DE CLIENTES
	include_once("modelBancoDeDados.php");

	$nomeCliente = $_GET['nome-cliente'];

	$cadastrarCliente = $pdo->prepare("INSERT INTO clientes (nome_cliente) VALUES ('$nomeCliente')");

	$cadastrarCliente->execute();

	echo "<script>document.location='../View/viewClientes.php'</script>";
?>