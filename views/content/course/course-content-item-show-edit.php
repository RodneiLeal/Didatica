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
                
                $return_course_item = ExecData($mysqli, 'cursos','curso_conteudo_titulos','*', $curso_id);
                while ($row_item_title = mysqli_fetch_array($return_course_item))
                {

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