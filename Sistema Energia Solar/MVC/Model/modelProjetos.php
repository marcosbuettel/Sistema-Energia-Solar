<?php
	//ARQUIVO PARA BUSCAR TODOS OS PROJETOS

	$verificaProjetos = $pdo->prepare("SELECT * FROM projetos");
	$verificaProjetos->execute();
	$totalProjetos = $verificaProjetos->fetchAlL(); 
?>