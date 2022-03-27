<?php 
	//ARQUIVO PARA EXCLUIR O CLIENTE

	include_once("modelBancoDeDados.php");

	$idCliente = $_GET['id'];
	
	$excluirCliente = $pdo->prepare("DELETE FROM clientes WHERE id_cliente = '$idCliente'");

	$excluirCliente->execute();

	echo "<script>document.location='../View/viewClientes.php'</script>";

?>