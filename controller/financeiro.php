<?php
	session_start();

	include '_biblio.php';
	include '../model/global.php';

	if(isset ($_POST['operation']))
	{

		//SOLCIITA SAQUE
		if($_POST['operation']=='solicita_saque')
		{

				//Verifica se usuário tem saldo

		                $my_values = ExecData($mysqli, 'financeiro','financeiro_totalizador','*', 0);
		                $row_values = mysqli_fetch_array($my_values);

					    if( (empty($row_values['total_em_conta'])) || ($row_values['total_em_conta']==0) )
					    {
							echo 'erro___Ops, você está sem saldo';
							exit;
					    }
					    else
					    {
					    	include '../config/config_site.php';

					    	$valor_minimo = site_data($mysqli, "adm_configuracao_saque_valor_minimo");
					    	if($valor_minimo > $row_values['total_em_conta'])
					    	{
								echo 'erro___Ops, você ainda não tem saldo suficiente para saque';
								exit;
					    	}
					    }
				//Verifica se usuário tem saldo


			$valor_conta =  $row_values['total_em_conta'];
			$campos=
			"
				usuario_saque_solicitacao_usuario_id,
				usuario_saque_solicitacao_valor,
				usuario_saque_solicitacao_data_cadastro,
				usuario_saque_solicitacao_ativo
			";
			
				$conteudo =
				"
					'{$_SESSION['usuarioID']}',
					'$valor_conta',
					'$data_cadastro',
					0
				";
			
			$crud = new crud('usuario_saque_solicitacao');
			$retorno = $crud->insert($mysqli, $campos, $conteudo);

				if($retorno==0)
				{
					
					echo 'erro___Algo deu errado neste comando';
					exit;
				}
				else
				{

					//Atualiza todos os saldos em cnta para em transferencia
					$crud = new crud('usuario_saldo');
					$retorno = $crud->update($mysqli, "usuario_saldo_ativo=1","usuario_saldo_usuario_id = '{$_SESSION['usuarioID']}' and usuario_saldo_ativo = 2");

					echo 'sucesso___Excelente, sua solicitação de saque foi encaminhada';
					exit;
				}
		}

		if($_POST['operation']=='adm_confirma_saque')
		{
				$data_register_id =  $_POST['data_register_id'];

				$crud = new crud('usuario_saque_solicitacao');
				$retorno = $crud->update($mysqli, "usuario_saque_solicitacao_ativo=1, usuario_saque_solicitacao_data_transferencia = '$data_cadastro'","usuario_saque_solicitacao_id = $data_register_id");

				if($retorno==0)
				{
					
					echo 'erro___Algo deu errado neste comando';
					exit;
				}
				else
				{
					echo 'sucesso___Excelente, confirmação realizada';
					exit;
				}
		}

	}
?>