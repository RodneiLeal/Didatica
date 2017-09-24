        
        <?php
    // extract($_REQUEST);
    // $instrutor = new Instructor;

    $perfi = $instrutor->perfil($idusuario);

    var_dump($perfil);



    // $header  = '<section class="content-header">';
    // $header .= '<h1>Perfil</h1>';
    // $header .= '<ol class="breadcrumb">';
    // $header .= '<li><a><i class="fa fa-dashboard"></i> Home</a></li>';
    // $header .= '<li><a>Perfil</a></li>';
    // $header .= '<li class="active">'.$nome.'</li>';
    // $header .= '</ol></section>';

?>
        
        
        
        
        
        
        
        
        
        
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Perfil</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Usuário</a></li>
            <li class="active">
								{nome do usuario}
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
                  <img class="profile-user-img img-responsive img-circle" src="{foto}" alt="{nome}.' - '.{formação}">
                  <h3 class="profile-username text-center">
                      
                        {nome}
                      
                  </h3>
                  <p class="text-muted text-center">
                      
                        {formação}
                      
                  </p>


						<!-- se o usuario for instrutor	-->

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
										
                      <b>Publicações</b> <a class="pull-right">
                       {total de publicações}
                      </a>
                    </li>

                    <li class="list-group-item">
                      <b>Inscritos</b> <a class="pull-right">
												{total de inscrito}
											<?php //echo ExecData($mysqli, 'usuario','consulta_total_inscritos','*', $row['usuario_id']);?></a>
                    </li>
                    <li class="list-group-item">
										<b>Avaliação</b>
										<a class="pull-right">
											<div rating="<?php //echo ExecData($mysqli, 'usuario','consulta_media_star','*', $row['usuario_id']);?>" class="user_star">
											{estrelas}</div>
										</a>
                    </li>
                  </ul>

									<!-- fim do se usuario for instrutor -->


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
                      {sobre}
                  </p>

                  <hr>
                  <!-- substituir o icone de lapis -->
                  <strong><i class="fa fa-briefcase  margin-r-5"></i> Habilidades</strong>
                  <p>
											<?php
												// $retorno_habilidades = ExecData($mysqli, 'usuario','consulta_usuario_habilidades','usuario_habilidade_habilidade', $usuario_busca);
												// while($habilidades = mysqli_fetch_array($retorno_habilidades))
												// {
												// 	echo '<span class="label label-info">'.$habilidades['usuario_habilidade_habilidade'].'</span>&nbsp;';
												// }
											?>
                    
                  </p>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      