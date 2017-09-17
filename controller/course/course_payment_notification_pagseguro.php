<?php
extract($_POST);
if(isset($notificationType) && $notificationType == 'transaction'){
    
	include '../_biblio.php';
	include '../../config/config_site.php';
	
    $email = $_SESSION['pagseguro_email'];
    $token = $_SESSION['pagseguro_token'];

    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'.$notificationCode.'?email='.$email.'&token='.$token;

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $transaction = curl_exec($curl);

    curl_close($curl);

    if($transaction == 'Unauthorized'){
        exit;
    }

    $transaction = simplexml_load_string($transaction);
	
	$status = $transaction -> status;
	$code 	= $transaction -> code;
	
	$consulta  = mysqli_fetch_assoc(mysqli_query($mysqli, "select matricula_certificado_id from matricula_certificado where matricula_certificado_pagseguro_code = '".$code."'"));

	$matricula_id = $consulta['matricula_certificado_id'];
		

	$crud = new crud('matricula_certificado');
	$retorno = $crud->update($mysqli, "matricula_certificado_ativo = {$status}", "matricula_certificado_pagseguro_code = '{$code}' and matricula_certificado_id = {$matricula_id}");

}
