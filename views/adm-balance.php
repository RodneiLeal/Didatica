  <section class="content-header">
    <h1>Balanço PagSeguro</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Usuários</a></li>
      <li class="active">Balanço PagSeguro</li>
    </ol>
  </section>
  <section class="content">


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Balanço PagSeguro</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Matrícula</th>
                      <th>Usuário</th>
                      <th>Curso</th>
                      <th>Data </th>
                      <th>Status PagSeguro</th>
                    </tr>
                      <?php
                          include 'config/config_site.php';

                                  $email_pagseguro = 'leo_wander@hotmail.com';
                                  $token_pagseguro = '1DCE73773DF14B918529AE937F558195';

                          $retorno = ExecData($mysqli, 'adm','financeiro_matricula_certificado','*', '');
                          $row = mysqli_fetch_array($retorno);

                              echo 
                              '
                                <tr>
                                  <td>'.$row['matricula_id'].'</td>
                                  <td><a href="?p=6">'.$row['usuario_nome'].'</a></td>
                                  <td>'.$row['curso_titulo'].'</td>
                                  <td>'.date("d/m/Y", strtotime($row['matricula_certificado_data_cadastro'])).'</td>
                                  <td>
                              ';
                                  


                                  $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/'.$row['matricula_certificado_pagseguro_code'].'?email='.$email_pagseguro.'&token='.$token_pagseguro;

                                  $_h = curl_init();
                                  curl_setopt($_h, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=ISO-8859-1"));

                                  curl_setopt($_h, CURLOPT_RETURNTRANSFER, true);
                                  curl_setopt($_h, CURLOPT_HTTPGET, 1);
                                  curl_setopt($_h, CURLOPT_URL, $url );
                                  curl_setopt($_h, CURLOPT_SSL_VERIFYPEER, false);
                                  curl_setopt($_h, CURLOPT_SSL_VERIFYHOST,  2);
                                  curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
                                  curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
                                  $output = curl_exec($_h);

                                    $transaction = simplexml_load_string($output);

                                    $status_compra = RetornaStatusPagseguro($transaction -> status);

                                    echo $status_compra;

                              echo
                              '
                                  </td>
                                </tr>
                              ';
                        ?>
                  </table>


 




                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

      

      
  </section>




  <!-- Modal -->
  <div class="modal fade" id="adm-withdrawal-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="fa fa-send"></span> Confirmação de Saque</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div id="adm-withdrawal-modal-data-bank" class="text-center"></div>
            <button type="button" class="btn btn-default btn-success btn-block adm-withdrawal-modal-confirm-withdrawal-bt" data_register_id=""><span class="fa fa-check"></span> Confirmar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        </div>
      </div>
    </div>
  </div>