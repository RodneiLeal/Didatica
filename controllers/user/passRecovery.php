<?php
	include '../../loader.php';
    extract($_POST);
    $user = new User($action, $email);
    $response = array(
        'state'  => 200,
        'message' => $user->getMsg(),
        'result' => $user -> getResult()
    );

    echo json_encode($response);
    
