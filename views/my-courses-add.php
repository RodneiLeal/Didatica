  <section class="content-header">
    <h1>Cadastro de curso</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Meus cursos</a></li>
      <li class="active">Cadastro de novo curso</li>
    </ol>
  </section>



<?php


  if(isset($_GET['step']))
  {
    if($_GET['step']==2)
    {

      ?>
      <section class="content" id="my-courses-add-step-2">
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
                                  <!--<input class="form-control" type="file" name="inputCourseImagem" onchange="previewImage(this)" accept="image/*"/>-->
                               
                                  <input type="file" name="produto_imagem_1" id="product_file_image_1" class="product_file_image_input" >

                               </div>
                               <div class="col-md-6 text-left">
                                  <div class="preview_block"></div>
                                  <img id="preview" src="" height="100%" width="100%" />
                               </div>
                            </div>
                        </div>
                     </div>

                      <div class="col-md-12 text-center">
                      <hr>
                        <input id="act" name="act" value="course_creator_2_up_image" type="hidden">
                        <input id="course_register" name="course_register" value="<?php echo (int)$_GET['course'];?>" type="hidden">
                        <a href="dashboard.php?p=my-courses-add&step=3&course=<?php echo (int)$_GET['course'];?>" class="btn btn-primary btn-lg "><i class="fa fa-plus"></i> Salvar imagem e continuar</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </section>
<?php
    }

    if($_GET['step']==3)
    {
      ?>
      <section class="content" id="my-courses-add-step-3">
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

                  <form class="form-horizontal" id="FormeditCourseSave" action="controller/course.php" event="dashboard.php?p=my-courses-add&step=2&course=Registro;" event_type='transfer_new_id_for_input' event_transfer_id='course_register_content_save_id'>
                    <div class=" box_content_add" style="display:none">
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
                                      <div class="cd-main-content-load"></div>
                                      <main class="cd-main-content" style="display: none">
                                          <div class="output"></div>
                                          <!-- put your arfaly container anywhere -->
                                          <div id="mas"></div>
                                      </main>
                                    </center>
                               </div>
                        </div>
                            <div class="col-md-12">

                                <input id="course_register_content" name="course_register_content" value="<?php echo (int)$_GET['course'];?>" type="hidden">
                                <input id="course_register_content_save_id" name="course_register_content_save_id" type="hidden">


                                <button type="button" class="btn btn-success btn-md " id="inputCourseContentAdd"><i class="fa fa-plus"></i> Adicionar arquivos</button>
                                <button type="button" class="btn btn-success btn-md hidden" id="inputCourseContentNewAdd"><i class="fa fa-plus"></i> Adicionar novo conteúdo</button>
                              
                            </div>
                      </div>
                      
						<hr>
                      <div class="col-md-12" id="courselistcontent"></div>
                      <script>
                           

                      </script>
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
        </div>
      </section>
<?php
    }


    if($_GET['step']==4)
    {
?>


      <section class="content" id="my-courses-add-step-4">
        <div class="row">
          <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Configuração de Prova</h3>
                </div>
                  <div class="box-body">
                    <div class="col-md-12 text-left">
                       <button type="button" class="btn btn-primary btn-xs " id="box_question_add_button"><i class="fa fa-plus"></i> Adicionar Questão</button>
                    </div>

                            <br><BR>
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
        </div>
      </section>

<?php
    }
  }
  else
  {
    ?>

    <section class="content" id="my-courses-add-step-1">
      <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Informações básicas</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" id="FormeditCourseSave" action="controller/course.php" event="dashboard.php?p=my-courses-edit&course=Registro&action=change" event_type='redireciona'>

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
										echo 
										'
											<option value="'.$categorias['curso_categoria_id'].'">'.$categorias['curso_categoria_nome'].'</option>
										';
									}
								?>
							</select>
                          </div>
                        </div>
						
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Título do curso</label>
                            <input type="text" class="form-control" name="inputCourseTitle" id="inputCourseTitle" required="true" required_message="Ops, por favor, informe o título do curso" >
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Hora média do curso</label>
                            <input type="text" class="form-control time"  name="inputCourseHour" id="inputCourseHour" required="true"  >
                          </div>
                        </div>

                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Resumo (chamada rápida do curso)</label>
                              <textarea class="form-control" rows="2"  name="inputCourseResume" id="inputCourseResume" required="true" required_message="Ops, por favor, informe a chamada rápida (Resumo)" ></textarea>
                            </div>
                         </div>

                    </div>

                    <div class="col-md-6">
                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Descrição completa</label>
                              <textarea class="form-control" rows="9"   name="inputCourseDescription" id="inputCourseDescription" required="true" required_message="Ops, por favor, informe a descrição completa deste curso" ></textarea>
                            </div>
                         </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <hr>
                      <input id="inputName" name="operation" value="course_creator_1" type="hidden">
                      <button type="button" class="btn btn-primary btn-lg form_send_information_bt"><i class="fa fa-plus"></i> Salvar e continuar</button>
                    </div>
      


                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>


<?php
  }
?>














<script>
	load_content_data("courselistcontent","views/content/course/course-content-item-show-edit.php?course="+<?php echo (int)$_GET['course'];?>);
	load_content_data("courselistcontentquestion","views/content/course/course-content-item-show-edit.php?course="+<?php echo (int)$_GET['course'];?>);
</script>