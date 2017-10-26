<?php
    include_once "../loader.php";
    $main = new Main;
    print_r($main->solicitacao($_POST));