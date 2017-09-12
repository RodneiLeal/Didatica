<?php
	session_start();
	include '../_biblio.php';
	include '../../model/global.php';
	include '../../config/config_site.php';

  $data_user = ExecData($mysqli, 'usuario','consulta_usuario','*',$_SESSION['usuarioID']);
  $row = mysqli_fetch_assoc($data_user);

	$curso_id = (int)$_GET['course'];        
  $dados_curso_sql = ExecData($mysqli, 'cursos','cursos_lista','curso_titulo', $curso_id);
	$dados_curso = mysqli_fetch_assoc($dados_curso_sql);
	
	$dados_site = site_data($mysqli,'adm_configuracao_certificado_valor');
	
	$url = PSG_URL."/?email=".PSG_EMAIL."&token=".PSG_TOKEN;

	$xml = '<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
			<checkout>
			  <sender>
				<name>'.$row['usuario_nome'].'</name>
				<email>'.$row['usuario_email'].'</email>
				<phone>
				  <areaCode>99</areaCode>
				  <number>99999999</number>
				</phone>
				<ip>1.1.1.1</ip>
				<documents>
				  <document>
					<type>CPF</type>
					<value>'.$row['usuario_cpf'].'</value>
				  </document>
				</documents>
			  </sender>
			  <currency>BRL</currency>
			  <items>
				<item>
				  <id>0001</id>
				  <description>'.$_SESSION['compraProduto'].'</description>
				  <amount>'.$dados_site.'</amount>
				  <quantity>1</quantity>
				  <weight>0</weight>
				  <shippingCost>0.00</shippingCost>
				</item>
			  </items>
			 
			  <extraAmount>0.00</extraAmount>
			  <reference>'.$dados_curso['curso_titulo'].'</reference>
			  <maxAge>999999999</maxAge>
			  <maxUses>999</maxUses>
			</checkout>

	';
	 //<redirectURL>'.$_SESSION['pagseguro_url_redireciona_cliente'].'</redirectURL>
	 
	$xml = str_replace("\n", '', $xml);
	$xml = str_replace("\r",'',$xml);
	$xml = str_replace("\t",'',$xml);
	//print_r($xml);

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
	$xml= curl_exec($curl);

	
	
	if($xml == 'Unauthorized'){
	    print_r("1".$xml_retorno -> error).'<br>';
		//echo '1-0';
		exit;
	}

	curl_close($curl);

	$xml_retorno= simplexml_load_string($xml);

	if(count($xml_retorno -> error) > 0)
	{
		print_r("1".$xml_retorno -> error).'<br>';
		///echo '2-0';
		exit;
	}

	$xml  	= json_encode($xml_retorno);
	$array  = json_decode($xml,TRUE);
	//print_r($array);
	

	
	echo '0-'.$array['code'];
	exit;

	 

?>