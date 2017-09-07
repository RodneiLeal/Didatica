<div class="content-wrapper">

 

  <section class="content">
	<?php
		include 'content/course/courses_search_form.php';
	?>
	
		<section class="content-header">
			<h1>Cursos encontrados</h1>
			<ol class="breadcrumb">
			  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			  <li><a href="#">Lista de Cursos</a></li>
			  <li class="active">Cursos</li>
			</ol>
		</section>
			
    <div class="row">
	<BR>
<?php

    $botoes_acao_admin ='';
    if( (isset($_GET['view'])) && ($_SESSION['usuarioTIPO']==3)) 
    {
			//se existe get para edição de status do curso
				if(isset($_GET['change_status']))
				{
					$curso_atualiza 	= (int)$_GET['course'];
					$curso_novo_status 	= (int)$_GET['change_status'];
					
					$crud = new crud("curso");
					$retorno = $crud->update($mysqli,"curso_ativo = $curso_novo_status","curso_id = $curso_atualiza");
						if($retorno==1)
						{
							//Envia notificação para instrutor
								$retorno_usuario_sql = ExecData($mysqli, 'cursos','cursos_lista','curso_usuario_id, curso_titulo', $curso_atualiza);
								$retorno_usuario = mysqli_fetch_assoc($retorno_usuario_sql);
								
								if($curso_novo_status == 1) //ativa o curso
								{
									EnviaMensagem($mysqli, $retorno_usuario['curso_usuario_id'], 'Seu Curso foi aprovado','Parabéns, Seu curso foi aprovado');
								}
								elseif($curso_novo_status == 0) //desativa o curso
								{
									EnviaMensagem($mysqli, $retorno_usuario['curso_usuario_id'], 'Seu curso foi recusado', 'Infelizmente, o seu curso foi recusado');		
								}
									
 								
							//Envia notificação para instrutor

							
							echo 
							'
								<div class="alert alert-success">
								  <strong>Successo!</strong> Registro atualizado
								</div>
							';
						}
						else
						{
							echo 
							'
								<div class="alert alert-danger">
								  <strong>Erro!</strong> Houve algo de errado, tente novamente
								</div>
							';
						}
				}
			//se existe get para edição de status do curso

        if($_GET['view']=='available')
        {
          $status_cursos = 1;
        }
        elseif($_GET['view']=='pending')
        {
          $status_cursos = 2;
        }
        elseif($_GET['view']=='disabled')
        {
          $status_cursos = 0;
        }
        $retorno = ExecData($mysqli, 'cursos','cursos_lista_ver_por_status','*', $status_cursos);
    }
    else
    {
      $retorno = ExecData($mysqli, 'cursos','cursos_lista','*', 0);
    }
	
?>

	<div id="courses_list">
		<?php include 'views/content/course/courses_search_result.php';?>
	</div>





    </div>
  </section>
</div>

