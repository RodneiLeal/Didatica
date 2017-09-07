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
	
	$data = array('usuario_nome'=>$name,
				  'usuario_email'=>$email,
				  'usuario_pass'=>md5($passwd),
				  'usuario_data_cadastro'=>$datetime);
	
	$registro = $user->registro($data);
	
	if($registro){
		session_start();
		$_SESSION['usuarioTIPO'] = 1;
		$_SESSION['usuarioID'] = $registro;
		echo '2__';
	}	
	
	exit;