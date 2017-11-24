<?php
    include_once "../../loader.php";
    $curso = new CursoModel;
    extract($_POST);
    $opcao = array((int)array_values($opcao)[0], (int)array_keys($opcao)[0], $idcurso);
    $resposta = $curso->confereQuestao($opcao);
    print(json_encode($resposta));



    