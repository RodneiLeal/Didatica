<?php
	extract($this->curso->getCurso($this->action)[0]);
?>
    <div id="main-content">
        <header class="page-header">
            <div class="mask-pattern"></div>
            <div class="mask"></div>
            <div class="page-header-bg page-header-bg-1"></div>
            <div class="page-header-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-title clearfix pull-left">
                                <?=$titulo?>
                            </h1>
                        </div>
                        <div class="col-md-12">
							<h5 class=" clearfix pull-left" style="color:#fff"><?=$resumo_rapido?></h5>
                        </div>
                        <div class="col-md-12  pull-left">
							<br>
							<h6 class=" clearfix pull-left" style="color:#fff">Criado por: <?=$instrutor?></h6>
                        </div>
                        <!-- col-md-12 -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- page-header-inner -->
        </header>


        <section class="kopa-area kopa-area-31">

            <div class="container">

                <div class="row">

                    <div class="col-md-9 col-sm-9 col-xs-12">

                    	<div class="entry-course-box">

                    		<div class="row">

                    			<div class="col-md-12 col-sm-12 col-xs-12 left-col">

                                    <h5 class="entry-title">SOBRE O CURSO</h5>

                                    <div class="entry-content">
                                        <p>
											<?=$ementa?>
										</p>

                                        <br>

                                        <div class="tag-box">

                                            <span>Categoria:</span>

                                            <a href="#"><?=$categoria?></a>
                                        </div>
                                        <!-- tag-box -->

                                        <div class="social-box clearfix">


                                            <ul class="social-links pull-left">
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ccbb241577e148"></script>
												<!-- Go to www.addthis.com/dashboard to customize your tools -->
												<div class="addthis_inline_share_toolbox_pivb"></div>
                                            </ul>

                                        </div>

                                        <!-- social-box -->

										<?php
											$foto = empty($foto)?'img/users/sem-foto.png':base64_decode($foto);
										?>

                                        <div class="about-author">
                                            <div class="author-avatar pull-left">
												<a href="#">
													<img src="<?=$foto?>" alt="<?=$instrutor?>">
												</a>
											</div>
                                            <div class="author-content">
                                                <h4><a href="#"><?=$instrutor?></a></h4>
												Formação ???
                                                <p>
													Sobre o instrutor????
												</p>

                                            </div>
                                        </div>
                                        <!-- about-author -->

                                    </div>

                    			</div>
                    			<!-- col-md-8 -->


                    		</div>
                    		<!-- row -->


                            <div id="comments">
                                <h4>Comentários</h4>
                                <ol class="comments-list clearfix">
								<?php

									foreach($this->curso->getCursoComentarios($idcurso) as $comentario) {
										extract($comentario);
										echo
										'
											<li class="comment clearfix">
												<article class="comment-wrap clearfix">

													<div class="comment-avatar pull-left">
														<img alt="subistituir foto por estrelas" src="">
													</div>

													<div class="comment-body">
														<div class="comment-content">
															<p>
																'.$comentario.'
															</p>
														</div>
														<div>
															<p>
																'.$justificativa.'
															</p>
														</div>

														<footer class="clearfix">
															<div class="pull-left">
																<h6>'.$nome.'</h6>
															</div>
															<div class="pull-right clearfix">
																<span class="entry-date pull-left">
																	'.strftime('%A, %d de %B de %Y', strtotime($data_avaliacao)).'
																</span>
															</div>
														</footer>
													</div><!--comment-body -->
												</article>
											</li>
										';
									}
								?>
                                </ol><!--comments-list-->
                            </div>


                    	</div>
                    	<!-- entry-course-box -->


                    </div>
                    <!-- col-md-9 -->
                    <div class="col-md-3 col-sm-3 col-xs-12">

                    	<div class="widget kopa-course-search-2-widget">
						<?php
							$imagem = empty($imagem)?'img/curso/no-image.png':base64_decode($imagem);
						?>

							<img src="<?=$imagem?>" height="218px">
 	                        <div class="widget-content text-center">
								<br>
	                        	<form method="post" action="#" class="course-form clearfix">

									<h5><?$titulo?></h5>


									<?php
										if(!empty($_SESSION)){
											$inscricao = $this->curso->getInscricao($_SESSION['idusuario'], $idcurso)[0];
											if(empty($inscricao)){
												echo '<a href="javascript:void()" id="course_start" course="'.$idcurso.'" class="kopa-button green-button medium-button kopa-button-icon">Iniciar Curso</a>';
											}else{
												echo '<a href="dashboard.php?p=course&enroll='.$inscricao['idinscricao'].'&act=read" class="kopa-button green-button medium-button kopa-button-icon">Acessar Curso</a>';
											}
										}else{
											echo '<a href="javascript:void()" id="course_start" course="'.$idcurso.'" class="kopa-button green-button medium-button kopa-button-icon course_start">Iniciar Curso</a>';
										}
									?>


		                        </form>
								<hr>
									<div class="comment-avatar  ">
										<img alt="foto do instrutor" src="<?=$foto?>" width="50px">
									</div>
									<h6><?=$instrutor?></h6>
									<?php 
										// echo $row['usuario_formacao'];
									?>
	                        </div>
	                        <!-- widget-content -->
        				</div>

                    </div>
                    <!-- col-md-3 -->


                </div>
                <!-- row -->

            </div>
            <!-- container -->

        </section>
        <!-- kopa-area -->


		<section class="kopa-area kopa-area-15">
     		<div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="widget kopa-ads-2-widget">
                            <div class="widget-title widget-title-s5 text-center">
                                <span></span>
                                <h2>Faça parte do Didática Online</h2>
                                <p>Comece a ensinar ou a aprender</p>
								<BR><BR><BR>
                             </div>



							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12 text-center">
									<h4>Torne-se um Instrutor</h4>
									Ensine o que você adora. A Didática Online disponibiliza a facilidade para você criar seu curso online
									<br>
									<a href="#" class="kopa-button blue-button medium-button kopa-button-icon">Começar</a>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 text-center">
									<h4>Aprenda com os melhores</h4>
									Escolha grandes cursos e aprenda com os melhores e mais especializados instrutores da Didática Online
									<br>
									<a href="#" class="kopa-button blue-button medium-button kopa-button-icon">Entrar</a>
								</div>
							</div>

                        </div>
                        <!-- widget -->
                    </div>
                    <!-- col-md-12 -->
                </div>
                <!-- row -->
			</div>
		 </section>

    </div>
    <!-- main-content -->









<script>
	$(function() {
		$( '#dl-menu' ).dlmenu({
			animationClasses : { classin : 'dl-animate-in-5', classout : 'dl-animate-out-5' }
		});


			var jElement = $('.kopa-course-search-2-widget');
			$(window).scroll(function(){
				if ( $(this).scrollTop() > 300 ){
					jElement.css({
						'position':'fixed',
						'top':'10px'
					});
				}else{
					jElement.css({
 						'top':'100px'
					});
				}
			});
	});

</script>

