<?php
	session_start();

	include '../_biblio.php';

	if(isset ($_POST['messages_send_all_instructors']))
	{

		include '../../config/config_site.php';
		
		$mensagem	= mysqli_real_escape_string($mysqli, $_POST['messages_send_all_instructors_message']); 
		$titulo		= mysqli_real_escape_string($mysqli, $_POST['messages_send_all_instructors_title']); 
		
				$campos=
				"
					usuario_mensagem_usuario_id,
					usuario_mensagem_titulo,
					usuario_mensagem_mensagem,
					usuario_mensagem_data,
					usuario_mensagem_lido
				";
				
				$consulta_usuario = mysqli_query($mysqli, "SELECT usuario_id FROM usuario where usuario_tipo =2");
				while($usuarios =  mysqli_fetch_array($consulta_usuario))
				{

							$conteudo =
							"
								'{$usuarios['usuario_id']}',
								'$titulo',
								'$mensagem',
								'$data_cadastro',
								2
							";
						$crud = new crud('usuario_mensagem');
						$retorno = $crud->insert($mysqli, $campos, $conteudo);
				}
					echo 'sucesso___Excelente, mensagem enviada a todos os instrutores';
	}
	
	
 