<?php
    session_start();
            
    require "../../loader.php";
            
    extract($_REQUEST);
            
    $user  =  new User();
            
    $login = $user->login($pid, $passwd);


    if(empty($login[0])){
        echo '0__';
        exit;
    }else{

        extract($login[0]);

        if(!$usuario_ativo){
            echo '1__';
            exit;
        }else{
            $_SESSION = $login[0];
            echo '2__';
        }
    }