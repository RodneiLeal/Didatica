<?php
  session_start();

  include '../../../controller/_biblio.php';
  include '../../../model/global.php';

?>
      <div id="course-content">
           
          <!-- The time line -->
          <ul class="timeline">

            <?php
                $curso_id = (int)$_GET['course'];
                
                $return_course_item = ExecData($mysqli, 'cursos','curso_conteudo_questoes_exame','*', $curso_id);
                while ($row_item_title = mysqli_fetch_array($return_course_item))
                {

                  echo 
                  '
                    <li>
                      <i class="fa fa-check bg-blue"></i>

                      <div class="timeline-item">
 							<h3 class="timeline-header">
							  <a href="javascript:void()" class="timeline-header course-title-item-show-content" course-item="'.$row_item_title['curso_item_id'].'">
								'.$row_item_title['curso_questao_pergunta_titulo'].'
							  </a>
							</h3>
                        
                      </div>
                    </li>
                    ';
                }
            ?>

            </ul>
      </div>