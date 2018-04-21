<?php
	include '../../loader.php';
    $user = new User('passRecovery', $_POST);
    $response = array(
        'state'  => 200,
        'message' => $user->getMsg(),
        'result' => $user -> getResult()
    );

    echo json_encode($response);
    
