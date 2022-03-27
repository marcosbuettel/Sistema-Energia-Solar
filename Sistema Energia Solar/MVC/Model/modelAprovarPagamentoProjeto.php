<?php 
	//ARQUIVO PARA APROVAÇÃO DOS DOCUMENTOS DO PROJETO
	
	session_start();
	include_once("modelBancoDeDados.php");
	
	$idProjeto = $_POST['id'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	$aprovarDocumentosProjeto = $pdo->prepare("UPDATE projetos SET status_projeto = 'pagamento-aprovado' WHERE id_projeto = '$idProjeto'");
	$aprovarDocumentosProjeto->execute();


	$tipoNotificacao = "pagamento-aprovado";
	$dataAtual = date('Y-m-d');
	/*
		BUSCANDO O ID DO USUARIO DO CLIENTE PARA SALVAR NA NOTIFICAÇÃO
		COMO ID DO DESTINATÁRIO
	*/
	$procurarUsuario = $pdo->prepare("SELECT * FROM usuarios INNER JOIN projetos ON usuarios.id_usuario = projetos.id_usuario WHERE id_projeto = '$idProjeto'");
	$procurarUsuario->execute();
	$totalProcurarUsuario = $procurarUsuario->fetchAlL(); 

	$idUsuario = $totalProcurarUsuario[0]['id_usuario'];
	$nomeProjeto = $totalProcurarUsuario[0]['nome_projeto'];
	/*
		BUSCANDO O ID DO USUARIO DO CLIENTE PARA SALVAR NA NOTIFICAÇÃO
		COMO ID DO DESTINATÁRIO
	*/

	include('modelNovaNotificacao.php');

	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>