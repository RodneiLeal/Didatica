</div><!-- /.content-wrapper -->
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0
	</div>
	<strong>Copyright &copy; <?=date('Y')?> <a href="http://rodneileal.com.br" target="_blank">Rodnei Leal</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->



	<!-- jQuery 3.1.1  -->
	<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>

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
	<script src="plugins/input_file/custom-file-input.js"></script>
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
	<script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="plugins/upload/jquery.filer.min.js"></script>
	<script src="plugins/upload/jquery.fileuploads.init.js"></script>

	<!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

	<!--<script src="plugins/chartjs/Chart.min.js"></script>-->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js'></script>

        <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	<!-- page script -->
	  
	<script type="text/javascript">
		
		$(document).ready(function(){

			$("#listInstructors").DataTable();
		
			//FILE UPLOAD
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

		jQuery(function ($) {
			LoadChart_Total();
		});
		
		function addData(chart, label, data) {
			chart.data.labels.push(label);
			chart.data.datasets.forEach((dataset) => {
				dataset.data.push(data);
			});
			chart.update();
		}

		function LoadChart_Total() {
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
				
		function Load_chart_values(total_acessos, total_matriculas, total_certificados) {
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

  </body>
</html>