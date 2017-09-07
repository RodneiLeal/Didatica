<div class="content-wrapper">
  <section class="content-header">
    <h1>Cadastro de curso</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Meus cursos</a></li>
      <li class="active">Cadastro de novo curso</li>
    </ol>
  </section>



<?php
	if( (isset($_GET['action'])) && ($_GET['action']=='change') )
	{
	 
		include 'config/config_site.php';
		$curso_id = (int)$_GET['course'];

		$retorno = ExecData($mysqli, 'cursos','cursos_lista','*', $curso_id);
		$row = mysqli_fetch_array($retorno);
    
			if($row['usuario_id'] !== $_SESSION['usuarioID'])
			{
				echo 
				'
					<hr>
					<div class="row text-center">
						<div class="col-md-12">
							<h1>Você não tem permissão para acessar está área</h1>
						</div>
					</div>
					
				';
				exit;
			}

	?>
			<hr>
			<div class="row text-center">
				<div class="col-md-12">
					<button type="button" class="btn btn-primary btn-xs" onclick="$('.content').fadeOut(200);$('#my-courses-add-step-1').fadeIn(200)">Informações básicas</button>
					<button type="button" class="btn btn-primary btn-xs" onclick="$('.content').fadeOut(200);$('#my-courses-add-step-2').fadeIn(200)">Imagem principal</button>
					<button type="button" class="btn btn-primary btn-xs" onclick="$('.content').fadeOut(200);$('#my-courses-add-step-3').fadeIn(200)">Conteúdo</button>
					<button type="button" class="btn btn-primary btn-xs" onclick="$('.content').fadeOut(200);$('#my-courses-add-step-4').fadeIn(200)">Questões do exame</button>
				</div>
			</div>
			
			
	<?php
	}
    ?>

	
 
    <section class="content " id="my-courses-add-step-1">
      <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Informações básicas</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" id="FormeditCourseSave" action="controller/course.php">
				
				<input id="course_edit_id" name="course_edit_id" type="hidden" value="<?php echo $curso_id;?>">
				
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Categoria do curso</label>
							<select class="form-control select2" style="width: 100%;"  name="inputCourseCategory" id="inputCourseCategory" required="true" required_message="Ops, por favor, informe a categoria do curso" >
								<?php
									$retorno_categorias = ExecData($mysqli, 'cursos','curso_categorias_lista','*', 0);
									while($categorias = mysqli_fetch_array($retorno_categorias))
									{
										
										$selecionar = ($row['curso_categoria_id'] == $categorias['curso_categoria_id']) ? ("selected") : ("");
										echo 
										'
											<option '.$selecionar.' value="'.$categorias['curso_categoria_id'].'">'.$categorias['curso_categoria_nome'].'</option>
										';
									}
								?>
							</select>
                          </div>
                        </div>
						
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Título do curso</label>
                            <input type="text" class="form-control" name="inputCourseTitle" id="inputCourseTitle" value="<?php echo $row['curso_titulo'];?>" required="true" required_message="Ops, por favor, informe o título do curso" >
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Hora média do curso</label>
                            <input type="text" class="form-control time"  name="inputCourseHour" id="inputCourseHour" value="<?php echo $row['curso_horas_total'];?>"  required="true" required_message="Ops, por favor, informe a média de horas deste curso" >
                          </div>
                        </div>

                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Resumo (chamada rápida do curso)</label>
                              <textarea class="form-control" rows="2"  name="inputCourseResume" id="inputCourseResume" required="true" required_message="Ops, por favor, informe a chamada rápida (Resumo)" ><?php echo $row['curso_resumo'];?></textarea>
                            </div>
                         </div>

                    </div>

                    <div class="col-md-6">
                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Descrição completa</label>
                              <textarea class="form-control" rows="9"   name="inputCourseDescription" id="inputCourseDescription" required="true" required_message="Ops, por favor, informe a descrição completa deste curso" ><?php echo $row['curso_descricao'];?></textarea>
                            </div>
                         </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <hr>
                      <input id="inputName" name="operation" value="course_editor_1" type="hidden">
                      <button type="button" class="btn btn-primary btn-lg form_send_information_bt"><i class="fa fa-plus"></i> Salvar </button>
                    </div>
      


                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>
	
	
      <section class="content" style="display:none" id="my-courses-add-step-2">
        <div class="row">
          <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Imagem principal do seu curso</h3>
                </div>
                <form method="post" action=""  enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="col-md-12 text-center">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Imagem principal</label>
                            <div class="col-md-12 text-center">
                              <hr>
                               <div class="col-md-6">
                                
                                  <input type="file" name="produto_imagem_1" id="product_file_image_1" class="product_file_image_input" >

                               </div>
                               <div class="col-md-6 text-left">
                                  <div class="preview_block"></div>
                                  <img id="preview" src="dist/img/courses/<?php echo $row['curso_imagem'];?>" height="100%" width="100%" />
                               </div>
                            </div>
                        </div>
                     </div>

                      <div class="col-md-12 text-center">
                      <hr>
                        <input id="act" name="act" value="course_creator_2_up_image" type="hidden">
                        <input id="course_register" name="course_register" value="<?php echo (int)$_GET['course'];?>" type="hidden">
                        
                      </div>
                  </div>
				</form>
              </div>
          </div>
        </div>
      </section>
 
      <section class="content " style="display:none" id="my-courses-add-step-3">
        <div class="row">
          <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Conteúdo do curso</h3>
                </div>
                  <div class="box-body">
                    <div class="col-md-12 text-left">
                       <button type="button" class="btn btn-primary btn-xs " id="box_content_add_button"><i class="fa fa-plus"></i> Adicionar conteúdo</button>
                      <hr>
                    </div>

                  <form class="form-horizontal" id="FormeditCourseEditContentSave" action="controller/course.php" >
                    <div class=" box_content_add" style="display:none">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-12">
								  <div class="col-md-6">
									<div class="form-group">
									  <label for="exampleInputEmail1">Título do conteúdo</label>
									  <input type="text" class="form-control" name="inputCourseContentTitle" id="inputCourseContentTitle" required="true" required_message="Ops, por favor, informe o título do conteúdo" >
									</div>

									<div class="form-group">
									  <label for="exampleInputEmail1">Descrição</label>
									  <textarea class="form-control" rows="6"  name="inputCourseContentResume" id="inputCourseContentResume" required="true" required_message="Ops, por favor, informe os detalhes da descrição" ></textarea>
									</div>
								  </div>
								   <div class="col-md-6">
										<center>
										  
										  <main class="cd-main-content">
											  <div class="output"></div>
												<!-- put your arfaly container anywhere 
													<div id="mas"></div>
												-->
												<input type="file" name="files[]" id="file_input_files" multiple="multiple">
										  </main>
										</center>
								   </div>
								  </div>
							</div>
						</div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">	
										<input id="course_register_content" name="course_register_content" value="<?php echo (int)$_GET['course'];?>" type="hidden">

										<input type="hidden" id="operation" name="operation" value="course_creator_add_content">
										<div class="cd-main-content-load"></div>
										<button type="button" class="btn btn-success btn-md " id="inputCourseContentAdd"><i class="fa fa-check"></i> Salvar Conteúdo</button>
										<button type="button" class="btn btn-success btn-md hidden" id="inputCourseContentNewAdd"><i class="fa fa-plus"></i> Adicionar novo conteúdo</button>
									</div>
								</div>
							</div>
                    </div>
                      
					
					<div class="row">
						<hr>
						<div class="col-md-12" id="courselistcontent"></div>
                    </div> 

                    </div>
                  </form>

                    <div class="col-md-12 text-center">
                    <hr>
                      <input id="inputName" name="operation" value="course_creator_add_content" type="hidden">
                       <a href="dashboard.php?p=my-courses-add&step=4&course=<?php echo (int)$_GET['course'];?>" class="btn btn-primary btn-lg "><i class="fa fa-plus"></i> Continuar</a>
                    </div>
                  </div>
              </div>
          </div>
         
      </section>
 

      <section class="content " style="display:none" id="my-courses-add-step-4">
        <div class="row">
          <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Configuração de Prova</h3>
                </div>
                  <div class="box-body">
                    <div class="col-md-12 text-left">
                       <button type="button" class="btn btn-primary btn-xs" id="box_question_add_button"><i class="fa fa-plus"></i> Adicionar Questão</button>
						<hr>
					</div>

                            
                            <div class="col-md-12" id="inputCourseQuestionAnswer_div" style="display: none">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Questão</label>
                                <input type="text" class="form-control" name="inputCourseQuestionTitle" id="inputCourseQuestionTitle" required="true" required_message="Ops, por favor, informe a pergunta" >
                              </div>

                                <div class="row">
                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Opções de resposta 1</label>
                                          <span class="input-group-addon">
                                            <input type="radio" aria-label="..." value="1" class="inputCourseQuestionAnswer_correct"> <br>correta
                                          </span>
                                          <input type="text" id="inputCourseQuestionAnswer1" name="inputCourseQuestionAnswer1" class="form-control" aria-label="...">
                                        </div>
                                  </div>

                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Opções de resposta 2</label>
                                          <span class="input-group-addon">
                                            <input type="radio" aria-label="..." value="2"  class="inputCourseQuestionAnswer_correct"> <br>correta
                                          </span>
                                          <input type="text" id="inputCourseQuestionAnswer2" name="inputCourseQuestionAnswer2" class="form-control" aria-label="...">
                                        </div>
                                  </div>

                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Opções de resposta 3</label>
                                          <span class="input-group-addon">
                                            <input type="radio" aria-label="..." value="3"  class="inputCourseQuestionAnswer_correct"> <br>correta
                                          </span>
                                          <input type="text" id="inputCourseQuestionAnswer3" name="inputCourseQuestionAnswer3" class="form-control" aria-label="...">
                                        </div>
                                  </div>

                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Opções de resposta 4</label>
                                          <span class="input-group-addon">
                                            <input type="radio" aria-label="..." value="4"  class="inputCourseQuestionAnswer_correct"> <br>correta
                                          </span>
                                          <input type="text" id="inputCourseQuestionAnswer4" name="inputCourseQuestionAnswer4" class="form-control" aria-label="...">
                                        </div>
                                  </div>

                                  <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Opções de resposta 5</label>
                                          <span class="input-group-addon">
                                            <input type="radio" aria-label="..." value="5" class="inputCourseQuestionAnswer_correct"> <br>correta
                                          </span>
                                          <input type="text" id="inputCourseQuestionAnswer5" name="inputCourseQuestionAnswer5" class="form-control" aria-label="...">
                                        </div>
                                  </div>
                                </div>

                              
                                  <button type="button" class="btn btn-success btn-md" course="<?php echo (int)$_GET['course'];?>" id="inputCourseQuestionAnswer_bt"><i class="fa fa-plus"></i> Salvar questão</button>
                               
                            </div>
							<hr>
								<div class="col-md-12" id="courselistcontentquestion"></div>

								</div>
                      <div class="col-md-12 text-center">
                      <hr>
                          <a href="dashboard.php?p=course&curso_id=<?php echo (int)$_GET['course'];?>" class="btn btn-primary btn-lg "><i class="fa fa-plus"></i> Finalizar</a>
                      </div>
                        
                  </div>
              </div>
          </div>
         
      </section>



 







</div>




