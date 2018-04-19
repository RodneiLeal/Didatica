<?php

	class Dashboard extends Main implements interfaceController{

		private $action,
				$parameters,
				$instrutor,
				$cursos,
				$inscricoes,
				$admin;

		function __construct(){
			parent::__construct();

			$get = func_num_args()>=1? func_get_args():array();
			$this->action 	  	= $get[0];
			$this->parameters 	= $get[1];
			$this->title	  	= SYS_NAME." - Dashboard";
			$this->instrutor  	= new Instructor;
			$this->cursos     	= new CursoModel;
			$this->inscricoes 	= new Inscricao;
			$this->admin 	  	= new Admin;

			session_start();
			if(empty($_SESSION)){
				header('location: '.HOME_URI);
			}
		}

		public function index(){
			extract($_SESSION);
			$foto = empty($foto)?"img/users/sem-foto.png":$foto;
			$action =  empty($this->action)?'home':$this->action;
			$action = str_replace(' ', '_', $action);
			include_once ROOT."template/dashboard-header.ctp";
			self::$action($this->parameters);
			include_once ROOT."template/dashboard-footer.ctp";
		}

		private function editar_perfil(){
            extract($_SESSION);
			$instrutor = $this->instrutor->getInstrutor($idusuario)[0];
            @extract($instrutor);
            
			$bancos = Main::getBancos();
            include_once ROOT."template/dashboard-contents/editar-perfil.ctp";
		}

		private function inscricoes(){
			extract($_SESSION);
			$minhasInscricoes = $this->inscricoes->getInscricaoPorUsuario($idusuario);
            include_once ROOT."template/dashboard-contents/minhas-inscricoes.ctp";
        }
        
		private function meus_cursos(){
			extract($_SESSION);
			$instrutor = $this->instrutor->getInstrutor($idusuario)[0];
            $meusCursos = $this->cursos->getCursosInstrutor($instrutor['idinstrutor']);
			include_once ROOT."template/dashboard-contents/meus-cursos.ctp";
		}

		private function inscricao($inscricao){
			$inscr          = $this->inscricoes->getInscricaoId($inscricao[0])[0];
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
                <a href="Dashboard/prova/'.$inscricao[0].'" class="btn btn-success course_get_question" course="{id do curso}" >
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> Responder Prova
                </a>
                </div>
                ';

            }else{
                $status = $this->admin->buscaTransacaoInscr($inscr['idinscricao'])[0];
                
                switch($status['status']){// STATUS_PGTO
                    
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
                            <form action="certificado" method="POST" target="_blanc">
                                <input type="hidden" name="inscr" value="'.$inscr['idinscricao'].'">
                                <input type="hidden" name="curso" value="'.$inscr['idcurso'].'">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i> Download do Certificado
                                </button>
                            </form>
                        </div>
                        ';
                    break;
                    
                    // em qualquer outro caso o botão 'Solicitar Certificado' estará disponível
                    default:
                        $btn = 
                        ' 
                        <div class="box-body course_box text-center">
                            <button type="button" class="btn btn-success solicitar-certificado">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i> Solicitar Certificado
                            </button>
                        </div>
                        ';
                }
            }
            include_once ROOT."template/dashboard-contents/curso.ctp";

        }
        
        private function novo_curso($param){
            $categorias = $this->cursos->getCategorias();
            $select = "<select class=\"\" placeholder=\"Categorias\" name=\"curso[categoria]\">";
            foreach($categorias as $categoria):
                $select .= "<option value=\"".$categoria['idcategoria']."\">".$categoria['categoria']."</option>";
            endforeach;
            $select .= "</select>";

            include_once ROOT."template/dashboard-contents/novo-curso.ctp";
            // self::curso($param);
		}

		private function curso($param){
            
            switch (@$param[1]) {
                
                case 'Grade do curso':
                    $doc = null;
                    $aulas = $this->cursos->getAulas($param[0])[0];

                    if (!empty($aulas['arquivo'])) {
                        $doc =  
                        "
                        <div class=\"row form-row\">
                            <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                <label>Arquivo de aula atual</label>
                                <iframe class=\"preview-file\" src=\"".$aulas['arquivo']."\" frameborder=\"0\" ></iframe>
                            </div>
                        </div>
                        ";
                    }

                    $sessao = 
                    "
                    <!-- formulario de dados do curso -->
                    <form action=\"controllers/curso/salvarAula.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"aula\">
                        <input type=\"hidden\" name=\"aula[idaula]\" value=\"".$aulas['idaula']."\">
                        <input type=\"hidden\" name=\"curso[idcurso]\" value=\"".$param[0]."\">
                        <div class=\"form-header with-border-bottom\">
                            <h3 class=\"form-title\">Grade do Curso</h3>
                            <button name=\"salvaraula\" class=\"form-btn\">Salvar e continuar</button>
                        </div>
                            
                        <div class=\"form-container\">
                            
                            <div class=\"box-group\">
                                <!-- template para os paineis de aula -->
                                <div class=\"box box-primary panel\">
                                    <div class=\"box-header\">
                                        <h4 class=\"box-title\">
                                        <a href=\"#aula-1\" data-parent=\"#accordion\" data-toggle=\"collapse\" aria-expanded=\"false\">Aula 1</a>
                                        </h4>
                                    </div>
                                    <div class=\"collapse in panel-collapse\" aria-expanded=\"true\" id=\"aula-1\">
                                        <div class=\"box-body form-container\">

                                            <div class=\"row form-row\">
                                                <div class=\"col-md-12\">
                                                    <div class=\"input-container input-box form-control\">
                                                        <input class=\"form-control\" name=\"aula[titulo]\"  placeholder=\"Titulo da Aula\" maxlength=\"50\" value=\"".$aulas['titulo']."\">
                                                        <span class=\"input-counter\"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class=\"row form-row\">
                                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                    <label>Objetivos</label>
                                                    <textarea class=\"editor\" name=\"aula[objetivos]\" id=\"editor3\"  palceholder=\"Descreva aqui os objetivos do seu curso\">".$aulas['objetivos']."</textarea>
                                                </div>
                                            </div>
                                            $doc
                                            <div class=\"row form-row\">
                                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                    <label>Selecionar arquivo</label>
                                                    <input type=\"file\" name=\"aula[arquivo]\">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class=\"form-header\">
                            <h3 class=\"form-title\"></h3>
                            <button name=\"salvaraula\" class=\"form-btn\">Salvar e continuar</button>
                        </div>
                    </form>
                    ";
                break;

                case 'Banco de questões':
                    $questoes = $this->cursos->getQuestoes($param[0]);



                    $sessao = 
                    '
                        <!-- formulario de dados do curso -->
                        <form action="" method="POST" enctype="multipart/form-data" id="questoes">
                
                            <div class="form-header with-border-bottom">
                                <h3 class="form-title">Banco de questões</h3>
                                <button name="salvarquestoes" class="form-btn">Salvar e continuar</button>
                            </div>

                            <div class="form-container">
                                <!-- template para questionario -->
                                <div class="box box-primary panel template">
                                    <div class="box-header">
                                        <h4 class="box-title">
                                        <a href="#panel-1" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">Questão 1</a>
                                        </h4>
                                        <div class="box-tools pull-left">
                                            <a class="btn btn-box-tool remove-ask"><i class="fa fa-trash fa-2x"></i></a>
                                        </div>
                                    </div>

                                    <div class="collapse in panel-collapse" aria-expanded="false" id="panel-1">

                                        <div class="box-body">

                                        <div class="row">
                                            <div class="col-md-12">
                                            <label>Questão</label>
                                            <input type="text" class="form-control" name="provas[1][questao]" placeholder="Questão">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                            <label>Opções</label>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <input type="radio" value="1" name="provas[1][resposta]">
                                                </span>
                                                <input class="form-control" name="provas[1][opcao_1]" type="text" placeholder="Resposta">
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <input type="radio" value="2" name="provas[1][resposta]">
                                                </span>
                                                <input class="form-control" name="provas[1][opcao_2]" type="text" placeholder="Resposta">
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <input type="radio" value="3" name="provas[1][resposta]">
                                                </span>
                                                <input class="form-control" name="provas[1][opcao_3]" type="text" placeholder="Resposta">
                                            </div>
                                            </div>

                                            <div class="col-md-6">
                                            <label>Opções</label>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <input type="radio" value="4" name="provas[1][resposta]">
                                                </span>
                                                <input class="form-control" name="provas[1][opcao_4]" type="text" placeholder="Resposta">
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <input type="radio" value="5" name="provas[1][resposta]">
                                                </span>
                                                <input class="form-control" name="provas[1][opcao_5]" type="text" placeholder="Resposta">
                                            </div>

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                
                            <div class="form-header">
                                <h3 class="form-title"></h3>
                                <button name="save" class="form-btn">Salvar e continuar</button>
                            </div>
                        </form>
                    ';
                break;

                case 'Configurações':
                    $sessao = 
                    '
                        <h3>Configurações</h3>
                    ';
                break;
                
                default:
                    $categorias = $this->cursos->getCategorias();
                    $curso = $this->cursos->getCursoId($param[0])[0];
                    $select = "<select class=\"\" placeholder=\"Categorias\" name=\"curso[categoria]\">";
                    foreach($categorias as $categoria):
                        $selected = $categoria['idcategoria']==$curso['categoria_idcategoria']?'selected':'';
                        $select .= "<option ".$selected." value=\"".$categoria['idcategoria']."\">".$categoria['categoria']."</option>";
                    endforeach;
                    $select .= "</select>";
                    
                    $disabled = !empty($curso['titulo'])?'disabled':'';
                    $imagem = empty($curso['imagem'])?"img/curso/select-image.png":$curso['imagem'];

                    $sessao = 
                    "
                        <!-- formulario de dados do curso -->
                        <form action=\"controllers/curso/salvarCurso.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"curso\">
                            <input type=\"hidden\" name=\"curso[idcurso]\" value=\"".$param[0]."\">
                            <div class=\"form-header with-border-bottom\">
                                <h3 class=\"form-title\">Página inicial do curso</h3>
                                <button name=\"salvarcurso\" class=\"form-btn\">Salvar e continuar</button>
                            </div>
                                
                            <div class=\"form-container\">
                                <div class=\"row form-row\">
                                    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                        <p class=\"form-text\">
                                        Estas serão as primeiras informações que os usuários verão quando encontrarem o seu curso e influenciarão muito na decisão de inscrição e no final na compra do certificado, portanto seja criativo e preencha todos os campos solicitados.
                                        </p>
                                    </div>
                                </div>
                
                                <div class=\"row form-row\">
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <label >Titulo do curso</label>
                                        <div class=\"input-container input-box form-control\">


                                        <input type=\"text\" placeholder=\"ex.: Design de produtos com Ilustrator\" maxlength=\"40\" name=\"curso[titulo]\" value=\"".$curso['titulo']."\" $disabled>

                                        
                                        <span class=\"input-counter\"></span>
                                        </div>
                                    </div>
                                    
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <label>Categoria do curso</label>
                                        <div class=\"form-control input-box\">

                                            $select                             
                    
                                        </div>
                                    </div>
                                </div>
                
                                <div class=\"row form-row\">
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <label>Descrição do curso<span class=\"label-desc\"></span></label>
                                        <textarea class=\"form-control editor\" maxlength=\"255\" name=\"curso[resumo]\" id=\"editor1\" placeholder=\"Resumo simples\">".$curso['resumo']."</textarea>
                                    </div>
                                    
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <p class=\"form-text\">
                                        Faça uma breve descrição do seu curso. Está é a chance que você tem de dizer ao usuário porque o seu curso é tão relevante e o que ele irá aprender  
                                        </p>
                                    </div>
                                </div>
                                
                                <div class=\"row form-row\">
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <label>Ementa <span class=\"label-desc\">(Tópicos do curso)</span></label>
                                        <textarea class=\"form-control editor\" name=\"curso[ementa]\" id=\"editor2\" maxlength=\"255\">".$curso['ementa']."</textarea>
                                    </div>
                                
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                    <p class=\"form-text\">
                                        Faça um lista de tópicos do seu curso, isto guiará os seus alunos pelo curso. Esta lista também será impressa no verso do certificado, indicando o que o aluno aprendeu e desenvouveu durante o curso.
                                    </p>
                                    </div>
                                </div>
                                
                                <div class=\"row form-row\">
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <label>Imagem do curso</label>
                                        <div class=\"avatar-view\" title=\"selecione uma imagem que melhor representa o seu curso\">
                                            <input type=\"hidden\" class=\"data-image\" name=\"curso[imagem]\">
                                            <img class=\"img-responsive\" src=\"$imagem\" style=\"max-height: 400px\"/>
                                        </div>
                                    </div>
                                    <div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">
                                        <p class=\"form-text\">
                                            Uma imagem vale mais que mil palavras, dizia o filósofo chinês Confúcio. Pensando nisso,  escolha uma imagem que melhor represente o seu curso. Lembre-se de que muitos usuários são mais visuais, portanto fazem suas escolhas baseadas em imagens e no sentimento que estas dispertam e no que elas represemtam.
                                        </p>
                                    </div>
                                </div>
                            </div>
                
                            <div class=\"form-header\">
                                <h3 class=\"form-title\"></h3>
                                <button name=\"salvarcurso\" class=\"form-btn\">Salvar e continuar</button>
                            </div>
                        </form>
                    ";
                break;
            }
            
            include_once ROOT."template/dashboard-contents/gerenciar-curso.ctp";
		}

		private function home(){
			extract($_SESSION);
			$foto = empty($foto)?"img/users/sem-foto.png":$foto;
			
			$instrutor = $this->instrutor->getInstrutor($idusuario)[0];
			if(!empty($instrutor)){
				extract($instrutor);
			}

			if($tipo){
                $publicacoes       = count($this->cursos->getCursosInstrutor($idinstrutor));
                $inscritos         = count($this->inscricoes->getInscricaoPorinstrutor($idinstrutor));
                $resumoFinanceiro  = $this->instrutor->resumoFinanceiro($idinstrutor);
            }
            include_once ROOT."template/dashboard-contents/perfil.ctp";
		}

		private function certificado($inscricao){
			extract($_SESSION);
			$inscr          = $this->inscricoes->getInscricaoId($inscricao[0])[0];
            $provas         = $this->cursos->getProvas($inscr['idinscricao']);

            $btn = '';
            
            if(!empty($provas) && ($provas[count($provas)-1]['nota'] >= NOTACORTE)){
                $btn = 
                '
                    <button type="button" class="btn btn-default bg-orange btn-promotion pull-right solicitar-certificado">
                        <strong>
                            <i class="fa fa-thumbs-up"></i>
                            &#160;&#160;Eu quero meu certificado!
                        </strong>
                    </button>
                ';

                if(!empty($inscr['data_finalizacao'])){
                    $btn = 
                    '
                        <form action="certificado" method="POST" target="_blanc">
                            <input type="hidden" name="inscr" value="6">
                            <input type="hidden" name="curso" value="8">
                            <button type="submit" class="btn btn-success pull-right">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i> Download do Certificado
                            </button>
                        </form>
                    ';
                }
            }

            include_once ROOT."template/dashboard-contents/certificado-modelo.ctp";
		}

		private function prova($inscricao){
			extract($_SESSION);
			$inscr              = $this->inscricoes->getInscricaoId($inscricao[0])[0];
            $curso              = $this->cursos->getCursoId($inscr['idcurso'])[0];
            $instrutor_foto     = empty($curso['instrutor_foto'])?'img/users/sem-foto.png':$curso['instrutor_foto'];
            $style              = empty($curso['imagem'])?NULL:"style=\"background:url('{$curso['imagem']}')\"";
            $media              = number_format($curso['media'], 2, '.', ' ');
            $questoes           = $this->cursos->getQuestoes($inscr['idcurso'], N_QUESTOES);
            include_once ROOT."template/dashboard-contents/prova.ctp";			
		}

		
	}