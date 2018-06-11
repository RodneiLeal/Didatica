<?php
  extract($_REQUEST);
  session_name($name);
  session_start();
  if($logoff == true){
    unset($_SESSION);
    session_destroy();
    exit;
  }
    