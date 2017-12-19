  <section class="content-header">
    <h1>Avaliação</h1>
    <ol class="breadcrumb">
      <li><a href="Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="//">Cursos</a></li>
      <li class="active">Avaliação</li>
    </ol>
  </section>

 

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-blue" <?=$style?>>
            <h3 class="widget-user-name" style="margin-top: 0;"><?=$curso['titulo']?></h3>
            
            <h6 class="widget-user-desc">Por <a href="//" class="b white"><?=$curso['instrutor']?></a></h6>
            <div class="row">
              <div class="col-md-3">
                <span></span>
              </div>
            </div>
            <div class="widget-user-image">
              <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
            </div>
          </div>
          <div class="box-footer"></div>

          <div class="box-body">
            <div class="col-md-12">

              <form id="prova">

                <input type="hidden" name="idcurso" id="curso" value="<?=$inscr['idcurso']?>">
                <input type="hidden" name="idinscr" id="inscr" value="<?=$inscr['idinscricao']?>">
                
                <div class="box box-primary">

                  <div class="box-header">
                    <h3 class="box-title">Avaliação</h3>
                    <h5 class="clock pull-right"></h5>
                  </div>

                  <div class="box-body">
                    <div id="course-content">

                      <ul class="timeline" data-children=".aula" id="aulas">
                        <li class="time-label">
                          <span class="bg-yellow">
                            <i class="fa fa-folder-open-o"></i> <?=count($questoes)?> questões
                          </span>
                        </li>

                        <?php 
                          if(true): 
                            foreach($questoes as $key=>$questao):
                              $opcoes = array_values(array_slice($questao, 3, 5));
                        ?>
                        
                        <li class="aula">
                          <i class="fa fa-file-text bg-green"></i>
                          <div class="timeline-item" >
                            
                            <h3 class="timeline-header">
                              <a>Questão <?=++$key?></a>
                            </h3>
                          
                            <div class="timeline-body">
                              <p><?=$questao['questao']?>?</p>
                            </div>
                              
                            <div class="timeline-footer">
                              <?php foreach($opcoes as $key_opt=>$opcao): if(empty($opcao)) continue?>
                              <div class="input-group ">
                                <span class="input-group-addon">
                                  <input class="opcao" type="radio" name="opcao[<?=$questao['id_questao']?>]" aria-label="Resposta" value="<?=++$key_opt?>">
                                </span>
                                <span class="form-control" ><?=$opcao?></span>
                              </div>
                              <?php endforeach ?>

                            </div>
                          </div>
                        </li>

                        <?php endforeach; endif; ?>

                        <li class="timeline-label ">
                          <i class="fa fa-circle-o bg-yellow"></i>
                        </li>

                      </ul>

                    </div>
                  </div>

                  <div class="box-footer">
                      <div class="respostas pull-left"></div>
                      <button type="button" class="btn btn-danger btn-xl pull-right" id="finalizar-prova">Finalizar</button>
                  </div>

                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL DE ORIENTAÇÃO PARA PROVA -->
  <div class="modal fade" role="dialog" id="good-luck">
    <div class="modal-dialog" data-dismiss="modal">

      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
          </div>
          <h3 class="widget-user-username"><?=$curso['instrutor']?></h3>
          <h5 class="widget-user-desc"></h5>
        </div>
        <div class="box-body">
          <div class="row" style="padding:30px 10px 0 10px">
            <div class="col-md-12">
              <p class="mediun-text">Separei algumas questões para avaliar seus estudos, porém, antes de começarmos, vou lhe passar algumas dicas:
              <ol type="1)">
                <li>Você terá <span data-nquestoes="<?=count($questoes)?>"><?=count($questoes)?></span> minutos para resolver as questões. Após este tempo
                sua prova será avaliada e arquivada automaticamente.</li>
                
                <li>Você poderá finalizar sua prova a qualquer tempo, clicando no botão <div class="btn btn-danger btn-sm">Finalizar</div></li>
                <li>Para ser aprovado seu desempenho deverá ser superior a 60%</li>
                <li>Não será aceito prova em branco</li>
              </ol>
              </p>

              <p class="mediun-text pull-right">Boa Sorte!</h4>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="button" data-dismiss="modal" class="pull-right btn btn-warning btn-xl iniciar-prova">Iniciar</button>
        </div>
      </div>
                
    </div>
  </div>

  <!-- MODAL CASO A TENHA IDO MAL NA PROVA -->
  <div class="modal fade" role="dialog" id="too-bad">
    <div class="modal-dialog" data-dismiss="modal">

      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
          </div>
          <h3 class="widget-user-username"><?=$curso['instrutor']?></h3>
          <h5 class="widget-user-desc"></h5>
        </div>
        <div class="box-body">
          <div class="row" style="padding:30px 10px 0 10px">
            <div class="col-md-12">
              <p class="mediun-text">Que pena!<br>
              Seu aproveitamento foi de apenas <strong class="nota"></strong>.<br><br>
              Reveja o seu material de estudo e tente novamente, tenho certeza que conseguirá na próxima.
              </p>
            </div>
          </div>
        </div>
      </div>
                
    </div>
  </div>

  <!-- MODAL CASO A TENHA IDO BEM NA PROVA -->
  <div class="modal fade" role="dialog" id="good-work">
    <div class="modal-dialog">

      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <img src="<?=$instrutor_foto?>" class="img-circle" alt="<?=$curso['titulo']?> - <?=$curso['instrutor']?>" />
          </div>
          <h3 class="widget-user-username"><?=$curso['instrutor']?></h3>
          <h5 class="widget-user-desc"></h5>
        </div>

        <div class="box-body">
          <div class="row" style="padding:30px 10px 0 10px">
            <div class="col-md-12">
              <p class="mediun-text">Parabéns <strong><?=$username?></strong> !<br>

              Você foi aprovado neste curso com aproveitamento de <strong class="nota"></strong>.

              <br>
              <br>

              Você quer seu certificado?
              
              </p>
            </div>
          </div>
        </div>

        <div class="box-footer">
          <button type="button" class="btn btn-default bg-orange btn-promotion pull-right" id="certificate-request" data-dismiss="modal">
            <strong>
              <i class="fa fa-thumbs-up"></i>
              &#160;&#160;Eu quero!
            </strong>
          </button>
        </div>

      </div>
                
    </div>
  </div>