  <section class="content-header">
    <h1>Minhas Mensagens</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Mensagens</li>
    </ol>
  </section>
  <section class="content">


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Mensagens recebidas</h3>
          </div><!-- /.box-header -->
			<div class="table-responsive mailbox-messages">
				<div class="col-md-5">
					<table class="table table-hover table-striped">
						
						<tr>
							<th>Título</th>
							<th>Data</th>
						</tr>

					<?php
						$retorno = ExecData($mysqli, 'mensagem','mensagens_todas','*', $_SESSION['usuarioID']);
						while($row = mysqli_fetch_array($retorno))
						{
							$status_cor = 'normal';
 							
							if($row['usuario_mensagem_lido']==2)//não lido
							{
								$status_cor = 'bold';
 							}
							echo
							'
								<tr style="font-weight:'.$status_cor.'" id="block_user_messages_'.$row['usuario_mensagem_id'].'">
									<td><a href="javascript:void()" class="user_messages_received" mensagem_id="'.$row['usuario_mensagem_id'].'" mensagem="'.$row['usuario_mensagem_mensagem'].'" data="'.strftime('%d, %B de %Y, %H %M', strtotime($row['usuario_mensagem_data'])).'">'.$row['usuario_mensagem_titulo'].'</a></td>
									<td>'.strftime('%d, %B de %Y, %H %M', strtotime($row['usuario_mensagem_data'])).'</td>
 								</tr>
							';
						}
					?>
					</table>
				</div>
				
					<div class="col-md-7">
					
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Ler Mensagem</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body no-padding">
								<div class="mailbox-read-info">
									<span class="mailbox-read-time pull-right" id="user_messages_read_data"></span></h5>
								</div>
									<div class="mailbox-read-message" id="user_messages_read_mensagem"></div>
							</div>
						</div>
					</div>
					
					
					
					</div>
			</div><!-- /.box -->
      </div>
    </div>

      

      
  </section>