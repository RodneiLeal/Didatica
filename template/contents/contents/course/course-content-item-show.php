<?php
	session_start();

	include '../../../controller/_biblio.php';
	include '../../../model/global.php';


	if(isset ($_POST['operation']))
	{

		if($_POST['operation']=='show-content')
		{
			$curso_item	= (int)$_POST['course_item'];

			$return_course_item_content = ExecData($mysqli, 'cursos','curso_conteudo_conteudo_item','*', $curso_item);
			$return_course_item_content_description = mysqli_fetch_array($return_course_item_content);

			echo $return_course_item_content_description['curso_item_descricao'];

				echo '{separate_content_files}';

	                  $return_course_item_docs = ExecData($mysqli, 'cursos','curso_conteudo_conteudo_item_docs','*', $curso_item);
	                  while ($return_course_item_docs_description = mysqli_fetch_array($return_course_item_docs))
	                  {
	                  	echo '<a href="dist/docs/courses/'.$return_course_item_docs_description['curso_item_doc_doc'].'" class="btn btn-primary btn-xs" download>Baixar Arquivo</a>';
	                  }
		}
	}
?>