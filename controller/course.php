<?php
	session_start();

	include '_biblio.php';
	include '../model/global.php';

	if(isset ($_POST['operation']))
	{

		//USUARIO INICIA CURSO
		if($_POST['operation']=='start')
		{
			$curso	= (int)$_POST['course'];

			// verifica se usuario esta logado
			if(!isset($_SESSION['usuarioID'])){
				echo 2;
				exit;
			}

			$campos=
			"
				matricula_usuario_id,
				matricula_curso_id,
				matricula_data_inscricao,
				matricula_ativo
			";
			
				$conteudo =
				"
					'{$_SESSION['usuarioID']}',
					'$curso',
					'$data_cadastro',
					1
				";
			
			$crud = new crud('matricula');
			echo $crud->insert($mysqli, $campos, $conteudo);
		}

		//USUARIO AVALIA CURSO
		if($_POST['operation']=='rate')
		{
			$matricula		= (int)$_POST['FormEnrollRate_matricula'];
			$nota 			= mysqli_real_escape_string($mysqli, $_POST['FormEnrollRate_nota']); 
			$comentario 	= mysqli_real_escape_string($mysqli, $_POST['FormEnrollRate_comentario']); 

				//Verifica se usuário já comentou

					    $retorno = ExecData($mysqli, 'cursos','cursos_matricula_avalia_verifica_contem','*', $matricula);
					    $row = mysqli_fetch_array($retorno);

					    if(!empty($row['curso_avaliacao_id']))
					    {
							echo 'erro___Ops, você já avaliou este curso';
							exit;
					    }
				//Verifica se usuário já comentou

			$campos=
			"
				curso_avaliacao_matricula_id,
				curso_avaliacao_nota,
				curso_avaliacao_comentario,
				curso_avaliacao_data_cadastro,
				curso_avaliacao_ativo
			";
			
				$conteudo =
				"
					'$matricula',
					'$nota',
					'$comentario',
					'$data_cadastro',
					2
				";
			
			$crud = new crud('curso_avaliacao');
			$retorno = $crud->insert($mysqli, $campos, $conteudo);

					if($retorno==0)
					{
						
						echo 'erro___Algo deu errado neste comando';
						exit;
					}
					else
					{
						echo 'sucesso___Excelente, seu comentário foi enviado com sucesso';
						exit;
					}

		}



		//USUARIO CRIA UM NOVO CURSO
			//STEP 1
			if( ($_POST['operation']=='course_creator_1') || ($_POST['operation']=='course_editor_1') )
			{
				$inputCourseDescription	= mysqli_real_escape_string($mysqli, $_POST['inputCourseDescription']); 
				$inputCourseHour		= mysqli_real_escape_string($mysqli, $_POST['inputCourseHour']); 
				$inputCourseResume		= mysqli_real_escape_string($mysqli, $_POST['inputCourseResume']); 
				$inputCourseTitle		= mysqli_real_escape_string($mysqli, $_POST['inputCourseTitle']); 
				$inputCourseCategory	= (int)$_POST['inputCourseCategory'];
 
 
					if($_POST['operation']=='course_creator_1') //Cadastra novo curso
					{
						$campos=
						"
							curso_usuario_id,
							curso_categoria_id,
							curso_titulo,
							curso_resumo,
							curso_descricao,
							curso_horas_total,
							curso_data_cadastro,
							curso_ativo
						";
							$conteudo =
							"
								'{$_SESSION['usuarioID']}',
								'$inputCourseCategory',
								'$inputCourseTitle',
								'$inputCourseResume',
								'$inputCourseDescription',
								'$inputCourseHour',
								'$data_cadastro',
								2
							";
				
							$crud = new crud('curso');
							$retorno = $crud->insert($mysqli, $campos, $conteudo);
							
							$registro_id = mysqli_insert_id($mysqli);
					}
					
					
							if($_POST['operation']=='course_editor_1') //Edita curso
							{
									$curso_id = (int)$_POST['course_edit_id'];
									
									$campos=
									"
 										curso_categoria_id 	= '$inputCourseCategory',
										curso_titulo 		= '$inputCourseTitle',
										curso_resumo 		= '$inputCourseResume',
										curso_descricao 	= '$inputCourseDescription',
										curso_horas_total 	= '$inputCourseHour',
 										curso_ativo 		= 2
									";
										$crud = new crud('curso');
										$retorno = $crud->update($mysqli, $campos, "curso_id = $curso_id");
										$registro_id = $curso_id;
							}
					
					
					if($retorno==0)
					{
						
						echo 'erro___Algo deu errado neste comando';
						exit;
					}
					else
					{
						echo 'sucesso___Excelente, seu curso foi editado com sucesso___'.$registro_id;
						exit;
					}
			}

 		
			

			//STEP 3
			if($_POST['operation']=='course_creator_add_content')
			{
				$inputCourseContentTitle	= mysqli_real_escape_string($mysqli, $_POST['inputCourseContentTitle']); 
				$inputCourseContentResume	= mysqli_real_escape_string($mysqli, $_POST['inputCourseContentResume']); 
				$course_register_content	= (int)$_POST['course_register_content']; 

 
 

				$campos=
				"
					curso_item_curso_id,
					curso_item_titulo,
					curso_item_descricao,
					curso_item_data_cadastro,
					curso_item_ativo
				";
				
					$conteudo =
					"
 						'$course_register_content',
						'$inputCourseContentTitle',
						'$inputCourseContentResume',
						'$data_cadastro',
						1
					";
				
				$crud = new crud('curso_item');
				$retorno = $crud->insert($mysqli, $campos, $conteudo);

				

					if($retorno==0)
					{
						
						echo 'erro';
						exit;
					}
					else
					{
						$registro_id = mysqli_insert_id($mysqli);
						
						if(count($_FILES["files"]['name'])>0)
						{
							$total = count($_FILES['files']['name']);

							// Loop through each file
							for($i=0; $i<$total; $i++)
							{
								//Get the temp file path
								$tmpFilePath = $_FILES['files']['tmp_name'][$i];

								//Make sure we have a filepath
								if ($tmpFilePath != "")
								{
									$file_name = 'didatica-online-'.md5((date("Y-m-d")).'-'.$_FILES['files']['name'][$i]).'-'.$_FILES['files']['name'][$i];
									//Setup our new file path
									$newFilePath = "../dist/docs/courses/".$file_name;

									//Upload the file into the temp dir
									if(move_uploaded_file($tmpFilePath, $newFilePath))
									{

										$campos=
										"
											curso_item_doc_curso_item_id,
											curso_item_doc_doc
										";
										
											$conteudo =
											"
												'$registro_id',
												'$file_name'
											";
										
										$crud = new crud('curso_item_doc');
										$retorno = $crud->insert($mysqli, $campos, $conteudo);
									}
								}
							}
						}
						
						
						echo 'sucesso';
						exit;
					}
			}

  
			//STEP 4
			if($_POST['operation']=='course_creator_add_question')
			{
				$inputCourseQuestionTitle	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionTitle']); 
				$inputCourseQuestionAnswer1	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionAnswer1']); 
				$inputCourseQuestionAnswer2	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionAnswer2']); 
				$inputCourseQuestionAnswer3	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionAnswer3']); 
				$inputCourseQuestionAnswer4	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionAnswer4']); 
				$inputCourseQuestionAnswer5	= mysqli_real_escape_string($mysqli, $_POST['inputCourseQuestionAnswer5']); 
				$course_register_content	= (int)$_POST['course_register_content']; 
				$answer_correct				= (int)$_POST['answer_correct'];

 
 

				$campos=
				"
					curso_questao_curso_id,
					curso_questao_pergunta_titulo,
					curso_questao_pergunta_resposta_1,
					curso_questao_pergunta_resposta_2,
					curso_questao_pergunta_resposta_3,
					curso_questao_pergunta_resposta_4,
					curso_questao_pergunta_resposta_5,
					curso_questao_pergunta_resposta_correta,
					curso_questao_data_cadastro
				";
				
					$conteudo =
					"
 						'$course_register_content',
						'$inputCourseQuestionTitle',
						'$inputCourseQuestionAnswer1',
						'$inputCourseQuestionAnswer2',
						'$inputCourseQuestionAnswer3',
						'$inputCourseQuestionAnswer4',
						'$inputCourseQuestionAnswer5',
						'$answer_correct',
						'$data_cadastro'
					";
				
				$crud = new crud('curso_questao');
				$retorno = $crud->insert($mysqli, $campos, $conteudo);

				$registro_id = mysqli_insert_id($mysqli);
					if($retorno==0)
					{
						
						echo 'erro___Algo deu errado neste comando';
						exit;
					}
					else
					{
						echo 'sucesso___Excelente, sua questão foi adicionado com sucesso';
						exit;
					}
			}


	}
			//STEP 2
			if( (isset($_GET['operation'])) && ($_GET['operation']=='course_creator_2') )
			{
			    if ( 0 < $_FILES['file']['error'] ) {
			        echo 0;
			        exit;
			    }
			    else {
			    	$nome_arquivo = md5($_FILES['file']['name']).'-'.$_FILES['file']['name'];

			        if(move_uploaded_file($_FILES['file']['tmp_name'], '../dist/img/courses/' . $nome_arquivo) )
			        {
			        	
						$curso_id	= (int)$_GET['course'];

						$campos=
						"
							curso_imagem = '$nome_arquivo'
						";
							 

						$crud = new crud('curso');
						$retorno = $crud->update($mysqli, $campos, "curso_id = $curso_id");
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
			        //echo 'dist/img/courses/' . $nome_arquivo;
			    }
			}

?>