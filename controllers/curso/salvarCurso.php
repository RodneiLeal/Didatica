<?php
	include_once "../../loader.php";
	
    $cursoModel =  new CursoModel('salvar_curso', $_POST);
    $response = array(
		'status'=>200,
		'message'=>$cursoModel->getMsg(),
		'result'=>$cursoModel->getResult()
	);

	echo json_encode($response);


