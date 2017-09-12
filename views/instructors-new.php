  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Novo Instrutor</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
			<div class="box-body">
				<?php
					include 'views/_terms.php';
				?>
				
				<div id="instructor_terms_resume" >
					<?php
						include 'views/_terms.php';
						
						$max = 200;
						echo substr_replace($termos_de_uso, (strlen($termos_de_uso) > $max ? '...' : ''), $max);
					?>
						<br>
						<a href="javascript:void()" onclick="$('#instructor_terms_resume').fadeOut(300); $('#instructor_terms').fadeIn(500); ">Ler mais...</a>
						
					
				</div>
				<div id="instructor_terms" style="display:none">
					<?php echo $termos_de_uso;?>
					<BR><BR>
					<a href="javascript:void()" onclick="$('#instructor_terms').fadeOut(500);$('#instructor_terms_resume').fadeIn(500)" >Ler menos</a>
				</div>
				
				
				<hr>
                    <div class="form-group">


					<?php
						$all_user = ExecData($mysqli, 'usuario','consulta_usuario_verifica_se_instrutor','*', $_SESSION['usuarioID']);
						$usuario_solicitacao = mysqli_fetch_assoc($all_user);

						if(empty($usuario_solicitacao['usuario_instrutor_solicitacao_id']))
						{
							echo 
							"
			                    <div class='checkbox'>
			                      <label>
			                        <input type='checkbox'  onchange='document.getElementById(\"instructor_new_bt\").disabled = !this.checked;'> Eu aceito os termos e condições
			                      </label>
			                    </div>
								  <div class='instructor_new_action'>
									<button type='button' disabled id='instructor_new_bt' class='btn btn-danger'>Tornar-se um Instrutor</button>
								  </div>
							";
						}
						else
						{
							echo 
							'
								  <div class="instructor_new_action_wait">
									<button type="button" disabled id="" class="btn btn-warning ">Aguardando aprovação de solicitação</button>
								  </div>
							';
						}
					?>
                      <div class="instructor_new_load"></div>
                    </div>		
			</div>
		</div>
	  </div>
	</div>
  </section>
