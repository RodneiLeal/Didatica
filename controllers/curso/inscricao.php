<?php
    include_once "../../loader.php";
    $inscricao =  new Inscricao;
    print_r($inscricao->inscreverUsuario($_POST));