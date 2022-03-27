<?php 
	//ARQUIVO PARA CADASTRO DE NOVA SOLICITAÇÃO
	//NA SOLICITAÇÃO TAMBÉM PODERÁ SER ENVIADO IMAGEM
	//USANDO AWS (AMAZON) PARA ARMAZENAR AS IMAGENS

	session_start();
	include_once("modelBancoDeDados.php");

	//$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$nomeCliente = $_POST['nome-cliente'];

	$verificaClienteLogado = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$verificaClienteLogado->execute();
	$totalClienteLogado = $verificaClienteLogado->fetchAlL(); 

	//$idBlocoCalendario = null;	
	//$usuarioLogado = $_SESSION['nome'];
	$idCliente = $totalClienteLogado[0]['id_cliente'];

	$tituloSolicitacao = $_POST['titulo-solicitacao'];
	$tipoSolicitacao = $_POST['tipo-solicitacao'];
	$descSolicitacao = $_POST['descricao-solicitacao'];
	$prazoSolicitacao = $_POST['prazo-solicitacao'];
	$dataAtual = date('d/m/Y H:i');

	$cadastrarSolicitacao = $pdo->prepare("INSERT INTO solicitacao_cliente (id_cliente_solicitacao_cliente, nome_cliente_solicitacao, titulo_solicitacao_cliente, tipo_solicitacao_cliente, descricao_solicitacao_cliente, prazo_solicitacao_cliente, data_solicitacao_cliente, status_solicitacao_cliente) VALUES ('$idCliente','$nomeCliente', '$tituloSolicitacao', '$tipoSolicitacao', '$descSolicitacao', '$prazoSolicitacao', '$dataAtual', 'solicitado')");

	$cadastrarSolicitacao->execute();

	echo "<script>document.location='../View/viewSolicitacoes.php'</script>";
?>