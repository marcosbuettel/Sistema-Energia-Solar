<?php 
	//ARQUIVO PARA COLOCAR A NOTIFICAÇÃO COMO VISTA
	//QUANDO ELA FOR CLICADA PELO USUARIO

	
	include_once("modelBancoDeDados.php");

	$idUsuarioLogado = $_GET['id'];

	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao SET vista_notificacao = 0 WHERE id_destinatario = $idUsuarioLogado");
	$notificacaoDesativada->execute();

	echo "<script>document.location='../View/viewPainelAdministrativo.php'</script>";
?>