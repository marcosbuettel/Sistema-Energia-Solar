<?php 
	//ARQUIVO PARA BUSCAR O LINK (PARA QUAL BLOCO VAI APÓS CLICAR 
	//NA NOTIFICAÇÃO) DE CADA BLOCO BASEADO NO ID DA NOTIFICAÇÃO

	$verificaLink = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendarioLink'");
	$verificaLink->execute();
	$totalLink = $verificaLink->fetchAlL(); 
?>