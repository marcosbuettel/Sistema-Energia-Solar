<?php 

	function tarefaAtrasada($data){

		$tarefaAtrasada = false;

		$dataFormatada = explode('-', $data);

		$dia = $dataFormatada[2];
		$mes = $dataFormatada[1];
		$ano = $dataFormatada[0];

		$diaAtual = date('d');
		$mesAtual = date('m');
		$anoAtual = date('Y');

		if($ano < $anoAtual){
			return true;
		}else if($ano == $anoAtual){
			if($mes < $mesAtual){
				return true;;
			}else if($mes == $mesAtual){
				if($dia < $diaAtual){
					return true;;
				}
			}
		}else{
			return false;
		}
	}
?>