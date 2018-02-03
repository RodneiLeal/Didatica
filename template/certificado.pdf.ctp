<?php

    $html =
    "
    <!DOCTYPE html>
        <html>
            <head>
                <link rel=\"stylesheet\" type=\"text/css\" href=\"css/certificado.pdf.css\">
                <title>Certificado - $titulo</title>
            </head>
            <body>
                <section>
                    <div class=\"certificado-header\">
                        <h1 class=\"title\">certificado</h1>
                    </div>
                    <div class=\"certificado-body\">
                        <div class=\"row mensagem-frente\">
                            <p >A Didática Online certifica que,</p>
                            <p><span class=\"nomeAluno\">$usuario</span></p>
                            <p>completou com sucesso o curso de <span class=\"dataAluno\">$titulo</span> com carga horaria total de <span class=\"dataAluno\">$tempo</span> hs elaborado e aplicado por <span class=\"dataAluno\">$instrutor</span></p>
                        </div>

                        <div class=\"row  ass-box\">
                            <div class=\"col pull-right\">
                                <p class=\"assinatura\">
                                    _________________________<br><span></span>".CEO."</span><br>Diretor Executivo
                                </p>
                            </div>

                            <div class=\"col pull-right\">
                                <p class=\"assinatura\">
                                    _________________________<br><span>".CET."</span><br>Diretor de Treinamentos
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class=\"certificado-footer\">
                        <div class=\"row\">
                            <p class=\"validacao\"> Certificado #<span> $codigo</span></p>
                        </div>
                    </div>

                </section>

                <div style=\"page-break-after: always;\"></div>

                <section>
                    <div class=\"certificado-header nomeAluno\">
                        <h1 class=\"nomeAluno\">$usuario</h1>
                    </div>

                    <div class=\"certificado-body\">
                        <div class=\"row mensagem-verso\">
                            <p>Este certificado tem validade para fins curriculares e em prova de titulos como um certificado de atualização, aperfeiçoamento ou extenção profissional. Não é um certificado de graduação nem certificado de habilitação técnica.
                            <br><br>
                            Conteudo programático: curso de <span>$titulo</span></p>

                            <div class=\"row topicos\">
                                $ementa
                            </div>
                            
                        </div>
                    </div>

                    <div class=\"certificado-footer\">
                        <div class=\"row\">
                            <p class=\"validacao\">Este cerfificado pode ser verificado em: https://<span>didatica.online/valida_certificado</span></p>
                        </div>
                    </div>
                </section>
            </body>
        </html>
    ";
    

