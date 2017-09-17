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
