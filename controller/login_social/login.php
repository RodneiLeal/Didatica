<?php
session_start();
include 'register.php';

	// include hybridauth lib
	$base_url_callback = 'http://www.didatica.online/controller/login_social/login.php?login='.$_GET["login"];
	
	$config_facebook = [
		'callback' => $base_url_callback,
		'keys' => [ 'key' => '159280651284190', 'secret' => 'd4043ce62d63f634064d32b0a967ca97' ]
	];

		$config_google = [
			'callback' => $base_url_callback,
			'keys' => [ 'key' => '540948825743-n8vqmgotkgl7cfetgkhh1911411mhcsc.apps.googleusercontent.com', 'secret' => 'izUV01B0E4Pkrrhs8o6EWgqM' ]
		];
	
			$config_linkedin = [
				'callback' => $base_url_callback,
				'keys' => [ 'key' => '772eq6xy5cqbub', 'secret' => 'YI9PeFJtODF4E2Zc' ]
			];
		
	require_once( "Hybrid/autoload.php" );

	if( isset( $_GET["login"] ) )
	{
		if( $_GET["login"] =='facebook') 
		{
			$adapter = new Hybridauth\Provider\Facebook($config_facebook);

		}
		elseif( $_GET["login"] =='google') 
		{
			$adapter = new Hybridauth\Provider\Google($config_google);
		}
		elseif( $_GET["login"] =='linkedin') 
		{
			$adapter = new Hybridauth\Provider\LinkedIn($config_linkedin);
		}
			try {
 				$adapter->authenticate();
				$isConnected = $adapter->isConnected();
				$userProfile = $adapter->getUserProfile();

				$adapter->disconnect();
			}
				catch(\Exception $e){
					echo 'Oops, we ran into an issue! ' . $e->getMessage();
				}
	}

	// logged in ?
	if( ! isset( $userProfile ) )
	{
		echo 
		'
			<script>location.href="../../index.php"</script>
		';
	}
	
	// user signed in with facebook
	else{
		$user = new User();
		$user_data = $user->checkUser($_GET["login"],$userProfile->identifier,$userProfile->displayName,$userProfile->email,$userProfile->photoURL);
		
		$_SESSION['usuarioTIPO'] = $user_data['usuario_tipo'];
		echo 
		'
			<script>location.href="../../index.php"</script>
		';
	}
