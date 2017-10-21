<?php  
    include_once "../../loader.php";

    $instrutor =  new Instructor;

    $instrutor->updateBanckInformation('conta', @array_shift(array_keys($_POST)), @array_shift($_POST), $_POST);
    echo "1__";
