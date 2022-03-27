<?php 

	$to = "marcostbmota@gmail.com";
	$subject = "Marcos";
	$body = "Nome: Marcos \nEmail: \nMensagem: Teste \n";
	$header = "From: contato@mtwebmg.com"."\r\n"
				."Reply-To: marcostbmota@gmail.com \e\n"
				."X=Mailer:PHP/".phpversion();

	if(mail($to, $subject, $body, $header)){
		echo("Email enviado com sucesso!");
	}else{
		echo("O email não pode ser enviado!");
	}



?>