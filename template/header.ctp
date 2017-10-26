<?php
	@session_start();
	extract($_SESSION);
?>
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

		<link rel="stylesheet" href="css/vendor/plugins/notification/toastr.min.css" type="text/css" media="all"/>

        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700italic,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="img/favicon.png">
  
		<style>
			ul{
				list-style:none;
			}
			.form-wrapper-top-search {
				background: #fff;
				-webkit-border-radius: 4px;
						border-radius: 4px;
				padding: 6px;
				position: relative;
				width: 450px;
			}

			.form-wrapper-top-search input[type="text"] {
				width:150px;
				height:50px;
				border:0px;
				border-left:1px solid #fafafa;
				padding-left:10px;
				top: 2px;
				bottom: 2px;
					transition: width .3s ease-in-out;
					-webkit-transition: width .3s ease-in-out;
					-moz-transition: width .3s ease-in-out;
					-ms-transition: width .3s ease-in-out;
			}

			.form-wrapper-top-search input[type="text"]:focus {
				width: 400px;
				color: black;
			}

			.form-wrapper-top-search button[type="submit"] {
				margin-left: -50px;
				height: 50px;
				width: 30px;
				background: #dfdfdf;
				color: white;
				border: 0;
				-webkit-appearance: none;
			}
		</style>

    </head>

<body class="kopa-home-2">
    <div id="kopa-page-header">
        <div id="kopa-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div id="logo-image" class="pull-left">
                            <a href="">
                                <img src="placeholders/logo.png" alt="">
                            </a>
                        </div>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-12">
					
						<nav id="main-nav">
							<ul id="main-menu" class="clearfix">
								<li class="current-menu-item">
									<a>Categorias<span class="menu-description">Encontre seu curso</span></a>
									<ul>
										<li>
											<a>Cursos</a>
											<ul>
												<?php foreach(Main::getCategoriaCursos() as $categoria):?>
													<li><a href="cursos/<?=$categoria['categoria']?>"><?=$categoria['categoria']?></a></li>
												<?php endforeach ?>
											</ul>
										</li>
									</ul>
								</li>
								<li >
									<form class="form-wrapper-top-search" action="cursos" method="GET">
										<input type="text" name="search" placeholder="Buscar curso..." required>
										<button type="submit"><i class="fa fa-search"></i></button>
									</form>
								</li>
							</ul>

							<div class="text-right botoes_topo" >
								<?php if(!empty($locked) && $locked) : ?>
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Ola, <?=$username?>!
									</a>
									<ul class="dropdown-menu">
										<li><a href="Dashboard">Painel de Controle</a></li>
										<li><a href="Dashboard?p=minhas-inscricoes">Meus cursos</a></li>
										<li><a href="Dashboard?p=minhas-mensagens">Mensagens</a></li>
										<li role="separator" class="divider"></li>
										<li><a class="logoff">Sair</a></li>
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
												<li><a class="logoff">Sair</a></li>
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
            <!-- container -->
        </div>
        <!-- kopa-header-top -->
    </div>
    <!-- kopa-page-header -->