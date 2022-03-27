<?php 
	//ARQUIVO PARA CADASTRO DE NOVA SOLICITAÇÃO
	//NA SOLICITAÇÃO TAMBÉM PODERÁ SER ENVIADO IMAGEM
	//USANDO AWS (AMAZON) PARA ARMAZENAR AS IMAGENS

	session_start();
	include_once("modelBancoDeDados.php");
	require '../../vendor/autoload.php';

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$nomeCliente = $_SESSION['nome-cliente'];

	$verificaClienteLogado = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$verificaClienteLogado->execute();
	$totalClienteLogado = $verificaClienteLogado->fetchAlL(); 

	$idBlocoCalendario = null;	
	$usuarioLogado = $_SESSION['nome'];
	$idCliente = $totalClienteLogado[0]['id_cliente'];

	$tituloSolicitacao = $_POST['titulo-solicitacao'];
	$tipoSolicitacao = $_POST['tipo-solicitacao'];
	$descSolicitacao = $_POST['descricao-solicitacao'];
	$prazoSolicitacao = $_POST['prazo-solicitacao'];
	$dataAtual = date('d/m/Y H:i');

	$cadastrarSolicitacao = $pdo->prepare("INSERT INTO solicitacao_cliente (id_cliente_solicitacao_cliente, nome_cliente_solicitacao, titulo_solicitacao_cliente, tipo_solicitacao_cliente, descricao_solicitacao_cliente, prazo_solicitacao_cliente, data_solicitacao_cliente, status_solicitacao_cliente) VALUES ('$idCliente','$nomeCliente', '$tituloSolicitacao', '$tipoSolicitacao', '$descSolicitacao', '$prazoSolicitacao', '$dataAtual', 'solicitado')");

	$cadastrarSolicitacao->execute();

	$verificaSolicitacao = $pdo->prepare("SELECT * FROM solicitacao_cliente");
	$verificaSolicitacao->execute();
	$totalSolicitacao = $verificaSolicitacao->fetchAlL(); 

	//FOR PARA PEGAR O ÚLTIMO ID DA SOLICITAÇÃO
	//POIS O ID NÃO PREENCHE AUTOMATICAMENTE
	for($j = 0; $j < count($totalSolicitacao); $j++){
		$idSolicitacao = $totalSolicitacao[$j]['id_solicitacao_cliente'];
	}

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

	if(!empty($_FILES["fileToUpload"]['name'][0])){
		
		for($i=0; $i<count($_FILES["fileToUpload"]['name']); $i++) {   
			// For this, I would generate a unqiue random string for the key name. But you can do whatever.
			$keyName = 'iSeven/' . basename($_FILES["fileToUpload"]['name'][$i]);
			$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

			// Add it to S3
			try {
				// Uploaded:
				$file = $_FILES["fileToUpload"]['tmp_name'][$i]; //NOME TEMP DO ARQUIVO NO SERVIDOR

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

			$cadastrarImagem = $pdo->prepare("INSERT INTO imagens_solicitacao (id_solicitacao_cliente, nome_imagem_solicitacao ) VALUES ('$idSolicitacao','$linkImg')");

			$cadastrarImagem->execute();
		}
	}

	/*if($_SESSION['tipo-usuario'] == 'leitor'){
		if(isset($aprovacaoBloco)){
			if($aprovacaoBloco == 1){
				$tipoNotificacao = 'aprovado';
			}else if($aprovacaoBloco == 2){
				$tipoNotificacao = 'reprovado';
			}	
		}else{
			$tipoNotificacao = 'comentário';
		}
	}else{
		
	}*/

	$tipoNotificacao = 'solicitacao';

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioLogado', '$idBlocoCalendario', '$idCliente', '$tipoNotificacao', '1')");

	$novaNotificacao->execute();

	include_once("modelNotificacaoPorUsuario.php");

	echo "<script>document.location='../View/viewPainelAdministrativo.php'</script>";
?>