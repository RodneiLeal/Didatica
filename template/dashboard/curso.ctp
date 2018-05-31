<section class="content">
  <input type="hidden" name="idcurso" id="curso" value="<?=$inscr['idcurso']?>">
  <input type="hidden" name="idinscr" id="inscr" value="<?=$inscr['idinscricao']?>">
  
  <div class="row">
    <div class="col-md-12">
      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-blue">
          <h3 class="widget-user-name" style="margin-top: 0;"><?=$curso['titulo']?></h3>
          <h6 class="widget-user-desc">Por <a href="//" class="b white"><?=$curso['instrutor']?></a></h6>
          <div class="row">
            <div class="col-md-3">
              <div class="starrr pull-left"  data-rating="<?=$media?>" title="<?=$media?>"></div>&#160;<span>Opnião de <?=$curso['votantes']?> alunos</span>
            </div>
          </div>
          <div class="widget-user-image">
            <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
          </div>
        </div>
        <div class="box-footer"></div>

        <div class="box-body">
          <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Conteúdo do curso</h3>
              </div>
              <div class="box-body">
                <div id="course-content">

                  <ul class="timeline" data-children=".aula" id="aulas">
                    <li class="time-label">
                      <span class="bg-yellow">
                        <i class="fa fa-folder-open"></i> <?=count($aulas)?> aulas
                      </span>
                    </li>

                    <?php if($aulas): foreach($aulas as $aula): ?>
                    
                    <li class="aula">
                      <i class="fa fa-book bg-green"></i>
                      <div class="timeline-item" >
                        
                        <h3 class="timeline-header">
                          <a><?=$aula['titulo']?></a>
                        </h3>
                        
                          <div class="timeline-body">
                            <?=$aula['objetivos']?>
                          </div>
                          
                          <div class="timeline-footer display-right">
                            <a href="<?=empty($aula['arquivo'])?'//':$aula['arquivo']?>" target="_blank" class="btn btn-default btn-xl" ><i class="fa fa-download"></i> Material de apoio</a>
                          </div>
                          
                      </div>
                    </li>

                    <?php endforeach; endif; ?>

                    <li class="timeline-label ">
                      <i class="fa fa-circle bg-yellow"></i>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header text-center">
                <h3 class="box-title title-course">Ações</h3>
              </div>
              <div class="course_load text-center"></div>

                <?=$btn?>

                <?=$btn_avaliacao?>

              <div class="box-body course_box text-center">
                <button class="btn btn-primary course_get_rate" data-toggle="modal" data-target="#send-message">
                  <i class="fas fa-paper-plane" aria-hidden="true"></i> Enviar mensagem para o instrutor
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- ENVIAR MENSAGEM PARA O INSTRUTOR -->
  <div class="modal fade" role="dialog" id="send-message">
    <div class="modal-dialog">

      <form  id="form-message" action="controllers/mensagem.php" method="POST">

        <input type="hidden" name="para" value="<?=$curso['instrutor_idinstrutor']?>">

        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-yellow">
            <div class="widget-user-image">
              <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
            </div>
            <h3 class="widget-user-username"><?=$curso['instrutor']?></h3>
          </div>

          <div class="box-body">
            <div class="row" style="padding:30px 10px 0 10px">
              <div class="col-md-12">
                  <div class="form-goup">
                    <label> Assunto:</label>
                    <div class="input-container input-box form-control">
                      <input type="text" name="assunto" placeholder="Ex: Duvida sobre a geração de calor por fricçao." maxlength="90">
                      <span class="input-counter"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Mensagem</label>
                    <textarea class="form-control" name="mensagem" rows="7" style="resize:none" placeholder="Deixe aqui sua ensagem para <?=$curso['instrutor']?>"></textarea>
                  </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button class="pull-right btn btn-warning btn-xl send-message"><i class="fas fa-paper-plane"></i> Enviar</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- OPINIÃO SOBRE O CURSO -->
  <div class="modal fade" role="dialog" id="avaliacao">
    <div class="modal-dialog">

      <form  id="form-comment" action="controllers/comentario.php" method="POST">
        <input type="hidden" name="curso_idcurso" value="<?=$inscr['idcurso']?>">
        <input type="hidden" name="usuario_idusuario" value="<?=$inscr['usuario_idusuario']?>">

        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-yellow">
            <div class="widget-user-image">
              <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
            </div>
            <h3 class="widget-user-username"><?=$curso['instrutor']?></h3>
          </div>

          <div class="box-body">
            <div class="row" style="padding:30px 10px 0 10px">
              <div class="col-md-12">

                <div class="form-goup">
                  <label>Titulo:</label>
                  <div class="input-container input-box form-control">
                    <input type="text" placeholder="Titulo ou resumo de sua avaliação para o curso <?=$curso['titulo']?>" maxlength="150" name="comentario" value="".$curso['titulo']."">
                    <span class="input-counter"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label>Resumo de sua avaliação:</label>
                  <textarea class="form-control" name="justificativa" rows="7" style="resize:none" placeholder="Explique por que gostou ou não gostou desse deste curso."></textarea>
                </div>

                <div class="form-group">
                  <label style="display:block">Avaliação:</label>
                  <ul class="rate-area">
                    <input type="radio" id="5-star" name="estrelas" value="5" /><label for="5-star" title="Ótimo">5 stars</label>
                    <input type="radio" id="4-star" name="estrelas" value="4" /><label for="4-star" title="Bom">4 stars</label>
                    <input type="radio" id="3-star" name="estrelas" value="3" /><label for="3-star" title="Médio">3 stars</label>
                    <input type="radio" id="2-star" name="estrelas" value="2" /><label for="2-star" title="Regular">2 stars</label>
                    <input type="radio" id="1-star" name="estrelas" value="1" /><label for="1-star" title="Ruin">1 star</label>
                  </ul>
                </div>

              </div>
            </div>
          </div>

          <div class="box-footer">
            <button class="pull-right btn btn-warning btn-xl submit-review"><i class="fas fa-paper-plane"></i> Enviar</button>
          </div>
        </div>
      </form>

    </div>
  </div>
