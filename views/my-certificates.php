<div class="content-wrapper">
  <section class="content-header">
    <h1>Meus certificados</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active">Meus certificados</li>
    </ol>
  </section>
  <section class="content">


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de certificados</h3>
          </div><!-- /.box-header -->


          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Curso</th>
                <th>Horas Curso</th>
                <th>Certificado</th>
                <th>Status</th>
              </tr>
              <?php 
                $all_enroll = ExecData($mysqli, 'cursos','cursos_certificados_lista_todos','*', 0);
                while($row = mysqli_fetch_array($all_enroll))
                {
					$link='Indisponível';
					if($row['matricula_certificado_ativo']==0)
					{
						$status_cor = 'warning';
						$status 	= 'Cancelado';
					}
					elseif($row['matricula_certificado_ativo']==1)
					{
						$status_cor = 'success';
						$status 	= 'Pago';
						
						$link = '<a href="my-certificates-view.php?certificate='.$row['matricula_certificado_certificado_code'].'" target="_blank"> Visualizar</a>';
					}
					elseif($row['matricula_certificado_ativo']==2)
					{
						$status_cor = 'primary';
						$status 	= 'Pendente Pagamento';
					}
					elseif($row['matricula_certificado_ativo']==3)
					{
						$status_cor = 'danger';
						$status 	= 'Disputa/Reclamação';
					}
					
					
					echo 
					'
					  <tr>
						<td><a href="?p=6">'.$row['curso_titulo'].'</a></td>
						<td>'.$row['curso_horas_total'].'</td>
						<td>'.$link.'</td>
						<td><span class="label label-'.$status_cor.'">'.$status.'</span></td>
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