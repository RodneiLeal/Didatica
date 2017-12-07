<?php

	include '_biblio.php';
	include '../config/config_site.php';


if(isset ($_POST['ProfileSave']))
{


		//Valida Campos
		$signup_email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_EMAIL);
		if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL))
		{
			echo 0;
			exit;
		}
		$inputEmail	= mysqli_real_escape_string($mysqli, $_POST['inputEmail']); 
		$inputName	= mysqli_real_escape_string($mysqli, $_POST['inputName']); 
		$passwd		= $_POST['passwd']; 
		//Valida Campos


			

			$consulta_usuario = mysqli_query($mysqli, "SELECT usuario_id FROM usuario where usuario_email = '$inputEmail' and usuario_id <> '{$_SESSION['usuarioID']}'");
			$usuario_valida = mysqli_fetch_assoc($consulta_usuario);																
			
			if(!empty($usuario_valida['usuario_id']))
			{
				echo 'erro___Este e-mail já pertence a um usuário';
				exit;
			}

				$senha = '';
				if(!empty($passwd))
				{
					$senha = ",usuario_pass = '".md5($passwd)."'";
				}
 
				$campos=
				"
					usuario_nome = '$inputName',
					usuario_email = '$inputEmail'
					$senha
				";
				

				$crud = new crud('usuario');
				$retorno = $crud->update($mysqli, $campos, "usuario_id = '{$_SESSION['usuarioID']}'");

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



if(isset ($_POST['ProfileSaveProfessional']))
{

		//Valida Campos
		$inputFormacao	= mysqli_real_escape_string($mysqli, $_POST['inputFormacao']); 
		$inputTitulo	= mysqli_real_escape_string($mysqli, $_POST['inputTitulo']); 
		$inputResumo	= mysqli_real_escape_string($mysqli, $_POST['inputResumo']); 

		$inputHabilidades	= mysqli_real_escape_string($mysqli, $_POST['inputHabilidades']);



		//Valida Campos

			$campos=
			"
				usuario_formacao = '$inputFormacao',
				usuario_titulo = '$inputTitulo',
				usuario_sobre = '$inputResumo'
			";
			

			$crud = new crud('usuario');
			$retorno = $crud->update($mysqli, $campos, "usuario_id = '{$_SESSION['usuarioID']}'");

			if($retorno==0)
			{
				
				echo 'erro___Algo deu errado neste comando';
				exit;
			}
			else
			{

				$crud = new crud('usuario_habilidade');
				$retorno = $crud->remove($mysqli, "usuario_habilidade_usuario_id = '{$_SESSION['usuarioID']}'");

 				$cats = explode(",", $inputHabilidades);
				foreach($cats as $cat)
				{
					$campos=
					"
						usuario_habilidade_usuario_id,
						usuario_habilidade_habilidade
					";
						$conteudo =
						"
							'{$_SESSION['usuarioID']}',
							'$cat'
						";
					$crud = new crud('usuario_habilidade');
					$crud->insert($mysqli, $campos, $conteudo);
				}

				echo 'sucesso___Excelente, seus dados foram atualizados';
				exit;
			}
}


if(isset ($_POST['instructor_new']))
{
	include '../config/config_site.php';

	$sql = "SELECT t1.usuario_id, t1.usuario_formacao, t1.usuario_titulo, t1.usuario_sobre, t2.usuario_habilidade_habilidade FROM usuario as t1 LEFT JOIN usuario_habilidade as t2 ON t1.usuario_id = t2.usuario_habilidade_usuario_id WHERE t1.usuario_id = {$_SESSION['usuarioID']} limit 1";


	$user_professional_data = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));



	$bool = (empty($user_professional_data['usuario_formacao']) || empty($user_professional_data['usuario_titulo']) || empty($user_professional_data['usuario_sobre']) || empty($user_professional_data['usuario_habilidade_habilidade']));


	if($bool){

		echo "0__Por favor, complete seu cadastro e tente novamente.";

	}else{

		$campos = "usuario_instrutor_solicitacao_usuario_id, usuario_instrutor_solicitacao_data";
		$conteudo = "{$_SESSION['usuarioID']},'$data_cadastro'";

		$crud = new crud('usuario_instrutor_solicitacao');
		$retorno = $crud->insert($mysqli, $campos, $conteudo);

		if($retorno==1){
			echo '1__Ótimo, sua solicitação para Instrutor foi encaminhada.';
		}else{
			echo '2__houve algo de errado, tente novamente.';
		}
	}
					
}



