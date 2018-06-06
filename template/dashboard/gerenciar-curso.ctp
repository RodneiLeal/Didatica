
  <section class="content">
    <div class="box box-primary">
      <div class="box-body no-margin no-padding">
        <div class="col-md-3">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="nav nav-stacked nav-steps">


                  <li><a href="Dashboard/curso/<?=$param[0]?>/capa">Capa</a></li>
                  <li><a href="Dashboard/curso/<?=$param[0]?>/Grade do curso">Grade do curso</a></li>
                  <li><a href="Dashboard/curso/<?=$param[0]?>/Banco de questões">Banco de questões</a></li>
                </ul>
              </div>
            </div>
            
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 flex">
               <form style="display: contents" action="controllers/curso/analisar_curso.php" method="POST" enctype="multipart/form-data" id="analisar_curso">
                  <input type="hidden" name="curso_idcurso" value="<?=$param[0]?>">

                 <?=$btn_analise?>

                </form>
              </div>
            </div>
          </div>

          <div class="col-md-9 with-border-left no-padding">

            <?=$sessao?>

          </div>
      </div>
    </div>
  </section>

<!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <form class="avatar-form" action="controllers/util/crop.php" enctype="multipart/form-data" method="post">
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
