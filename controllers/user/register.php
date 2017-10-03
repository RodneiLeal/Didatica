<?php
	include '../../loader.php';
	extract($_REQUEST);
	$user = new User();
	
	if(isset($rede)){

        extract($user->getUserSocial($rede));
		$passwd = $identifier.$email;
		$dataUserRede = array(
			'foto'=>empty($foto)?NULL:$foto,
			'redeSocialID'=>$identifier,
			'nome'=>$nome,
			'sobrenome'=>$sobrenome
		);
    }

	$datetime = date("Y-m-d H:i:s");
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo '0__';
		exit;
	}

	if(!empty($user->findUser($email)[0])){
		echo '1__';
		exit;
	}
	
	$data = array(
		'username'=>$username,
		'email'=>$email,
		'pswd'=>hash('sha256', $passwd),
		'dataCadastro'=>$datetime
	);

	if(isset($dataUserRede) && is_array($dataUserRede)){
		$data = array_merge($data, $dataUserRede);
	}

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

	$user = $user->saveUser($data)[0];
	
	if($user){
		@session_start();
		$_SESSION = $user;
		echo '2__';
		exit;
	}
	else{
		echo '3__';
		exit;
	}
