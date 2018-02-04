<?php
    include_once "../../loader.php";
    $inscricao =  new Inscricao;
    $inscricao->inscreverUsuario($_POST);
    $response = array(
        'status'=>200,
        'message'=>$inscricao->getMsg(),
        'result'=>$inscricao->getResult()
    );

    echo json_encode($response);
