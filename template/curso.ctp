<?php

$curso_id = $this->action;

$retorno = ExecData($mysqli, 'cursos','cursos_lista_frontend_curso','*', $curso_id);
$row = mysqli_fetch_array($retorno);

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
                                <?php echo $row['curso_titulo'];?>
                            </h1>
                        </div>
                        <div class="col-md-12">
							<h5 class=" clearfix pull-left" style="color:#fff"><?php echo $row['curso_resumo'];?></h5>
                        </div>
                        <div class="col-md-12  pull-left">
							<br>
							<h6 class=" clearfix pull-left" style="color:#fff">Criado por: <?php echo $row['usuario_nome'];?></h6>
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
											<?php echo $row['curso_descricao'];?>
										</p>

                                        <br>

                                        <div class="tag-box">

                                            <span>Categoria:</span>

                                            <a href="#"><?php echo $row['curso_categoria_nome'];?></a>
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
 
                                        <div class="about-author">
                                            <div class="author-avatar pull-left">
												<a href="#">
													<img src="<?php echo mostra_imagem('user_frontend',$row['usuario_foto']);?>" alt="<?php echo $row['usuario_nome'];?>">
												</a>
											</div>
                                            <div class="author-content">
                                                <h4><a href="#"><?php echo $row['usuario_nome'];?></a></h4>
												<?php echo $row['usuario_formacao'];?>
                                                <p>
													<?php echo $row['usuario_sobre'];?>
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
									setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
									date_default_timezone_set('America/Sao_Paulo');
									
									$retorno_comentarios_sql = ExecData($mysqli, 'cursos','cursos_lista_frontend_avaliacao','*', $curso_id);
									//echo $retorno_comentarios_sql;
									$retorno_comentarios = mysqli_query($mysqli, $retorno_comentarios_sql);
									while($comentarios = mysqli_fetch_array($retorno_comentarios))
									{
										echo 
										'
											<li class="comment clearfix">
												<article class="comment-wrap clearfix"> 
													<div class="comment-avatar pull-left">
														<img alt="" src="'.mostra_imagem('user',$comentarios['usuario_foto']).'">
													</div>
													<div class="comment-body">
														<div class="comment-content">
															<p>
																'.$comentarios['curso_avaliacao_comentario'].'
															</p>
														</div>
																					  
														<footer class="clearfix">
															<div class="pull-left">
																<h6>'.$comentarios['usuario_nome'].'</h6>
															</div>
															<div class="pull-right clearfix">
																<span class="entry-date pull-left">
																	'.strftime('%A, %d de %B de %Y', strtotime($comentarios['curso_avaliacao_data_cadastro'])).'
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
							<img src="<?="dist/img/courses/".$row['curso_imagem']?>" height="218px">
 	                        <div class="widget-content text-center">
								<br>
	                        	<form method="post" action="#" class="course-form clearfix">
									 
									<h5><?php echo $row['curso_titulo'];?></h5>


									<?
										$retorno_matricula = ExecData($mysqli, 'cursos','cursos_matricula','*', $curso_id);
										$row_matricula = mysqli_fetch_assoc($retorno_matricula);

									if(!isset($_SESSION['usuarioID'])){
										echo 
										'
										<a href="javascript:void()" id="course_start" course="'.$curso_id.'" class="kopa-button green-button medium-button kopa-button-icon course_start">Iniciar Curso</a>
										';
									}else if(empty($row_matricula['matricula_id']) && isset($_SESSION['usuarioID'])){
											echo 
											'
											<a href="javascript:void()" id="course_start" course="'.$curso_id.'" class="kopa-button green-button medium-button kopa-button-icon">Iniciar Curso</a>
											';
										}else{
											echo 
											'
												<a class="kopa-button green-button medium-button kopa-button-icon" href="dashboard.php?p=course&curso_id='.$curso_id.'&enroll='.$row_matricula['matricula_id'].'&act=read">Acessar Curso</a>
											';
										}
									?>

		                            	                            
		                        </form>
								<hr>
									<div class="comment-avatar  ">
										<img alt="" src="<?php echo mostra_imagem('user',$comentarios['usuario_foto']);?>" width="50px">
									</div>
									<h6><?php echo $row['usuario_nome'];?></h6>
									<?php echo $row['usuario_formacao'];?>
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

 

	
	
	
	
	<?php include '_rodape.php';?>
	
	 

    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js" charset="utf-8"></script>
	<script src="js/main.js"></script>
	<script src="dist/functions.js"></script>
	<script src="js/menu/modernizr.custom.js"></script>
	<script src="js/menu/jquery.dlmenu.js"></script>
	
	<link href="plugins/notification/toastr.min.css" rel="stylesheet" type="text/css" />
	<script src="plugins/notification/toastr.min.js"></script>
</body> 


</html>
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