<?php
	extract($this->curso->getCursoId($this->action)[0]);
?>
    <div id="main-content">
        <header class="page-header">
            <div class="mask-pattern"></div>
            <div class="mask"></div>
            <div class="page-header-bg page-header-bg-1"></div>
            <div class="page-header-inner">
                <div class="container">
                    <div class="row">
						<div class="col-md-9">
							<h1 class="page-title clearfix pull-left">
								<?=$titulo?>
							</h1>
						</div>
					</div>
					
					<div class="row">
                        <div class="col-md-12  pull-left">
							<br>
							<h6 class=" clearfix pull-left" style="color:#fff">Criado por: <?=$instrutor?></h6>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <p><?=$resumo?></p>
										<h5 class="entry-title">O que você vai aprender neste curso:</h5>
										<div class="entry-content">
											<p><?=$ementa?></p>
										</div>	
										<div class="tag-box">
											<span>Categoria:</span>
											<a href="cursos/<?=$categoria?>"><?=$categoria?></a>
										</div>

										<?php
											$instrutor_foto = empty($instrutor_foto)?'img/users/sem-foto.png':$instrutor_foto;
										?>

                                    </div>
                    			</div>
                    		</div>

                            <div id="comments">
                                <h4>Comentários</h4>
                                <ol class="comments-list clearfix">
								<?php
									if($comentarios = $this->curso->getCursoComentarios($idcurso)):
										foreach($comentarios as $comentario) :
											extract($comentario);
											$avatar = empty($avatar)?'img/users/sem-foto.png':$avatar;
								?>

									<li class="comment clearfix">
										<article class="comment-wrap clearfix">
											<div class="comment-avatar pull-left">
												<img alt="<?=$nome?>" src="<?=$avatar?>">
												<h6><?=$nome?></h6>
											</div>
											<div class="comment-body">
												<div class="comment-content">
													<p>
														<?=$comentario?>
													</p>
												</div>
												<div>
													<p>
														<?=$justificativa?>
													</p>
												</div>
												<div class="avaliacao">
                                                	<div class="starrr" data-rating="<?=$estrelas?>"></div>
                                            	</div>
												<footer class="clearfix">
													<div class="pull-right clearfix">
														<span class="entry-date pull-left">
															<?=strftime('%A, %d de %B de %Y', strtotime($data_avaliacao))?>
														</span>
													</div>
												</footer>
											</div>
										</article>
									</li>

								<?php
										endforeach;
									endif;
								?>

                                </ol>
                            </div>
                    	</div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">

                    	<div class="widget kopa-course-search-2-widget">
							<?php $imagem = empty($imagem)?'img/curso/no-image.png':$imagem;?>

							<img src="<?=$imagem?>" id="capa">
 	                        <div class="widget-content text-center">
								<br>
									<h5><?=$titulo?></h5>

									<?php
										if(isset($_SESSION['idusuario'])):

											$inscricao = new Inscricao;
											$inscricao = $inscricao->getInscricaoPorCursoUsuario($_SESSION['idusuario'], $idcurso)[0];
											if($inscricao):
									?>
												<!-- direciona o usuario para a pagina do curso -->
												<button data-inscr="<?=$inscricao['idinscricao']?>" class="kopa-button green-button medium-button kopa-button-icon acessar-curso">Acessar Curso</button>
									
											<?php else:?>
												<!-- registra o curso na base de dados e direciona o usuario para a pagina do curso -->
												<button  data-curso="<?=$idcurso?>" data-user="<?=$_SESSION['idusuario']?>" class="kopa-button green-button medium-button kopa-button-icon iniciar-curso">Iniciar Curso</button>
										
											<?php endif?> 
										<?php else :?>
												<!-- Obriga o usuario a efetuar o cadastro ou o login e depois direciona-o para a pagina do curso -->
											<button class="kopa-button green-button medium-button kopa-button-icon cd-signin">Iniciar Curso</button>
										
									<?php endif ?>

								<hr>
									<div class="comment-avatar  ">
										<img class="img-circle" alt="foto do instrutor" src="<?=$instrutor_foto?>" width="50px">
									</div>
									<h6><?=$instrutor?></h6>

	                        </div>
        				</div>
                    </div>
                </div>
            </div>
        </section>
    </div>