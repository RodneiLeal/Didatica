<?php
    include '../../loader.php';
    $user  = new User('updateUser', $_POST);
    $response = array(
        'status' => 200,
        'message'=>$user->getMsg(),
        'result'=>$user->getResult()
    );

    echo json_encode($response);