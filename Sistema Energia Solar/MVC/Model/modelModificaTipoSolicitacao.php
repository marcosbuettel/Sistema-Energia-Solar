<?php 
	//ARQUIVO PARA MODIFICAR A COLUNA QUE A SOLICITAÇÃO 
	//SE ENCONTRA. SERVE PARA VERIFICAR EM QUAL COLUNA
	//ELA ESTÁ E DEPENDENDO DO QUE FOR CLICADO, IR PARA
	//DIREITA OU PARA ESQUERDA E ENTÃO MUDAR NO BANCO DE DADOS
	//A COLUNA NOVA

	session_start();
	
	include_once("modelBancoDeDados.php");

	$dataModificacao = date("Y-m-d H:i:s");  

	$tipoSolicitacao = array('solicitado', 'producao', 'aguardando', 'aprovado', 'postar', 'finalizado');

	if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
		$nomeCliente = $_GET['cliente'];	
	}else{
		$nomeCliente = $_SESSION['nome-cliente'];	
	}

	
	$coluna = $_GET['tipo'];
	$idSolicitacao = $_GET['id'];
	//$direcao = $_GET['direcao'];
	
	if($coluna == 0){
		$tipo = $tipoSolicitacao[0];
	}else if($coluna == 1){		
		$tipo = $tipoSolicitacao[1];
	}else if($coluna == 2){
		$tipo = $tipoSolicitacao[2];
	}else if($coluna == 3){
		$tipo = $tipoSolicitacao[3];
	}else if($coluna == 4){
		$tipo = $tipoSolicitacao[4];
	}else if($coluna == 5){
		$tipo = $tipoSolicitacao[5];
	}		

	$editarTipoSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET status_solicitacao_cliente = '$tipo' , data_modificacao_solicitacao_cliente = '$dataModificacao' WHERE nome_cliente_solicitacao = '$nomeCliente' AND id_solicitacao_cliente = '$idSolicitacao'");

	$editarTipoSolicitacao->execute();

	header("Location: ../View/viewSolicitacoesPorCliente.php?cliente=$nomeCliente");
?>