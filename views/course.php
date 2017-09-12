<?php
  include 'controller/course/course_count_visit_add.php';
  include 'config/config_site.php';
  include 'model/dbc.php';

  $curso_id = (int)$_GET['curso_id'];

  $db = new dbc();

  $selectCourse =  "SELECT * FROM curso, usuario WHERE usuario_id = curso_usuario_id AND curso_id= {$curso_id} LIMIT 1";
  $query = $db->query($selectCourse);
  $row = $query->fetchAll()[0];

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $row['curso_titulo'];?></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active"><?php echo $row['curso_titulo'];?></li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
    <div class="col-md-12">

      <?php

        echo
        '
          <div class="box box-widget widget-user">
            <div class="widget-user-header bg-blue">
              <h3 class="widget-user-name">'.$row['curso_titulo'].'</h3>
              <h5 class="widget-user-desc">Torne-se um especialista em '.$row['curso_titulo'].'</h5>
              <div class="widget-user-image">
                <img src="'.mostra_imagem('user',$row['usuario_foto']).'" class="img-circle" alt="'.$row['curso_titulo'].' - '.$row['usuario_nome'].'" />
                <span class="user-name">'.$row['usuario_nome'].'</span>
              </div>
            </div>
            <div class="box-footer"></div>
        ';

        if( (isset($_GET['act'])) && ($_GET['act']=='read')){
          $matricula_id = (int)$_GET['enroll'];
          
      ?>
      <div class="box-body">
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Conteúdo do curso</h3>
            </div>
            <div class="box-body">
              <div id="course-content">
                <!-- The time line -->
                <ul class="timeline">

                  <?php
                    $filesCourse = "SELECT curso_item_id, curso_item_titulo, (SELECT COUNT(curso_item_doc_id) FROM curso_item_doc WHERE curso_item_doc_curso_item_id = curso_item_id) AS total_arquivos FROM curso_item WHERE curso_item_curso_id = {$curso_id} ORDER BY curso_item_data_cadastro ASC";
                    $query = $db->query($filesCourse);
                    $result = $query->fetchAll();

                    foreach ($result as $row_item_title){
                      echo
                      '
                        <li>
                          <i class="fa fa-envelope bg-blue"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="fa fa-folder-open"></i> '.$row_item_title['total_arquivos'].'</span>
                            <h3 class="timeline-header">
                              <a href="javascript:void()" class="timeline-header course-title-item-show-content" course-item="'.$row_item_title['curso_item_id'].'">
                                '.$row_item_title['curso_item_titulo'].'
                              </a>
                            </h3>

                              <div class="hidden timeline-body course-content-item course-content-item-'.$row_item_title['curso_item_id'].'"></div>

                              <div class="timeline-footer hidden course-content-item-docs course-content-item-docs-'.$row_item_title['curso_item_id'].'">

                                </div>
                          </div>
                        </li>
                        ';
                    }
                  ?>

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

            <?php

              $prova_SQL = "SELECT * FROM curso_exame WHERE curso_exame_curso_id = {$curso_id} AND curso_exame_usuario_id = {$_SESSION['usuarioID']} AND curso_exame_ativo = 1";
              $query = $db->query($prova_SQL);
              $prova = $query->fetchAll();
              $prova = $prova[0];

              // se usuario não tiver feito exame ou nota do ultimo exame for menor que 60, então botão 'responder prova' estará disponível
              if(empty($prova) xor (isset($prova['curso_exame_nota']) && $prova['curso_exame_nota']<60)){
                echo
                '
                  <div class="box-body course_box text-center">
                    <a href="course-question-exam.php?course='.$curso_id.'" class="btn btn-success course_get_question" course="'.$curso_id.'">
                      <i class="fa fa-graduation-cap" aria-hidden="true"></i> Responder Prova
                    </a>
                  </div>
                ';
              }
              else{ #senão o botão de solicitação de certificado estará disponivel

                $pgto_SQL = "SELECT *, matricula_certificado_ativo AS status_pgto FROM matricula_certificado, matricula WHERE matricula_certificado_matricula_id = matricula_id AND matricula_usuario_id = {$_SESSION['usuarioID']} AND matricula_curso_id = {$curso_id}";
                $query = $db->query($pgto_SQL);
                $pgto = $query->fetchAll();
                $pgto = $pgto[0];
                
                switch($pgto['status_pgto']){
                  // se status do pagamento for igual a 1 ou 2, então exibe mensagem de 'aguardando pagamento'
                  case 1:
                  case 2:
                  echo 
                  '
                  <div class="box-body course_box text-center">
                    <div class="alert alert-info" role="alert">
                      <strong>Aguardando confirmação de pagamento</strong>
                    </div>
                  </div>
                  ';
                  break;
                  // se status do pagamento for igual a 3 ou 4, então botão 'Download do Certificado' estará disponível
                  case 3:
                  case 4:
                    echo
                    '
                    <div class="box-body course_box text-center">
                      <button class="btn btn-success print_certificate" course="'.$curso_id.'">
                        <i class="fa fa-id-card-o" aria-hidden="true"></i>Download do Certificado
                      </button>
                    </div>
                    ';
                  break;
                  // em qualquer outro caso o botão 'Solicitar Certificado' estará disponível
                  default:
                    echo
                    ' 
                    <div class="box-body course_box text-center">
                      <button class="btn btn-success course_get_certified" course="'.$curso_id.'">
                        <i class="fa fa-id-card-o" aria-hidden="true"></i> Solicitar Certificado
                      </button>
                    </div>
                    ';
                }
              }
            ?>

            <div class="box-body course_box text-center">
              <button class="btn btn-primary course_get_rate" id="" course="<?php echo $curso_id;?>">
                <i class="fa fa-thermometer-half" aria-hidden="true"></i> Avaliar Curso
              </button>
            </div>

            <div class="box-body course_box text-center">
              <button class="btn btn-warning btn-xs course_get_critical" id="" course="<?php echo $curso_id;?>">Enviar crítica ao Tutor</button>
            </div>
        </div>
      </div>
    </div>

    <form id="form_pagseguro" action="<?php echo $_SESSION['UrlPagseguroLightBox'];?>" method="post" onsubmit="PagSeguroLightbox(this, {
          success : function(transactionCode){
            $.post('controller/course/course_payment_save_code_pagseguro.php', {
                enroll: <?php echo $matricula_id;?>,
                transaction_code: transactionCode
              });
          },
          abort : function(){
          console.log('Ops! Aconteceu algo errado.');
          }
      }); return false;" >
      <input type="hidden" name="code" id="code"/>
    </form>

    <div class="modal fade" id="modal_avaliar" tabindex="-1" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="height:60%">
          <div class="modal-header">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i></button>
          </div>
          <div class="modal-body" >
            <form  id="FormEnrollRate" action="controller/course.php">
              <div class="form-group">
              <label for="exampleInputEmail1">Nota geral para o Curso</label>
              <div class="user_star_rating_course"></div>
              </div>

              <div class="form-group">
              <label for="exampleInputEmail1">Comentários</label>
              <textarea class="form-control" id="FormEnrollRate_comentario" name="FormEnrollRate_comentario" rows="7" placeholder="Descreva o que achou sobre o conteúdo, explicação, entre outros detalhes"></textarea>
              </div>


              <div class="form-group">
                <input id="FormEnrollRate_nota" name="FormEnrollRate_nota"  value="" type="hidden">

                <input id="FormEnrollRate_matricula" name="FormEnrollRate_matricula" value="" type="hidden">
                <input id="" name="operation" value="rate" type="hidden">
                <button type="button" class="btn btn-primary form_send_information_bt">Enviar Avaliação</button>

              </div>

            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php

        }else{

          //Se meu curso
          if($_SESSION['usuarioID']==$row['curso_usuario_id']){
            
            $retorno_course = ExecData($mysqli, 'cursos','curso_estatisticas','*', $curso_id);
            $row_course = mysqli_fetch_array($retorno_course);

    ?>
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
                    <span class="info-box-number"><?php echo ( ($row_course['total_visualizacao']==0) || (empty($row_course['total_visualizacao']) )) ? ("0") : ($row_course['total_visualizacao']) ;?></span>

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
                    <span class="info-box-number"><?php echo ( ($row_course['total_certificado_pago']==0) || (empty($row_course['total_certificado_pago']) )) ? ("0") : ($row_course['total_certificado_pago']) ;?></span>

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
                      <span class="info-box-number"><?php echo $row_course['total_matriculas'];?></span>

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
                      <span class="info-box-number"><?php echo ( ($row_course['total_avaliacao']==0) || (empty($row_course['total_avaliacao']) )) ? ("0") : ($row_course['total_avaliacao']) ;?></span>

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


                    <?php

                      $retorno_course = ExecData($mysqli, 'cursos','curso_matriculados_widget_8','*', $curso_id);
                      while($row_matriculados = mysqli_fetch_array($retorno_course))
                      {
                        echo
                        '
                          <li>
                            <img src="'.mostra_imagem('user',$row_matriculados['usuario_foto']).'" alt="'.$row_matriculados['usuario_nome'].'">
                            <a class="users-list-name" href="#">'.$row_matriculados['usuario_nome'].'</a>
                          </li>
                        ';
                      }
                    ?>


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
                <a class="btn btn-default btn-xs" href="?p=my-courses-edit&course=<?php echo $curso_id;?>&action=change">Editar Curso</a>

                <button class="btn btn-danger btn-xs" id="course_start" course="'.$curso_id.'">Desativar Curso</button>
              </div>
            </div>
          </div>

    </div>
          <?php

              }
              else
              {
                      echo
                      '
                        <div class="box-body">
                          <div class="col-md-8">
                            <div class="box box-primary">
                              <div class="box-header">
                                <h3 class="box-title">Sobre o curso</h3>
                              </div>
                              <div class="box-body">
                                <div id="lipsum">
                                '.nl2br($row['curso_descricao']).'
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
                      ';

                          $retorno_matricula = ExecData($mysqli, 'cursos','cursos_matricula','*', $curso_id);
                          $row_matricula = mysqli_fetch_assoc($retorno_matricula);

                              if(empty($row_matricula['matricula_id'])){
                                echo
                                '
                                  <div class="box-body course_box text-center">
                                    <button class="btn btn-primary" id="course_start" course="'.$curso_id.'">Iniciar Curso</button>
                                  </div>
                                ';
                              }
                              else
                              {
                                echo
                                '
                                  <div class="box-body course_box text-center">
                                    <a class="btn btn-success" href="dashboard.php?p=course&curso_id='.$curso_id.'&enroll='.$row_matricula['matricula_id'].'&act=read">Acessar Curso</a>
                                  </div>
                                ';
                              }
              }
                echo
                '
                        </div>
                      </div>
                    </div>
                    <div class="box-footer"></div>
                  </div>
                ';
        }


?>
    </div>
    </div>
  </section>
</div>

<script type="text/javascript" src="<?=$pgs_library?>"></script>