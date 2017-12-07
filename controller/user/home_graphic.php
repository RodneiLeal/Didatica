<?php
	session_start();

	include '../_biblio.php';
	include '../../model/global.php';
	include '../../config/config_site.php';
	

	 
		
		$valor_certificado = site_data($mysqli, "adm_configuracao_certificado_valor");
		
		$retorno = ExecData($mysqli, 'usuario','consulta_usuario','*', $_SESSION['usuarioID']);
		$resultado_usuario = mysqli_fetch_assoc($retorno);
		$usuario_data_cadastro = $resultado_usuario['usuario_data_cadastro'];
		
		
		 
		
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos','*', $_SESSION['usuarioID']);
		while($total_acessos_query = mysqli_fetch_assoc($retorno))
		{

			$total_acessos[]	=$total_acessos_query['total_acessos'];
			$mes_consulta[]		=$total_acessos_query['mes_consulta'];
 		}
			
			//$label_acessos 	= json_encode($mes_consulta,true);
			//$resul_acessos 	= json_encode($total_acessos,JSON_NUMERIC_CHECK);
		//$total_acessos = $total_acessos_query['total_acessos'];
		
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas','*', $_SESSION['usuarioID']);
		$total_matriculas_query = mysqli_fetch_assoc($retorno);
		$total_matriculas = $total_matriculas_query['total_matriculas'];
		
		$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados','*', $_SESSION['usuarioID']);
		$total_certificados_query = mysqli_fetch_assoc($retorno);
		$total_certificados = $total_certificados_query['total_certificados'];
		$total_certificados = $total_certificados * $valor_certificado;
		

			
			
			
$months = array("3", "4", "5");
$monthvalues = array();
foreach ($months as $month) {
    $monthvalues[$month] = 0;
}


$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_acessos','*', $_SESSION['usuarioID']);
while($total_acessos_query = mysqli_fetch_assoc($retorno))
{
    $monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
}
 



//echo json_encode($months);
//echo '_____';
//echo json_encode(array_values($monthvalues));

		$arrLabels = array("January","February","March");
		$arrDatasets = array(
			array(
				'label' => "My First dataset",
				'fillColor' => "rgba(220,220,220,0.2)",
				'strokeColor' => "rgba(220,220,220,1)",
				'pointColor' => "rgba(220,220,220,1)",
				'pointStrokeColor' => "#fff",
				'pointHighlightFill' => "#fff",
				'pointHighlightStroke' => "rgba(220,220,220,1)",
				'data' => array(28, 48, 40)
			),
				array(
					'label' => "My Sec dataset",
					'fillColor' => "rgba(220,220,220,0.2)",
					'strokeColor' => "rgba(220,220,220,1)",
					'pointColor' => "rgba(220,220,220,1)",
					'pointStrokeColor' => "#fff",
					'pointHighlightFill' => "#fff",
					'pointHighlightStroke' => "rgba(220,220,220,1)",
					'data' => array(78, 18, 80)
				),
				
					array(
						'label' => "My Sec dataset",
						'fillColor' => "rgba(220,220,220,0.2)",
						'strokeColor' => "rgba(220,220,220,1)",
						'pointColor' => "rgba(220,220,220,1)",
						'pointStrokeColor' => "#fff",
						'pointHighlightFill' => "#fff",
						'pointHighlightStroke' => "rgba(220,220,220,1)",
						'data' => array(28, 68, 20)
					)
		);
		 
		$arrReturn = array('labels' => $arrLabels, 'datasets' => $arrDatasets);

		print (json_encode($arrReturn));

exit;
echo 
'		
	{
		label: "Acessos",
		fillColor: "rgba(210, 214, 222, 0)",
		strokeColor: "#00a65a",
		pointColor: "#00a65a",
		pointStrokeColor: "#00a65a",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "#00a65a",
		data: '.json_encode(array_values($monthvalues)).'
	},
	{
		label: "Matrículas",
		fillColor: "rgba(60,141,188,0)",
		strokeColor: "#f39c12",
		pointColor: "#f39c12",
		pointStrokeColor: "#f39c12",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "#f39c12",
		data: [28, 48, 40]
	},
	{
		label: "Faturamento",
		fillColor: "rgba(222,141,188,0)",
		strokeColor: "#dd4b39",
		pointColor: "#dd4b39",
		pointStrokeColor: "#dd4b39",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "#dd4b39",
		data: [28, 38, 65]
	}
';
			
			
			
			
			
			
			//print (json_encode($arrReturn));
	 