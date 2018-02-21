<?php
  require "../loader.php";
  $user  =  new User('login', $_POST);
  $response = array(
    'status'=>200,
    'message'=>$user->getMsg(),
    'result'=>$user->getResult()
  );
    
	echo json_encode($response);