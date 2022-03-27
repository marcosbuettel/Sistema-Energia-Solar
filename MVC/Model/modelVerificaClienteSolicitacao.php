<?php 
	session_start();
	include_once("modelBancoDeDados.php");

	$idCliente = $_GET['id'];
	$idNotificacaoAtiva = $_GET['idN'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	$verificaClienteSolicitacao = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = $idCliente");

	$verificaClienteSolicitacao->execute();
	$totalClienteSolicitacao = $verificaClienteSolicitacao->fetchAlL();

	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = 0 WHERE id_usuario = $idUsuarioLogado AND id_notificacao = $idNotificacaoAtiva");
	$notificacaoDesativada->execute();

	$nomeCliente = $totalClienteSolicitacao[0]['nome_cliente'];

	echo "<script>document.location = '../View/viewSolicitacoesPorCliente.php?cliente=$nomeCliente'</script>";

?>