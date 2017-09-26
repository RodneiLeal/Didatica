<?php
    $p = NULL;
    extract($_REQUEST);

    switch ($p) {

        case 'perfil':
            include_once ROOT."template/contents/perfil.ctp";
        break;

        case 'perfil-edit':
            include_once ROOT."template/contents/perfil-edit.ctp";
        break;

        default:
            include_once ROOT."template/contents/perfil.ctp";
        
    }

    


