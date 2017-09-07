<?php

	if (!isset($_COOKIE['count_course_visit_'.$curso_id])) {
		mysqli_query($mysqli, "INSERT INTO curso_visualizacao VALUES(null, $curso_id, '".ip2long($_SERVER['REMOTE_ADDR'])."',NOW())");
	}
	setcookie('count_course_visit_'.$curso_id, 1, time()+3700);
	
	//$result = mysqli_fetch_assoc(mysqli_query('SELECT count(curso_visualizacao_id) as total_visitas FROM curso_visualizacao where curso_visualizacao_curso_id = '.$curso_id));

