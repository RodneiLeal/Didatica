
<!DOCTYPE html>
<html lang="pt-br" >

	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
		
        <title><?=$this->getTitle()?></title>

		<base href="<?=HOME_URI?>" >

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/superfish.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/jquery.navgoco.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/menu/component.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/complementar.css" type="text/css" media="all" />

		<link rel="stylesheet" href="css/vendor/plugins/notification/toastr.min.css" type="text/css" media="all"/>

        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700italic,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" type="image/png" href="img/favicon.png">
		<link rel="shortcut icon" type="image/png" href="img/favicon.ico" />
  
    </head>

<body class="kopa-home-2">
    <div id="kopa-page-header">
        <div id="kopa-header-top">

            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div id="logo-image" class="pull-left">
                            <a href="">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-12">
					
						<nav id="main-nav">
							<ul id="main-menu" class="clearfix">

								<li class="current-menu-item">
									<a>Categorias<span class="menu-description">Encontre seu curso</span></a>
									<ul>
										<?php foreach(Main::getCategoriaCursos() as $categoria):?>
											<li>
												<a href="cursos/<?=$categoria['categoria']?>"><?=$categoria['categoria']?></a>
											</li>
										<?php endforeach ?>
									</ul>
								</li>

								<li >
									<form class="form-wrapper-top-search" action="cursos" method="GET">
										<input type="text" name="search" placeholder="Buscar curso..." required>
										<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
									</form>
								</li>

							</ul>

							<div class="text-right botoes_topo" >

								<a href="validar certificado">Validar Certificado</a>

								<?php if(!empty($locked) && $locked) : ?>
								
								<a>Olá <?=$username?>!</a>

								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Menu <i class="fa fa-caret-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href="Dashboard">Painel de Controle</a></li>
										<li><a href="Dashboard/inscricoes">Minhas Inscrições</a></li>
										<li><a href="Dashboard/mensagens">Mensagens<span class="label label-success label-home-menu"><?=Main::nMensagens()?></span></a></li>
										<li role="separator" class="divider"></li>
										<li><a name="<?=session_name()?>" class="logoff">Sair</a></li>
									</ul>
								</div>


								<?php else : ?>
										<a class="cd-signin"><i class="fa fa-sign-in"></i> Entrar</a>
								<?php endif ?>
							</div>
							<!-- main-menu -->

							<nav class="main-nav-mobile clearfix demo-2">
								<div id="dl-menu" class="dl-menuwrapper">
									<button class="dl-trigger">Open Menu</button>
									<ul class="dl-menu">
										<?php if(!empty($locked) && $locked):?>

										<li>
											<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Ola, <?=$username?>!
											</a>
											<ul class="dl-submenu">
												<li><a href="Dashboard">Painel de Controle</a></li>
												<li><a href="Dashboard?p=minhas-inscricoes">Meus cursos</a></li>
												<li><a href="Dashboard?p=minhas-mensagens">Mensagens</a></li>
												<li role="separator" class="divider"></li>
												<li><a name="<?=session_name()?>" class="logoff">Sair</a></li>
											</ul>
										</li>
										<?php else :?>
										<li>
											<a class="cd-signin"><i class="fa fa-sign-in"></i> Entrar</a>
										</li>
										<?php endif ?>
										<li>
											<a>Cursos</a>
											<ul class="dl-submenu">
												<?php foreach($this->getCategoriaCursos() as $categoria):?>
												<li>
													<a href="cursos/<?=Main::preparaURL($categoria['categoria'])?>"><?=$categoria['categoria']?></a>
												</li>
												<?php endforeach ?>
											</ul>
										</li>
									</ul>
								</div>
							</nav>
							<!--/main-menu-mobile-->
						</nav>
					</div>
                </div>
                <!-- row -->
            </div>

        </div>
    </div>