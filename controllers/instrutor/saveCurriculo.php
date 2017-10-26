<?php
    include_once "../../loader.php";
    $instrutor =  new Instructor();
    print_r($instrutor->saveCurriculo($_POST));

