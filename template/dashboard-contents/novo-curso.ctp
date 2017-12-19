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
            </div>
            <div class="box-body" id="crop-avatar" >


              <div class="avatar-view">
                <img class="img-responsive course_list" src="img/curso/select-image.png" />
              </div>



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
                  <h4 class="preview-curso-titulo">Título</h4>
                </div>
              </div>


            </div>
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


<!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Editor de imagem</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file" >
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>

                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-rotate-left"></i></button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45&deg;</button>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-rotate-right"></i></button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45&deg;</button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block avatar-save">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->




















