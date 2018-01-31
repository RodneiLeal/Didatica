<?php
    session_start();
    include '../../loader.php';
    $cursoModel = new CursoModel;

    extract($_POST);
    
    $path = 'uploads/users/'.$_SESSION['username'].'/cursos/'.$curso['titulo'].'/';
    $src = $curso['imagem'];
    $curso['imagem'] = str_replace('bucket/', $path, $curso['imagem']);
    
    /* UPDATE CURSO */
    $cursoModel->updateCurso(@array_shift(array_keys($curso)), @array_shift($curso), $curso);
    rename('../../'.$src, '../../'.$curso['imagem']);

    /* UPDATE AULA */
    if(!empty($_FILES['aula']['tmp_name'])){
        $aula = array_merge($aula, ['arquivo'=>$path.$_FILES['aula']['name']]);
        move_uploaded_file($_FILES['aula']['tmp_name'], ROOT.$path.$_FILES['aula']['name']);
    }
    $cursoModel->updateAula(@array_shift(array_keys($aula)), @array_shift($aula), $aula);

    $cursoModel->atualizaQuestoes($provas);
    // var_dump(@array_shift($_POST['aula']));
    // var_dump(@array_shift(array_keys($_POST['aula'])));

    // header('Location: ../../Dashboard?p=meus-cursos');
