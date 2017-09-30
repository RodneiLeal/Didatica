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

        default:
            include_once ROOT."template/contents/perfil.ctp";
        
    }

    


