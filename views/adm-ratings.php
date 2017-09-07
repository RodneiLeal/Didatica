<div class="content-wrapper">
  <section class="content-header">
    <h1>Avaliações</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#">Usuários</a></li>
      <li class="active">Avaliações</li>
    </ol>
  </section>
  <section class="content">


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
				<?php
				
						if ($_SERVER['REQUEST_METHOD'] === 'GET')
						{
							if(isset($_GET['rating_id']))
							{
								$rating_id 	= (int)$_GET['rating_id'];
								$status 	= (int)$_GET['action'];
							
								$crud = new crud('curso_avaliacao');
								$retorno = $crud->update($mysqli,"curso_avaliacao_ativo = $status","curso_avaliacao_id=$rating_id");
								
								if($retorno ==1)
								{
									echo 
									'
										<div class="alert alert-success">
										  <strong>Ok!</strong> Registrado alterado com sucesso
										</div>
									';
								}
								else
								{
									echo 
									'
										<div class="alert alert-danger">
										  <strong>Ops!</strong> Houve algo de errado, tente novamente
										</div>
									';
								}
							}
						}
				
				?>
                <div class="box-header">
                  <h3 class="box-title">Avaliações</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Usuário</th>
					  <th>Curso</th>
                      <th>Data Avaliação</th>
                      <th>Nota</th>
					  <th>Mensagem</th>
                      <th>Status</th>
					  <th>Ações</th>
                    </tr>
            <?php
                include 'config/config_site.php';

                $retorno = ExecData($mysqli, 'sistema','avaliacoes_lista','*', '');
                while($row = mysqli_fetch_array($retorno))
				{
                
					if ($row['curso_avaliacao_ativo']==1)
					{
						$status = "<span class='label label-success'>Ativo</span>";
						$acoes = '';
					}
					elseif ($row['curso_avaliacao_ativo']==2)
					{
						$status = "<span class='label label-warning'>Pendente</span>";
						$acoes =
							'
								<a href="dashboard.php?p=adm-ratings&rating_id='.$row['curso_avaliacao_id'].'&action=1&TK='.md5($row['curso_avaliacao_id']).'">Ativar</a>  |  
								<a href="dashboard.php?p=adm-ratings&rating_id='.$row['curso_avaliacao_id'].'&action=0&TK='.md5($row['curso_avaliacao_id']).'">Não tivar</a> 
							';
					}
					elseif ($row['curso_avaliacao_ativo']==0)
					{
						$status = "<span class='label label-default'>Não ativado</span>";
						$acoes = '';
					}

                    echo 
                    '
                      <tr>
                        <td>'.$row['curso_avaliacao_id'].'</td>
                        <td><a href="?p=6">'.$row['usuario_nome'].'</a></td>
						<td>'.$row['curso_titulo'].'</td>
                        <td>'.date("d/m/Y", strtotime($row['curso_avaliacao_data_cadastro'])).'</td>
                        <td>'.$row['curso_avaliacao_nota'].'</td>
						<td><small>'.$row['curso_avaliacao_comentario'].'</small></td>
                         <td>
                          '.$status.'
                        </td>
                         <td>
                          '.$acoes.'
                        </td>
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




  <!-- Modal -->
  <div class="modal fade" id="adm-withdrawal-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="fa fa-send"></span> Confirmação de Saque</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div id="adm-withdrawal-modal-data-bank" class="text-center"></div>
            <button type="button" class="btn btn-default btn-success btn-block adm-withdrawal-modal-confirm-withdrawal-bt" data_register_id=""><span class="fa fa-check"></span> Confirmar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <Script>

  </Script>