<?php 
	include_once("modelBancoDeDados.php");

	$idSolicitacao = $_GET['id'];
	$nomeCliente = $_GET['cliente'];
	
	$excluirSolicitacao = $pdo->prepare("DELETE FROM solicitacao_cliente WHERE id_solicitacao_cliente = '$idSolicitacao'");

	$excluirSolicitacao->execute();

	echo "<script>document.location='../View/viewSolicitacoesPorCliente.php?cliente=$nomeCliente'</script>";
?>