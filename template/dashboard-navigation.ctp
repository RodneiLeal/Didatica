<?php
	$solicitacao = empty($this->instrutor->getSolicitacaoInstrutor($idusuario)[0]);

	function get_menu_instructor(){
		$menu_user =
		'
			<li>
				<a href="Dashboard">
					<i class="fa fa-home"></i><span>Home</span>
				</a>
			</li>

			<li class="treeview">
				<a><i class="fa fa-university"></i><span>Instrutor</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/editar perfil" title="Editar Perfil"></i>Editar Perfil</a></li>

					<!--<li><a href="Dashboard/mensagens" title="Caixa de mensagens"></i>Caixa de Mensagens</a></li>-->

				</ul>
			</li>
				
			<li class="treeview">
				<a><i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/novo curso" title="Novo curso"></i>Novo curso</a></li>
					<li><a href="Dashboard/meus cursos" title="Meus cursos"></i>Meus cursos</a></li>
					<li><a href="Dashboard/inscricoes" title="Minhas Inscrições"></i>Minhas Inscrições</a></li>
				</ul>
			</li>
			';

			'<li class="treeview">
				<a><i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/meus_certificados" title="Lista todos os cursos"></i>Ver meus Certificados</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a><i class="fa fa-money"></i><span>Financeiro</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/resumo financeiro" title="Lista todos os cursos"></i>Meu saldo</a></li>
				</ul>
			</li>
		';

		return $menu_user;
	}

	function get_menu_user($data){
		$menu_user =
		'
			<li>
				<a href="Dashboard">
					<i class="fa fa-home"></i><span>Home</span>
				</a>
			</li>

			<li class="treeview">
				<a><i class="fa fa-user"></i><span>Usuario</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/editar perfil" title="Editar Perfil"></i>Editar Perfil</a></li>
					<!--<li><a href="Dashboard/mensagens" title="Caixa de mensagens"></i>Caixa de Mensagens</a></li>-->
				</ul>
			</li>
			
			<li class="treeview">
				<a><i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/inscricoes" title="Minhas Inscrições"></i>Minhas Inscrições</a></li>
				</ul>
			</li>
			';
			
			$menu_user .= $data?
			'
			<li class="treeview">
				<a data-toggle="modal" class="closed-modal" data-target="#novo-instrutor">
					<i class="fa fa-university"></i><span>Tornar-se um Instrutor</span>
				</a>
			</li>
			':'';
			
			'<li class="treeview">
				<a><i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="Dashboard/meus certificados" title="Lista todos os cursos"></i>Ver meus Certificados</a></li>
				</ul>
			</li>
		';

		return $menu_user;
	}
?>

<aside class="main-sidebar">
    <section class="sidebar">
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<?php 
				if($tipo) echo get_menu_instructor();
				else echo get_menu_user($solicitacao);
			?>
		</ul>
    </section>
</aside><!-- /.sidebar -->