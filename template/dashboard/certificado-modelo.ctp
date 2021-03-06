<link rel="stylesheet" type="text/css" href="css/certificado.mdl.css">

<style>
	.certificado-body{
		width: 100%;
		height: 100%;
		background:url("img/bg.png"), url('img/bg-band-model.png');
		background-repeat: no-repeat;
		background-position: center;
		background-blend-mode: multiply, normal;
		background-size: 98%;
	}
</style>
 
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Certificado</h3>

						<!-- ESTE BOTÃO ESTARÁ DISPONÍVEL SOMENTE DEPOIS DE O USUÁRIO SER APROVADO NA PROVA -->
					
						<?=$btn?>

          </div>
          <div class="box-body">
            	<!-- frente do certificado -->
							<div class="wrap">
								<section class="certificado-body">
									<div class="row-3">
										<div class="col-1"></div>
										<div class="col-6">
											<div class="row">
												<h1 class="title">certificado</h1>
											</div>
										</div>
									</div>
									<div class="row-3">
										<div class="col-1-5"></div>
										<div class="col-8">
											<div class="row">
												<p>A Didática Online certifica que,</p>

												<p><span class="nomeAluno"><?=$nome.$sobrenome?></span></p>

												<p>em <span class="dataAluno">31/02/1900</span>, completou com sucesso o curso de <span class="dataAluno">Piscologia Estérica</span> com carga horaria total de <span class="dataAluno">50</span>hs elaborado e aplicado por <span class="dataAluno">Maria Arrependida</span></p>
											</div>
										</div>
									</div>
									<div class="row-3">
										<div class="col-3"></div>
										<div class="col-3">
											<p class="assinatura">
												_________________________<br><span><?=CET?></span><br>Diretor de treinamento
											</p>
										</div>
										<div class="col-3">
											<p class="assinatura">
												_________________________<br><span><?=CEO?></span><br>Diretor Executivo
											</p>
										</div>
									</div>

									<div class="row-1">
										<p class="validacao"> certificado #<span>70707070707070</span></p>
									</div>

								</section>
							</div>
         
          </div>
        </div>
      </div>
    </div>
  </section>

	<!-- CASO A PROVA SEJA CONCLUIDA COM APROVEITAMENTO ACIMA DE DA PONTUAÇÃO CONFIGURADA 
	<div class="modal fade" role="dialog" id="congratulations">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h3 style="color: #ee8829">PARABÉNS!</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
								<p class="recuo">
									É com enorme satisfação que o parabenizamos por ter concluído este curso.
								</p>
								<p class="recuo">
									Para que possamos permanecer oferecendo materiais de qualidade como este que você acabou de utilizar e mantermos este site no ar,  precisamos de sua ajuda.
								</p>
								<p class="recuo">
									O valor monetário é de <strong>R$ <?=number_format(CERTIFICADO_VALOR, 2, ',', '.')?></strong> podendo ser em <strong><?=$parcelas='9x de R$ 5,14'?></strong> pelo PagSeguro, é respectivo a certificação do aluno(a).
								</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-default btn-xl bg-orange pull-left btn-promotion">
								<strong>
								<i class="fa fa-thumbs-up fa-2x"></i>
									&#160;&#160;Eu quero meu certificado!
								</strong>
								</button>
						</div>
						<div class="col-md-6 pull-right">
							<p>
								Grato pela atenção e colaboração.
							</p>
							<img src="img/logo.png">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->