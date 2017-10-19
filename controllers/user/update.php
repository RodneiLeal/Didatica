<?php
    include '../../loader.php';
    session_start();
    // session_destroy();

	extract($_POST);
    $user  = new User();
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo '0__';
		exit;
    }

    if(isset($pswd)){
        $_POST['pswd'] = hash('sha256', $pswd);
    }
    
    /******ESTUDAR FOMA DE FAZER O APLOAD DE IMAGENS VINDO DO JQUERY*******/

    // if(!empty($_FILES['imageFile']))
    //     print move_uploaded_file($_FILES['imageFile']['tmp_name'], 'uploads/'.$_FILES['imageFile']['name']);
    
    $user->updateUser('usuario', @array_shift(array_keys($_POST)), @array_shift($_POST), $_POST);

    $data = array('idusuario'=>$idusuario);
    $user_update = $user->getUser($data, 1)[0];
    
    // // final
    $_SESSION = $user_update;


    