           
           
           
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