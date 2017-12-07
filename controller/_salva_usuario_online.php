<?php
	include '_biblio.php';


	DEFINE ('REMOTE_ADDR', $_SERVER['REMOTE_ADDR']);
	DEFINE ('PHP_SELF', $_SERVER['PHP_SELF']);

    $timestamp=time(); 
    $timeout=time()-300; // valor em segundos 


	$campos=
	"
		usuario_online_usuario_id,
		usuario_online_time,
		usuario_online_ip,
		usuario_online_file
	";
	
		$conteudo =
		"
			'{$_SESSION['usuarioID']}',
			'$timestamp',
			'{$_SERVER['REMOTE_ADDR']}',
			'{$_SERVER['PHP_SELF']}'
		";

	$crud = new crud('usuario_online');
	$retorno = $crud->insert($mysqli, $campos, $conteudo);

	$retorno = $crud->remove($mysqli, "usuario_online_time < '$timeout'");

?>
  
