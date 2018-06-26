<?php
    include_once "../../loader.php";
    $curso = new CursoModel;
    extract($_POST);
    $nota = (float)number_format((float)(($acertos/$nquestoes)*100), 2, ',', '.' );
    $prova = array('inscricao_idinscricao'=>$idinscr, 'prova'=>json_encode($opcao), 'nota'=>$nota);
    if($curso->salvaProva($prova))
        print(json_encode(array('avaliacao'=>NOTA_CORTE<=(int)$nota, 'nota'=>$nota)));