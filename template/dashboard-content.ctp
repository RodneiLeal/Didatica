<?php
    $p = NULL;
    extract($_GET);

    switch ($p) {

        // PERFIL DO USUARIO
        case 'editar-perfil':
            $bancos = Main::getBancos();
            include_once ROOT."template/dashboard-contents/editar-perfil.ctp";
        break;

        case 'minhas-inscricoes':
            $minhasInscricoes = $this->inscricoes->getInscricaoPorUsuario($idusuario);
            include_once ROOT."template/dashboard-contents/minhas-inscricoes.ctp";
        break;

        // CERTIFICADO
        case 'certificado-model':
        case 'certificado':
            
            include_once ROOT."template/dashboard-contents/certificado-model.ctp";
        break;
        
        // CURSOS 
        case 'novo-curso':
            $categorias = $this->cursos->getCategorias();
            include_once ROOT."template/dashboard-contents/novo-curso.ctp";
        break;

        case 'meus-cursos':
            $instrutor = $this->instrutor->getInstrutor($idusuario)[0];
            $meusCursos = $this->cursos->getCursosInstrutor($instrutor['idinstrutor']);
            include_once ROOT."template/dashboard-contents/meus-cursos.ctp";
        break;

        case 'curso':
            $inscr          = $this->inscricoes->getInscricaoId($_REQUEST['inscr'])[0];
            $curso          = $this->cursos->getCursoId($inscr['idcurso'])[0];
            $instrutor_foto = empty($curso['instrutor_foto'])?'img/users/sem-foto.png':$curso['instrutor_foto'];
            $style          = empty($curso['imagem'])?NULL:"style=\"background:url('{$curso['imagem']}')\"";
            $aulas          = $this->cursos->getAulas($curso['idcurso']);
            $media          = number_format($curso['media'],2, '.', ' ');
            $provas         = $this->cursos->getProvas($inscr['idinscricao']);

            if(empty($provas) || !($provas[count($provas)-1]['nota'] >= NOTACORTE)){
                $btn = 
                '
                <div class="box-body course_box text-center">
                <a href="Dashboard?p=prova&inscr='.$_REQUEST['inscr'].'" class="btn btn-success course_get_question" course="{id do curso}" >
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> Responder Prova
                </a>
                </div>
                ';

            }else{

                switch(0){// STATUS_PGTO
                    
                    // se status do pagamento for igual a 1 ou 2, então exibe mensagem de 'aguardando pagamento'
                    case 1:
                    case 2:
                        $btn = 
                        '
                        <div class="box-body course_box text-center">
                            <div class="alert alert-info" role="alert">
                            <strong>Aguardando confirmação de pagamento</strong>
                            </div>
                        </div>
                        ';
                    break;

                    // se status do pagamento for igual a 3 ou 4, então botão 'Download do Certificado' estará disponível
                    case 3:
                    case 4:
                        $btn = 
                        '
                        <div class="box-body course_box text-center">
                        <button type="button" class="btn btn-success print_certificate" course="{id do curso}">
                            <i class="fa fa-id-card-o" aria-hidden="true"></i>Download do Certificado
                        </button>
                        </div>
                        ';
                    break;
                    
                    // em qualquer outro caso o botão 'Solicitar Certificado' estará disponível
                    default:
                        $btn = 
                        ' 
                        <div class="box-body course_box text-center">
                        <button type="button" class="btn btn-success" data-insc="{idinscricao}">
                            <i class="fa fa-id-card-o" aria-hidden="true"></i> Solicitar Certificado
                        </button>
                        </div>
                        ';
                }
            }
            include_once ROOT."template/dashboard-contents/curso.ctp";
            
        break;
        
        case 'prova':
            $inscr              = $this->inscricoes->getInscricaoId($_REQUEST['inscr'])[0];
            $curso              = $this->cursos->getCursoId($inscr['idcurso'])[0];
            $instrutor_foto     = empty($curso['instrutor_foto'])?'img/users/sem-foto.png':$curso['instrutor_foto'];
            $style              = empty($curso['imagem'])?NULL:"style=\"background:url('{$curso['imagem']}')\"";
            $media              = number_format($curso['media'], 2, '.', ' ');
            $questoes           = $this->cursos->getQuestoes($inscr['idcurso']);
            
            include_once ROOT."template/dashboard-contents/prova.ctp";
        break;

        default:
            if($tipo){
                $publicacoes = count($this->cursos->getCursosInstrutor($idinstrutor));
                $inscritos   = count($this->inscricoes->getInscricaoPorinstrutor($idinstrutor));
            }
            include_once ROOT."template/dashboard-contents/perfil.ctp";
        
    }