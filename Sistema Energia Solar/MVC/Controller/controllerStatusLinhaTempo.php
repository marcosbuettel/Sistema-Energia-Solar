<!-- ARQUIVO PARA MONTAR A LINHA DO TEMPO DOS PROJETOS
	POR ENQUANTO ESTÁ PARADO ESSE ARQUIVO -->
<div class="separador-linha-tempo">
	<?php if(empty($totalBlocoProjeto[0]['id_bloco_projeto'])){?>
	<i class="far fa-circle"></i>
	<?php }elseif($totalBlocoProjeto[0]['status_bloco_projeto'] == 'Desenvolvimento'){?>
	<i class="fas fa-play-circle"></i>			
	<?php }elseif($totalBlocoProjeto[0]['status_bloco_projeto'] == 'Aguardando Cliente'){?>
	<i class="fas fa-clock"></i>
<?php }elseif($totalBlocoProjeto[0]['status_bloco_projeto'] == 'Concluído'){?>
	<i class="fas fa-check-circle"></i>
	<?php }?>
		
	<?php if($i!=10){?>
	<div class="separador-status"></div>
	<?php }?>
</div>
		<!--<i class="fas fa-clock"></i>
		<i class="fas fa-check-circle"></i>
		<i class="fas fa-circle"></i>-->
