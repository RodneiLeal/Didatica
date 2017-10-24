<?php
    $p = NULL;
    extract($_REQUEST);

    switch ($p) {

        // PERFIL DO USUARIO
        case 'perfil':
            include_once ROOT."template/dashboard-contents/perfil.ctp";
        break;

        case 'perfil-edit':
            include_once ROOT."template/dashboard-contents/perfil-edit.ctp";
        break;

        // CERTIFICADO
        case 'certificado-model':
            include_once ROOT."template/dashboard-contents/certificado-model.ctp";
        break;
        
        // CURSOS 
        case 'novo-curso':
            include_once ROOT."template/dashboard-contents/novo-curso.ctp";
        break;

        case 'meus-cursos':
            include_once ROOT."template/dashboard-contents/meus-cursos.ctp";
        break;

        case 'minhas-inscricoes':
            include_once ROOT."template/dashboard-contents/minhas-inscricoes.ctp";
        break;

        case 'curso':
            include_once ROOT."template/dashboard-contents/curso.ctp";
        break;

        default:
            include_once ROOT."template/dashboard-contents/perfil.ctp";
        
    }

    


