
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<base href=" <?=$_SERVER['REMOTE_ADDR']=='127.0.0.1'?'./':'http://www.didatica.online/'?>" >

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/notification/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="dist/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?=$this->get_title();?></title>
  </head>
  <body class="hold-transition " style="background-image: url('dist/img/formatura.jpg');background-size: 100% 100%;">
    <div class="login-certified-validate">
      <div class="login-logo">
        <a href="index2.html"><img src="dist/img/didatica-online-median.png"></a>
      </div><!-- /.login-logo -->

      <div class="login-certified-validate-body">
          <p class="login-certified-validate-msg">Validação de Certificado</p>

            <div class="form-group has-feedback">
              <input type="text" class="form-control text-center" id="certified-validate-code" placeholder="numero do certificado">
              <span class="fa fa-font form-control-feedback"></span>
            </div>
              <div class="certified-return text-center"></div>

            <div class="row">
              <div class="col-xs-12 text-center">
                <button id="certified-validate" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Validar Certificado</button>
              </div><!-- /.col -->
            </div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
  <script type="text/javascript" src="//code.jquery.com/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="plugins/notification/toastr.min.js"></script>
  <script type="text/javascript" src="dist/functions.js"></script>
</html>
