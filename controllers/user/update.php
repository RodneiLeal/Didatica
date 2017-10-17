<?php
    include '../../loader.php';
    session_destroy();

	extract($_REQUEST);
    $user  = new User();
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo '0__';
		exit;
    }

    if(isset($pswd)){
        $_REQUEST['pswd'] = hash('sha256', $pswd);
    }
    

    /******ESTUDAR FOMA DE FAZER O APLOAD DE IMAGENS VINDO DO JQUERY*******/

    // if(!empty($_FILES['imageFile']))
    //     print move_uploaded_file($_FILES['imageFile']['tmp_name'], 'uploads/'.$_FILES['imageFile']['name']);
    
    $user_update = $user->updateUser('usuario', @array_shift(array_keys($_REQUEST)), @array_shift($_REQUEST), $_REQUEST);

   if(empty($user_update)){
       $data = array('idusuario'=>$idusuario);
       $user_update = $user->getUser($data, 1)[0];
   }

   print_r($user_update);
    
    // // final
    session_start();
    $_SESSION = $user_update;

    