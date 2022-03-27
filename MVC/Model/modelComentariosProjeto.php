<?php 

	$verificaComentarios = $pdo->prepare("SELECT * FROM comentario_projeto WHERE id_projeto = $idProjeto");
	$verificaComentarios->execute();
	$totalComentarios = $verificaComentarios->fetchAlL(); 
?>