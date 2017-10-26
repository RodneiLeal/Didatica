<?php
    include_once "../../loader.php";
    $instrutor =  new Instructor();
    var_dump($instrutor->saveBanckInformation($_POST));