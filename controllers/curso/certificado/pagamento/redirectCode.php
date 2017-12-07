<?php
	include_once "../../../../loader.php";
	$inscricao = new Inscricao;
	$inscricao = $inscricao->getInscricaoId($_POST['inscr'])[0];
	$url = PGS_URL."/?email=".PGS_EMAIL."&token=".PGS_TOKEN;
	$xml=
		'<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
		<checkout>
			<currency>'.UNIDADE_MONETARIA.'</currency>
			<items>
				<item>
					<id>'.$inscricao['idinscricao'].'</id>
					<description>'.$inscricao['titulo'].'</description>
					<amount>'.CERTIFICADO_VALOR.'</amount>
					<quantity>1</quantity>
				</item>
			</items>

			<sender>
				<name>'.$inscricao['usuario'].'</name>  
				<email>'.$inscricao['usermail'].'</email>
			</sender>
		</checkout>';
		
	$xml = str_replace("\n", '', $xml);
	$xml = str_replace("\r",'',$xml);
	$xml = str_replace("\t",'',$xml);
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
	$xml= curl_exec($curl);
		
	if($xml == 'Unauthorized'){
	    print_r($xml_retorno->error).'<br>';
		exit;
	}

	curl_close($curl);

	$xml_retorno= simplexml_load_string($xml);

	if(count($xml_retorno->error) > 0)
	{
		print_r($xml_retorno->error).'<br>';
		exit;
	}

	print($xml_retorno->code);
	exit;