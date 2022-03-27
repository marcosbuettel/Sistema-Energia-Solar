<?php 
	$solicitacoesAtrasadas = 0;
	
	for($j = 0; $j < count($totalSolicitacoesAbertas); $j++){
		$dataFormatada = explode('-', $totalSolicitacoesAbertas[$j]['prazo_solicitacao_cliente']);

		$dia = $dataFormatada[2];
		$mes = $dataFormatada[1];
		$ano = $dataFormatada[0];

		$diaAtual = date('d');
		$mesAtual = date('m');
		$anoAtual = date('Y');

		if($ano < $anoAtual){
			$solicitacoesAtrasadas++;
		}else if($ano == $anoAtual){
			if($mes < $mesAtual){
				$solicitacoesAtrasadas++;
			}else if($mes == $mesAtual){
				if($dia < $diaAtual){
					$solicitacoesAtrasadas++;
				}
			}
		}
	}
?>