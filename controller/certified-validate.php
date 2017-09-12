<?php
	require_once "../classes/dbc.php";

	extract($_REQUEST);
	
	$pdo =  new dbc();

	$sql = "SELECT usuario_nome FROM matricula_certificado, usuario, matricula 
			WHERE matricula_certificado_certificado_code = '$code' 
			AND matricula_certificado_matricula_id = matricula_id 
			AND matricula_usuario_id = usuario_id";
			  
	$stmt = $pdo->query($sql);
	$result =  $stmt->fetchAlL(PDO::FETCH_ASSOC);

	if(empty($result)){
		echo '0__';
		exit;
	}

	echo $result;