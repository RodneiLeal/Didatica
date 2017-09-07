<div class="content-wrapper">
  <section class="content-header">
    <h1>Saldo</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active">Meus saldo</li>
    </ol>
  </section>
  <section class="content">

          <div class="row">
              <?php 
                $my_values = ExecData($mysqli, 'financeiro','financeiro_totalizador','*', 0);
                $row_values = mysqli_fetch_array($my_values);
              ?>

              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Ganhos Totais</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-6 col-xs-6">
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h3>R$ <?php echo $row_values['total_em_conta'];?></h3>
                            <p>Em Conta</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-dollar"></i>
                          </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-md finaceiro_saque_solicita" ><i class="fa fa-send"></i> Solicitar Saque</button>
                      
                        <div class="modal fade" id="modal_solicita_saque" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                          <div class="modal-dialog" role="document">
                          <div class="modal-content" style="height:60%">
                            <div class="modal-header">
                              <button type="button" onclick="location.reload();" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body" style="text-align:center;height:30%">
                            <br><br>
                            <h3><b>Solicitação de saque</b></h3>
                              <div id="modal_solicita_saque_resultado"></div>
                            <br>
                            <img id="modal_solicita_saque_loading" src="dist/img/loader.gif">
                            <br><br>
                            <span id="modal_solicita_saque_wait">Por favor, aguarde...</span>
                            <br>
                            <BR><BR>
                            </div>
                          </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </div>

                      <div class="col-lg-6 col-xs-6">
                        <div class="small-box bg-blue">
                          <div class="inner">
                            <h3>R$ <?php echo $row_values['total_ja_recebido'];?></h3>
                            <p>Já recebido</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-dollar"></i>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
          </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Histórico</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Curso</th>
                <th>Matrícula</th>
                <th>Valor</th>
                <th>Status</th>
              </tr>
              <?php 
                $all_enroll = ExecData($mysqli, 'financeiro','financeiro_historico','*', 0);
                while($row = mysqli_fetch_array($all_enroll))
                {
                  echo 
                  '
                      <tr>

                        <td><a href="?p=6">'.$row['curso_titulo'].'</a></td>
                        <td>'.$row['usuario_nome'].'</td>
                        <td>'.$row['total_valor'].'</td>
                        <td>'.$row['totalizador_status'].'</td>
                      </tr>
                  ';
                }
              ?>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>

      

      
  </section>
</div>

<script>
  $('#modal_solicita_saque').on('hidden.bs.modal', function () {
   location.reload();
  })
</script>