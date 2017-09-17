	
	
	
	<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>

          <?php
            switch($usuario_tipo){
              case 1: # aluno
                echo get_menu_user();
              break;
              
              case 2: #instrutor
                echo get_menu_instructor();
              break;
              
              case 3: #admin
                echo get_menu_admin();
              break;

              default: #em situaçõe de erro ou qaundo não for possivel identificar tipo de usuario, este será conciderado como aluno
                echo get_menu_user();
            }
          ?>

          
      </ul>
  
    </section>
    <!-- /.sidebar -->
  </aside>

<?php

	function get_menu_admin(){
			$menu_admin =
			'
				<li>
					<a href="dashboard">
						<i class="fa fa-home"></i><span>Home</span>
					</a>
				</li>

				<li class="treeview">
					<a href="#">
						<i class="fa fa-users"></i><span>Usuarios</span><i class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">
							<li><a href="dashboard.php?p=instructors" title="Lista todos os instrutores">Usuários</a></li>
							<li><a href="dashboard.php?p=instructors&view=pending" title="Lista todos os instrutores">Pendente Aprovação</a></li>
							<li><a href="dashboard.php?p=instructors-messages" title="Lista todos os instrutores">Enviar Mensagem</a></li>
						</ul>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=courses-list&view=available" title="Lista todos os cursos"></i>Aprovados</a></li>
						<li><a href="dashboard.php?p=courses-list&view=pending" title="Lista todos os cursos para avaliação">Pendente Aprovação</a></li>
						<li><a href="dashboard.php?p=courses-list&view=disabled" title="Lista todos os cursos para avaliação">Reprovados</a></li>
					</ul>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-money"></i><span>Financeiro</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=adm-withdrawal" title=""></i>Saques solicitados</a></li>
						<li><a href="dashboard.php?p=adm-balance" title=""></i>Balanço</a></li>
						<li><a href="dashboard/relatorio" title=""></i>Relatório</a></li>
					</ul>
				</li>
		
				<li class="treeview">
				<a href="#">
					<i class="fa fa-gear"></i><span>Configurações</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=adm-ratings" title=""></i>Avaliações de Cursos</a></li>
						<li><a href="dashboard.php?p=adm-config" title=""></i>Configurações</a></li>
					</ul>
				</li>
			';

			return $menu_admin;
	}
	
	function get_menu_instructor(){
			$menu_user =
			'
				<li>
					<a href="dashboard">
						<i class="fa fa-home"></i><span>Home</span>
					</a>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-university"></i><span>Instrutor</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=my-courses-list" title="Lista todos os cursos"></i>Meus cursos</a></li>
					</ul>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=my-courses-enroll" title="Lista todos os cursos"></i>Matriculas</a></li>
					</ul>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=my-certificates" title="Lista todos os cursos"></i>Ver meus Certificados</a></li>
					</ul>
				</li>

				<li class="treeview">
				<a href="#">
					<i class="fa fa-money"></i><span>Financeiro</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
						<li><a href="dashboard.php?p=my-financial-balance" title="Lista todos os cursos"></i>Meu saldo</a></li>
					</ul>
				</li>
			';

			return $menu_user;
	}

	function get_menu_user(){
		$menu_user =
		'
			<li class="treeview">
				<a href="?p=new-instructor">
					<i class="fa fa-university"></i><span>Tornar-se um Instrutor</span>
				</a>
			</li>
			
			<li class="treeview">
				<a href="#">
					<i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
					<li><a href="dashboard.php?p=my-courses-enroll" title="Lista todos os cursos"></i>Matriculas</a></li>
					</ul>
			</li>

			<li class="treeview">
			<a href="#">
				<i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i>
			</a>
				<ul class="treeview-menu">
				<li><a href="dashboard.php??p=my-certificates" title="Lista todos os cursos"></i>Ver meus Certificados</a></li>
				</ul>
			</li>

		';

		return $menu_user;
	}
?>