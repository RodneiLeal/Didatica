<?php
	session_start();

	include '_biblio.php';
	include '../model/global.php';

	if(isset ($_POST['operation']))
	{
		if($_POST['operation']=='course_exam_finish')
		{
			$curso	= (int)$_POST['course_register_content'];

 

        	//$return_course_item = ExecData($mysqli, 'exame','curso_exame_respostas_envia','*', $questao_id);
				$questoes_total_sql = ExecData($mysqli, 'exame','curso_perguntas_total','total_questoes', $curso);
				$questoes_total = mysqli_fetch_assoc($questoes_total_sql);


 
				$contador = 1;
				$respostas_certas = 0;
				$respostas_erradas= 0;

				while($contador <= $questoes_total['total_questoes'])
				{
					//echo $contador;
				    
					$questao_id  = (int)$_POST['questao_pergunta_'.$contador];
					$resposta_id = (int)$_POST['questao_resposta_'.$contador];

					$retorna_resposta_correta_query = ExecData($mysqli, 'exame','curso_exame_respostas_envia','*', $questao_id);
					$retorna_resposta_correta = mysqli_fetch_assoc($retorna_resposta_correta_query);

					if($retorna_resposta_correta['curso_questao_pergunta_resposta_correta']==$resposta_id)
					{
						$respostas_certas++;
					}
					else
					{
						$respostas_erradas++;
					}

				    $contador++;
				} 


				//Calculando media de acertos
					$perguntas = $questoes_total['total_questoes'];
					$acertos = $respostas_certas;
					$media = (($acertos / $perguntas) * 100);

					if($media < 60)
					{
						$resultado = 0;//reprovado
					}
					else
					{
						$resultado = 1;//aprovado
					}
				//Calculando media de acertos


					$campos=
					"
						curso_exame_usuario_id,
						curso_exame_curso_id,
						curso_exame_data,
						curso_exame_nota,
						curso_exame_ativo
					";
					
						$conteudo =
						"
							'{$_SESSION['usuarioID']}',
							'$curso',
							'$data_cadastro',
							'$media',
							'$resultado'
						";
					
					$crud = new crud('curso_exame');
					$retorno = $crud->insert($mysqli, $campos, $conteudo);

						if($retorno==0)
						{
							
							echo 'erro___Algo deu errado neste comando, tente novamente';
							exit;
						}
						else
						{
							if($resultado == 0)
							{
								echo 'reproved___Lamentamos muito, mas, você não acertou os 60% necessários';
							}
							else
							{
								echo 'sucesso___Parabéns! Você já pode solicitar seu certificado';
							}
							 
						}
 
		}
	}
?>