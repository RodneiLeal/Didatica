<?php
	/*confihgurações de sistema*/
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

	$ini_app = parse_ini_file('app.ini', true);
	extract($ini_app['sistema']);
	define('MAIN_PKG', $main_pkg);
	define("SYS_NAME", "Didática Online");
	define('MASTER_MAIL', $master_email);
	define("ROOT", __DIR__.DIRECTORY_SEPARATOR);
	define("UPLOADS", ROOT."/views/_uploads");
	define("HOME_URI", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"http://localhost/".MAIN_PKG."/":$_SERVER['REQUEST_SCHEME'].'s://'.$_SERVER['HTTP_HOST']);
	define("CONFIRME_URI", HOME_URI.$confirme_path_file);
	define("DB_HOST", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?'localhost':$db_host);
	define("DB_NAME", $db_name);
	define("DB_USER", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"root":$db_user);
	define("DB_PASSWD", $_SERVER['REMOTE_ADDR']=='127.0.0.1'?"1234":$db_passwd);
	define("DB_CHARSET", "utf8");
	define("DEBUG", $debug);
	define("PAGE_NOT_FOUND", ROOT."includes".DIRECTORY_SEPARATOR."404.php");
	define("MAILGUN_KEY", $mailgun_key);
	define("MAILGUN_LINK", $mailgun_link);

	define("FOLDERS", serialize(array("util",
									  "controllers",
									  "includes",
									  "model",
									  "view",
									  "template")));


									  
	extract($ini_app['pagseguro']);
	define('PGS_TOKEN', $pgs_token);
	define('PGS_EMAIL', $pgs_email);
	define('PGS_EMAIL_SANDBOX', $pgs_email_sandbox);
	define('PGS_URL', $pgs_url);
	define('PGS_URL_LIGHTBOX', $pgs_url_lightbox);
	define('PGS_URL_NOTIFICACAO', $pgs_url_notificacao);
	define('PGS_LIBRARY', $pgs_library);
	
	require_once ROOT."loader.php";