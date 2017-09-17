<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<base href="./">
	<!-- <base href="http://www.didatica.online/"> -->


	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/certificado.css">

	<link rel="shortcut icon" href="/img/favicon.png">
	
	<title><?=$this->get_title()?></title>
</head>
<body>
		<!-- frente do certificado -->
	<div class="wrap">
		<section>
			<div class="row-3">
				<div class="col-1"></div>
				<div class="col-6">
					<div class="row">
						<h1 class="title">certificado</h1>
					</div>
				</div>
			</div>
			<div class="row-3">
				<div class="col-1"></div>
				<div class="col-8">
					<div class="row">
						<p>A Didática Online certifica que,</p>

						<p><span class="nomeAluno">{Nome do aluno}</span></p>

						<p>em <span class="dataAluno">{data do certificado}</span>, completou com sucesso o curso de <span class="dataAluno"></span> com carga horaria total de <span class="dataAluno">{horas de curso}</span>hs elaborado e aplicado por <span class="dataAluno">{instrutor}</span></p>
					</div>
				</div>
			</div>
			<div class="row-3">
				<div class="col-3"></div>
				<div class="col-3">
					<p class="assinatura">
						_________________________<br><span>Felipe Rodrigo</span><br>Diretor de treinamento
					</p>
				</div>
				<div class="col-3">
					<p class="assinatura">
						_________________________<br><span>Leonardo Oliveira</span><br>Diretor Executivo
					</p>
				</div>
			</div>

			<div class="row-1">
				<p class="validacao"> certificado #<span>{codgo do certificado}</span></p>
			</div>

		</section>
	</div>

		<!-- verso do certificado -->
	<div class="wrap">
		<section>
			<div class="row-2">
				<div class="col-1"></div>
				<div class="col-6">
					<div class="row">
						<h1 class="title nomeAluno">{nome do aluno}</h1>
					</div>
				</div>
			</div>
			<div class="row-7">
				<div class="col-1"></div>
				<div class="col-8">
					<div class="row">
						<p>Este certificado tem validade para fins curriculares e em prova de titulos como um certificado de atualização, aperfeiçoamento ou extenção profissional. Não é um certificado de graduação nem certificado de habilitação técnica.
					</div>
					<div class="row">
						<p>Conteudo programático: curso de <span></span>{titulo do curso}</p>

						<!-- repetiçãopara completar os tópicos -->
						<!-- <p> <i class="fa fa-check"></i> <strong ng-bind="topicos.topico"></strong></p> -->

						<p class="content_titles_course">
						{lista com todos os topicos do curso}
							<!-- ementa do curso -->
						</p>
					</div>
				</div>
			</div>
			<div class="row-1">
				<p class="validacao">Este cerfificado pode ser verificado em: https://<span>{link de validação}</span></p>
			</div>
		</section>
	</div>
</body>
</html>