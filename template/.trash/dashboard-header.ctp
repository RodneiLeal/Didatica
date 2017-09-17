<?php
    if(isset($_SESSION)) @session_start();

    
    extract($_SESSION);
    
    if((isset($_GET['logoff'])) && ($_GET['logoff']=='true')) {
        unset($_SESSION);
        session_destroy();
	}
    
	if(!isset($usuario_id)) {
        echo 
        "
        <script>
        location.href = 'Home';
        </script>
        ";
		exit;
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
    <head>
            <base href="./">
            
            
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            
            
            <link rel="shortcut icon" href="dist/img/favicon.png">
            <link rel="stylesheet" href="plugins/upload/jquery.filer-dragdropbox-theme.css">
            <link rel="stylesheet" href="plugins/upload/components.css">
            
        
            
            
            <link rel="stylesheet" href="plugins/upload/jquery.filer.css">
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
        
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
        
        <!--- Custom Components -->
        <link href="plugins/notification/toastr.min.css" rel="stylesheet" type="text/css" />
        
        <!-- upload 
        <link rel="stylesheet" href="dist/css/upload_custom.css">-->
        <link rel="stylesheet" href="dist/css/custom.css">
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <link rel="stylesheet" type="text/css" href="plugins/input_file/component.css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            
            
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            
            <title><?=$this->getTitle()?></title>
            
        <?=get_description()?>
        <?=get_keywords()?>
        
    </head>
    
    <body class="hold-transition skin-black-light sidebar-mini">
        <div class="wrapper">
            
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    
                    <span class="logo-mini"><img src="dist/img/didatica-inline-logotipo-mini.png" width="25px"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="dist/img/didatica-inline-logotipo.png" width="100px"></span>
                </a>
                
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
                
                
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        
                        
                        
                        <?php
                                $retorno = ExecData($mysqli, 'mensagem','mensagens_total','*', $usuario_id);
                                $row = mysqli_fetch_assoc($retorno);
                                ?>



<span class="label label-danger"><?php echo $row['total'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Você tem <?php echo $row['total'];?> novas mensagens</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    
                                    <?php
                            $retorno = ExecData($mysqli, 'mensagem','mensagens_todas_nao_lidas','*', $usuario_id);
                            while($row = mysqli_fetch_array($retorno)) {
                                echo
                                '
                                <li><!-- start message -->
                                <a href="dashboard.php?p=user-messages&read='.$row['usuario_mensagem_id'].'">
                                <!--
                                <div class="pull-left">
                                <img src="dist/img/Rodnei.jpg" class="img-circle" alt="User Image">
                                </div>
                                -->
                                    <h4>
                                    '.$row['usuario_mensagem_titulo'].'
                                    <small><i class="fa fa-clock-o"></i> '.strftime('%d %m, %H %M', strtotime($row['usuario_mensagem_data'])).'</small>
                                    </h4>
                                    <p>
                                    '.substr_replace($row['usuario_mensagem_mensagem'], (strlen($row['usuario_mensagem_mensagem']) > 30 ? '...' : ''), 30).'</p>
                                    </a>
                                </li><!-- end message -->
                                ';
                            }
                            ?>




</ul>
</li>
<li class="footer"><a href="dashboard.php?p=user-messages">Ver todas as mensagens</a></li>
</ul>
                    </li>
                    
                    
                    <!-- User Account: style can be found in dropdown.less -->
                    
                    <?php print_r($_SESSION);?>
                    

<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="img/users/<?=!empty($usuario_foto)?$usuario_foto:"usuario-sem-imagem-01.png"?>" class="user-image" alt="<?=$usuario_nome?>">
        <span class="hidden-xs"> <?=$usuario_nome?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                        <img src="img/users/<?=!empty($usuario_foto)?$usuario_foto:"usuario-sem-imagem-01.png"?>" class="img-circle" alt="<?=$usuario_nome?>">
                        
                        <p>
                            <a href="profile">

                                <font color="#fff">
                                    <?php 
                                        echo $usuario_nome.' - '.substr_replace($usuario_formacao, (strlen($usuario_formacao) > 10 ? '...' : ''), 10);
                                    ?>
                                </font>

                            </a>
                            
                            <small>Usuario desde <?php echo date('M/Y', strtotime($usuario_data_cadastro));?></small>


                            <small>Ultimo acesso: <span>23/01/2017 11:23</span></small>
                        </p>
                </li>
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="dashboard?user-edit" class="btn btn-default btn-flat">Editar</a>
                    </div>
                    <div class="pull-right">
                        <a href="dashboard?logoff=true" class="btn btn-default btn-flat">Sair</a>
                    </div>
                </li>
            </ul>
        </li>
        
    </ul>
</div>
</nav>
            </header>
            <div class="content-wrapper">
                