<?php
    session_start();
    require "../loader.php";
    $user  =  new User;
    extract($_POST);

    if(isset($rede)){
        extract($user->getUserSocial($rede));
        $passwd = $identifier.$email;
    }

    $login = $user->login(trim($pid), trim($passwd));

    if(empty($login[0])){
        echo '0__';
        exit;
    }else{
        extract($login[0]);
        if(!$locked){
            echo '1__';
            exit;
        }else{
            $_SESSION = $login[0];
            echo '2__';
        }
    }