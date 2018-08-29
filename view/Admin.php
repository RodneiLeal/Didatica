<?php

    class Admin extends Main implements interfaceController{

		private $adm,
				$instrutor,
				$curso,
				$action,
				$param;

		function __construct(){
			parent::__construct();

			
			$get	      	 = func_num_args()>=1?func_get_args():array();
			$this->action 	 = $get[0];
			$this->param	 = $get[1];
			$this->title  	 = SYS_NAME." - Administração";
			$this->adm	  	 = new Adm;
			$this->instrutor = new Instructor;
			$this->curso 	 = new CursoModel;
			session_name('adm');
			session_start();
		}
		
		public function index(){
			extract($_SESSION);
			$action =  empty($this->action)?'home':$this->action;
			$action = str_replace(' ', '_', $action);

            $menu_navegacao = self::menu_navegacao();

			if(empty($_SESSION)){
				include_once ROOT."template/admin/login.ctp";
			}
			else{
				include_once ROOT."template/admin/header.ctp";
				self::$action($this->param);
				include_once ROOT."template/admin/footer.ctp";
			}
		}

		private function menu_navegacao(){
            
			return "
				<li>
					<a href=\"Admin\">
						<i class=\"fa fa-home\"></i><span>Home</span>
					</a>
				</li>

				<li class=\"treeview\">
					<a><i class=\"fa fa-gear\"></i><span>Configurações</span><i class=\"fa fa-angle-left pull-right\"></i></a>
					<ul class=\"treeview-menu\">
						<li><a title=\"Politica de privacidade\" href=\"Admin/sobre\">Sobre Nós</a></li>
						<li><a title=\"Politica de privacidade\" href=\"Admin/politica de privacidade\">Politica de privacidade</a></li>
						<li><a title=\"Politica de privacidade\" href=\"Admin/termos de uso\">Termos de uso</a></li>
						<li><a title=\"Configurações Financeiras\"href=\"Admin/config/financeira\">Finaceira</a></li>
						<li><a title=\"Configurações Provas\"href=\"Admin/config/provas\">Provas</a></li>
						<li><a title=\"Configurações Certificado\"href=\"Admin/config/certificado\">Certificado</a></li>
					</ul>
				</li>
				
				<li class=\"treeview\">
					<a href=\"Admin/solicitacoes\" ><i class=\"fa fa-bell\"></i><span>Solicitações</span></a>
				</li>

				<li>
					<a href=\"Admin/Fluxo de caixa\" title=\"Minhas Inscrições\"><i class=\"fa fa-money\"></i><span>Financeiro</span></a>
				</li>
				";
        }
		
		public function home(){
			include_once ROOT."template/admin/home.ctp";
		}

		public function sobre(){
			$sobre = $this->adm->getSobre();
			include_once ROOT."template/admin/sobre.ctp";
		}

		public function politica_de_privacidade(){
			$sobre = $this->adm->getSobre();
			include_once ROOT."template/admin/politica_de_privacidade.ctp";
		}

		public function termos_de_uso(){
			$sobre = $this->adm->getSobre();
			include_once ROOT."template/admin/termos_de_uso.ctp";
		}

		public function config($sessao){
			$cfg = $this->adm->getConfig();
			$titulo = ucfirst(empty($sessao[0])?'financeira':$sessao[0]);
			switch ($sessao[0]) {
				default:
					$sessao = "
							<input type=\"hidden\" name=\"idconfig\" value=\"".$cfg['idconfig']."\">

							<p>
								<label for=\"\">Unidade monetária</label>
								<select name=\"unid_monet\">
									<option value=\"BRL\">BRL</option>
								</select>
								<span>".$cfg['unid_monet']."</span>
							</p>

							<p>
								<label for=\"\">Valor do certificado</label>
								<input type=\"text\" name=\"certificado_valor\" value=\"".$cfg['certificado_valor']."\">
							</p>

							<p>
								<label for=\"\">Comissão</label>
								<input type=\"text\" name=\"comissao\" value=\"".$cfg['comissao']."\">
							</p>

							<p>
								<label for=\"\">Crédito mínimo para saque</label>
								<input type=\"text\" name=\"min_saque\" value=\"".$cfg['min_saque']."\">
							</p>
                            ";
				break;

				case 'provas':
					$sessao = "
							<input type=\"hidden\" name=\"idconfig\" value=\"".$cfg['idconfig']."\">

							<p>
								<label for=\"\">número de questões</label>
								<input type=\"text\" name=\"n_questoes\" value=\"".$cfg['n_questoes']."\">
							</p>
							<p>
								<label for=\"\">Nota de corte</label>
								<input type=\"text\" name=\"nota_corte\" value=\"".$cfg['nota_corte']."\">
							</p>
                            ";
				break;

				case 'certificado':
					$sessao = "
							<input type=\"hidden\" name=\"idconfig\" value=\"".$cfg['idconfig']."\">

							<p>
								<label for=\"\">CEO</label>
								<input type=\"text\" name=\"ceo\" value=\"".$cfg['ceo']."\">
							</p>
							<p>
								<label for=\"\">CET</label>
								<input type=\"text\" name=\"cet\" value=\"".$cfg['cet']."\">
							</p>
							  ";
				break;
			}
			include_once ROOT."template/admin/config.ctp";
		}

		public function solicitacoes(){
			$array_solicitacoes = $this->adm->getSolicitacoes();
			$solicitacoes = NULL;

			if(!empty($array_solicitacoes)){
				foreach ($array_solicitacoes as $index=>$solicitacao) {
					$data = $this->formataData($solicitacao['data_solicitacao']);
					$solicitacoes .=  
					"<tr>
						<th width=\"30\">".($index+1)."</th>
						<td><a href=\"admin/solicitacao/".$solicitacao['idsolicitacao']."\">".$solicitacao['mensagem']."</a></td>
						<td>".$solicitacao['nome']."</td>
						<td>".$data."</td>
					</tr>";
				}
			}
									
			include_once ROOT."template/admin/solicitacoes.ctp";
		}

		private function getInfoInstrutor($solicitacao){
			$instrutor = $this->instrutor->perfil($solicitacao['usuario_idusuario'])[0];
			$instrutor['foto'] = empty($instrutor['foto'])?'img/users/sem-foto.png':$instrutor['foto'];

			if($solicitacao['tipo']==1){
				return "<div class=\"form-header with-border-bottom\">
							<h3 class=\"form-title\">Novo Instrutor</h3>
						</div>

						<section class=\"content\">
							<div class=\"row\">
								<div class=\"col-md-12\">
								<div class=\"box box-widget widget-user\">
									<div class=\"widget-user-header bg-blue\">
										<h3 class=\"widget-user-name\" style=\"margin-top: 0;\">".$instrutor['nome'].' '.$instrutor['sobrenome']."</h3>
										<div class=\"widget-user-image\">
											<img src=\"".$instrutor['foto']."\" class=\"img-circle\" alt=\" ".$instrutor['nome'].' '.$instrutor['sobrenome']."\" />
										</div>
									</div>

									<div class=\"box-footer\"></div>

									<div class=\"box-body\">
										<div class=\"col-md-8\">
											<div class=\"box box-primary\">
												<div class=\"box-header\">
													<h3 class=\"box-title\">Dados Pessoais</h3>
												</div>
												<div class=\"box-body\">
													<div id=\"course-content\">

														<strong>E-mail: </strong>".$instrutor['email']."<br>
														<strong>Data de cadastro: </strong>".$instrutor['dataCadastro']."<br>
														<strong>Telefone: </strong>".$instrutor['telefone']."<br>
														<strong>Resumo: </strong>".$instrutor['resumo']."<br>
													
													</div>
												</div>
											</div>
										</div>


										<div class=\"col-md-4\">
											<div class=\"box box-primary\">
												<div class=\"box-header text-center\">
													<h3 class=\"box-title title-course\">Dados Bancário</h3>
												</div>
												<div class=\"box-body\">
													<strong>Banco conveniado: </strong>".$instrutor['banco_idbanco']."<br>
													<strong>Agencia: </strong>".$instrutor['agencia']."<br>
													<strong>Conta: </strong>".$instrutor['conta']."<br>
													<strong>Operacao: </strong>".$instrutor['operacao']."<br>
													<strong>CPF: </strong>".$instrutor['cpf']."<br>
												</div>
											</div>
										</div>

										<div class=\"col-md-12\">
											<div class=\"box box-primary\">
												<div class=\"box-header text-center\">
													<h3 class=\"box-title title-course\">Currículo</h3>
												</div>
												<div class=\"box-body\">
													<strong>Titulacao: </strong>".$instrutor['titulacao']."<br>
													<strong>Formacao: </strong>".$instrutor['formacao']."<br>
													<strong>Instituicao: </strong>".$instrutor['instituicao']."<br>
													<strong>Lattes: </strong>".$instrutor['lattes']."<br>
												</div>
											</div>
										</div>
									</div>

									<div class=\"box-footer\">
										<form action=\"controllers/adm/autorizarInstrutor.php\" method=\"POST\" id=\"auth\">
											<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
											<input type=\"hidden\" name=\"idusuario\" value=\"".$solicitacao['usuario_idusuario']."\">

											<button class=\"btn btn-danger btn-lg autorizar-instrutor\" type=\"submit\" value=\"0\">Instrutor não autorizado</button>
											<button class=\"btn btn-success btn-lg autorizar-instrutor pull-right\" type=\"submit\" value=\"1\">Instrutor autorizado</button>
										</form>
									</div>

								</div>
								</div>
							</div>
						</section>";

			}else if($solicitacao['tipo']==3){
				$financeiro = $this->instrutor->getSaldo($instrutor['idinstrutor'])[0];
				$instrutor = $instrutor+$financeiro;
				$saldo = number_format($instrutor['saldo'], 2, '.', '');
				$ref_0 = @crypt(0);
				$ref_1 = @crypt($saldo);
				return "<div>
							<strong>Nome: </strong>".$instrutor['nome'].' '.$instrutor['sobrenome']."<br>
							<strong>E-mail: </strong>".$instrutor['email']."<br>
							<strong>Data de cadastro: </strong>".$instrutor['dataCadastro']."<br>
							<strong>Telefone: </strong>".$instrutor['telefone']."<br>
							<strong>Resumo: </strong>".$instrutor['resumo']."<br>
							<strong>Titulacao: </strong>".$instrutor['titulacao']."<br>
							<strong>Foto: </strong><img src=\"".$instrutor['foto']."\"><br>
							
							<strong>Formacao: </strong>".$instrutor['formacao']."<br>
							<strong>Instituicao: </strong>".$instrutor['instituicao']."<br>
							<strong>Lattes: </strong>".$instrutor['lattes']."<br>

							<strong>Banco conveniado: </strong>".$instrutor['banco_idbanco']."<br>
							
							<strong>Agencia: </strong>".$instrutor['agencia']."<br>
							<strong>Conta: </strong>".$instrutor['conta']."<br>
							<strong>Operacao: </strong>".$instrutor['operacao']."<br>
							<strong>CPF: </strong>".$instrutor['cpf']."<br><br><br>
						</div>
						
						<form action=\"controllers/adm/resgateDeCreditos.php\" method=\"POST\">
							
							<h2>
								Confirmar transferência de créditos
							</h2>
							<label>R$ 
								<input type=\"text\" name=\"debito\" readonly value=\"".$saldo."\">
							</label>
							<label> Não, 
								<input type=\"radio\" name=\"referencia\" checked value=\"".$ref_0."\">
							</label>
							<label>Sim, 
								<input type=\"radio\" name=\"referencia\" value=\"".$ref_1."\">
							</label>
							<button class=\"btn btn-success btn-lg\" type=\"submit\">Autorizado</button>
						</form>
					   ";
			}
		}
		
		private function getInfoCurso($solicitacao){
			$info = $this->curso->getCursoId($solicitacao['curso_idcurso'])[0];
			$aulas = $this->curso->getAulas($solicitacao['curso_idcurso']);
			$instrutor_foto     = empty($info['instrutor_foto'])?'img/users/sem-foto.png':$info['instrutor_foto'];

			if(!is_array($aulas)){
				$aulas_content = "<strong>Este curso ainda não tem aulas definida</strong>";
				$frame = "";
			}
			else{
				$frame = $aulas[0]['arquivo'];

				$aulas_content = "<strong>Resumo da aula: </strong>".$aulas[0]['objetivos']."<br>";
						  
			}

			return "
			
			<div class=\"form-header with-border-bottom\">
				<h3 class=\"form-title\">Novo Curso</h3>
			</div>

			<section class=\"content\">
			<div class=\"row\">
				<div class=\"col-md-12\">
				<div class=\"box box-widget widget-user\">
					<div class=\"widget-user-header bg-blue\">
						<h3 class=\"widget-user-name\" style=\"margin-top: 0;\">".$info['titulo']."</h3>
						<h6 class=\"widget-user-desc\">Por <a href=\"//\" class=\"b white\">".$info['instrutor']."</a></h6>
						<div class=\"row\">
							<div class=\"col-md-3\">
								<span>".$info['categoria']."</span>
							</div>
						</div>
						<div class=\"widget-user-image\">
							<img src=\"".$instrutor_foto."\" class=\"img-circle\" alt=\" ".$info['instrutor']."\" />
						</div>
					</div>

					<div class=\"box-footer\"></div>

					<div class=\"box-body\">
						<div class=\"col-md-8\">
							<div class=\"box box-primary\">
								<div class=\"box-header\">
									<h3 class=\"box-title\">Conteudo do curso</h3>
								</div>
								<div class=\"box-body\">
									<div id=\"course-content\">


										<strong>Resumo: </strong>".$info['resumo']."<br>
										<strong>Tópicos: </strong>".$info['ementa']."<br>
										<strong>Numero de quetões registradas: </strong>".$info['n_questoes']."<br>
										$aulas_content
									
									
									</div>
								</div>
							</div>
						</div>
						<div class=\"col-md-4\">
							<div class=\"box box-primary\">
								<div class=\"box-header text-center\">
									<h3 class=\"box-title title-course\">Capa do curso</h3>
								</div>
								<div class=\"box-body\">
									<img src=\"".$info['imagem']."\" class=\"img-responsive\" alt=\"Image\">
								</div>
							</div>
						</div>

						<div class=\"col-md-4 pull-right\">
							<div class=\"box box-primary\">
								<div class=\"box-header text-center\">
									<h3 class=\"box-title title-course\">Material do curso</h3>
								</div>
								<div class=\"box-body\">
									<iframe src=\"".$frame."\" frameborder=\"0\"></iframe>
								</div>
							</div>
						</div>
					</div>

					<div class=\"box-footer\">
						<form action=\"controllers/adm/autorizarCurso.php\" method=\"POST\" id=\"auth\">
							<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
							<input type=\"hidden\" name=\"idcurso\" value=\"".$solicitacao['curso_idcurso']."\">
							<button class=\"btn btn-danger btn-lg autorizar-curso\" type=\"submit\" value=\"0\">Publicação não autorizada</button>
							<button class=\"btn btn-success btn-lg autorizar-curso pull-right\" type=\"submit\" value=\"1\">Publicação autorizada</button>
						</form>
					</div>

				</div>
				</div>
			</div>
			</section>
			";
		}
		
		public function solicitacao($idsolicitacao){

			@$solicitacao_data = $this->adm->getSolicitacoes($idsolicitacao[0])[0];

			if(sizeof($solicitacao_data)){
				switch ($solicitacao_data['tipo']) {
					case 1:
						$solicitacao = self::getInfoInstrutor($solicitacao_data);
					break;
	
					case 2:
						$solicitacao = self::getInfoCurso($solicitacao_data);
					break;
					case 3:
						$solicitacao = self::getInfoInstrutor($solicitacao_data);
					break;
				}
			}else{
				$solicitacao = "
								<h3>Solicitação inexistente</h3>
							   ";
			}


			include_once ROOT."template/admin/solicitacao.ctp";
		}

		private function fluxo_de_caixa(){
			$array_creditos_apagar = $this->adm->getCreditosApagar();
			$table = NULL;
			$total = 0;
			if(!empty($array_creditos_apagar)){
				$index = 1;
				foreach ($array_creditos_apagar as $creditos_apagar) {
					
					if(empty(round(floatval($creditos_apagar['saldo']), 2))){
						continue;
					}

					$total += $creditos_apagar['saldo'];

					$saldo = number_format($creditos_apagar['saldo'], 2, ',', '.');
					$table .=  
					"<tr>
						<th width=\"30\">".($index++)."</th>
						<td><a href=\"\">".$creditos_apagar['nome']."</a></td>
						<td style=\"width:25%\"> R$ ".$saldo."</td>
					</tr>";
				}
			}
			$total =  number_format($total, 2, ',', '.');

			$total = "<div class=\"row\"> 
				<div class=\"col-md-3 pull-right\"> 
					<div class=\"small-box bg-primary\"> 
						<div class=\"inner\"> 
							<h3>Total</h3> 
							<p class=\"painel-financeiro\">R$ {$total}
					</div> 
				</div> 
			</div>";


			include_once ROOT."template/admin/fluxo_de_caixa.ctp";
		}

	}