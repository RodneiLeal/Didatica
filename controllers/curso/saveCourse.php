<?php
    session_start();
    include_once "../../loader.php";
    $instrutor  =  new Instructor;
    $cursoModel =  new CursoModel;
    extract($_POST);

    $path = 'uploads/users/'.$_SESSION['username'].'/cursos/'.$curso['titulo'].'/';

    if(!file_exists($path)){
        @mkdir(ROOT.$path, 0777, true);
    }

    $instrutor = $instrutor->getInstrutor($_SESSION['idusuario'])[0];

    $src = $curso['imagem'];
    $curso['imagem'] = str_replace('bucket/', $path, $curso['imagem']);

    $curso = array_merge($curso, ['instrutor_idinstrutor'=>$instrutor['idinstrutor']]);
    

    if(($idcurso = $cursoModel->salvaCurso($curso)) && rename('../../'.$src, '../../'.$curso['imagem'])){
        $aula = array_merge($aula, ['arquivo'=>$path.$_FILES['aula']['name']], ['curso_idcurso'=>$idcurso]);
        if(($idaula = $cursoModel->salvaAulas($aula)) && move_uploaded_file($_FILES['aula']['tmp_name'], ROOT.$path.$_FILES['aula']['name'])){
            
            foreach($provas as $prova){
                $prova = array_merge($prova, ['curso_idcurso'=>$idcurso]);
                $idquestao = $cursoModel->salvaQuestoes($prova);
            }
            
        }  
    }
    
    header('Location: ../../Dashboard?p=meus-cursos');
