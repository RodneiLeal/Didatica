<?php
    session_start();
    extract($_REQUEST);
    if($logoff == true){
		unset($_SESSION);
		session_destroy();
    }
    