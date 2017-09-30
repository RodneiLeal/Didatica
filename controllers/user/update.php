<?php
    include '../../loader.php';
    session_destroy();

	extract($_REQUEST);
	
	$user = new User();
	$datetime = date("Y-m-d H:i:s");
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    




    // final
    session_start();
    $_SESSION = $user_update[0];