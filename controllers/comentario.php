<?php
    require "../loader.php";
    $curso  =  new CursoModel('comentario', $_POST);
    $response = array(
        'status'=>200,
        'message'=>$curso->getMsg(),
        'result'=>$curso->getResult()
    );
    
	echo json_encode($response);