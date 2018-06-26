<?php
  require "../../loader.php";
  $userAdm  =  new Adm('setConfig', $_POST);
  $response = array(
    'status'=>200,
    'message'=>$userAdm->getMsg(),
    'result'=>$userAdm->getResult()
  );
    
	echo json_encode($response);