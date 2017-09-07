<?php 
	session_start();
	include "config.php";
	include "views/headers.php";
	include "views/header-nav.php";
	include "views/side-nav-menu.php";
	include "views/side-nav.php";
	include "controller/_salva_usuario_online.php";
	
	include "config/config_site.php";

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


        include "views/footer.php";
        include "views/control.php";
      ?>


    </div><!-- ./wrapper -->

	

			<!-- jQuery 3.1.1 
			<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
			-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
			
			<!-- Bootstrap 3.3.5 -->
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<!-- FastClick -->
			<script src="plugins/fastclick/fastclick.min.js"></script>
			<!-- AdminLTE App -->
			<script src="dist/js/app.min.js"></script>
			<!-- Sparkline -->
			<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
			
			<!-- jvectormap -->
			<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
			<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
			<!-- SlimScroll 1.3.0 -->
			<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
			
			<!-- ChartJS 1.0.1 -->
			

			<!--<script src="plugins/star-rating.js"></script>-->
			
			<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>


			<!-- AdminLTE dashboard demo (This is only for demo purposes)  
			<script src="dist/js/pages/dashboard.js"></script>-->


			<!--- Custom Components -->
			<script src="plugins/jquery.validate/jquery.validate.js"></script>
			<script src="plugins/notification/toastr.min.js"></script>
			<script src="dist/functions.js"></script>

			<!-- upload -->
			<script src="dist/js/droply.js"></script>
			<script src="dist/js/modernizr.js"></script>

			<script src="plugins/select2/select2.full.min.js"></script>

			<link rel="stylesheet" type="text/css" href="plugins/input_file/component.css" />
			<script src="plugins/input_file/custom-file-input.js"></script>
			<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>



			<script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
			<script src="plugins/input-mask/jquery.inputmask.js"></script>
			<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
			<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
			
			<script src="plugins/upload/jquery.filer.min.js"></script>
			<script src="plugins/upload/jquery.fileuploads.init.js"></script>

			<script type="text/javascript">
			  $(function () {

				//Initialize Select2 Elements
				$(".select2").select2();
				$("#courselistcontentquestion").html("<img src='dist/img/loader.gif'>");

				setTimeout(function(){
					load_content_data("courselistcontent","views/content/course/course-content-item-show-edit.php?course="+<?php echo (int)$_GET['course'];?>);
					load_content_data("courselistcontentquestion","views/content/course/course-question-item-show-edit.php?course="+<?php echo (int)$_GET['course'];?>);
				}, 2000);
				
			  });
			  
			$(document).ready(function(){
				$(".time").inputmask("h:s",{ "placeholder": "hh/mm" });
			});
			

			$(function () {
				$(".user_star").each( function() {
					var current_rating = $(this).attr("rating");
					$(this).parent().rateYo({
						starWidth: "15px",
						halfStar: true,
						rating: current_rating
					});
				});

				$(".user_star_rating_course").rateYo({starWidth: "25px", rating: 0, fullStar: true})
				.on("rateyo.set", function (e, data) {
					//alert("The rating is set to " + data.rating + "!");
					document.getElementById("FormEnrollRate_nota").value=data.rating;
				});
			});

					
					function mascara(o,f){
						v_obj=o
						v_fun=f
						setTimeout("execmascara()",1)
					}
						function execmascara(){
							v_obj.value=v_fun(v_obj.value)
						}
						function mvalor(v){
							v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
							v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
							v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares

							v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
							return v;
						}
						
						
						//FILE UPLOAD
							$(document).ready(function(){
 
								//Example 2
								$('#file_input_files').filer({
									limit: null,
									maxSize: null,
									extensions: null,
									changeInput: '<a class="jFiler-input-choose-btn blue">Selecionar Arquivo</a>',
									showThumbs: true,
									theme: "dragdropbox",
									dragDrop: {
										dragEnter: null,
										dragLeave: null,
										drop: null
									}
								});


							});
						
						//FILE UPLOAD
			</script>
			 
  </body>
</html>






<!-- FIM HTML -->











<!-- INICIO DAS FUNÇÕES -->

