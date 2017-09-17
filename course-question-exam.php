<?php
  include 'config/config_site.php';
  include 'controller/_biblio.php';
  include 'model/global.php';
  

    $curso_id = (int)$_GET['course'];
    $dados_curso_sql = ExecData($mysqli, 'cursos','cursos_lista','curso_titulo', $curso_id);
	$dados_curso = mysqli_fetch_assoc($dados_curso_sql);
?>
<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avaliação do curso de <?php echo $dados_curso['curso_titulo'];?></title>


        <link href="plugins/exam/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/exam/css/font-awesome.css" rel="stylesheet">


        <link href="plugins/exam/css/bootstrap-touchspin.css" rel="stylesheet">
        <link href="plugins/exam/css/select2.css" rel="stylesheet">
        <link href="plugins/exam/css/jquery.countdown.css" rel="stylesheet">
         
        <link href="plugins/exam/css/main.css" rel="stylesheet">

        <link href="plugins/exam/css/essentials.css" rel="stylesheet" />
        <link href="plugins/exam/css/layout.css" rel="stylesheet" />
        <link href="plugins/exam/css/sidebar.css" rel="stylesheet" />
        <link href="plugins/exam/css/sidebar-skins.css" rel="stylesheet" />
        
        <link href="plugins/notification/toastr.min.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
          .hidden
          {
            display: none
          }
        </style>

</head>
<body>



