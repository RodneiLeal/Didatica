<?php
    include_once "../../loader.php";

    $cursoModel =  new Instructor('resgatarCreditos', $_POST);
    $response = array(
		'status'=>200,
		'message'=>$cursoModel->getMsg(),
		'result'=>$cursoModel->getResult()
	);

    echo json_encode($response);
    
   