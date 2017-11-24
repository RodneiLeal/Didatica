<?php
	/*confihgurações de sistema*/
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

	$ini_app = parse_ini_file('app-cfg.ini', true);
	extract($ini_app['sistema']);
	define('MAIN_PKG', $main_pkg);
	define("SYS_NAME", "Didática Online");
	define('MASTER_MAIL', $master_email);
	define("ROOT", __DIR__.DIRECTORY_SEPARATOR);
	define("UPLOADS", ROOT."/views/_uploads");
	define("HOME_URI", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"http://localhost/".MAIN_PKG."/":$_SERVER['REQUEST_SCHEME'].'s://'.$_SERVER['HTTP_HOST']);
	define("CONFIRME_URI", HOME_URI.$confirme_path_file);
	define("DB_HOST", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?'localhost':$db_host);
	define("DB_NAME", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?'didatica_db':$db_name);
	define("DB_USER", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"root":$db_user);
	define("DB_PASSWD", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"1234":$db_passwd);
	define("DB_CHARSET", "utf8");
	define("DEBUG", false);
	define("PAGE_NOT_FOUND", ROOT."includes".DIRECTORY_SEPARATOR."404.php");
	define("FOLDERS", serialize(array("classes",
									  "controllers",
									  "functions",
									  "includes",
									  "model",
									  "view",
									  "template")));
									  
	extract($ini_app['pagseguro']);
	define('PSG_TOKEN', $psg_token);
	define('PSG_EMAIL', $psg_email);
	define('PSG_EMAIL_SANDBOX', $psg_email_sandbox);
	define('PSG_URL', $psg_url);
	define('PSG_URL_LIGHTBOX', $psg_url_lightbox);
	define('PSG_URL_NOTIFICACAO', $psg_url_notificacao);
	define('SANDBOX_ACTIVE', $sandbox_active);

	$pgs_library = SANDBOX_ACTIVE ? "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js": "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js";

	// $_SESSION['compraProduto']						= 'Certificado Curso'; #produto teste
	

	require_once ROOT."loader.php";