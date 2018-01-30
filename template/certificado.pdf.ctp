<?php

    require_once("util/dompdf/dompdf_config.inc.php");

    $html = '<!DOCTYPE html>
            <html>
                <head>
                    <link rel="stylesheet" type="text/css" href="css/certificado.pdf.css">
                    <title>Certificado - {Nome do curso}</title>
                </head>
                <body>
                    <section>
                        <div class="certificado-header">
                            <h1 class="title">certificado</h1>
                        </div>

                        <div class="certificado-body">
                            <div class="row mensagem-frente">
                                <p >A Didática Online certifica que,</p>
                                <p><span class="nomeAluno">{nome do aluno}</span></p>
                                <p>completou com sucesso o curso de <span class="dataAluno">{nome do curso}</span> com carga horaria total de <span class="dataAluno">{xx}</span> hs elaborado e aplicado por <span class="dataAluno">{nome instrutor}</span></p>
                            </div>

                            <div class="row  ass-box">
                                <div class="col pull-right">
                                    <p class="assinatura">
                                        _________________________<br><span></span>{CEO-nome}</span><br>Diretor Executivo
                                    </p>
                                </div>

                                <div class="col pull-right">
                                    <p class="assinatura">
                                        _________________________<br><span>{CET-nome}</span><br>Diretor de Treinamentos
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="certificado-footer">
                            <div class="row">
                                <p class="validacao"> Certificado #<span> {número}</span></p>
                            </div>
                        </div>

                    </section>

                    <div style="page-break-after: always;"></div>

                    <section>
                        <div class="certificado-header nomeAluno">
                            <h1 class="nomeAluno">{nome do aluno}</h1>
                        </div>

                        <div class="certificado-body">
                            <div class="row mensagem-verso">
                                <p>Este certificado tem validade para fins curriculares e em prova de titulos como um certificado de atualização, aperfeiçoamento ou extenção profissional. Não é um certificado de graduação nem certificado de habilitação técnica.
                                <br><br>
                                Conteudo programático: curso de <span>{nome do curso}</span></p>

                                <!-- repetiçãopara completar os tópicos -->
                                <div class="row topicos">
                                    <ul>
                                        <li>{lista de topicos}</li>
                                        <li>{lista de topicos}</li>
                                        <li>{lista de topicos}</li>
                                        <li>{lista de topicos}</li>
                                    </ul>
                                </div>
                                
                            </div>

                        </div>

                        <div class="certificado-footer">
                            <div class="row">
                                <p class="validacao">Este cerfificado pode ser verificado em: https://<span>{nome do site}</span></p>
                            </div>
                        </div>
                    </section>
                </body>
            </html>';

    $this->dompdf = new DOMPDF;
    $this->dompdf->load_html($html);
    $this->dompdf->set_paper('A4', 'landscape');
    $this->dompdf->render();
    $this->dompdf->stream("saida.pdf", array("Attachment" => false));    

