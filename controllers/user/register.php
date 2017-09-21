<?php
	include '../../loader.php';

	extract($_REQUEST);
	
	$user = new User();
	$datetime = date("Y-m-d H:i:s");
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo '0__';
		exit;
	}

	$registro = $user->findUser($email);
	
	if(!empty($registro[0])){
		echo '1__';
		exit;
	}
	
	$data = array('nome'=>$name,
				  'email'=>$email,
				  'pswd'=>hash('sha256', $passwd),
				  'dataCadastro'=>$datetime);

	// alterar a coluna locked no banco de dados para que esta opção funcione corretamente.

	// $subject  = 'Comfirmação de cadastro';
	// $message  = 'Olá '.$nome;
	// $message .= ', recebemos o seu com sucesso.'; 
	// $message .= 'Para utilizar os nossos serviços, ';
	// $message .= 'precisamos que ative a sua conta clicando no link abaixo:';
	// $message .= '<a href="'.CONFIRME_URI.'">Clique aqui para ativar o seu cadastro</a>';
	// $headers  = 'From: '.MASTER_MAIL.'\r\n';
	// $headers .= 'Reply-To: '.MASTER_MAIL.'\r\n';

	// if($user->saveUser($data)){
	// 	if(mail($to, $subject, $message, $headers)){
	// 		echo '2__';
	// 	}
	// }
	
	if($user->saveUser($data)){
		echo '2__';
	}	
	
	exit;