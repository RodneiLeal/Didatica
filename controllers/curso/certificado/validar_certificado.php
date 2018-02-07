<?php
    include_once "../../../loader.php";
    extract($_POST);
    $admin = new Admin;
    $admin->validarCertificado($code);
    $response =  array(
        'status'=>200,
        'message'=>$admin->getMsg(),
        'result'=>$admin->getResult()
    );

    echo json_encode($response);

    