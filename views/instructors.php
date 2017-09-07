<div class="content-wrapper">
  <section class="content-header">
    <h1>Instrutores</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Usuários</a></li>
      <li class="active">Instrutores</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">


    
<?php

 		if( (isset($_GET['change_type'])) && ($_SESSION['usuarioTIPO']==3)) 
		{
			//se existe get para edição de status do curso
				if(isset($_GET['change_type']))
				{
					$usuario_id 		= (int)$_GET['instructors_id'];
					$usuario_novo_tipo 	= (int)$_GET['change_type'];
					
					$crud = new crud("usuario");
					$retorno = $crud->update($mysqli,"usuario_tipo = $usuario_novo_tipo","usuario_id = $usuario_id");
						if($retorno==1)
						{
							
							//Envia notificação para instrutor
								if($usuario_novo_tipo == 1) //bloqueado para instrutor
								{
									EnviaMensagem($mysqli, $usuario_id, 'Você não foi aprovado', 'Infelizmente, você não foi aprovado para se tornar um instrutor');
								}
								elseif($usuario_novo_tipo == 2) //liberado para instrutor
								{
									EnviaMensagem($mysqli, $usuario_id, 'Você foi aprovado', 'Parabéns, você foi aprovado como instrutor');							
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
		}
		
 
	
	
	
		$botao_instrutor_aprova = 0;
		if( (isset($_GET['view'])) && ($_GET['view']=='pending')) 
		{
			$all_user = ExecData($mysqli, 'usuario','consulta_usuario_instrutores_pendente_aprovacao','*', 0);
			$botao_instrutor_aprova = 1;
		}
		else
		{
			$all_user = ExecData($mysqli, 'usuario','consulta_usuario_instrutores','*', 0);
		}
		
		$max = 30;
        while($row = mysqli_fetch_array($all_user))
        {
			$botao_aprovacao = '';
			if($botao_instrutor_aprova == 1) //botão de aprovação do instrutor
			{
				$botao_aprovacao = '<a href="?p=instructors&change_type=2&instructors_id='.$row['usuario_id'].'" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Aprovar</a>';
			}

			$formacao = (empty($row['usuario_formacao'])) ? ("Formação não informada"): ($row['usuario_formacao']);
			$formacao = substr_replace($formacao, (strlen($formacao) > $max ? '...' : ''), $max);
			
			$usuario_nome = substr_replace($row['usuario_nome'], (strlen($row['usuario_nome']) > 10 ? '...' : ''), 10);
          echo 
          '
            <!-- Profile Image -->
            <div class="col-md-3 ">
              <a href="dashboard.php?p=instructor&instrutor='.$row['usuario_id'].'&name='.preparaURL($row['usuario_nome']).'">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="'.mostra_imagem('user',$row['usuario_foto']).'" alt="'.$row['usuario_nome'].' - '.$formacao.'">
                    <h3 class="profile-username text-center">'.$usuario_nome.'</h3>
                    <p class="text-muted text-center">'.$formacao.'</p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Publicações</b>
                          <a class="pull-right">
                           '.$row['total_publicacao'].'
                          </a>
                      </li>
                      <li class="list-group-item">
                        <b>Inscritos</b> <a class="pull-right">'.ExecData($mysqli, 'usuario','consulta_total_inscritos','*', $row['usuario_id']).'</a>
                      </li>
                      <li class="list-group-item">
                        <b>Avaliação</b>
							<a class="pull-right">
								<div rating="'.ExecData($mysqli, 'usuario','consulta_media_star','*', $row['usuario_id']).'" class="user_star"></div>
							</a>
                      </li>
                    </ul>
                  </div>
				  
					<div class="box-footer">
						'.$botao_aprovacao.'
						<a href="?p=instructors&change_type=1&instructors_id='.$row['usuario_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Bloquear</a>
					</div>
					
                </div><!-- /.box -->
              </a>
            </div><!-- /.col -->

          ';
        }
    ?>

        


      
    </div>
  </section>
</div>