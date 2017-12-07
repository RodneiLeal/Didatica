<?php
	session_start();

include '_biblio.php';

if(isset ($_POST['SystemConfig']))
{

		$SystemCertifiedValue			= str_replace(",",".",mysqli_real_escape_string($mysqli, $_POST['SystemCertifiedValue'])); 
		$SystemCertifiedValueMinimal	= str_replace(",",".",mysqli_real_escape_string($mysqli, $_POST['SystemCertifiedValueMinimal'])); 
		$SystemCertifiedDay				= mysqli_real_escape_string($mysqli, $_POST['SystemCertifiedDay']); 
		
				$campos = 
				"
					adm_configuracao_certificado_valor 		= '$SystemCertifiedValue',
					adm_configuracao_saque_valor_minimo 	= '$SystemCertifiedValueMinimal',
					adm_configuracao_saque_dia_solicitacao	= '$SystemCertifiedDay'
				";
				

				// erro gravissimo, se apagar totalmente as configurações, não é possivel gravalas novamente, pois esta sendo feito somente um update nos dados iniciais.


				// comom contornar este erro

				$crud = new crud('adm_configuracao');
				$retorno = $crud->update($mysqli, $campos, "adm_configuracao_id = 1");

				if($retorno==0)
				{
					
					echo 'erro___Algo deu errado neste comando';
					exit;
				}
				else
				{
					echo 'sucesso___Excelente, seus dados foram atualizados';
					exit;
				}
}






if(isset ($_POST['SystemConfig_category']))
{
	if($_POST['SystemConfig_category']=='edit')
	{
				$SystemCategory				= mysqli_real_escape_string($mysqli, $_POST['SystemCategory']); 
				$SystemConfig_category_id	= mysqli_real_escape_string($mysqli, $_POST['SystemConfig_category_id']); 
		
				$campos = 
				"
					curso_categoria_nome 		= '$SystemCategory'
				";
				
				$crud = new crud('curso_categoria');
				$retorno = $crud->update($mysqli, $campos, "curso_categoria_id = '$SystemConfig_category_id' ");

				if($retorno==0)
				{
					
					echo 'erro___Algo deu errado neste comando';
					exit;
				}
				else
				{
					echo 'sucesso___Excelente, seus dados foram atualizados';
					exit;
				}
	}
	else
	{
				$SystemCategory				= mysqli_real_escape_string($mysqli, $_POST['SystemCategory']); 
 		
				$campos = 
				"
					curso_categoria_nome
				";
					$conteudo = 
					"
						'$SystemCategory'
					";
				
				$crud = new crud('curso_categoria');
				$retorno = $crud->insert($mysqli, $campos, $conteudo);

				if($retorno==0)
				{
					
					echo 'erro___Algo deu errado neste comando';
					exit;
				}
				else
				{
					echo 'sucesso___Excelente, seus dados foram atualizados';
					exit;
				}
		
		
	}
	
	
	
	
}