<?php 
	//ARQUIVO PARA CADASTRAR O COMENTÁRIO
	//COM O MOTIVO DA REPROVAÇÃO DO PROJETO
	session_start();
	include_once("modelBancoDeDados.php");

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$idProjeto = $_GET['idP'];
	$nomeUsuario = $_SESSION['nome'];
	$dataComentarioProjeto = date('Y-m-d');
	

	if(isset($_POST['comentario-projeto'])){
		$comentarioProjeto = $_POST['comentario-projeto'];

		$cadastrarComentario = $pdo->prepare("INSERT INTO comentario_projeto (id_usuario, id_projeto, nome_usuario_comentario_projeto, data_comentario_projeto, descricao_comentario_projeto) VALUES ('$idUsuarioLogado', '$idProjeto', '$nomeUsuario','$dataComentarioProjeto', '$comentarioProjeto')");

		$cadastrarComentario->execute();
		
	}

	$editarStatusProjeto = $pdo->prepare("UPDATE projetos SET status_projeto = 'reprovado' WHERE id_projeto = '$idProjeto'");

	$editarStatusProjeto->execute();


	/*
		BUSCANDO O ID DO USUARIO DO CLIENTE PARA SALVAR NA NOTIFICAÇÃO
		COMO ID DO DESTINATÁRIO
	*/

	$dataAtual = date('Y-m-d');
	$tipoNotificacao = "documentos-reprovados";
		
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