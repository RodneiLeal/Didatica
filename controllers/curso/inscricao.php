<?php
    include_once "../../loader.php";
    
    $inscricao =  new Inscricao;
    
    $data_inscricao = date("Y-m-d H:i:s");
    $ultimo_acesso = date("Y-m-d H:i:s");
    
    $data = array(
        'data_inscricao'=>date("Y-m-d H:i:s"),
        'ultimo_acesso'=>date("Y-m-d H:i:s")
    );
    
    $data = array_merge($_POST, $data);
    
    print_r($inscricao->inscreverUsuario($data));