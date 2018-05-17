<?php
	if(!defined("ROOT")){
		include 'app.php';
	}

	include "util/Hybrid/autoload.php";

	if(!defined("DEBUG") || DEBUG === true){
		error_reporting(1); 			/*não esquecer de modificar este parametro para 0*/
		ini_set("display_errors", 1);	/*não esquecer de modificar este parametro para 0*/
	}else{
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
	}

	spl_autoload_register(function($className){
	
		foreach (unserialize(FOLDERS) as $folder) {
			$file = ROOT.$folder.DIRECTORY_SEPARATOR.$className.".php";
		
			if(file_exists($file)){
				require_once $file;
				return;
			}
		}

		require_once PAGE_NOT_FOUND;
		exit;
	});

	function enableCORS() {

		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}

		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

			exit(0);
		}

		return true;
	}


	/**
	 * apartir deste ponto tem que recuperar configurações fornecidas pelos administradores
	 * 
	 */

	define('CEO', 'Felipe Rodrigo');
	define('CET', 'Leonardo Oliveira');
	define('N_QUESTOES', 10);
	define('NOTACORTE', 60);
	define('CERTIFICADO_VALOR', '39.99');
	define('UNIDADE_MONETARIA', 'BRL');
	define('COMISSAO', 20);