if(isset ($_POST['ResetPass']))
{
		include '_funcoes.php';
 		
		//Valida Campos
			$signup_email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
			if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL))
			{
				echo 0;
				exit;
			}
 			
			$signup_email	= mysqli_real_escape_string($mysqli, $_POST['user_email']); 

			$consulta_usuario = mysqli_query($mysqli,"SELECT * FROM usuario where usuario_email = '$signup_email'");
			$usuario = mysqli_fetch_assoc($consulta_usuario);
			
				if(empty($usuario['usuario_id'])) //Não cadastrado
				{
					echo 1;
					exit;
				}
				else
				{
						$maiusculas = true;
						$numeros = true;
						$simbolos = false;
						
						$lmin = 'abcdefghijklmnopqrstuvwxyz';
						$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$num = '1234567890';
						$simb = '!@#$%';
						$senha_envia = '';
						$caracteres = '';
						$caracteres .= $lmin;
						if ($maiusculas) $caracteres .= $lmai;
						if ($numeros) $caracteres .= $num;
						if ($simbolos) $caracteres .= $simb;
						$len = strlen($caracteres);
						
						for ($n = 1; $n <= 10; $n++)
						{
							$rand = mt_rand(1, $len);
							$senha_envia .= $caracteres[$rand-1];
						}
						
						$senha_salva = md5($senha_envia);
						
						$recuperar_senha=
						"
							Olá, ".$usuario['usuario_nome']."<BR><BR>
							Você solicitou um lembrete de senha de acesso ao DidaticaOnline<Br><Br>
							Sua nova senha é: ".$senha_envia."<br><Br>
							Acesse já sua área administrativa e altere a senha gerada<br><br>
							<BR><BR>
							<small>Está é uma mensagem automática, por favor, não responda</small>
						";

						
								$campos=
								"
									usuario_pass = '$senha_salva'
								";

								$crud = new crud('usuario');
								$retorno = $crud->update($mysqli, $campos, "usuario_id = '{$usuario['usuario_id']}'");

								$retorno_mail = EnviaEmail($usuario['usuario_email'], $usuario['usuario_nome'], 'DidaticaOnline - Lembrede de Acesso', $recuperar_senha, '');
								
								echo 2;
								exit;
				}
				
		//Valida Campos


}




if(isset ($_POST['MensagemLer']))
{

		//Valida Campos
		$mensagem_id	= mysqli_real_escape_string($mysqli, $_POST['mensagem_id']); 
		//Valida Campos

			$campos=
			"
				usuario_mensagem_lido = 1
			";

			$crud = new crud('usuario_mensagem');
			$crud->update($mysqli, $campos, "usuario_mensagem_id = '$mensagem_id'");
}



if(isset($_GET['operation']))
{
	if($_GET['operation']=='ProfileImage')
	{

	    if ( 0 < $_FILES['file']['error'] ) {
	        echo 0;
	        exit;
	    }
	    else
	    {
	    	$nome_arquivo = md5($_FILES['file']['name']).'-'.$_FILES['file']['name'];

	        if(move_uploaded_file($_FILES['file']['tmp_name'], '../dist/img/users/' . $nome_arquivo) )
	        {
	        	 
				$campos=
				"
					usuario_foto = '$nome_arquivo'
				";
					 

				$crud = new crud('usuario');
				$retorno = $crud->update($mysqli, $campos, "usuario_id = '{$_SESSION['usuarioID']}'");
				if($retorno==1)
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
	        }
	        else
	        {
	        	echo 0;
	        }
		}
	}
}
?>