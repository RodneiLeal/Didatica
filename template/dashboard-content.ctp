<?php
    $p = NULL;
    extract($_REQUEST);

    switch ($p) {

        // PERFIL DO USUARIO
        case 'perfil':
            include_once ROOT."template/contents/perfil.ctp";
        break;

        case 'perfil-edit':
            include_once ROOT."template/contents/perfil-edit.ctp";
        break;

        // CERTIFICADO
        case 'certificado-model':
            include_once ROOT."template/contents/certificado-model.ctp";
        break;
        
        // CURSOS
        case 'novo-curso':
            include_once ROOT."template/contents/novo-curso.ctp";
        break;

        case 'meus-cursos':
            include_once ROOT."template/contents/meus-cursos.ctp";
        break;

        case 'minhas-inscricoes':
            include_once ROOT."template/contents/minhas-inscricoes.ctp";
        break;

        default:
            include_once ROOT."template/contents/perfil.ctp";
        
    }

    


