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

	$registro = $user->saveUser($data);
	
	if($registro){
		session_start();
		$_SESSION = $registro;
		echo '2__';
	}	
	
	exit;