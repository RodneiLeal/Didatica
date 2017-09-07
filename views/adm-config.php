<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Configurações</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Configurações</a></li>
      <li class="active">Edição</li>
    </ol>
  </section>
  <section class="content">

  <?php
      $data_user = ExecData($mysqli, 'site','configuracoes','*',$_SESSION['usuarioID']);
      $row = mysqli_fetch_assoc($data_user);
  ?>


    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Configurações</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">


                  <form class="form-horizontal" id="FormeditProfileSave" action="controller/system_config.php">

						<div class="form-group">
						  <label for="SystemCertifiedValue" class="col-sm-2 control-label">Valor Certificado</label>
						  <div class="col-sm-10">
							<input class="form-control" id="SystemCertifiedValue" name="SystemCertifiedValue" placeholder="" required="true" required_message="Ops, por favor, preencha este campo" type="text"
							  value="<?php echo $row['adm_configuracao_certificado_valor'];?>" onkeyup="mascara(this, mvalor);" maxlength="6"
							>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="SystemCertifiedValueMinimal" class="col-sm-2 control-label">Valor minimo para saque</label>
						  <div class="col-sm-10">
							<input class="form-control" id="SystemCertifiedValueMinimal" name="SystemCertifiedValueMinimal" placeholder="" required="true" required_message="Ops, por favor, preencha este campo" type="text"
							  value="<?php echo $row['adm_configuracao_saque_valor_minimo'];?>"  onkeyup="mascara(this, mvalor);" maxlength="6"
							>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="SystemCertifiedDay" class="col-sm-2 control-label">Dia de liberação do botão para solicitação de saque</label>
						  <div class="col-sm-10">
							<select class="form-control" id="SystemCertifiedDay" name="SystemCertifiedDay" placeholder="" required="true" required_message="Ops, por favor, preencha este campo">
							
								<option value="1" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==1) ? ("selected") : ("");?>>Segunda-Feira</option>
								<option value="2" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==3) ? ("selected") : ("");?>>Terça-Feira</option>
								<option value="3" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==4) ? ("selected") : ("");?>>Quarta-Feira</option>
								<option value="4" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==5) ? ("selected") : ("");?>>Quinta-Feira</option>
								<option value="5" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==6) ? ("selected") : ("");?>>Sexta-Feira</option>
								<option value="6" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==7) ? ("selected") : ("");?>>Sábado</option>
								<option value="0" <?php echo ($row['adm_configuracao_saque_dia_solicitacao']==0) ? ("selected") : ("");?>>Domingo</option>
							</select>
						  </div>
						</div>
						
						<div class="form-group">
						  <div class="col-sm-offset-2 col-sm-10">
						  
							<input class="form-control" id="SystemConfig" name="SystemConfig" type="hidden" >
							<button type="button" id="editProfileSave" class="btn btn-primary form_send_information_bt">Salvar</button>
						  </div>
						</div>
						
                  </form>

           
          </div>
        </div>
      </div>
	  
	  
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Categorias</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">

                  <form class="form-horizontal" id="FormeditCategorys" action="controller/system_config.php">
						<div class="form-group">
						  <label for="SystemCategory" class="col-sm-2 control-label">Nome da nova categoria</label>
						  <div class="col-sm-10">
							<input class="form-control" id="SystemCategory" name="SystemCategory" placeholder="" required="true" required_message="Ops, por favor, preencha este campo" type="text">
						  </div>
						</div>
						
						<div class="form-group">
						  <div class="col-sm-offset-2 col-sm-10">
						  
							<input class="form-control" id="SystemConfig_category_id" name="SystemConfig_category_id" type="hidden" >
							<input class="form-control" id="SystemConfig_category" name="SystemConfig_category" value="new" type="hidden" >
							
							<button type="button" id="editFormeditCategorys" class="btn btn-primary form_send_information_bt">Salvar</button>
						  </div>
						</div>
						
                  </form>
          </div>
			<div class="box">
				<?php
					if( (isset($_GET['change_type'])) && ($_SESSION['usuarioTIPO']==3)) 
					{
						if(isset($_GET['change_type']))
						{
							$category 		= (int)$_GET['category'];
 							
							$crud = new crud("curso_categoria");
							$retorno = $crud->remove($mysqli,"curso_categoria_id = $category");
								if($retorno==1)
								{
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
					}
				?>
			  <div class="box-body table-responsive no-padding">
				<table class="table table-hover">
				  <tr>
					<th>#</th>
					<th>Nome</th>
					<th>Ações</th>
				  </tr>
				<?php
					$retorno = ExecData($mysqli, 'cursos','curso_categorias_lista','*', 0);
					while($categorias = mysqli_fetch_array($retorno))
					{
						echo 
						'
						  <tr>
							<td>'.$categorias['curso_categoria_id'].'</td>
							<td>'.$categorias['curso_categoria_nome'].'</td>
							<td>
						';
				?>
						<button type="button" class="btn btn-primary btn-xs" onclick="$('#SystemConfig_category_id').val(<?php echo $categorias['curso_categoria_id'];?>);$('#SystemCategory').val('<?php echo $categorias['curso_categoria_nome'];?>');$('#SystemConfig_category').val('edit')">editar</button>
						<a href="dashboard.php?p=adm-config&change_type=remove&category=<?php echo $categorias['curso_categoria_id'];?>" class="btn btn-danger btn-xs">remover</a>
				<?php
						echo 
						'
							</td>
						  </tr>
						';
					}
				?>
				</table>
			  </div><!-- /.box-body -->
			</div>
		  
        </div>
      </div>
	  
	  
    </div>

  </section>

</div>







 