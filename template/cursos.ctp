<?php
	$curso_categoria_nome	 = $this->action;
	$curso_subcategoria_nome = $this->param[0];
	$cursos = $this->cursos->getCursosPorCategoria($curso_categoria_nome, $curso_subcategoria_nome);
	$categoria_curso = isset($curso_subcategoria_nome)?$curso_subcategoria_nome:$curso_categoria_nome;
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
                                <?=$curso_categoria_nome;?>
                            </h1>
                        </div>
                        <div class="col-md-12">
							<h5 class=" clearfix pull-left" style="color:#fff">
							
							<?php
								if($cursos):
									echo "Os maiores especialistas em $categoria_curso";
								else:
									echo "Não encontramos nenhum curso para $categoria_curso";
								endif;
							?>

							</h5>
                        </div>

                        <!-- col-md-12 -->                        
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- page-header-inner -->
        </header>

		
        <section class="kopa-area kopa-area-15">

			<div class="container">
	    		<div class="row">
	    			<div class="col-md-12 col-sm-12 col-xs-12">
	    				<div class="widget kopa-masonry-list-2-widget">
	    					<div class="widget-title widget-title-s5 text-left">
								<span></span>
 	                            <h4>Cursos para: <?=$categoria_curso?></h4>
 	                        </div>

	    					<div class="masonry-list-wrapper">
                                <ul class="clearfix">
								
								<?php
									if($cursos):
										foreach ($cursos as $curso):
											extract($curso);
                                            $imagem = empty($imagem)?'img/curso/no-image.png':$imagem;
                                            $media  = number_format($media, 2, '.', ' ');
								?>
											<li class="masonry-item">
												<article class="entry-item hot-item" data-html="true" data-toggle="popover" data-container="body" data-content="<?=$resumo?>">
													<div class="entry-thumb">
														<a href="curso/<?=$idcurso?>/<?=Main::preparaURL($categoria)?>/<?=Main::preparaURL($titulo)?>">
															<!-- <div class="mask"></div> -->
															<img src="<?=$imagem?>" height="230px">
														</a>
														<!--<span class="entry-hot">New</span> se curso inserido a menos de 30 dias -->
													</div>
														

													<div class="entry-content">
														<div class="avaliacao">
															<div class="starrr" data-rating="<?=$media?>" title="Média entre <?=$votantes?> opiniões de alunos"><span><?=$media?></span> </div>
														</div>
														<div class="course-teacher">
															<span><?=$categoria?></span><br>
															<a href="instrutor/<?=$instrutor_idinstrutor?>/<?=Main::preparaURL($instrutor)?>"><?=$instrutor?></a>
														</div>
												
														<h6 class="entry-title">
															<a href="curso/<?=$idcurso?>/<?=Main::preparaURL($categoria)?>/<?=Main::preparaURL($titulo)?>">                                                            
															<?=$titulo?>
															</a>
														</h6>
													</div>
												</article>
											</li>

								<?php
										endforeach;
									endif;
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
						<?php if($cursos):?>
                            <h3>Veja mais de <?=count($cursos)?> cursos, ministrados por instrutores especializados</h3>
						<?php endif?>
                            <a class="kopa-button kopa-line-button medium-button" href="#">entrar agora</a>
                            
                        </div>
                        <!-- widget -->
                        
                    </div>
                    <!-- col-md-12 -->
                    
                </div>
                <!-- row -->

            </div>
            <!-- container -->
            
        </section>
    </div>
    <!-- main-content -->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js" charset="utf-8"></script>
	<script src="js/main.js"></script>
	<script src="dist/functions.js"></script>
	<script src="js/menu/modernizr.custom.js"></script>
	<script src="js/menu/jquery.dlmenu.js"></script>
	
	<link href="../plugins/notification/toastr.min.css" rel="stylesheet" type="text/css" />
	<script src="../plugins/notification/toastr.min.js"></script>
</body> 


</html>