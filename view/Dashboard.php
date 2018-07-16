<?php

	class Dashboard extends Main implements interfaceController{

		private $action,
				$parameters,
				$instrutor,
				$cursos,
				$inscricoes,
				$financ;

		function __construct(){
			parent::__construct();

			$get = func_num_args()>=1? func_get_args():array();
			$this->action 	  	= $get[0];
			$this->parameters 	= $get[1];
			$this->title	  	= SYS_NAME." - Dashboard";
			$this->instrutor  	= new Instructor;
			$this->cursos     	= new CursoModel;
			$this->inscricoes 	= new Inscricao;
			$this->financ 	  	= new Financeiro;
            session_name('store');
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
            $menu_message = self::getMensages();
            $menu_navegacao = self::menu_navegacao($tipo, $idusuario);
			include_once ROOT."template/dashboard/header.ctp";
			self::$action($this->parameters);
			include_once ROOT."template/dashboard/footer.ctp";
        }

		private function home(){
            extract($_SESSION);
            $resumoFinanceiro = NULL;
			$foto = empty($foto)?"img/users/sem-foto.png":$foto;
			
			$instrutor = $this->instrutor->perfil($idusuario)[0];
			if(!empty($instrutor)){
				extract($instrutor);
			}

			if($tipo){
                $publicacoes       = count($this->cursos->getCursosInstrutor($idinstrutor));
                $inscritos         = count($this->inscricoes->getInscricaoPorinstrutor($idinstrutor));
                $resumoFinanceiro  = self::resumoFinanceiro($idinstrutor);
            }
            include_once ROOT."template/dashboard/perfil.ctp";
		}
        
        private function menu_navegacao($tipo, $idusuario){
            if($tipo){
                $menu_instrutor = '
                    <li>
                        <a href="Dashboard">
                            <i class="fa fa-home"></i><span>Home</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a><i class="fa fa-university"></i><span>Instrutor</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/editar perfil" title="Editar Perfil">Editar Perfil</a></li>
                        </ul>
                    </li>
                        
                    <li class="treeview">
                        <a><i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/novo curso" title="Novo curso">Novo curso</a></li>
                            <li><a href="Dashboard/meus cursos" title="Meus cursos">Meus cursos</a></li>
                            <li><a href="Dashboard/inscricoes" title="Minhas Inscrições">Minhas Inscrições</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="Dashboard/mensagens" title="Minhas Inscrições"><i class="fa fa-envelope"></i>Mensagens<span class="label label-success label-dsh-menu">'.self::nMensagens().'</span></a>
                    </li>
                    ';

                    '<li class="treeview">
                        <a><i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/meus_certificados" title="Lista todos os cursos">Ver meus Certificados</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a><i class="fa fa-money"></i><span>Financeiro</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/resumo financeiro" title="Lista todos os cursos">Meu saldo</a></li>
                        </ul>
                    </li>';

                return $menu_instrutor;
            }
            else{
                $menu_user = '
                    <li>
                        <a href="Dashboard">
                            <i class="fa fa-home"></i><span>Home</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a><i class="fa fa-user"></i><span>Usuario</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/editar perfil" title="Editar Perfil">Editar Perfil</a></li>
                            <!--<li><a href="Dashboard/mensagens" title="Caixa de mensagens">Caixa de Mensagens</a></li>-->
                        </ul>
                    </li>
                    
                    <li class="treeview">
                        <a><i class="fa fa-book"></i><span>Cursos</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/inscricoes" title="Minhas Inscrições">Minhas Inscrições</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="Dashboard/mensagens" title="Minhas Inscrições"><i class="fa fa-envelope"></i>Mensagens<span class="label label-success label-dsh-menu">'.self::nMensagens().'</span></a>
                    </li>
                    ';
                    
                    $menu_user .= empty($this->instrutor->getSolicitacaoInstrutor($idusuario)[0])?
                    '
                    <li class="treeview">
                        <a data-toggle="modal" class="closed-modal" data-target="#novo-instrutor">
                            <i class="fa fa-university"></i><span>Tornar-se um Instrutor</span>
                        </a>
                    </li>
                    ':'';
                    
                    '<li class="treeview">
                        <a><i class="fa fa-graduation-cap"></i><span>Certificados</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="Dashboard/meus certificados" title="Lista todos os cursos"></i>Ver meus Certificados</a></li>
                        </ul>
                    </li>';

                return $menu_user;
            }
        }

		private function editar_perfil(){
            extract($_SESSION);
			$instrutor = $this->instrutor->perfil($idusuario)[0];
            @extract($instrutor);
            
			$bancos = Main::getBancos();
            include_once ROOT."template/dashboard/editar-perfil.ctp";
		}

		private function inscricoes(){
			extract($_SESSION);
			$minhasInscricoes = $this->inscricoes->getInscricaoPorUsuario($idusuario);
            include_once ROOT."template/dashboard/minhas-inscricoes.ctp";
        }
        
		private function meus_cursos(){
			extract($_SESSION);
			$instrutor = $this->instrutor->perfil($idusuario)[0];
            $meusCursos = $this->cursos->getCursosInstrutor($instrutor['idinstrutor']);
			include_once ROOT."template/dashboard/meus-cursos.ctp";
		}

		private function inscricao($inscricao){
			$inscr          = $this->inscricoes->getInscricaoId($inscricao[0])[0];
            $curso          = $this->cursos->getCursoId($inscr['idcurso'])[0];
            $instrutor_foto = empty($curso['instrutor_foto'])?'img/users/sem-foto.png':$curso['instrutor_foto'];
            $style          = empty($curso['imagem'])?NULL:"style=\"background:url('{$curso['imagem']}')\"";
            $aulas          = $this->cursos->getAulas($curso['idcurso']);
            $media          = number_format($curso['media'],2, '.', ' ');
            $provas         = $this->cursos->getProvas($inscr['idinscricao']);

            if(empty($provas) || !($provas[count($provas)-1]['nota'] >= NOTA_CORTE)){
                $btn_avaliacao = null;
                $btn = 
                '
                <div class="box-body course_box text-center">
                <a href="Dashboard/prova/'.$inscricao[0].'" class="btn btn-success course_get_question">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> Responder Prova
                </a>
                </div>
                ';

            }else{
                $status = $this->financ->buscaTransacaoInscr($inscr['idinscricao'])[0];
                
                switch($status['status']){// STATUS_PGTO
                    
                    // se status do pagamento for igual a 1 ou 2, então exibe mensagem de 'aguardando pagamento'
                    case 1:
                    case 2:
                        $btn_avaliacao = null;
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
                        $btn_avaliacao = 
                        '
                        <div class="box-body course_box text-center">
                            <button class="btn btn-warning course_get_critical" data-target="#avaliacao" data-toggle="modal">
                            <i class="fa fa-star"></i>
                            De sua opinião sobre este curso</button>
                        </div>
                        ';
                        $btn = 
                        '
                        <div class="box-body course_box text-center">
                            <form action="certificado" method="POST" target="_blanc">
                                <input type="hidden" name="inscr" value="'.$inscr['idinscricao'].'">
                                <input type="hidden" name="curso" value="'.$inscr['idcurso'].'">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-certificate" aria-hidden="true"></i> Download do Certificado
                                </button>
                            </form>
                        </div>
                        ';
                        
                    break;
                    
                    // em qualquer outro caso o botão 'Solicitar Certificado' estará disponível
                    default:
                        $btn_avaliacao = null;
                        $btn = 
                        ' 
                        <div class="box-body course_box text-center">
                            <button type="button" class="btn btn-success solicitar-certificado">
                                <i class="fas fa-certificate" aria-hidden="true"></i> Solicitar Certificado
                            </button>
                        </div>
                        ';
                }
            }
            include_once ROOT."template/dashboard/curso.ctp";

        }
        
        private function novo_curso($param){
            $categorias = $this->cursos->getCategorias();
            $select = "<select class=\"\" placeholder=\"Categorias\" name=\"curso[categoria]\">";
            foreach($categorias as $categoria):
                $select .= "<option value=\"".$categoria['idcategoria']."\">".$categoria['categoria']."</option>";
            endforeach;
            $select .= "</select>";

            include_once ROOT."template/dashboard/novo-curso.ctp";
        }
        
        private function tabela_de_questoes($idcurso){
            $questoes = $this->cursos->getQuestoes($idcurso);

            $tabela = "
                    <div class=\"form-header with-border-bottom\">
                        <h3 class=\"form-title\">Banco de questões</h3>
                        <a href=\"Dashboard/curso/".$idcurso."/Banco de questões/adicionar\" class=\"form-btn\">Adicionar questões</a>
                    </div>
                    
                    <div class=\"form-container\">
                        <div class=\"box box-primary\">
                            <div class=\"box-body\">
                                <table id=\"example2\" class=\"table table-bordered table-hover \">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Questão</th>
                                    </tr>
                                    </thead>
                                    <tbody>";

                                    if(!empty($questoes)){
                                        foreach ($questoes as $index=>$questao) {
                                            
                                            $tabela .=  
                                            "<tr>
                                            <th width=\"30\">".($index+1)."</th>
                                            <td><a href=\"Dashboard/curso/".$idcurso."/Banco de questões/editar/".$questao['id_questao']."\">".mb_strimwidth($questao['questao'], 0, 255, '[...]')."</a></td>
                                            </tr>";
                                        }
                                    }
                                        
                                    $tabela .=  "
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Questão</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                ";
            return $tabela;
        }

        private function editar_questao($idcurso, $idquestao){
            $questao = $this->cursos->getQuestoes($idcurso, $idquestao)[0];

            function checked($resposta, $value){
                return $resposta == $value?"checked":"";
            }

            $form = "
                <!-- formulario de dados do curso -->
                <form action=\"controllers/curso/ask_manager.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"questoes\">

                    <input type=\"hidden\" name=\"curso_idcurso\" value=\"".$idcurso."\">
                    <input type=\"hidden\" name=\"questoes[1][id_questao]\" value=\"".$idquestao."\">

                    <div class=\"form-header with-border-bottom\">
                        <h3 class=\"form-title\">Banco de questões</h3>
                        <button name=\"salvarquestoes\" class=\"form-btn\">Salvar e continuar</button>
                    </div>
                    
                    <div class=\"form-container\">
                        <!-- template para questionario -->
                        <div class=\"box box-primary panel template\">
                            <div class=\"box-header\">
                                <div class=\"box-tools pull-left\">
                                    <a class=\"btn btn-box-tool delete-ask\"><i class=\"fa fa-trash fa-2x\"></i></a>
                                </div>
                            </div>

                            <div class=\"box-body\">
                                <div class=\"row\">
                                    <div class=\"col-md-12\">
                                    <label>Questão</label>
                                    <input type=\"text\" class=\"form-control\" name=\"questoes[1][questao]\" placeholder=\"Questão\" value=\"".$questao['questao']."\">
                                    </div>
                                </div>

                                <div class=\"row\">
                                    <div class=\"col-md-6\">
                                    <label>Opções</label>

                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">
                                        <input type=\"radio\" value=\"1\" name=\"questoes[1][resposta]\" ".checked($questao['resposta'], 1).">
                                        </span>
                                        <input class=\"form-control\" name=\"questoes[1][opcao_1]\" type=\"text\" placeholder=\"Resposta\" value=\"".$questao['opcao_1']."\">
                                    </div>

                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">
                                        <input type=\"radio\" value=\"2\" name=\"questoes[1][resposta]\" ".checked($questao['resposta'], 2).">
                                        </span>
                                        <input class=\"form-control\" name=\"questoes[1][opcao_2]\" type=\"text\" placeholder=\"Resposta\" value=\"".$questao['opcao_2']."\">
                                    </div>

                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">
                                        <input type=\"radio\" value=\"3\" name=\"questoes[1][resposta]\"".checked($questao['resposta'], 3).">
                                        </span>
                                        <input class=\"form-control\" name=\"questoes[1][opcao_3]\" type=\"text\" placeholder=\"Resposta\" value=\"".$questao['opcao_3']."\">
                                    </div>
                                    </div>

                                    <div class=\"col-md-6\">
                                    <label>Opções</label>

                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">
                                        <input type=\"radio\" value=\"4\" name=\"questoes[1][resposta]\" ".checked($questao['resposta'], 4).">
                                        </span>
                                        <input class=\"form-control\" name=\"questoes[1][opcao_4]\" type=\"text\" placeholder=\"Resposta (opcional)\" value=\"".$questao['opcao_4']."\">
                                    </div>

                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">
                                        <input type=\"radio\" value=\"5\" name=\"questoes[1][resposta]\"  ".checked($questao['resposta'], 5).">
                                        </span>
                                        <input class=\"form-control\" name=\"questoes[1][opcao_5]\" type=\"text\" placeholder=\"Resposta (opcional)\" value=\"".$questao['opcao_5']."\">
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
        
                    <div class=\"form-footer\">
                        <h3 class=\"form-title\"></h3>
                        <button name=\"salvarquestoes\" class=\"form-btn\">Salvar e continuar</button>
                    </div>
                </form>
            ";

            return $form;
        }

		private function curso($param){

            $curso = $this->cursos->getCursoId($param[0])[0];

            switch (@$param[1]) {
                
                case 'Grade do curso':
                    $doc = null;
                    $aulas = $this->cursos->getAulas($param[0])[0];

                    if (!empty($aulas['arquivo'])) {
                        $doc =  "
                            <div class=\"row form-row\">
                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                    <label>Arquivo de aula atual</label>
                                    <iframe class=\"preview-file\" src=\"".$aulas['arquivo']."\" frameborder=\"0\" ></iframe>
                                </div>
                            </div>
                        ";
                    }

                    $sessao = "
                        <!-- formulario de dados do curso -->
                        <form action=\"controllers/curso/salvarAula.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"aula\">
                            <input type=\"hidden\" name=\"idaula\" value=\"".$aulas['idaula']."\">
                            <input type=\"hidden\" name=\"curso_idcurso\" value=\"".$param[0]."\">
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
                                                            <input name=\"titulo\"  placeholder=\"Titulo da Aula\" maxlength=\"90\" value=\"".$aulas['titulo']."\">
                                                            <span class=\"input-counter\"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class=\"row form-row\">
                                                    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                        <label>Objetivos</label>
                                                        <textarea class=\"editor\" name=\"objetivos\" id=\"editor3\"  palceholder=\"Descreva aqui os objetivos do seu curso\">".$aulas['objetivos']."</textarea>
                                                    </div>
                                                </div>
                                                $doc
                                                <div class=\"row form-row\">
                                                    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                        <label>Selecionar arquivo</label>
                                                        <input type=\"file\" name=\"arquivo\">
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
                    switch (@$param[2]) {
                        case 'adicionar':
                            $sessao = "
                                <!-- formulario de dados do curso -->
                                
                                    
                                    <div class=\"form-header with-border-bottom\">
                                    <h3 class=\"form-title\">Banco de questões</h3>
                                    <button name=\"\" type=\"button\" class=\"form-btn add-ask\">Adicionar questão</button>
                                    
                                    <form action=\"controllers/curso/ask_manager.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"questoes\">
                                        <input type=\"hidden\" name=\"curso_idcurso\" value=\"".$param[0]."\">
                                        <button name=\"salvarquestoes\" class=\"form-btn\">Salvar e continuar</button>
                                    </div>

                                    <div class=\"form-tools with-border-bottom\">
                                        
                                    </div>

                                    <div class=\"form-container question-box\">
                                        <!-- template para questionario -->
                                        <div class=\"box box-primary panel template\">
                                            <div class=\"box-header\">
                                                <h4 class=\"box-title\">
                                                <a href=\"#panel-1\" data-toggle=\"collapse\" data-parent=\"#accordion\" aria-expanded=\"false\">Questão 1</a>
                                                </h4>
                                                <div class=\"box-tools pull-left\">
                                                    <a class=\"btn btn-box-tool remove-ask\"><i class=\"fa fa-trash fa-2x\"></i></a>
                                                </div>
                                            </div>

                                            <div class=\"collapse in panel-collapse\" aria-expanded=\"false\" id=\"panel-1\">

                                                <div class=\"box-body\">

                                                <div class=\"row\">
                                                    <div class=\"col-md-12\">
                                                    <label>Questão</label>
                                                    <input type=\"text\" class=\"form-control\" name=\"questoes[1][questao]\" placeholder=\"Questão\">
                                                    </div>
                                                </div>

                                                <div class=\"row\">
                                                    <div class=\"col-md-6\">
                                                    <label>Opções</label>

                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">
                                                        <input type=\"radio\" value=\"1\" name=\"questoes[1][resposta]\">
                                                        </span>
                                                        <input class=\"form-control\" name=\"questoes[1][opcao_1]\" type=\"text\" placeholder=\"Resposta\">
                                                    </div>

                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">
                                                        <input type=\"radio\" value=\"2\" name=\"questoes[1][resposta]\">
                                                        </span>
                                                        <input class=\"form-control\" name=\"questoes[1][opcao_2]\" type=\"text\" placeholder=\"Resposta\">
                                                    </div>

                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">
                                                        <input type=\"radio\" value=\"3\" name=\"questoes[1][resposta]\">
                                                        </span>
                                                        <input class=\"form-control\" name=\"questoes[1][opcao_3]\" type=\"text\" placeholder=\"Resposta\">
                                                    </div>
                                                    </div>

                                                    <div class=\"col-md-6\">
                                                    <label>Opções</label>

                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">
                                                        <input type=\"radio\" value=\"4\" name=\"questoes[1][resposta]\">
                                                        </span>
                                                        <input class=\"form-control\" name=\"questoes[1][opcao_4]\" type=\"text\" placeholder=\"Resposta (opcional)\">
                                                    </div>

                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">
                                                        <input type=\"radio\" value=\"5\" name=\"questoes[1][resposta]\">
                                                        </span>
                                                        <input class=\"form-control\" name=\"questoes[1][opcao_5]\" type=\"text\" placeholder=\"Resposta (opcional)\">
                                                    </div>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                        
                                    <div class=\"form-header\">
                                        <h3 class=\"form-title\"></h3>
                                        <button name=\"\" type=\"button\" class=\"form-btn add-ask\">Adicionar questão</button>
                                        <button name=\"salvarquestoes\" class=\"form-btn\">Salvar e continuar</button>
                                    </div>
                                </form>
                            ";
                        break;

                        case 'editar':
                            $sessao = self::editar_questao($param[0], $param[3]);
                        break;

                        default:
                            $sessao = self::tabela_de_questoes($param[0]);
                        break;
                    }
                break;

                case 'Configurações':
                    $sessao = 
                    '
                        <h3>Configurações</h3>
                    ';
                break;
                
                default:
                    $categorias = $this->cursos->getCategorias();
                    $select = "<select class=\"\" placeholder=\"Categorias\" name=\"curso[categoria]\">";
                    foreach($categorias as $categoria):
                        $selected = $categoria['idcategoria']==$curso['categoria_idcategoria']?'selected':'';
                        $select .= "<option ".$selected." value=\"".$categoria['idcategoria']."\">".$categoria['categoria']."</option>";
                    endforeach;
                    $select .= "</select>";
                    
                    $disabled = !empty($curso['titulo'])?'disabled':'';
                    $imagem = empty($curso['imagem'])?"img/curso/select-image.png":$curso['imagem'];

                    $sessao = "
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
                                        <input type=\"text\" placeholder=\"ex.: Design de produtos com Ilustrator\" maxlength=\"90\" name=\"curso[titulo]\" value=\"".$curso['titulo']."\" $disabled>
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

            if($curso['locked']){
                 $btn_analise = '<span class="form-btn form-btn-published" style="flex: auto">Publicado</span>';
            }
            elseif(empty($this->cursos->getSolicitacaoAnalise($param[0])[0])){
                $btn_analise = '<button class="form-btn form-btn-publish publish" style="flex: auto">Envia para análise</button>';
            }
            else{
                $btn_analise = '<span class="form-btn form-btn-review" style="flex: auto">Em análise</span>';
            }
            
            include_once ROOT."template/dashboard/gerenciar-curso.ctp";
        }

		private function certificado($inscricao){
			extract($_SESSION);
			$inscr          = $this->inscricoes->getInscricaoId($inscricao[0])[0];
            $provas         = $this->cursos->getProvas($inscr['idinscricao']);

            $btn = '';
            
            if(!empty($provas) && ($provas[count($provas)-1]['nota'] >= NOTA_CORTE)){
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
                                <i class="fas fa-certificate" aria-hidden="true"></i> Download do Certificado
                            </button>
                        </form>
                    ';
                }
            }

            include_once ROOT."template/dashboard/certificado-modelo.ctp";
		}

		private function prova($inscricao){
			extract($_SESSION);
            $inscr              = $this->inscricoes->getInscricaoId($inscricao[0])[0];
            $curso              = $this->cursos->getCursoId($inscr['idcurso'])[0];
            $instrutor_foto     = empty($curso['instrutor_foto'])?'img/users/sem-foto.png':$curso['instrutor_foto'];
            $media              = number_format($curso['media'], 2, '.', ' ');
            $questoes           = $this->cursos->getQuestoes($inscr['idcurso'], null, N_QUESTOES);
            include_once ROOT."template/dashboard/prova.ctp";			
        }

        private function getMensages(){
            $messages   = $this->instrutor->readerMessages(NULL, TRUE);
            $nMessages  = count($messages);

            $message_list =  "<li class=\"dropdown messages-menu\">
            <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                <i class=\"fa fa-envelope-o\"></i>
                <span class=\"label label-success\">{$nMessages}</span>
            </a>
            <ul class=\"dropdown-menu\">
                <li class=\"header\">Você tem {$nMessages} messages</li>
                <li>
                <ul class=\"menu\">";

            foreach ($messages as $message) {
                extract($message);
                $data_envio  = $this->formataData($data_envio, 'dhm');
                $foto = empty($foto)?"img/users/sem-foto.png":$foto;
                
                $message_list .= "<li>
                    <a href=\"Dashboard/mensagem/{$idmensagem}\">
                        <div class=\"pull-left\">
                            <img src=\"{$foto}\" class=\"img-circle\" alt=\"User Image\">
                        </div>

                        <h4 title=\"{$assunto}\">
                            ".mb_strimwidth($assunto, 0, 15, '...')."
                            <small><i class=\"fa fa-clock-o\"></i>{$data_envio}</small>
                        </h4>
                        <h5>{$remetente}</h5>
                    </a>
                </li>";
                
            }

            $message_list .= "</ul></li></ul></li>";

            return $message_list;
        }

        private function mensagem($idmensagem){
            $message   = $this->instrutor->readerMessages($idmensagem);
            extract($message[0]);
            $foto = empty($foto)?"img/users/sem-foto.png":$foto;

            include_once ROOT."template/dashboard/mensagem.ctp";			
        }

        public function nMensagens(){
			return count($this->instrutor->readerMessages(NULL, TRUE));
		}

        private function mensagens(){
            $messages   = $this->instrutor->readerMessages();
            $tabela = '<tbody>';
            foreach ($messages as $index=>$message) {
                $tabela .=  
                "<tr>
                    <th width=\"30\">".($index+1)."</th>
                    <td><a href=\"Dashboard/mensagem/".$message['idmensagem']."\">".mb_strimwidth($message['assunto'], 0, 30, '[...]')."</a></td>
                    <td>".$message['remetente']."</td>
                    <td>".$this->formataData($message['data_envio'], 'dhm')."</td>
                    <td>".$this->formataData($message['data_leitura'], 'dhm')."</td>
                </tr>";
            }
            $tabela .= '</tbody>';
            include_once ROOT."template/dashboard/mensagens.ctp";			
        }

        private function consultaSolicitacaoDeResgate($saldo, $ultimo_pagamento_data, $ultimo_pagamento_valor){
            extract($_SESSION);
            if($saldo >= MIN_SAQUE){
                if(!$this->instrutor->getConsultaResgateCredito($idusuario)){
                    return "<form action=\"controllers/instrutor/resgatarCreditos.php\" method=\"POST\" id=\"resgatarCreditos\">
                                <input type=\"hidden\" name=\"usuario_idusuario\" value=\"{$idusuario}\">
                                <button class=\"btn btn-block btn-lg btn-primary resgatarCreditos\">Resgatar créditos</button>
                            </form>";
                }else{
                    return "<span class=\"form-btn form-btn-review\" style=\"padding:10px\">Solicitação em andamento</span>";
                }
            }
            return "<p style=\"font-size: 13px;\">Último pagamento 
                        <br>
                        <strong>data: </strong>{$ultimo_pagamento_data} &nbsp;&nbsp;<strong>valor: </strong>R$ {$ultimo_pagamento_valor} 
                    </p>";
        }

        public function resumoFinanceiro($idinstrutor){
            $_30 = $_15 = $_07 = $saldo = $ultimo_pagamento_valor = number_format(0, 2, ',', '.');
            $ultimo_pagamento_data = '--/--/---- --:--';
            
            $_30     = number_format($this->instrutor->getCreditos($idinstrutor, 30)[0]['creditos'], 2, ',', '.');
            $_15     = number_format($this->instrutor->getCreditos($idinstrutor, 15)[0]['creditos'], 2, ',', '.');
            $_07     = number_format($this->instrutor->getCreditos($idinstrutor, 07)[0]['creditos'], 2, ',', '.');
            $_saldo  = number_format($ns=$this->instrutor->getSaldo($idinstrutor)[0]['saldo'], 2, ',', '.');

            $ultimo_pagamento = @$this->instrutor->getUltimoPagamento($idinstrutor)[0];
            
            if(!empty($ultimo_pagamento)){
                $ultimo_pagamento_valor = number_format($ultimo_pagamento['debito'], 2, ',', '.');
                $ultimo_pagamento_data  = $this->formataData($ultimo_pagamento['data_registro'], 'd');
            }

            $html = "<div class=\"row\"> 
                        <div class=\"col-md-9\"> 
                            <div class=\"small-box bg-primary\"> 
                                <div class=\"inner\"> 
                                    <div class=\"painel-financeiro-title\">
                                        <h3 class=\"title\">Ganhos estimados</h3>
                                    </div>
                                    <div class=\"row\"> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 30 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_30}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 15 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_15}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 7 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_07}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
 
                        <div class=\"col-md-3\"> 
                            <div class=\"small-box bg-primary\"> 
                                <div class=\"inner\"> 
                                    <h3>Saldo atual</h3> 
                                    <p class=\"painel-financeiro\">R$ {$_saldo}</p>"

                                    .self::consultaSolicitacaoDeResgate($ns, $ultimo_pagamento_data, $ultimo_pagamento_valor).

                                "</div> 
                            </div> 
                        </div> 
                    </div>";

            return $html;
        }

		
	}