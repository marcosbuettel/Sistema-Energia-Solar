<?php 
	//ARQUIVO PARA FAZER UPLOAD DE ARQUIVO TXT QUE VEM DE UM FORMULARIO
	//DAS LANDING PAGES
	//AINDA NÃO ESTÁ EM USO

	$nomeArquivo = $_FILES['arquivo-escolhido']['tmp_name'];
	echo "Nome do arquivo: " .$nomeArquivo;
	$file = fopen($nomeArquivo, 'r');
	echo "<br>";
	$count = 0;
	while(!feof($file)){
		$linha = fgets($file);
		$linha = str_replace('"', " ", $linha);
		if(!$linha == null){			

			$partes = explode(',', $linha);
			
			/*if(!empty($linha)){
				for($i = 0; $i < 4; $i++){
					echo $partes[$i]. ' | ';
				}
			}
			*/
			if($count > 0){
				include('../Model/modelVerificaFormulario.php');
				$verificaEmail = false;
				for ($i=0; $i < count($totalFormulario); $i++) { 
					if($partes[3] == $totalFormulario[$i]['email_formulario']){
						$verificaEmail = true;
					}
				}
				if($verificaEmail == false){
					include('../Model/modelCadastroFormulario.php');
				}
				else{
					header('Location: ../View/viewFormularios.php');

					echo "<script>document.location='../viewFormularios.php</script>";
				}
			}
			//echo "<br>";
			$count++;
		}
	}

	fclose($file);
?>