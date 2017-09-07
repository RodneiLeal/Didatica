<div class="content-wrapper">
  <section class="content-header">
    <h1>Minhas matrículas</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active">Minhas matriculas</li>
    </ol>
  </section>
  <section class="content">


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Cursos</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                
                <th>Curso</th>
                <th>Matrícula</th>
                <th>Horas Curso</th>
                <th>Certificado</th>
                <th>Entrar</th>
              </tr>
              <?php 
                $all_enroll = ExecData($mysqli, 'cursos','cursos_matricula_lista_todos','*', 0);
                while($row = mysqli_fetch_array($all_enroll))
                {
                  echo 
                  '
                      <tr>

                        <td><a href="?p=6">'.$row['curso_titulo'].'</a></td>
                        <td>'.date("d/m/Y", strtotime($row['curso_data_cadastro'])).'</td>
                        <td>'.$row['curso_horas_total'].'</td>

                        <!-- este botão irá exibir um certificado modelo com dados parciais do usuário, enquanto não for concluido o curso e não for efetuado o pagamento do certificado. Após o pagamento será exibido o numero do certificado e o status de curso concluido. -->
                        
                        <td><a class="btn btn-xs btn-info certificado-modelo" href="">'.$row['certificado_status'].'</a></td>


                        <td><a class="btn btn-xs btn-primary" href="dashboard.php?p=course&curso_id='.$row['curso_id'].'&enroll='.$row['matricula_id'].'&act=read">Acessar Curso</a></td>
                      </tr>
                  ';
                }
              ?>
            </table>
                        <!-- <td>'.$row['certificado_status'].'</td> -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>

      

      
  </section>
</div>