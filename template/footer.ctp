
    <div id="bottom-sidebar-s2" class="container-fluid">

        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div id="footer-logo-image"><a href=""><img src="img/logo-lg.png" alt=""></a></div>

                <div class="widget widget_text">
                    <p>A melhor plataforma de ensino Online.</p>
                </div>
                <!-- widget -->
                
            </div>
            <!-- col-md-4 -->

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="row">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="widget clearfix widget_nav_menu">
                            
                            <h4 class="widget-title">Sobre nós</h4>
                            <div class="menu-menu-container">                                
                                <ul class="menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-528">
										<a data-toggle="modal" class="closed-modal" data-target="#sobre">Sobre nós</a>
									</li>

                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-541">
										<a data-toggle="modal" class="closed-modal" data-target="#pp">Política de Privacidade</a>
									</li>

									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-541">
										<a data-toggle="modal" class="closed-modal" data-target="#termos">Termos de Uso</a>
									</li>

									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-541">
										<a href="validar certificado">Validar Certificado</a>
									</li>
                                </ul>
                            </div>
                        </div>
                        <!-- widget -->
                    </div>

                </div>
                
            </div>
            <!-- col-md-4 -->


			<div class="col-md-4 col-sm-4 col-xs-12">

				<div id="fb-root"></div>
				<div class="fb-page" data-href="https://www.facebook.com/didaticacursosonline" data-width="440" data-height="290" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>

				
			</div>
		<!-- col-md-4 -->
            
        </div>
        <!-- row -->
        
    </div>


    <footer id="kopa-page-footer-s2" class="container-fluid">

        <p id="copyright" class="text-center">Copyright &copy; <?=date('Y')?>. Todos os direitos reservados.</p>

        <p id="back-top">
            <a href="#top"><i class="fa fa-arrow-up"></i></a>
        </p>
        
    </footer>

	<div id="termos" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4>Termos de uso</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6"><a class="btn btn-primary btn-block" data-toggle="modal" data-target="#tu-aluno">Para o Aluno</a></div>
						<div class="col-md-6"><a class="btn btn-primary btn-block" data-toggle="modal" data-target="#tu-instrutor">Para o Instrutor</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style>
	.modal-body{
		overflow-y: auto;
		max-height: 300px;
	}
	</style>

	<div id="pp" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4>Politica de Privacidade</h4>
				</div>
				<div class="modal-body" style="overflow-y: auto;max-height: 400px;">
					<?=PP?>
				</div>
			</div>
		</div>
	</div>

	<div id="sobre" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4>Sobre Nós</h4>
				</div>
				
				<div class="modal-body">

					<?=SOBRE?>

				</div>

			</div>
		</div>
	</div>

	<div id="tu-aluno" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4>Termos De Uso Para Você Aluno</h4>
				</div>
				<div class="modal-body">

					<?=TU?>

				</div>
			</div>
		</div>
	</div>

	<div id="tu-instrutor" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4>Termos De Uso Para Você Instrutor</h4>
				</div>
				<div class="modal-body">

					<?=TI?>

				</div>
			</div>
		</div>
	</div>
	
	<div class="cd-user-modal">
		<div class="cd-user-modal-container">
		
			<ul class="cd-switcher">
				<li><a class="cd-signin">Entrar</a></li>
				<li><a class="cd-signup">Novo Cadastro</a></li>
			</ul>

			<div id="cd-login">

				<form class="cd-form login_box" action="controllers/login.php" method="POST" id="login"> 
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail ou usuário</label>
						<input class="full-width has-padding has-border" name="user" type="text" placeholder="Nome de usuário ou e-mail">
						<span class="cd-error-message">Informe seu e-mail!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Senha</label>
						<input class="full-width has-padding has-border" name="pswd" type="password"  placeholder="Senha">
						<a class="hide-password">Mostrar</a>
						<span class="cd-error-message">Informe sua senha!</span>
					</p>

					<p class="fieldset">
 						<button class="full-width button" id="login">Login</button>
					</p>
				</form>

				<!--div class="social-auth-links text-center">
					<p>- OU -</p>
					<form action="" method="post">
						<button data-target="facebook" class="social-signin btn btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</button>
						<button data-target="google" class="social-signin btn btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Google+</button>
						<button data-target="linkedin" class="social-signin btn btn-social btn-linkedin btn-flat"><i class="fa fa-linkedin"></i> LinkedIn</button>
					</form>
				</div-->
				<p class="cd-form-bottom-message"><a href="#0">Esqueci minha senha?</a></p>
				
			</div> 

			<div id="cd-signup">
					
				<form class="cd-form signup-form">
					<p class="fieldset">
						<label class="image-replace cd-username" for="register_name">Seu nome</label>
						<input class="full-width has-padding has-border" id="register_name" type="text" placeholder="Nome de usuário">
						<span class="cd-error-message">Informe seu Nome!</span>
 					</p>
					
					<p class="fieldset">
						<label class="image-replace cd-email" for="register_email">E-mail</label>
						<input class="full-width has-padding has-border" id="register_email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Informe seu e-mail!</span>
					</p>
					
					<p class="fieldset">
						<label class="image-replace cd-password" for="register_pass">Senha</label>
						<input class="full-width has-padding has-border" id="register_pass" type="password"  placeholder="Senha">

						<a class="hide-password">Mostrar</a>

						<span class="cd-error-message">Informe sua senha!</span>
					</p>
 
					<p class="fieldset">
						<button class="signup full-width button">Criar nova conta</button>
					</p>
				</form>

				<!--div class="social-auth-links text-center">
					<p>- OU -</p>
					<a href="?rede=Facebook" class="social-signin btn btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</a>
					<a href="?rede=Google" class="social-signin btn btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Google+</a>
					<a href="?rede=LinkedIn" class="social-signin btn btn-social btn-linkedin btn-flat"><i class="fa fa-linkedin"></i> LinkedIn</a>
				</div-->
				
			</div>

			<div id="cd-reset-password"> 
				<p class="cd-form-message">Esqueceu sua senha, por favor, informe seu e-mail, você receberá sua nova senha no e-mail informado.</p>

				<form class="cd-form" action="controllers/user/passRecovery.php" id="pass-recovery">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-passwd">E-mail</label>
						<input class="full-width has-padding has-border" id="email" name="email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<button class="full-width reset-passwd button" >Gerar nova senha</button>
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Voltar para log-in</a></p>
			</div>
			<a href="#0" class="cd-close-form">Fechar</a>
		</div>
	</div>

