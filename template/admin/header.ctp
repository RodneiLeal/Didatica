<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <base href="<?=HOME_URI?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="js/vendor/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="js/vendor/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="js/vendor/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/vendor/plugins/notification/toastr.min.css">
    <link rel="stylesheet" href="css/vendor/crop/cropper.min.css">
    <link rel="stylesheet" href="css/vendor/loading/jquery.loading.min.css">
    <link rel="stylesheet" href="css/complementar.css">
    

    <link rel="shortcut icon" href="img/favicon.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?=$this->getTitle()?></title>

    <!-- adicionar descrição e palavras chaves -->

  </head>


  <body class="hold-transition skin-black-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="" class="logo">
          <span class="logo-mini"><img src="img/logo-mini.png" width="20px"></span>
          <span class="logo-lg"><img src="img/logo.png" width="100px"></span>
        </a>

        <input id="idusuario" type="hidden" value="">
        
        <nav class="navbar navbar-static-top" role="navigation">
          <a class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <li class="user user-menu">
                <a><span class="hidden-xs"> <?=$username?></span></a>
              </li>
              
              <li>
                <a class="logoff" title="Sair" name="<?=session_name()?>"><i class="fa fa-sign-out"></i></a>
              </li>

              

            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MENU</li>

            <?=$menu_navegacao?>
            
          </ul>
        </section>
      </aside><!-- /.sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