<div class="page-section half bg-white">
    <div class="container">
        <div class="section-toolbar">
            <div class="cell">
                <div class="media width-120 v-middle margin-none">
                    <div class="media-left">
                        <div class="icon-block bg-grey-200 s30"><i class="fa fa-question"></i></div>
                    </div>
                    <div class="media-body">
                        <p class="text-body-2 text-light margin-none">Questões</p>
						<?php
							$questoes_total_sql = ExecData($mysqli, 'exame','curso_perguntas_total','total_questoes', $curso_id);
							$questoes_total = mysqli_fetch_assoc($questoes_total_sql);
						?>
                        <p class="text-title text-primary margin-none"><?php echo $questoes_total['total_questoes'];?></p>
                    </div>
                </div>
            </div>
            <div class="cell">
                <div class="media width-800 v-middle margin-none">
                    <div class="media-left">
                        <div class="icon-block bg-grey-200 s30"><i class="fa fa-graduation-cap"></i></div>
                    </div>
                    <div class="media-body">
                        <p class="text-body-2 text-light margin-none">Exame do Curso</p>
                        <p class="text-title text-success margin-none"><?php echo $dados_curso['curso_titulo'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <div class="page-section">
        <div class="row">

            <div class="col-md-12">

                
              <div class="text-subhead-2 text-light ">
                Questão <span class="exam_number_question">1</span> de <?php echo $questoes_total['total_questoes'];?>
              </div>

    <?php
        $curso_id = (int)$_GET['course'];
        $return_course_item = ExecData($mysqli, 'exame','curso_perguntas_retorna','*', $curso_id);

        $contador = 1;
        while ($row_item_title = mysqli_fetch_array($return_course_item))
        {

          echo  
          '
            <div class=""  id="questao_'.$row_item_title['curso_questao_id'].'">
                <div class="panel panel-default paper-shadow " data-z="0.5">
                    <div class="panel-heading">
                        <h4 class="text-headline">Questão <span class="exam_number_question">'.$contador.'</span></h4>
                    </div>
                    <div class="panel-body">
                        <p class="text-body-2">
                          '.$row_item_title['curso_questao_pergunta_titulo'].'
                        </p>
                     </div>
                </div>

 
                <div class="panel panel-default paper-shadow" data-z="0.5">
                    <div class="panel-body">
                          <div class="radio radio-primary question_answer" >
                              <input checked class="'.$contador.'" type="radio" name="'.$row_item_title['curso_questao_id'].'" id="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_1'].'" value="1">
                              <label for="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_1'].'">'.$row_item_title['curso_questao_pergunta_resposta_1'].'</label>
                          </div>
                          <div class="radio radio-primary question_answer">
                              <input class="'.$contador.'"  type="radio" name="'.$row_item_title['curso_questao_id'].'" id="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_2'].'" value="2">
                              <label for="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_2'].'">'.$row_item_title['curso_questao_pergunta_resposta_2'].'</label>
                          </div>

                          <div class="radio radio-primary question_answer">
                              <input class="'.$contador.'"  type="radio" name="'.$row_item_title['curso_questao_id'].'" id="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_3'].'" value="3">
                              <label for="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_3'].'">'.$row_item_title['curso_questao_pergunta_resposta_3'].'</label>
                          </div>
                         <div class="radio radio-primary question_answer">
                              <input class="'.$contador.'"  type="radio" name="'.$row_item_title['curso_questao_id'].'" id="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_4'].'" value="4">
                              <label for="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_4'].'">'.$row_item_title['curso_questao_pergunta_resposta_4'].'</label>
                          </div>

                         <div class="radio radio-primary question_answer">
                              <input class="'.$contador.'"  type="radio" name="'.$row_item_title['curso_questao_id'].'" id="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_5'].'" value="5">
                              <label for="'.$contador.'_'.$row_item_title['curso_questao_id'].'_'.$row_item_title['curso_questao_pergunta_resposta_5'].'">'.$row_item_title['curso_questao_pergunta_resposta_5'].'</label>
                          </div>
                    </div>

                </div>
              </div>
              <hr>
            ';

            $contador = $contador + 1;
        }
    ?>

                    <div class="panel-footer">
                        <div class="text-left">
                            <button class="btn btn-success" id="exam_finish" course="<?php echo $curso_id;?>"><i class="fa fa-save fa-fw"></i> Finalizar Exame</button>
                         </div>
                    </div>
                <br/>
                <br/> 
            </div>
 

        </div>
    </div>

</div>

<!-- Footer -->
<footer class="footer">
                <div class="container_footer">
                    <div class="text-subhead-2 text-light">Tempo restante</div>
                    <div class="tk-countdown"></div>
                </div>
</footer>
<!-- // Footer -->

    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
        var colors = {
          "danger-color": "#e74c3c",
          "success-color": "#81b53e",
          "warning-color": "#f0ad4e",
          "inverse-color": "#2c3e50",
          "info-color": "#2d7cb5",
          "default-color": "#6e7882",
          "default-light-color": "#cfd9db",
          "purple-color": "#9D8AC7",
          "mustard-color": "#d4d171",
          "lightred-color": "#e15258",
          "body-bg": "#f6f6f6"
          };
            var config = {
                theme: "html",
                skins: {"default":{"primary-color":"#42a5f5"}}
            };
    </script>
 
        <!-- <script src="js/vendor/core/all.js"></script> -->
                <script src="plugins/exam/js//jquery.js"></script>
                <script src="plugins/exam/js/bootstrap.js"></script>
                <script src="plugins/exam/js/breakpoints.js"></script>
                <script src="plugins/exam/js/jquery.nicescroll.js"></script>
                <script src="plugins/exam/js/isotope.pkgd.js"></script>
                <script src="plugins/exam/js/packery-mode.pkgd.js"></script>
                <script src="plugins/exam/js/jquery.cookie.js"></script>
                <script src="plugins/exam/js/jquery-ui.custom.js"></script>
                <script src="plugins/exam/js/modernizr.js"></script>

                <script src="plugins/exam/js/table.js"></script>
                <script src="plugins/exam/js/form.js"></script>
                <script src="plugins/exam/js/jquery.nestable.js"></script>
                <script src="plugins/exam/js/countdown.js"></script>
                
  
     
                <script src="plugins/exam/js/all.js"></script>


                <script src="plugins/notification/toastr.min.js"></script>
                <script src="dist/functions.js"></script>

</body>

</html>


    <div class="modal fade" id="modal_exam_finish" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
      <div class="modal-content" style="height:60%">
        <div class="modal-body" style="text-align:center;height:30%">
        <br><br>
        <h3><b id="modal_exam_title">Verificando suas respostas</b></h3>
          <div id="modal_exam_result"></div>
        <br>
        <img id="modal_exam_loading" src="dist/img/loader.gif">
        <br><br>
        <span id="modal_exam_wait">Por favor, aguarde...</span>
        <BR><BR>
          <a id="modal_exam_view_certified" href="dashboard.php?p=course&curso_id=<?php echo $curso_id;?>&enroll=1&act=read" class="btn btn-success btn-md">Acessa curso</a>
        <br><br>
        </div>
      </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->