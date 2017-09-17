
	

    <div id="bottom-sidebar-s2" class="container-fluid">

        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div id="footer-logo-image"><a href=""><img src="placeholders/logo-lg.png" alt=""></a></div>

                <div class="widget widget_text">
                    <p>A melhor plataforma de ensino Online.</p>
                </div>
                <!-- widget -->
                
            </div>
            <!-- col-md-4 -->

            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="row">
                    
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="widget clearfix widget_nav_menu">
                            
                            <h4 class="widget-title">Sobre nós</h4>
                            <div class="menu-menu-container">                                
                                <ul class="menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-528"><a href="#">Sobre nós</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-541"><a href="#">Política de Privacidade</a></li>
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-541"><a href="#">Quem pode se cadastrar</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- widget -->
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="widget clearfix widget_nav_menu">
                            
                            <h4 class="widget-title">Minha Conta</h4>
                            <div class="menu-menu-container">                                
                                <ul class="menu">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-528"><a href="#">Painel</a></li>
                                     <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-537"><a href="#">Meus Cursos</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-540"><a href="#">Certificados</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- widget -->
                    </div>

                </div>
                
            </div>
            <!-- col-md-4 -->


                <div class="col-md-4 col-sm-4 col-xs-12">

                    <div class="widget kopa-newsletter-widget">

                        <h4 class="widget-title">Newsletter</h4>
                        
                        <form class="newsletter-form clearfix" method="post" action="">
                            <p class="input-email clearfix">
                                <input type="text" size="40" required class="email" value="" name="email" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';">
                                <input type="submit" class="submit" value="Assinar">
                            </p>                    
                        </form>
                        <div id="newsletter-response"></div>

                    </div>
                    <!-- kopa-newsletter-widget -->

                    <div class="widget kopa-social-link-widget">

                        <h4 class="widget-title">Siga-nos</h4>

                        <ul class="social-nav model-2 clearfix">
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                        
                    </div>
                    <!-- kopa-social-link-widget -->
                    
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

	
	<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="">Entrar</a></li>
				<li><a href="">Novo Cadastro</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form login_box">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="user_email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Informe seu e-mail!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Senha</label>
						<input class="full-width has-padding has-border" id="user_pass" type="password"  placeholder="Senha">
						<a class="hide-password">Mostrar</a>
						<span class="cd-error-message">Informe sua senha!</span>
					</p>

					<p class="fieldset">
 						<button class="full-width" type="button" id="login-bt" access="website">Login</button>
					</p>
				</form>

				<div class="social-auth-links text-center">
					<p>- OU -</p>

					<a href="controller/login_social/login.php?login=facebook" class="btn btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</a>

					<a href="controller/login_social/login.php?login=google" class="btn btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Google+</a>

					<a href="controller/login_social/login.php?login=linkedin" class="btn btn-social btn-linkedin btn-flat"><i class="fa fa-linkedin"></i> Linkedin</a>

				</div><!-- /.social-auth-links -->
				<BR><BR>
				<p class="cd-form-bottom-message"><a href="#0">Esqueceu sua senha?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
					
				<form class="cd-form register_box">

					<p class="fieldset">
						<label class="image-replace cd-username" for="register_name">Seu nome</label>
						<input class="full-width has-padding has-border" id="register_name" type="text" placeholder="Seu nome">
						<span class="cd-error-message">Informe seu Nome!</span>
 					</p>
					
					<!-- <p class="fieldset">
						<label class="image-replace cd-username" for="register_cpf">Seu CPF</label>
						<input class="full-width has-padding has-border" id="register_cpf" type="text" placeholder="CPF">
						<span class="cd-error-message">Informe seu CPF!</span>
					</p> -->
					
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
						<button class="full-width has-padding" type="button" id="register-bt" access="new_register">Criar nova conta</button>
					</p>
				</form>

				<div class="social-auth-links text-center">
					<p>- OU -</p>
				 
					<a href="controller/login_social/login.php?login=facebook" class="btn btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</a>
					<a href="controller/login_social/login.php?login=google" class="btn btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Google+</a>
					<a href="controller/login_social/login.php?login=linkedin" class="btn btn-social btn-linkedin btn-flat"><i class="fa fa-linkedin"></i> Linkedin</a>
					<p>- OU -</p>
				</div><!-- /.social-auth-links -->
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Esqueceu sua senha, por favor, informe seu e-mail, você receberá sua nova senha no e-mail informado.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<button class="full-width has-padding" type="button" onclick="lembrar_senha_site()">Gerar nova senha</button>
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Voltar para log-in</a></p>
			</div> <!-- cd-reset-password -->

			<a href="#0" class="cd-close-form">Fechar</a>
		</div> <!-- cd-user-modal-container -->

	</div> <!-- cd-user-modal -->
</body> 
</html>
<script>
	$(function() {
		$( '#dl-menu' ).dlmenu({
			animationClasses : { classin : 'dl-animate-in-5', classout : 'dl-animate-out-5' }
		});
	});
</script>
	
	
	