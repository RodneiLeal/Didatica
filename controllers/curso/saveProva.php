<?php
    include_once "../../loader.php";
    $curso = new CursoModel;
    extract($_POST);
    $nota = (float)number_format((float)(($nota/N_QUESTOES)*100), 2, ',', '.' );
    $prova = array('inscricao_idinscricao'=>$idinscr, 'prova'=>json_encode($opcao), 'nota'=>$nota);
    // if($curso->salvaProva($prova))
        print(json_encode(array('avaliacao'=>NOTACORTE<=(int)$nota, 'nota'=>$nota)));