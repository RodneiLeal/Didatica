<?php
	/*confihgurações de sistema*/

	date_default_timezone_set('UTC');
	
	$db_user	 = "didatica_online";
	$db_passwd	 = "YV6y4j5yw2";

	define("SYS_NAME", "Didática Online");
	define("ROOT", __DIR__.DIRECTORY_SEPARATOR);
	define("UPLOADS", ROOT."/views/_uploads");
	#define("HOME_URI", "127.0.0.1/trabalhos/didatica/v4");
	define("DB_HOST", "localhost");
	define("DB_NAME", "didatica_online_cursos");
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
	
	define('PSG_TOKEN', '988E476CFFB34113B27BCB59D1A077B1');
	define('PSG_EMAIL', 'leonardo.nihilo@outlook.com');
	define('PSG_EMAIL_SANDBOX', 'v29218027482493566605@sandbox.pagseguro.com.br');
	define('PSG_URL', 'https://ws.pagseguro.uol.com.br/v2/checkout');
	define('PSG_URL_LIGHTBOX', 'https://pagseguro.uol.com.br/v2/checkout/payment.html');
	define('PSG_URL_NOTIFICACAO', 'http://www.didatica.online/controller/course_payment_notification_pagseguro.php');
	define('SANDBOX_ACTIVE', false);

	/*testes*/

	// define('PSG_TOKEN', '9B93B563D7DC4255B93A37C5D3AAA871');
	// define('PSG_EMAIL', 'rodnei.leal@hotmail.com');
	// define('PSG_EMAIL_SANDBOX', 'v38218955758021744159@sandbox.pagseguro.com.br');
	// define('PSG_URL', 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout');
	// define('PSG_URL_LIGHTBOX', 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html');
	// define('PSG_URL_NOTIFICACAO', 'http://www.didatica.online/controller/course_payment_notification_pagseguro.php');
	// define('SANDBOX_ACTIVE', true);

	$pgs_library = SANDBOX_ACTIVE ? "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js": "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js";

	$_SESSION['compraProduto']						= 'Certificado Curso'; #produto teste
	

	require_once ROOT."loader.php";