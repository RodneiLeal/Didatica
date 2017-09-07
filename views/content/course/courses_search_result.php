<?php
	if( (isset($_POST['operation'])) && ($_POST['operation']=='search_form') )
	{
		$retorno = '';
		
		$search_title = '';
		$search_category = '';
		
		if(!empty($_POST['busca_texto'])) //Busca por titulo
		{
			$search_title = mysqli_real_escape_string($mysqli, $_POST['busca_texto']); 
		}
		
			if(!empty($_POST['busca_categoria'])) //categoria
			{
				if($_POST['busca_categoria']==0)
				{
					$search_category = '';
				}
				else
				{
					$search_category = (int)$_POST['busca_categoria']; 
				}
				
			}
			
		include '../../../controller/_biblio.php';
		include '../../../model/global.php';
				
		$busca_content = $search_title.'__'.$search_category;
		$retorno = ExecData($mysqli, 'cursos','cursos_lista_busca_filtro','*', $busca_content);
		 
	}	
		
		while($row = mysqli_fetch_array($retorno))
		{
			if( (isset($_GET['view'])) && ($_SESSION['usuarioTIPO']==3)) 
			{
				if($_GET['view']=='pending')
				{
				  $botoes_acao_admin =
				  '
					<a href="?p=courses-list&view=pending&change_status=1&course='.$row['curso_id'].'" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Aprovar</a>
					<a href="?p=courses-list&view=pending&change_status=0&course='.$row['curso_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reprovar</a>
				  ';
				}
				elseif($_GET['view']=='disabled')
				{
				  $botoes_acao_admin =
				  '
					<a href="?p=courses-list&view=pending&change_status=1&course='.$row['curso_id'].'" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Aprovar</a>
				  ';
				}
			}
			echo 
			'
				<div class="col-md-3">
				  <div class="box box-primary">
					<div class="box-header with-border">
						<a href="?p=course&curso_id='.$row['curso_id'].'">
							<h3 class="box-title">
								'.$row['curso_titulo'].'
							</h3>
						
							<span class="pull-right">
								<div rating="'.ExecData($mysqli, 'usuario','consulta_media_star','*', $row['usuario_id']).'" class="user_star"></div>
							</span>
							<img class="img-responsive pad course_list" src="'.mostra_imagem('curso',$row['curso_imagem']).'" alt="'.$row['curso_titulo'].'">
						</a>
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
?>