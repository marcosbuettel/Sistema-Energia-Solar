<?php 
	//ARQUIVO PARA APROVAÇÃO DOS DOCUMENTOS DO PROJETO
	
	session_start();
	include_once("modelBancoDeDados.php");
	require '../../vendor/autoload.php';
	
	$idProjeto = $_GET['idP'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	$dataLocal = date("Y-m-d H:i:s"); 
	

	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;	

	$bucketName = 'deploy-arpoador';
	$IAM_KEY = 'AKIAREY7JX52VPRLVVWT';
	$IAM_SECRET = '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';

	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-1'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}
	
	
	if(!empty($_FILES["fileToUploadDiagramaUnifilar"]['name'])){
		// For this, I would generate a unqiue random string for the key name. But you can do whatever.
		$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadDiagramaUnifilar"]['name']);
		$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

		// Add it to S3
		try {
			// Uploaded:
			$file = $_FILES["fileToUploadDiagramaUnifilar"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

			$s3->putObject(
				array(
					'Bucket'=>$bucketName,
					'Key' =>  $keyName,
					'SourceFile' => $file,
					'StorageClass' => 'REDUCED_REDUNDANCY'
				)
			);

		} catch (S3Exception $e) {
			die('Error:' . $e->getMessage());
		} catch (Exception $e) {
			die('Error:' . $e->getMessage());
		}

	$linkImg = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;	

	}else{
		$linkImg = null;		
	}

	$aprovarDocumentosProjeto = $pdo->prepare("UPDATE projetos SET status_projeto = 'analise', img_diagrama_projeto = '$linkImg' WHERE id_projeto = '$idProjeto'");
	$aprovarDocumentosProjeto->execute();


	$tipoNotificacao = "analise";
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