<?php
    require_once 'controller/_db.php';        
    include 'model/global.php';

    if((isset($_GET['logoff'])) && ($_GET['logoff']=='true')){
		unset($_SESSION['usuarioTIPO']);
		unset($_SESSION['usuarioID']);
	}

	if(!isset($_SESSION['usuarioID']))
	{
		echo 
		"
        <script>
			location.href = 'index.php';
		</script>
		";
		exit;
	}
    
    function get_title()
    {
        $titulo = "<title>Didática Online</title>";

        return $titulo;
    }

    function get_description()
    {
        return $description = '<meta name="description" content="Descrição da pagina">';
    }

    function get_keywords()
    {
        return $keywords = '<meta name="keywords" content="lista de palavras chaves">';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<html>
  <head>
    <meta charset="utf-8">
	<link rel="shortcut icon" href="dist/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="plugins/upload/jquery.filer-dragdropbox-theme.css">
	<link rel="stylesheet" href="plugins/upload/jquery.filer.css">
	<link rel="stylesheet" href="plugins/upload/components.css">
	<base href="./">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!--- Custom Components -->
    <link href="plugins/notification/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- upload 
    <link rel="stylesheet" href="dist/css/upload_custom.css">-->
    <link rel="stylesheet" href="dist/css/custom.css">
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	
	

	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->


    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- função para pegar o titulo configurado -->
    <?=get_title()?>
    <?=get_description()?>
    <?=get_keywords()?>
   
  </head>
  <body class="hold-transition skin-black-light sidebar-mini">
    <div class="wrapper">