      <!-- Content Wrapper. Contains page content -->

	<?php
	
		if(isset($_GET['instrutor']) && (inteiro($_GET['instrutor'])==1) )
		{
			$usuario_busca = (int)$_GET['instrutor'];
			$instrutor_visualiza = 1; //dados outro instrutor
		}
		else
		{
			$usuario_busca = $_SESSION['usuarioID'];
			$instrutor_visualiza = 0; //meu perfil
		}
		
		$data_user = ExecData($mysqli, 'usuario','consulta_usuario','*',$usuario_busca);
		$row = mysqli_fetch_assoc($data_user);
	?>
	
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Perfil</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Usuário</a></li>
            <li class="active">
			  <?php
				echo $row['usuario_nome'];
			  ?>
				</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">

            <!-- Profile Image -->
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo mostra_imagem('user',$row['usuario_foto']);?>" alt="<?php echo $row['usuario_nome'].' - '.$row['usuario_formacao'];?>">
                  <h3 class="profile-username text-center">
                      <?php
                        echo $row['usuario_nome'];
                      ?>
                  </h3>
                  <p class="text-muted text-center">
                      <?php
                        echo (empty($row['usuario_formacao'])) ? ("Formação não informada"): ($row['usuario_formacao']);
                       ?>
                  </p>
		<?php
			if($_SESSION['usuarioTIPO'] != 1)
			{
		?>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Publicações</b> <a class="pull-right">
                        <?php
                          echo $row['total_publicacao'];
                         ?>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <b>Inscritos</b> <a class="pull-right"><?php echo ExecData($mysqli, 'usuario','consulta_total_inscritos','*', $row['usuario_id']);?></a>
                    </li>
                    <li class="list-group-item">
						<b>Avaliação</b>
						<a class="pull-right">
							<div rating="<?php echo ExecData($mysqli, 'usuario','consulta_media_star','*', $row['usuario_id']);?>" class="user_star"></div>
						</a>
                    </li>
                  </ul>
		<?php
			}
		?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <!-- About Me Box -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sobre mim</h3>
 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-graduation-cap margin-r-5"></i> Formação</strong>
                  <p class="text-muted">
                      <?php
                         echo $row['usuario_formacao'];
                       ?>
                  </p>


                  <hr>

                  <strong><i class="fa fa-book margin-r-5"></i> Resumo</strong>

                  <p>
                      <?php
                        echo $row['usuario_sobre'];
                       ?>
                  </p>

                  <hr>
                  <!-- substituir o icone de lapis -->
                  <strong><i class="fa fa-briefcase  margin-r-5"></i> Habilidades</strong>
                  <p>
					<?php
						$retorno_habilidades = ExecData($mysqli, 'usuario','consulta_usuario_habilidades','usuario_habilidade_habilidade', $usuario_busca);
						while($habilidades = mysqli_fetch_array($retorno_habilidades))
						{
							echo '<span class="label label-info">'.$habilidades['usuario_habilidade_habilidade'].'</span>&nbsp;';
						}
					?>
                    
                  </p>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
			<?php
			if($_SESSION['usuarioTIPO'] == 2)
			{
				if($instrutor_visualiza==1)
				{
					echo 
					'
						<section class="content-header">
						  <h1>Cursos do '.$row['usuario_nome'].'</h1>
						</section>
					';
					
						$retorno = ExecData($mysqli, 'cursos','cursos_lista_por_usuario','*', $usuario_busca);
						while($row = mysqli_fetch_array($retorno))
						{
							echo 
							'
								<div class="col-md-4">
								  <div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title"><a href="?p=course&curso_id='.$row['curso_id'].'">'.$row['curso_titulo'].'</a></h3>
										<div id="stars" class="starrr pull-right" data-rating=4>(32)4.07 </div>
									  <img class="img-responsive pad course_list" src="'.mostra_imagem('curso',$row['curso_imagem']).'" alt="'.$row['curso_titulo'].'">
									</div><!-- /.box-header -->
									<div class="box-body">
									  <span class="desccription">
										  '.$row['curso_resumo'].'
									  </span>
									</div><!-- /.box-body -->
									<div class="box-footer">
									  <button class="btn btn-default btn-xs"><i class="fa fa-share"></i> Compartilhar</button>
									  '.$botoes_acao_admin.'
									</div><!-- /.box-footer -->
								  </div>
								</div>
							';
						}
				}

				/*else
				{
					
					echo 
					'
					  <div class="col-md-12">
						<div class="box box-primary">
						  <div class="box-header with-border">
							<h3 class="box-title">Ganhos Estimados</h3>
						  </div><!-- /.box-header -->
						  <div class="box-body">
							<div class="row">
							  <div class="col-lg-3 col-xs-6">
								<div class="small-box bg-blue">
								  <div class="inner">
									<h3>BRL 12,36</h3>
									<p>hoje, até o momento.</p>
								  </div>
								  <div class="icon">
									<i class="fa fa-dollar"></i>
								  </div>
								</div>
							  </div>

							  <div class="col-lg-3 col-xs-6">
								<div class="small-box bg-blue">
								  <div class="inner">
									<h3>BRL 28,45</h3>
									<p>Ultimos 7 dias</p>
								  </div>
								  <div class="icon">
									<i class="fa fa-dollar"></i>
								  </div>
								</div>
							  </div>

							  <div class="col-lg-3 col-xs-6">
								<div class="small-box bg-blue">
								  <div class="inner">
									<h3>BRL 231,56</h3>
									<p>Este mês</p>
								  </div>
								  <div class="icon">
									<i class="fa fa-dollar"></i>
								  </div>
								</div>
							  </div>

							  <div class="col-lg-3 col-xs-6">
								<div class="small-box bg-blue">
								  <div class="inner">
									<h3>BRL 653,27</h3>
									<p>Saldo</p>
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
					';
				}*/
			}
			?>
          </div>

        </section><!-- /.content -->
      