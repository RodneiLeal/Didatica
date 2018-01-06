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
	
	/**
	 * apartir deste ponto tem que recuperar configurações fornecidas pelos administradores
	 * 
	 */

	define('N_QUESTOES', 10);
	define('NOTACORTE', 60);
	define('CERTIFICADO_VALOR', '39.99');
	define('UNIDADE_MONETARIA', 'BRL');