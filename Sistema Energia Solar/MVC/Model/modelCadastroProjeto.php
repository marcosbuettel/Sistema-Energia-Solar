<?php 
	//ARQUIVO PARA CADASTRO DO PROJETO

	session_start();
	include_once("modelBancoDeDados.php");
	require '../../vendor/autoload.php';

	$idUsuarioProjeto = $_SESSION['id-usuario-logado'];
	$nomeProjeto = $_POST['nome-projeto'];
	$dataProjeto = date('Y-m-d');
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
	
	
	//AQUI COMEÇA O CADASTRO DAS 5 IMAGENS QUE FAZEM PARTE DO PROJETO
	//REPETINDO O CÓDIGO DA AWS PARA CADA UMA DAS IMAGENS

	// ------------------------------------------------------------------
	//						IMAGEM CONTA DE LUZ
	// ------------------------------------------------------------------

	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadConta"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadConta"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgConta = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM PROCURAÇÃO
	// ------------------------------------------------------------------
	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadProcuracao"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadProcuracao"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgProcuracao = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM PADRÃO
	// ------------------------------------------------------------------
	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadPadrao"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadPadrao"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgPadrao = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM DISJUNTOR
	// ------------------------------------------------------------------
	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadDisjuntor"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadDisjuntor"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgDisjuntor = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM LOCAÇÃO
	// ------------------------------------------------------------------
	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadLocacao"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadLocacao"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgLocacao = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM DESCRIÇÃO
	// ------------------------------------------------------------------
	$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadDescricao"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUploadDescricao"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

	$linkImgDescricao = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;


	// ------------------------------------------------------------------
	//						IMAGEM EXTRA 1
	// ------------------------------------------------------------------

	if(!empty($_FILES["fileToUploadImgExtra1"]['name'])){

		$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadImgExtra1"]['name']);
		$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

		// Add it to S3
		try {
			// Uploaded:
			$file = $_FILES["fileToUploadImgExtra1"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

		$linkImgExtra1 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	}else{
		$linkImgExtra1 = null;
	}

	// ------------------------------------------------------------------
	//						IMAGEM EXTRA 2
	// ------------------------------------------------------------------

	if(!empty($_FILES["fileToUploadImgExtra2"]['name'])){

		$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadImgExtra2"]['name']);
		$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

		// Add it to S3
		try {
			// Uploaded:
			$file = $_FILES["fileToUploadImgExtra2"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

		$linkImgExtra2 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	}else{
		$linkImgExtra2 = null;
	}

	// ------------------------------------------------------------------
	//						IMAGEM EXTRA 3
	// ------------------------------------------------------------------

	if(!empty($_FILES["fileToUploadImgExtra3"]['name'])){

		$keyName = 'daniel/' .$dataLocal. basename($_FILES["fileToUploadImgExtra3"]['name']);
		$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

		// Add it to S3
		try {
			// Uploaded:
			$file = $_FILES["fileToUploadImgExtra3"]['tmp_name']; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

		$linkImgExtra3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	}else{
		$linkImgExtra3 = null;
	}	

	//AQUI TERMINA A PARTE DOS CÓDIGOS DA AWS
	//A PARTIR DAQUI É O CADASTRO DAS IMAGENS NO BANCO	

	$cadastrarProjeto = $pdo->prepare("INSERT INTO projetos (id_usuario, nome_projeto, img_conta_projeto, img_procuracao_projeto, img_padrao_projeto, img_disjuntor_projeto, img_locacao_projeto, img_descricao_projeto, img_extra1_projeto, img_extra2_projeto, img_extra3_projeto ,data_projeto) VALUES ('$idUsuarioProjeto','$nomeProjeto', '$linkImgConta','$linkImgProcuracao','$linkImgPadrao', '$linkImgDisjuntor', '$linkImgLocacao', '$linkImgDescricao', '$linkImgExtra1' , '$linkImgExtra2', '$linkImgExtra3', '$dataProjeto')");

	$cadastrarProjeto->execute();

	$verificaProjetos = $pdo->prepare("SELECT * FROM projetos ORDER BY id_projeto ASC");
	$verificaProjetos->execute();
	$totalProjetos = $verificaProjetos->fetchAlL(); 

	$idProjeto = $totalProjetos[0]['id_projeto'];

	$idUsuarioLogado = $idUsuarioProjeto;
	$tipoNotificacao = "novo-projeto";
	$dataAtual = date('Y-m-d');
	/*
		BUSCANDO O ID DO USUARIO DO CLIENTE PARA SALVAR NA NOTIFICAÇÃO
		COMO ID DO DESTINATÁRIO
	*/
	$procurarUsuario = $pdo->prepare("SELECT * FROM usuarios INNER JOIN projetos ON usuarios.id_usuario = projetos.id_usuario WHERE id_projeto = '$idProjeto'");
	$procurarUsuario->execute();
	$totalProcurarUsuario = $procurarUsuario->fetchAlL(); 

	$idUsuario = $totalProcurarUsuario[0]['id_usuario'];
	//$nomeProjeto = $totalProcurarUsuario[0]['nome_projeto'];
	/*
		BUSCANDO O ID DO USUARIO DO CLIENTE PARA SALVAR NA NOTIFICAÇÃO
		COMO ID DO DESTINATÁRIO
	*/

	include('modelNovaNotificacao.php');

	echo "<script>document.location='../View/viewPainelAdministrativo.php'</script>";
?>