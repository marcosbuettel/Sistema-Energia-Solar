<?php
	//ARQUIVO PARA EDIÇÃO DO DIA E DA SEMANA DA TAREFA

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['idT'];
	$idSemanaTarefa = $_GET['idS'];					
	$idDia = $_GET['dia'];

	$editarDiaSemana = $pdo->prepare("UPDATE tarefa SET id_semana_tarefa = '$idSemanaTarefa', dia_semana_tarefa = '$idDia' WHERE id_tarefa = '$idTarefa'");

	$editarDiaSemana->execute();

	header('Location: ../View/viewQuadroTarefas.php');
	//echo "<script>document.location='../View/viewQuadroTarefas.php</script>";	
?>