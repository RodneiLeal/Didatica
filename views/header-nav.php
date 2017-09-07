<header class="main-header">
  <!-- Logo -->
  <a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    
    <span class="logo-mini"><img src="dist/img/didatica-inline-logotipo-mini.png" width="25px"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="dist/img/didatica-inline-logotipo.png" width="100px"></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>


    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">


        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
				<?php
					$retorno = ExecData($mysqli, 'mensagem','mensagens_total','*', $_SESSION['usuarioID']);
					$row = mysqli_fetch_assoc($retorno);
				?>
              <span class="label label-danger"><?php echo $row['total'];?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem <?php echo $row['total'];?> novas mensagens</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

				<?php
					$retorno = ExecData($mysqli, 'mensagem','mensagens_todas_nao_lidas','*', $_SESSION['usuarioID']);
					while($row = mysqli_fetch_array($retorno))
					{
 						echo
						'
							<li><!-- start message -->
								<a href="dashboard.php?p=user-messages&read='.$row['usuario_mensagem_id'].'">
									<!--
										<div class="pull-left">
											<img src="dist/img/Rodnei.jpg" class="img-circle" alt="User Image">
										</div>
									-->
									<h4>
										'.$row['usuario_mensagem_titulo'].'
									<small><i class="fa fa-clock-o"></i> '.strftime('%d %m, %H %M', strtotime($row['usuario_mensagem_data'])).'</small>
									</h4>
									<p>
									'.substr_replace($row['usuario_mensagem_mensagem'], (strlen($row['usuario_mensagem_mensagem']) > 30 ? '...' : ''), 30).'</p>
								</a>
							</li><!-- end message -->
						';
					}
				?>



                  
                </ul>
              </li>
              <li class="footer"><a href="dashboard.php?p=user-messages">Ver todas as mensagens</a></li>
            </ul>
        </li>


        <!-- User Account: style can be found in dropdown.less -->
        <?php
            $data_user = ExecData($mysqli, 'usuario','consulta_usuario','*', $_SESSION['usuarioID']);
            $row = mysqli_fetch_assoc($data_user);
        ?>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo mostra_imagem('user',$row['usuario_foto']);?>" class="user-image" alt="<?php echo $row['usuario_nome'];?>">
            <span class="hidden-xs">
                <?php
                  echo $row['usuario_nome'];
                ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="<?php echo mostra_imagem('user',$row['usuario_foto']);?>" class="img-circle" alt="<?php echo $row['usuario_nome'];?>">
              <p>
                <a href="?p=profile">
                  <font color="#fff">
                  <?php
                      $max = 10 ;
                      echo $row['usuario_nome'].' - '.substr_replace($row['usuario_formacao'], (strlen($row['usuario_formacao']) > $max ? '...' : ''), $max);
                    ?>
                  </font>
                </a>
                <small>Usuario desde <?php echo strftime('%B de %Y', strtotime($row['usuario_data_cadastro']));?></small>
                <small>Ultimo acesso: <span>23/01/2017 11:23</span></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="dashboard.php?p=user-edit" class="btn btn-default btn-flat">Editar</a>
              </div>
              <div class="pull-right">
                <a href="dashboard.php?logoff=true" class="btn btn-default btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>


      </ul>
    </div>
  </nav>
</header>