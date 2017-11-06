<?php  
    include_once "../loader.php";
    extract($_POST);
    $main = new Main;
    
    if($subcategorias = $main->getSubcategoriaCursos($categoria_idcategoria)){

        foreach($subcategorias as $subcategoria){
            echo "<option value=\"{$subcategoria['idsubcategoria']}\">{$subcategoria['subcategoria']}</option>";
        }
    }


