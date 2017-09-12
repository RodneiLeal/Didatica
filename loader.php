<?php
	if(!defined("ROOT")){
		include 'config.php';
	}

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