<?php
	if($chart_load_data==1)
	{
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
				while($total_acessos_query = mysqli_fetch_assoc($retorno))
				{
					$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
				}
				$total_acessos_valores = json_encode(array_values($monthvalues));
 
				
					$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas','*', $_SESSION['usuarioID']);
					while($total_matriculas_query = mysqli_fetch_assoc($retorno))
					{
						$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
					}
					$total_matriculas_valores = json_encode(array_values($monthvalues));
					
				
						$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados','*', $_SESSION['usuarioID']);
						while($total_certificados_query = mysqli_fetch_assoc($retorno))
						{
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
				while($total_acessos_query = mysqli_fetch_assoc($retorno))
				{
					$monthvalues[$total_acessos_query['mes_consulta']] = (int)$total_acessos_query['total_acessos'];
				}
				$total_acessos_valores_esta_semana = json_encode(array_values($monthvalues));
 
				
					$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_matriculas_esta_semana','*', $_SESSION['usuarioID']);
					while($total_matriculas_query = mysqli_fetch_assoc($retorno))
					{
						$monthvalues[$total_matriculas_query['mes_consulta']] = (int)$total_matriculas_query['total_matriculas'];
					}
					$total_matriculas_valores_esta_semana = json_encode(array_values($monthvalues));
					
				
						$retorno = ExecData($mysqli, 'sistema','dashboard_dados_rapidos_graficos_intrutor_total_certificados_esta_semana','*', $_SESSION['usuarioID']);
						while($total_certificados_query = mysqli_fetch_assoc($retorno))
						{
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
					while($total_matriculas_query = mysqli_fetch_assoc($retorno))
					{
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

?>
			<!--<script src="plugins/chartjs/Chart.min.js"></script>-->
			<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js'></script>
			<script>
					jQuery(function ($) 
					{
						LoadChart_Total();
					});
					
						function addData(chart, label, data) {
							chart.data.labels.push(label);
							chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
							});
							chart.update();
						}


						function LoadChart_Total()
						{
							Load_chart_values(<?php echo $total_acessos;?>, <?php echo $total_matriculas;?>, <?php echo $total_certificados;?>);

							var ctx = document.getElementById("salesChart");
							var myChart = new Chart(ctx, {
								type: 'line',
								data: {
									labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
									datasets: [
										{
											label: "Acessos",
											data: <?php echo $total_acessos_valores;?>,
												backgroundColor: [
												  "rgb(0,166,90, 0.5)"
												]
 										},
										{
											label: "Matrículas",
											data: <?php echo $total_matriculas_valores;?>,
												backgroundColor: [
												  "rgb(243,156,18, 0.5)"
												]
										},
										{
											label: "Faturamento",
											data: <?php echo $total_certificados_valores;?>,
												backgroundColor: [
												  "rgb(189,6,13, 0.5)"
												]
										}									
									]
								},
								options: {
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero:true
											}
										}]
									}
								}
							});
						}
						
						
						
							function LoadChart_Ultimos_7_dias()
							{
								Load_chart_values(<?php echo $total_acessos_esta_semana;?>, <?php echo $total_matriculas_esta_semana;?>, <?php echo $total_certificados_esta_semana;?>);

								var ctx = document.getElementById("salesChart");
								var myChart = new Chart(ctx, {
									type: 'line',
									data: {
										labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
										datasets: [
											{
												label: "Acessos",
												data: <?php echo $total_acessos_valores_esta_semana;?>,
													backgroundColor: [
													  "rgb(0,166,90, 0.5)"
													]
											},
											{
												label: "Matrículas",
												data: <?php echo $total_matriculas_valores_esta_semana;?>,
													backgroundColor: [
													  "rgb(243,156,18, 0.5)"
													]
											},
											{
												label: "Faturamento",
												data: <?php echo $total_certificados_valores_esta_semana;?>,
													backgroundColor: [
													  "rgb(189,6,13, 0.5)"
													]
											}									
										]
									},
									options: {
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero:true
												}
											}]
										}
									}
								});
							}
						
						
						
						
						
						
							function LoadChart_Ultimos_30_dias()
							{
								Load_chart_values(<?php echo $total_acessos_ultimos_30_dias;?>, <?php echo $total_matriculas_ultimos_30_dias;?>, <?php echo $total_certificados_ultimos_30_dias;?>);

								var ctx = document.getElementById("salesChart");
								var myChart = new Chart(ctx, {
									type: 'line',
									data: {
										labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
										datasets: [
											{
												label: "Acessos",
												data: <?php echo $total_acessos_valores_ultimos_30_dias;?>,
													backgroundColor: [
													  "rgb(0,166,90, 0.5)"
													]
											},
											{
												label: "Matrículas",
												data: <?php echo $total_matriculas_valores_ultimos_30_dias;?>,
													backgroundColor: [
													  "rgb(243,156,18, 0.5)"
													]
											},
											{
												label: "Faturamento",
												data: <?php echo $total_certificados_valores_ultimos_30_dias;?>,
													backgroundColor: [
													  "rgb(189,6,13, 0.5)"
													]
											}									
										]
									},
									options: {
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero:true
												}
											}]
										}
									}
								});
							}
						
						
						
						
							function LoadChart_Ultimos_90_dias()
							{
								Load_chart_values(<?php echo $total_acessos_ultimos_90_dias;?>, <?php echo $total_matriculas_ultimos_90_dias;?>, <?php echo $total_certificados_ultimos_90_dias;?>);

								var ctx = document.getElementById("salesChart");
								var myChart = new Chart(ctx, {
									type: 'line',
									data: {
										labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
										datasets: [
											{
												label: "Acessos",
												data: <?php echo $total_acessos_valores_ultimos_90_dias;?>,
													backgroundColor: [
													  "rgb(0,166,90, 0.5)"
													]
											},
											{
												label: "Matrículas",
												data: <?php echo $total_matriculas_valores_ultimos_90_dias;?>,
													backgroundColor: [
													  "rgb(243,156,18, 0.5)"
													]
											},
											{
												label: "Faturamento",
												data: <?php echo $total_certificados_valores_ultimos_90_dias;?>,
													backgroundColor: [
													  "rgb(189,6,13, 0.5)"
													]
											}									
										]
									},
									options: {
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero:true
												}
											}]
										}
									}
								});
							}
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
							function Load_chart_values(total_acessos, total_matriculas, total_certificados)
							{
								var img_load = 'loader_small.gif';
								$("#dashboard_chart_load_value_total-access").html("<img src='dist/img/"+img_load+"'>");
								$("#dashboard_chart_load_value_total-enroll").html("<img src='dist/img/"+img_load+"'>");
								$("#dashboard_chart_load_value_total-money").html("<img src='dist/img/"+img_load+"'>");
								
								setTimeout(function(){ 
									$("#dashboard_chart_load_value_total-access").html(total_acessos);
									$("#dashboard_chart_load_value_total-enroll").html(total_matriculas);
									$("#dashboard_chart_load_value_total-money").html('R$ '+total_certificados);
								}, 2000);

							}
							
							
			</script>

<?php
	}
?>
 