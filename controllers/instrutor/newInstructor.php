<?php
    include '../../loader.php';
    $instructor  = new Instructor('novo_instrutor', $_POST);
    $response = array(
        'status' => 200,
        'message'=>$instructor->getMsg(),
        'result'=>$instructor->getResult()
    );

    echo json_encode($response);