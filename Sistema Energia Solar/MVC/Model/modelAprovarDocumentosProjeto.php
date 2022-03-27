<?php 
	//ARQUIVO PARA APROVAÇÃO DOS DOCUMENTOS DO PROJETO
	
	session_start();
	include_once("modelBancoDeDados.php");


	$idProjeto = $_POST['id'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$dataAtual = date('Y-m-d');
	$tipoNotificacao = "documentos-aprovados";

	$aprovarDocumentosProjeto = $pdo->prepare("UPDATE projetos SET status_projeto = 'aguardando-pagamento' WHERE id_projeto = '$idProjeto'");
	$aprovarDocumentosProjeto->execute();


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
	
	if(isset($_GET['tipo'])){
		if($_GET['tipo'] == 0){
			echo "<script>document.location='../View/viewProjetos.php'</script>";		
		}
	}

	echo "<script>document.location='../View/viewVisualizarProjeto.php?idP=$idProjeto&idU=$idUsuarioLogado'</script>";
?>