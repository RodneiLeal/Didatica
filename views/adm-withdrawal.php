  <section class="content-header">
    <h1>Saques</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Usuários</a></li>
      <li class="active">Saques</li>
    </ol>
  </section>
  <section class="content">


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Saques</h3>
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
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>Data Solicitação</th>
                      <th>Data Envio</th>
                      <th>Valor</th>
                      <th>Status</th>
                    </tr>
            <?php
                include 'config/config_site.php';

                $retorno = ExecData($mysqli, 'adm','financeiro_saques','*', '');
                $row = mysqli_fetch_array($retorno);
                
                    if ($row['usuario_saque_solicitacao_ativo']==1)
                      {
                        $status = "<span class='label label-success'>Enviado</span>";
                      }
                      else
                      {
                        $status = "<span style='cursor:pointer' class='label label-warning adm-withdrawal-modal-confirm-withdrawal' data_register='".$row['usuario_saque_solicitacao_id']."' data_bank='".nl2br($row['usuario_banco_descricao'])."'>Pendente</span>";
                      }

                    echo 
                    '
                      <tr>
                        <td>'.$row['usuario_saque_solicitacao_id'].'</td>
                        <td><a href="?p=6">'.$row['usuario_nome'].'</a></td>
                        <td>'.date("d/m/Y", strtotime($row['usuario_saque_solicitacao_data_cadastro'])).'</td>
                        <td>'.$row['data_envio'].'</td>
                        <td>R$ '.number_format($row['usuario_saque_solicitacao_valor'],2).'</td>
                        <td>
                          '.$status.'
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

  <Script>

  </Script>