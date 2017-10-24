  <section class="content-header">
    <h1>Novo curso</h1>
    <ol class="breadcrumb">
      <li><a><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a>Cursos</a></li>
      <li class="active">Novo Curso</li>
    </ol>
  </section>

  <?php
    if(true):
  ?>
  <!-- Informações do curso -->
  <section class="content" id="my-courses-add-step-1">
    <div class="row">
      <form action="" method="post" >
      
        <!-- Dados iniciais do curso -->
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informações básicas </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <label>Título do curso</label>
                  <input type="text" class="form-control" name="inputCourseTitle" id="inputCourseTitle" required="true" required_message="Ops, por favor, informe o título do curso" >
                </div>
              </div>  
                
              <div class="row">
                <div class="col-md-6">
                  <label>Categoria do curso</label>
                  <select class="form-control" name="inputCourseCategory" id="inputCourseCategory">
                    <?php
                      if($categorias = $this->cursos->getCategorias()):
                        foreach($categorias as $categoria):
                    ?>
                    <option value="<?=$categoria['idcategoria']?>"><?=$categoria['categoria']?></option>
                    <?php
                        endforeach;
                      endif;
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Hora média do curso</label>
                  <input type="number" class="form-control time"  name="inputCourseHour" id="inputCourseHour" required="true"  value="30">
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <label>Resumo</label>
                  <textarea class="editor" id="editor1" class="form-control" name="inputCourseResume" required="true" required_message="Ops, por favor, informe a chamada rápida (Resumo)" ></textarea>
                </div>
                
                <div class="col-md-6">
                  <label>Ementa</label>
                  <textarea class="editor" id="editor2" class="form-control" name="inputCourseDescription" id="inputCourseDescription" required="true" required_message="Ops, por favor, informe a descrição completa deste curso" ></textarea>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-md-12">
                <input id="inputName" name="operation" value="course_creator_1" type="hidden">
                <button class="btn btn-success btn-lg">Próximo passo <i class="fa fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
        </div>

        <!-- preview do curso -->
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><a href="">Preview curso</a></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="preview_block"></div>
              <img id="preview" class="img-responsive course_list" src="img/curso/no-image.png" />
              <div class="starrr" data-rating="0" title="Média entre 0 Opiniões de alunos"><span>0</span></div>
              <div class="row">
                <div class="col-md-12">
                  <h5>Categoria</h5>    
                </div>
                <div class="col-md-12">
                  <h5>autor</h5>
                </div>
                <div class="col-md-12">
                  <h4>Tíulo</h4>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <label>Imagem principal</label>
              <input type="file" name="produto_imagem_1" id="product_file_image_1" class="btn btn-dfault btn-xs product_file_image_input" >
            </div><!-- /.box-footer -->
          </div>
        </div>

      </form>
    </div>
  </section>

  <!-- ao clicar em avançar, este dados serão salvos no banco de dados e retornará a esta pagina -->

  <?php
    endif;
    if(true):
  ?>
 
  <!-- nesta etapa o instrutor poderá criar varias seções.
  cada seção comum titulo, descrição ou resumo e material de apoio que deverá ser arquivo .pdf -->
  
  <!-- arquivos do curso -->
  <section class="content" id="my-courses-add-step-3">
    <div class="row">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Grade do curso</h3>
            </div>

            <div class="box-body">
              <div class="box-group">

                <!-- template para os paineis de aula -->
                <div class="box box-primary panel">
                  <div class="box-header">
                    <h4 class="box-title">
                      <a href="#aula-1" data-parent="#accordion" data-toggle="collapse" aria-expanded="true">Aula 1</a>
                    </h4>
                  </div>
                  <div class="collapse in panel-collapse" aria-expanded="true" id="aula-1">
                    <div class="box-body">

                      <div class="row">
                        <div class="col-md-12">
                          <label>Titulo</label>
                          <input type="text" class="form-control" require placeholder="Titulo da Aula">
                          <br>
                          <label>Objetivos</label>
                          <textarea class="editor" name="" id="editor3" cols="30" ></textarea>
                          <br>
                          <input type="file" name="aula[]">
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>

              </div>
            </div>
            
            <div class="box-footer">
              <div class="col-md-12">
                <button class="btn btn-success btn-lg">Próximo Passo <i class="fa fa-angle-double-right"></i></button>
              </div>
            </div>            
          </div>
        </div>
      </form>
    </div>
  </section>

  <?php
    endif;
    if(true):
  ?>

  <!-- Prova -->
  <section class="content" id="my-courses-add-step-4">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">Banco de questões para Prova</h3>
          </div>

          <div class="box-body">

            <div class="box-group">

              <!-- template para questionario -->
              <div class="box box-primary panel">
                <div class="box-header">

                  <h4 class="box-title">
                    <a href="#panel-1" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" class="">Questão 1</a>
                  </h4>
                </div>

                <div class="collapse in panel-collapse" aria-expanded="true" id="panel-1">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Questão</label>
                        <input type="text" class="form-control" placeholder="Questão">
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-6">
                        <label>Opções</label>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="1" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="2" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                        
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="3" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label>Opções</label>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="4" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="5" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                      
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              
              <div class="box box-primary panel">
                <div class="box-header">
                  <h4 class="box-title">
                    <a href="#panel-2" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" style="">Quetão 2</a>
                  </h4>
                </div>
                
                <div class="collapse panel-collapse" aria-expanded="false" id="panel-2">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Questão</label>
                        <input type="text" class="form-control" placeholder="Questão">
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-6">
                        <label>Opções</label>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="1" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="2" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                        
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="3" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label>Opções</label>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="4" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>

                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="5" name="reposta-1">
                          </span>
                          <input class="form-control" type="text" placeholder="Resposta">
                        </div>
                      
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            
          </div>
          
          <div class="box-footer">
            <button class="btn btn-warning btn-lg">Adicionar Questão <i class="fa fa-question-circle"></i></button>
            <button class="btn btn-success btn-lg">Finalizar <i class="fa fa-thumbs-up"></i></button>
          </div>

        </div>
      </div>
    </div>
  </section>
 
  <?php endif;?>