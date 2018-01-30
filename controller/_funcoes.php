<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);


 
if(!function_exists(preparaURL))
{
	function preparaURL($string)
	{
		$table = array(
				'Š'=>'S', 'š'=>'s', 'Ð'=>'D', 'd'=>'d', 'Ž'=>'Z',
				'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
				'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
				'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
				'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
				'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
				'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
				'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
				'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
				'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
				'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
				'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
				'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
				'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
				'ÿ'=>'y', 'R'=>'R', 'r'=>'r',
			);
			// Traduz os caracteres em $string, baseado no vetor $table
			$string = strtr($string, $table);
			// converte para minúsculo
			$string = strtolower($string);
			// remove caracteres indesejáveis (que não estão no padrão)
			$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
			// Remove múltiplas ocorrências de hífens ou espaços
			$string = preg_replace("/[\s-]+/", " ", $string);
			// Transforma espaços e underscores em hífens
			$string = preg_replace("/[\s_]/", "-", $string);
			// retorna a string
			return $string;
	}
}

if(!function_exists(EnviaEmail))
{
	function EnviaEmail($destinatario_email, $destinatario_nome, $assunto, $mensagem, $link){ 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:key-ce207b344d6e7bb0bb925f9ab83ec646');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 
				  'https://api.mailgun.net/v2/www.showprojetos.com.br/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
					array('from' => 'Didática Online Contato <nao-responda@didaticaonline.com.br>',
						  'to' => $destinatario_nome .'<'.$destinatario_email.'>',
						  'subject' => $assunto,
						  'html' => $mensagem));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
 
if(!function_exists(inteiro))
{
	function inteiro($valor)
	{
		if (!filter_var($valor, FILTER_VALIDATE_INT) === false) {
			return 1;
		} else {
			return 0;
		}
	}
}
	
	

if(!function_exists(log_erro))
{
	function log_erro($texto)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/controller/_biblio.php';
		
		$data_cadastro = date("Y-m-d H:i");
		$campos=
		"
			log_erro_descricao,
			log_erro_data
		";
		
			$conteudo =
			"
 				'$texto',
				'$data_cadastro'
 			";
		$crud = new crud('matricula');
		$crud->insert($mysqli, $campos, $conteudo);
	}
}
	 

?>