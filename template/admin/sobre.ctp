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

    <p>
        
        <button name="<?=session_name()?>" type="button" class="logoff btn btn-lg btn-danger">Sair</button>
        
    </p>


    
    <form action="">
        <div class="form-group row">
            <div class="col-md-1">
                <label>Sobre nós</label>
            </div>
            <div class="col-md-11">
                <textarea class="editor" id="sobre" name="sobre"><?=$sobre['nos']?></textarea>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-1">
                <label>Politica de privacidade</label>
            </div>
            <div class="col-md-11">
                <textarea class="editor" id="pPrivacidade" name="pPrivacidade"><?=$sobre['pPrivacidade']?></textarea>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-1">
                <label>Termos de usuário</label>
            </div>
            <div class="col-md-11">
                <textarea class="editor" id="tUsuario" name="tUsuario"><?=$sobre['tUsuario']?></textarea>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-1">
                <label>Termos de instrutores</label>
            </div>
            <div class="col-md-11">
                <textarea class="editor" id="tInstrutores" name="tInstrutores"><?=$sobre['tInstrutores']?></textarea>
            </div>
        </div>
    </form>

    



    <!-- PagSeguro -->
    <script src="<?=PGS_LIBRARY?>"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- CKeditor -->
    <script src="js/vendor/ckeditor/ckeditor.js"></script>

    <!-- <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
    <!-- SlimScroll -->
    <!-- <script src="js/vendor/plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
    <!-- FastClick -->
    <!-- <script src="js/vendor/plugins/fastclick/fastclick.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="js/vendor/dist/js/app.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="js/vendor/dist/js/demo.js"></script> -->

    <!-- <script src="js/vendor/plugins/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="js/vendor/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
    <script src="js/vendor/plugins/notification/toastr.min.js"></script>
    <!-- <script src="js/vendor/countdown/jquery.countdown.min.js"></script> -->
    <!-- <script src="js/vendor/star-rating/star-rating.js"></script> -->
    <!-- <script src="js/vendor/crop/cropper.min.js"></script> -->
    <!-- <script src="js/vendor/crop/crop-main.js"></script> -->
    <!-- <script src="js/vendor/loading/jquery.loading.min.js"></script> -->
    <script src="js/vendor/menu/jquery.dlmenu.js"></script>
    <!-- <script src="js/vendor/menu/modernizr.custom.js"></script> -->
    <script src="js/functions.js"></script>
    <!-- <script src="js/main.js"></script> -->

    <!-- page script -->
  </body>
</html>