</body> 
</html>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/vendor/menu/modernizr.custom.js"></script>
<script src="js/vendor/menu/jquery.dlmenu.js"></script>
<script src="js/vendor/dist/js/droply.js"></script>
<script src="js/vendor/plugins/notification/toastr.min.js"></script>
<script src="js/vendor/star-rating/star-rating.js"></script>
<script src="js/vendor/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/vendor/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/custom.js" charset="utf-8"></script>
<script src="js/functions.js"></script>
<script src="js/main.js"></script>

<?php

	use \Hybridauth\Hybridauth;

	class loginRede{
		
		private $rede;

		function __construct($rede){
			$this->rede = $rede;
			self::init();
		}

		public function init(){


			/* cadastro automático utilizando das redes sociais */
			if(isset($this->rede)){
				$urlCallback = HOME_URI.'/controllers/login.php?rede=';
				
				switch($this->rede){
					case 'Facebook':
						$config =  [
							'callback' => $urlCallback.$this->rede,
							'providers'=>[
								'Facebook'=>[
									'enabled'=>true,
									'keys'     => [ 'id' => '159280651284190', 'secret' => 'd4043ce62d63f634064d32b0a967ca97' ]
								]
							]
						];
					break;
					case 'Google':
						$config = [
							'callback' => $urlCallback.$this->rede,
							'providers'=>[
								'Google'=>[
									'enabled'=>true,
									'keys'     => [ 'id' => '540948825743-n8vqmgotkgl7cfetgkhh1911411mhcsc.apps.googleusercontent.com', 'secret' => 'izUV01B0E4Pkrrhs8o6EWgqM' ]
								]
							]
						];
					break;
					case 'LinkedIn':
						$config = [
							'callback' => $urlCallback.$this->rede,
							'providers'=>[
								'LinkedIn'=>[
									'enabled'=>true,
									'keys'     => [ 'id' => '772eq6xy5cqbub', 'secret' => 'YI9PeFJtODF4E2Zc' ]
								]
							]
						];
					break;
				}
				
				try{
					$hybridauth = new Hybridauth( $config );
					$adapter = $hybridauth->authenticate($this->rede);
	
					/* ************** esta havendo algum erro neste ponto **************** */
	
					$userProfile = $adapter->getUserProfile();
					$adapter->disconnect();
	
					$dataUser = array(
						'identifier'=> $userProfile->identifier,
						'email'     => $userProfile->email,
						'foto'      => $userProfile->photoUrl,
						'nome'      => $userProfile->firstName,
						'sobrenome' => $userProfile->lastName,
						'username'  => $userProfile->displayName
					);

					// se o processo estiver ok até este ponto, então salvar informações obtidas

					var_dump($dataUser);
	
					// $this->msg = array(
					// 	'type'=>'success',
					// 	'title'=>'Cadastro concluído',
					// 	'msg'=>'Você esta conectado através do '.$this->rede
					// );
	
					// return;
					
				}catch(\Hybridauth\Exception\Exception $e){
					var_dump('exceção: '.$e->getMessage());
					
					// $this->msg = array(
					// 	'type'=>'error',
					// 	'title'=>'Oops, encontramos um problema!',
					// 	'msg'=>$e->getMessage()
					// );
				}
			}
		}

	}

	if(isset($_GET['rede']))
	new loginRede($_GET['rede']);
