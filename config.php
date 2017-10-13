<?php
	/*confihgurações de sistema*/
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

	$db_host			= "didatica-db.mysql.uhserver.com";
	$db_name			= "didatica_db";
	$db_user			= "app_didatica";
	$db_passwd			= "D1d@71c4";
	$confirme_path_file	= "/controllers/users/confirme.php";
	$master_email		= "rodnei.leal@rodneileal.com.br";

	define("SYS_NAME", "Didática Online");
	define('MASTER_MAIL', $master_email);
	define("ROOT", __DIR__.DIRECTORY_SEPARATOR);
	define("UPLOADS", ROOT."/views/_uploads");
	define("HOME_URI", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?'./':$_SERVER['SERVER_NAME']);
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
									  
	/*produção*/
	
	// define('PSG_TOKEN', '988E476CFFB34113B27BCB59D1A077B1');
	// define('PSG_EMAIL', 'leonardo.nihilo@outlook.com');
	// define('PSG_EMAIL_SANDBOX', 'v29218027482493566605@sandbox.pagseguro.com.br');
	// define('PSG_URL', 'https://ws.pagseguro.uol.com.br/v2/checkout');
	// define('PSG_URL_LIGHTBOX', 'https://pagseguro.uol.com.br/v2/checkout/payment.html');
	// define('PSG_URL_NOTIFICACAO', 'http://www.didatica.online/controller/course_payment_notification_pagseguro.php');
	// define('SANDBOX_ACTIVE', false);

	/*testes*/

	define('PSG_TOKEN', '9B93B563D7DC4255B93A37C5D3AAA871');
	define('PSG_EMAIL', 'rodnei.leal@hotmail.com');
	define('PSG_EMAIL_SANDBOX', 'v38218955758021744159@sandbox.pagseguro.com.br');
	define('PSG_URL', 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout');
	define('PSG_URL_LIGHTBOX', 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html');
	define('PSG_URL_NOTIFICACAO', 'http://www.didatica.online/controller/course_payment_notification_pagseguro.php');
	define('SANDBOX_ACTIVE', true);

	$pgs_library = SANDBOX_ACTIVE ? "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js": "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js";

	// $_SESSION['compraProduto']						= 'Certificado Curso'; #produto teste
	

	require_once ROOT."loader.php";