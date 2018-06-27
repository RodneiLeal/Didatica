<?php  
    include_once "../../loader.php";

    $instrutor =  new Instructor;
    // corrigir.

    // se existe um idconta, então é uma conta ja cadastrada, senão é uma conta nova.
    $instrutor->updateBanckInformation('conta', @array_shift(array_keys($_POST)), @array_shift($_POST), $_POST);
    echo "1__";
