<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Didatica Online | Log in</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

    <link rel="stylesheet" href="js/vendor/plugins/iCheck/square/blue.css">
    
    
    <link rel="stylesheet" href="js/vendor/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="js/vendor/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/vendor/plugins/notification/toastr.min.css">
    <link rel="stylesheet" href="css/vendor/loading/jquery.loading.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="./"><img src="img/logo-lg.png"></a>
      </div>
      <div class="login-box-body">
        <form action="controllers/adm/login.php" method="POST" id="login">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email" name="user">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="pswd">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck" style="margin-top: 0;">
                <label>
                  <input type="checkbox"> Manter conectado
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div>
          </div>
        </form>

        <a href="">Esqueci minha senha</a><br>

      </div>
    </div>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/vendor/plugins/notification/toastr.min.js"></script>
    <script src="js/vendor/plugins/iCheck/icheck.min.js"></script>
    <script src="js/functions.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
    </script>

  </body>
</html>