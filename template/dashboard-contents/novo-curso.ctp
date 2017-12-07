  <section class="content-header">
    <h1>Novo curso</h1>
    <ol class="breadcrumb">
      <li><a><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a>Cursos</a></li>
      <li class="active">Novo Curso</li>
    </ol>
  </section>

  <form method="POST" enctype="multipart/form-data" action="./controllers/curso/saveCourse.php">
    <!-- Informações do curso -->
    <section class="content" id="etapa-1">
      <div class="row">
        <!-- Dados iniciais do curso -->
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informações básicas </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Título do curso</label>
                  <input type="text" class="form-control curso-titulo" name="curso[titulo]" placeholder="Título do curso" >
                </div>

                <div class="col-md-6">
                  <label>Horas mínima de curso</label>
                  <input type="text" class="form-control time" name="curso[tempo]" placeholder="Tempo mínimo de curso em horas">
                </div>
              </div>

              <div class="row">

                <div class="col-md-6">
                  <label>Categoria do curso</label>
                  <select class="form-control curso-categoria">

                    <option disabled selected>Categorias</option>
                    <?php
                      if($categorias):
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
                  <label>Subcategorias do curso</label>
                  <select class="form-control curso-subcategoria" name="curso[subcategoria_idsubcategoria]">
                      <option disabled selected>Subcategorias</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Resumo <span class="label-desc">(Breve descrição sobre o curso)</span></label>
                  <textarea class="form-control editor" name="curso[resumo]" id="editor1" placeholder="Resumo simples"></textarea>
                </div>

                <div class="col-md-6">
                  <label>Ementa <span class="label-desc">(Tópicos do curso)</span></label>
                  <textarea class="form-control editor" name="curso[ementa]" id="editor2" ></textarea>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-md-12">
                <button type="button" class="btn btn-success btn-lg prox-etapa">Próximo <i class="fa fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- preview do curso -->
        <div class="col-md-4">
          <div class="box box-primary" style="overflow: hidden">
            <div class="box-header with-border">
              <h3 class="box-title">Preview curso</h3>
            </div><!-- /.box-header -->
            <div class="box-body" >
              <label for="selectImage">
                <img id="preview" class="img-responsive course_list imagePreview" src="img/curso/select-image.png" />
              </label>
              <input id="selectImage" type="file" name="curso" reqired class="btn btn-dfault btn-xs imageFile" style="display: none" >
              <div class="starrr" data-rating="0" title="Média entre 0 Opiniões de alunos"><span>0</span> </div>
              <div class="row">
                <div class="col-md-6">
                  <h5><strong>Categoria: </strong> <span class="preview-curso-categoria"></span></h5>
                </div>

                <div class="col-md-6">
                  <h5><strong>Subcategoria:</strong> <span class="preview-curso-subcategoria"></span></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h5><strong>Autor: </strong><?=$nome.' '.$sobrenome?></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="preview-curso-titulo">Tíulo</h4>
                </div>
              </div>


            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

    <!-- AULAS DO CURSO -->
    <section class="content display-hidden" id="etapa-2">
      <div class="row">
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
                          <input class="form-control" name="aula[titulo]"  placeholder="Titulo da Aula">
                          <br>
                          <label>Objetivos</label>
                          <textarea class="editor" name="aula[objetivos]" id="editor3"  palceholder="Descreva aqui os objetivos do seu curso"></textarea>
                          <br>
                          <input type="file" name="aula">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="box-footer">
              <div class="col-md-12">
                <button type="button" class="btn btn-success btn-lg etapa-anterior"><i class="fa fa-angle-double-left"></i> Voltar</button>
                <button type="button" class="btn btn-success btn-lg pull-right prox-etapa">Próximo <i class="fa fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Prova -->
    <section class="content display-hidden" id="etapa-3">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Banco de questões para Prova</h3>
            </div>

            <div class="box-body" >

              <div class="box-group question-box">

                <!-- template para questionario -->
                <div class="box box-primary panel template">
                  <div class="box-header">
                    <h4 class="box-title">
                      <a href="#panel-1" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">Questão 1</a>
                    </h4>
                    <div class="box-tools pull-left">
                        <a class="btn btn-box-tool remove-ask"><i class="fa fa-trash fa-2x"></i></a>
                    </div>
                  </div>

                  <div class="collapse in panel-collapse" aria-expanded="true" id="panel-1">

                    <div class="box-body">

                      <div class="row">
                        <div class="col-md-12">
                          <label>Questão</label>
                          <input type="text" class="form-control" name="provas[1][questao]" placeholder="Questão">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <label>Opções</label>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <input type="radio" value="1" name="provas[1][resposta]">
                            </span>
                            <input class="form-control" name="provas[1][opcao_1]" type="text" placeholder="Resposta">
                          </div>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <input type="radio" value="2" name="provas[1][resposta]">
                            </span>
                            <input class="form-control" name="provas[1][opcao_2]" type="text" placeholder="Resposta">
                          </div>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <input type="radio" value="3" name="provas[1][resposta]">
                            </span>
                            <input class="form-control" name="provas[1][opcao_3]" type="text" placeholder="Resposta">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <label>Opções</label>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <input type="radio" value="4" name="provas[1][resposta]">
                            </span>
                            <input class="form-control" name="provas[1][opcao_4]" type="text" placeholder="Resposta">
                          </div>

                          <div class="input-group">
                            <span class="input-group-addon">
                              <input type="radio" value="5" name="provas[1][resposta]">
                            </span>
                            <input class="form-control" name="provas[1][opcao_5]" type="text" placeholder="Resposta">
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>

            </div>

            <div class="box-footer">
              <button type="button" class="btn btn-success btn-lg etapa-anterior"><i class="fa fa-angle-double-left"></i> Voltar</button>
              <button type="button" class="btn btn-warning btn-lg add-ask">Adicionar Questão <i class="fa fa-question-circle"></i></button>
              <button type="submit" class="btn btn-success btn-lg pull-right">Finalizar <i class="fa fa-thumbs-up"></i></button>
            </div>

          </div>
        </div>
      </div>
    </section>
  </form>





















