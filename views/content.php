
<div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
		Minha Dashboard
    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
  
<?php
	$chart_load_data = 0;
	if($_SESSION['usuarioTIPO']==2)//Instrutor
	{
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_instrutor','*', $_SESSION['usuarioID']);
		$row_dashboard_dados_rapidos = mysqli_fetch_array($retorno);
		
		$chart_load_data = 1;
	}
	elseif($_SESSION['usuarioTIPO']==3)//Admin
	{
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos','*', 0);
		$row_dashboard_dados_rapidos = mysqli_fetch_array($retorno);
		
		$chart_load_data = 1;
	}
?>

			<!-- Info boxes -->
			<div class="row">
				  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
					  <span class="info-box-icon bg-blue"><i class="ion-ios-people"></i></span>
					  <div class="info-box-content">
						<span class="info-box-text">Conectados</span>
						<span class="info-box-number">
						  <?php
							echo $row_dashboard_dados_rapidos['usuario_online'];
						  ?>
							usuários on-line
						</span>
					  </div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				  </div><!-- /.col -->

				  <!-- fix for small devices only -->
				  <div class="clearfix visible-sm-block"></div>

				  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
					  <span class="info-box-icon bg-blue"><i class="ion-ios-paper-outline"></i></span>
					  <div class="info-box-content">
						<span class="info-box-text">Cetificados<br />Emitidos</span>
						 <span class="info-box-number">
						  <?php
							echo $row_dashboard_dados_rapidos['total_certificado'];
						  ?>
						</span>
					  </div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				  </div><!-- /.col -->


				  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
					  <span class="info-box-icon bg-blue"><i class="fa fa-book"></i></span>
					  <div class="info-box-content">
						<span class="info-box-text">Total de cursos</span>
						 <span class="info-box-number">
						  <?php
							echo $row_dashboard_dados_rapidos['total_curso'];
						  ?>
						</span>
					  </div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				  </div><!-- /.col -->


				  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
					  <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
					  <div class="info-box-content">
						<span class="info-box-text">Total de Matrículas</span>
						 <span class="info-box-number">
						  <?php
							echo $row_dashboard_dados_rapidos['total_usuarios'];
						  ?>
						</span>
					  </div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				  </div><!-- /.col -->
			</div><!-- /.row -->





    <!-- Chart -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Movimentação</h3>
            <div class="box-tools pull-right">
              <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
              <div class="btn-group">
                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:void()" class="dashboard_chart_load" onclick="LoadChart_Total()">Total</a></li>
				  <li><a href="#" class="dashboard_chart_load" onclick="LoadChart_Ultimos_7_dias()">Últimos 7 dias</a></li>
 				  <li><a href="#" class="dashboard_chart_load" onclick="LoadChart_Ultimos_30_dias()">Últimos 30 dias</a></li>
 				  <li><a href="#" class="dashboard_chart_load" onclick="LoadChart_Ultimos_90_dias()">Últimos 3 meses</a></li>
                </ul>
              </div>

              <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                </p>
                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" style="height: 180px;"></canvas>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- ./box-body -->
          <div class="box-footer">
            <div class="row">
			
			
              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                  <h5 class="description-header" id="dashboard_chart_load_value_total-access">-</h5>
                  <span class="description-text">TOTAL DE ACESSOS</span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->


              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                  <h5 class="description-header" id="dashboard_chart_load_value_total-enroll">-</h5>
                  <span class="description-text">TOTAL DE MATRICULAS</span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->


              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-red"><i class="fa fa-caret-left"></i> 0%</span>
                  <h5 class="description-header" id="dashboard_chart_load_value_total-money">-</h5>
                  <span class="description-text">FATURAMENTO</span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
			  
			  
            </div><!-- /.row -->
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->








  </section><!-- /.content -->
</div><!-- /.content-wrapper-->



 