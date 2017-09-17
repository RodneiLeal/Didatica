<?php 
	extract($_REQUEST);

	switch ($p) {

		case 'user-edit':
			include "views/editProfile.php";
			break;

		case 'instructors':
			include "views/instructors.php";
			break;
			
		case 'instructors-messages':
			include "views/instructors-messages.php";
			break;
				
		case 'new-instructor':
			include "views/instructors-new.php";
			break;
				
		case 'user-messages':
			include "views/user-messages-read.php";
			break;
			
		case 'dashboard':
			include "views/content.php";
			break;

		case 'courses-list':
			include "views/courses.php";
		break;

		case 'my-courses-list':
			include "views/my-courses.php";
			break;

		case 'my-courses-add':
			include "views/my-courses-add.php";
			break;
			
		case 'my-courses-edit':
			include "views/my-courses-edit.php";
			break;
			
			
		case 'my-courses-enroll':
			include "views/my-courses-enroll.php";
			break;

		case 'my-certificates':
			include "views/my-certificates.php";
			break;



		case 'my-financial-balance':
			include "views/my-financial-balance.php";
			break;
				
		case 'course':
			include "views/course.php";
			break;
		
		
		case 'users':
			include "views/users.php";
			break;
		

		case 'adm-balance':
			include "views/adm-balance.php";
			break;

		case 'adm-withdrawal':
			include "views/adm-withdrawal.php";
			break;
			
			
		case 'adm-ratings':
			include "views/adm-ratings.php";
			break;
			
		case 'adm-config':
			include "views/adm-config.php";
			break;

		default:
			include "views/profile.php";
			break;
	}



	

	// INICIO DAS FUNÇÕES

	if($chart_load_data==1){

		include 'config/config_site.php';

		$valor_certificado = site_data($mysqli, "adm_configuracao_certificado_valor");

		//Dados grafico Total
		$retorno_acessos = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos','*', $_SESSION['usuarioID']);
		$total_acessos_query = mysqli_fetch_assoc($retorno_acessos);
		$total_acessos = $total_acessos_query['total_acessos'];
		
		$retorno_matriculas = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas','*', $_SESSION['usuarioID']);
		$total_matriculas_query = mysqli_fetch_assoc($retorno_matriculas);
		$total_matriculas = $total_matriculas_query['total_matriculas'];
			
		$retorno_certificados = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_certificados','*', $_SESSION['usuarioID']);
		$total_certificados_query = mysqli_fetch_assoc($retorno_certificados);
		$total_certificados = $total_certificados_query['total_certificados'];
		$total_certificados = $total_certificados * $valor_certificado;

		$months_total = array("1","2","3", "4", "5","6","7","8","9","10","11","12",);
		$monthvalues = array();

		foreach ($months_total as $month) {
			$monthvalues[$month] = 0;
		}
	
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos','*', $_SESSION['usuarioID']);

		while($total_acessos_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
		}
				
		$total_acessos_valores = json_encode(array_values($monthvalues));
 
				
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas','*', $_SESSION['usuarioID']);

		while($total_matriculas_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
		}
		$total_matriculas_valores = json_encode(array_values($monthvalues));
					
				
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados','*', $_SESSION['usuarioID']);

		while($total_certificados_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_certificados_query['mes_consulta']] = (int)$total_certificados_query['total_certificados'];
		}
		$total_certificados_valores = json_encode(array_values($monthvalues));
							
		//Dados grafico Total		
							
						

		//Dados Esta semana
		$retorno_acessos = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_esta_semana','*', $_SESSION['usuarioID']);
		$total_acessos_query = mysqli_fetch_assoc($retorno_acessos);
		$total_acessos_esta_semana = $total_acessos_query['total_acessos'];
		
		
		$retorno_matriculas = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_esta_semana','*', $_SESSION['usuarioID']);
		$total_matriculas_query = mysqli_fetch_assoc($retorno_matriculas);
		$total_matriculas_esta_semana = $total_matriculas_query['total_matriculas'];
		
		$retorno_certificados = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_certificados_esta_semana','*', $_SESSION['usuarioID']);
		$total_certificados_query = mysqli_fetch_assoc($retorno_certificados);
		$total_certificados = $total_certificados_query['total_certificados'];
		$total_certificados_esta_semana = $total_certificados * $valor_certificado;

		$months_total = array("1","2","3", "4", "5","6","7","8","9","10","11","12",);
		$monthvalues = array();

		foreach ($months_total as $month) {
			$monthvalues[$month] = 0;
		}
	
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos_esta_semana','*', $_SESSION['usuarioID']);
		
		while($total_acessos_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
		}

		$total_acessos_valores_esta_semana = json_encode(array_values($monthvalues));
				
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas_esta_semana','*', $_SESSION['usuarioID']);

		while($total_matriculas_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
		}

		$total_matriculas_valores_esta_semana = json_encode(array_values($monthvalues));
	
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados_esta_semana','*', $_SESSION['usuarioID']);
		
		while($total_certificados_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_certificados_query['mes_consulta']] = (int)$total_certificados_query['total_certificados'];
		}
		
		$total_certificados_valores_esta_semana = json_encode(array_values($monthvalues));
							
		//Dados Esta semana

		//ULTIMOS 30 DIAS
		$retorno_acessos = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_ultimos_30_dias','*', $_SESSION['usuarioID']);
		$total_acessos_query = mysqli_fetch_assoc($retorno_acessos);
		$total_acessos_ultimos_30_dias = $total_acessos_query['total_acessos'];
		
		$retorno_matriculas = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_ultimos_30_dias','*', $_SESSION['usuarioID']);
		$total_matriculas_query = mysqli_fetch_assoc($retorno_matriculas);
		$total_matriculas_ultimos_30_dias = $total_matriculas_query['total_matriculas'];
		
		$retorno_certificados = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_ultimos_30_dias','*', $_SESSION['usuarioID']);
		$total_certificados_query = mysqli_fetch_assoc($retorno_certificados);
		$total_certificados = $total_certificados_query['total_certificados'];
		$total_certificados_ultimos_30_dias = $total_certificados * $valor_certificado;

		$months_total = array("1","2","3", "4", "5","6","7","8","9","10","11","12",);
		$monthvalues = array();
		foreach ($months_total as $month) {
			$monthvalues[$month] = 0;
		}
	
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos_ultimos_30_dias','*', $_SESSION['usuarioID']);
		while($total_acessos_query = mysqli_fetch_assoc($retorno))
		{
			$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
		}
		$total_acessos_valores_ultimos_30_dias = json_encode(array_values($monthvalues));
		
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas_ultimos_30_dias','*', $_SESSION['usuarioID']);
		while($total_matriculas_query = mysqli_fetch_assoc($retorno))
		{
			$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
		}
		$total_matriculas_valores_ultimos_30_dias = json_encode(array_values($monthvalues));
		
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados_ultimos_30_dias','*', $_SESSION['usuarioID']);
		while($total_certificados_query = mysqli_fetch_assoc($retorno))
		{
			$monthvalues[$total_certificados_query['mes_consulta']] = (int)$total_certificados_query['total_certificados'];
		}

		$total_certificados_valores_ultimos_30_dias = json_encode(array_values($monthvalues));
							
		//ULTIMOS 30 DIAS
		
		//ULTIMOS 90 DIAS
		$retorno_acessos = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_ultimos_90_dias','*', $_SESSION['usuarioID']);
		$total_acessos_query = mysqli_fetch_assoc($retorno_acessos);
		$total_acessos_ultimos_90_dias = $total_acessos_query['total_acessos'];
		
		$retorno_matriculas = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_ultimos_90_dias','*', $_SESSION['usuarioID']);
		$total_matriculas_query = mysqli_fetch_assoc($retorno_matriculas);
		$total_matriculas_ultimos_90_dias = $total_matriculas_query['total_matriculas'];
		
		$retorno_certificados = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_resumo_total_ultimos_90_dias','*', $_SESSION['usuarioID']);
		$total_certificados_query = mysqli_fetch_assoc($retorno_certificados);
		$total_certificados = $total_certificados_query['total_certificados'];
		$total_certificados_ultimos_90_dias = $total_certificados * $valor_certificado;

		$months_total = array("1","2","3", "4", "5","6","7","8","9","10","11","12",);
		$monthvalues = array();

		foreach ($months_total as $month) {
			$monthvalues[$month] = 0;
		}

		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos_ultimos_90_dias','*', $_SESSION['usuarioID']);
		while($total_acessos_query = mysqli_fetch_assoc($retorno))
		{
			$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
		}

		$total_acessos_valores_ultimos_90_dias = json_encode(array_values($monthvalues));
				
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas_ultimos_90_dias','*', $_SESSION['usuarioID']);
		while($total_matriculas_query = mysqli_fetch_assoc($retorno)){
			$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
		}
		$total_matriculas_valores_ultimos_90_dias = json_encode(array_values($monthvalues));
	
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados_ultimos_90_dias','*', $_SESSION['usuarioID']);
		while($total_certificados_query = mysqli_fetch_assoc($retorno))
		{
			$monthvalues[$total_certificados_query['mes_consulta']] = (int)$total_certificados_query['total_certificados'];
		}
		$total_certificados_valores_ultimos_90_dias = json_encode(array_values($monthvalues));
							
		//ULTIMOS 90 DIAS

	}
?>