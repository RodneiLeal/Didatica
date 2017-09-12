    <div id="main-content">

        <section class="container-fluid">

            <div class="home-slider home-slider-1">

                <div class="owl-carousel owl-carousel-1">

                    <div class="item">

                        <article class="entry-item">
                            <div class="entry-thumb">
                                <img src="placeholders/post-image/post-1.jpg" alt="">
                                <div class="mask"></div>
                            </div>
                            <div class="entry-content">
                                <div class="container">
                                    <div class="row center">
                                        <div class="col-md-6 col-sm-6 col-xs-12 left-col">
                                            <h2><a>Comece Agora.</a></h2>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 right-col">
                                            <p>
												Mude de vida. Comece a estudar agora!
												Cadastre-se no Didática Online e tenha acesso a centenas de cursos gratuitos
										
											</p>
                                            <button class="cd-signup btn btn-primary">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <!-- entry-item -->
                        
                    </div>
                    <!-- item -->

                    <div class="item">
                        <article class="entry-item">
                            <div class="entry-thumb">
                                <img src="placeholders/post-image/post-001.jpg" alt="">
                                <div class="mask"></div>
                            </div>
                            <div class="entry-content">
                                <div class="container">
                                    <div class="row center">
                                        <div class="col-md-6 col-sm-6 col-xs-12 left-col">
                                            <h2><a>Estudar nunca foi tão facil</a></h2>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 right-col">
                                            <ul>
                                                <li>Certificado Rápido</li>
                                                <li>Horas Complementares para Faculdade</li>
                                                <li>Conteúdo de Qualidade</li>
                                                <li>Cursos Gratuitos</li>
                                                <li>Prova Online</li>
                                            </ul>
                                            <button class="cd-signup btn btn-primary">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <!-- entry-item -->
                        
                    </div>
                    <!-- item -->
                    
                </div>
                <!-- owl-carousel-1 -->

                <div class="loading">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- loading -->
                
            </div>
            <!-- home-slider -->
            
        </section>
        <!-- container-fluid -->



<!--        <section class="kopa-area kopa-area-15 kopa-area-light">-->
		
        <section class="kopa-area kopa-area-15">

			<div class="container">
	    		<div class="row">
	    			<div class="col-md-12 col-sm-12 col-xs-12">
	    				<div class="widget kopa-masonry-list-2-widget">
	    					<div class="widget-title widget-title-s5 text-left">
 	                            <h4>Mais Pupulares</h4>
 	                        </div>

	    					<div class="masonry-list-wrapper">
                                <ul class="clearfix">

								
									<?php
										$retorno = ExecData($mysqli, 'cursos','cursos_lista_frontend','*', 0);
										while($cursos = mysqli_fetch_array($retorno))
										{
											echo 
											'
												<li class="masonry-item">
													<article class="entry-item hot-item">
														<div class="entry-thumb">
															<a href="curso/'.$cursos['curso_id'].'/'.preparaURL($cursos['curso_categoria_nome']).'/'.preparaURL($cursos['curso_titulo']).'">
																<div class="mask"></div>
																<img src="dist/img/courses/'.$cursos['curso_imagem'].'" height="230px">
															</a>
															<ul class="kopa-rating clearfix">
																<li><i class="fa fa-star"></i></li>
																<li><i class="fa fa-star"></i></li>
																<li><i class="fa fa-star"></i></li>
																<li><i class="fa fa-star"></i></li>
																<li><i class="fa fa-star-o"></i></li>
															</ul>
															<!--<span class="entry-hot">Hot</span>-->
														</div>
														<div class="entry-content">
															<div class="course-teacher">
																<span>'.$cursos['curso_categoria_nome'].'</span><br>
																<a href="#">'.$cursos['usuario_nome'].'</a>
															</div>
															<h6 class="entry-title">
																<a href="curso/'.$cursos['curso_id'].'/'.preparaURL($cursos['curso_categoria_nome']).'/'.preparaURL($cursos['curso_titulo']).'">
																	'.$cursos['curso_titulo'].'
																</a>
															</h6>
														</div>
													</article>
												</li>
											';
										}
									?>




                                </ul>
                                <!-- clearfix -->
                            </div>
                            <!-- masonry-list-wrapper -->
	    				</div>
	    				<!-- widget -->
	    			</div>
	    			<!-- col-md-12 -->
	    		</div>
	    		<!-- row -->
	    	</div>
	    	<!-- container -->
    	</section>
    	<!-- kopa-area-12 -->

		
		
        <section class="kopa-area-16 kopa-area-parallax">

            <div class="mask"></div>

            <div class="container">
                
                <div class="row">

                    <div class="col-md-12">

                        <div class="widget kopa-tagline-1-widget">
						<?php
							$total_query = ExecData($mysqli, 'sistema','dashboard_dados_rapidos','*', 0);
							$total = mysqli_fetch_assoc($total_query);
						?>
                            <h3>Veja mais de <?php echo $total['total_curso'];?> cursos, ministrados por instrutores especializados</h3>

                            <button class="cd-signin kopa-button kopa-line-button medium-button">entrar agora</button>
                            
                        </div>
                        <!-- widget -->
                        
                    </div>
                    <!-- col-md-12 -->
                    
                </div>
                <!-- row -->

            </div>
            <!-- container -->
            
        </section>

		
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
									<button class="cd-signup kopa-button blue-button medium-button kopa-button-icon">Começar</button>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 text-center">
									<h4>Aprenda com os melhores</h4>
									Escolha grandes cursos e aprenda com os melhores e mais especializados instrutores da Didática Online
									<br>
									<button class="cd-signup kopa-button blue-button medium-button kopa-button-icon">Entrar</button>
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