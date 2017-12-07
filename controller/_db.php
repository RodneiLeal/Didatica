<?php
    
    $config['host'] = 'localhost';
    $config['dbname']   = DB_NAME;
    $config['username'] = DB_USER;
    $config['password'] = DB_PASSWD;

    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);

    if ($mysqli->connect_errno) {
        // Escreva aqui tudo que você quer que aconteça quando der merda na conexão
        echo "Falha ao conectar com o banco de dados: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return false;
    }
     
    mysqli_query($mysqli, "SET NAMES 'utf8'");
    mysqli_query($mysqli, 'SET character_set_connection=utf8');
    mysqli_query($mysqli, 'SET character_set_client=utf8');
    mysqli_query($mysqli, 'SET character_set_results=utf8');

?> 
