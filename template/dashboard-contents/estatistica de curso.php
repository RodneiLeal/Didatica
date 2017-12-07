    <div class="box-body">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Estatísticas</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-eye"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Visualizações</span>
                    <span class="info-box-number">{total de visualizações}</span>

                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                        <span class="progress-description">

                        </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="ion ion-bag"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Certificados vendidos</span>
                    <span class="info-box-number">{total de certificados pagos}</span>

                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                        <span class="progress-description"></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>

              <div class="col-md-4">
                    <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Inscritos</span>
                      <span class="info-box-number">{total de inscritos}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">

                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                  <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Avaliações</span>
                      <span class="info-box-number">{total de avaliações}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                          <span class="progress-description">

                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
              </div>

              <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Útimos inscritos</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <ul class="users-list clearfix">


                          <li>
                            <img src="'.mostra_imagem('user',$row_matriculados['usuario_foto']).'" alt="'.$row_matriculados['usuario_nome'].'">
                            <a class="users-list-name" href="#">foto dos matriculados</a>
                          </li>
            


                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Visualizar todos</a>
                  </div>
                  <!-- /.box-footer -->
                </div>
                <!--/.box -->
              </div>
              <!-- /.col -->
          </div>

          <div class="row">
            <div class="col-md-12">
              <hr>
              <div class="box-body  ">
                <a class="btn btn-default btn-xs" href="?p=my-courses-edit&course={id do curso}&action=change">Editar Curso</a>

                <button class="btn btn-danger btn-xs" id="course_start" course="{id do curso}">Desativar Curso</button>
              </div>
            </div>
          </div>

    </div>
        <?php else : ?>
                      <div class="box-body">
                        <div class="col-md-8">
                          <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">Sobre o curso</h3>
                            </div>
                            <div class="box-body">
                              <div id="lipsum">
                              {descrição do curso}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="box box-primary">
                            <div class="box-header text-center">
                              <h3 class="box-title title-course">Grátis</h3>
                            </div>
                            <div class="course_load text-center"></div>

                        
                              
                            <?php if(true): // se matricula id ?>

                                <div class="box-body course_box text-center">
                                  <button class="btn btn-primary" id="course_start" course="{curso id}">Iniciar Curso</button>
                                </div>
                            <?php else : ?>

                                <div class="box-body course_box text-center">
                                  <a class="btn btn-success" href="dashboard.php?p=course&curso_id={curso id}&enroll={curso id}&act=read">Acessar Curso</a>
                                </div>
                            <?php endif; ?>

        <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer"></div>
                  </div>

    </div>
    </div>