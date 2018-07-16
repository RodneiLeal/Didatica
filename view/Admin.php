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
            
			return '
				<li>
					<a href="Admin">
						<i class="fa fa-home"></i><span>Home</span>
					</a>
				</li>

				<li class="treeview">
					<a><i class="fa fa-gear"></i><span>Configurações</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a title="Politica de privacidade" href="Admin/sobre">Sobre Nós</a></li>
						<li><a title="Politica de privacidade" href="Admin/sobre">Politica de privacidade</a></li>
						<li><a title="Politica de privacidade" href="Admin/sobre">Termos do uso</a></li>
						<li><a title="finaceiro" href="Admin/config" title="Editar Perfil">Financeiro</a></li>
					</ul>
				</li>
				
				<li class="treeview">
					<a><i class="fa fa-bell"></i><span>Solicitações</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a title="Candidatos a instrutores" href="Admin/solicitacoes" title="Minhas Inscrições">Instrutores</a></li>
						<li><a title="Solicitações para resgate de créditos" href="Admin/solicitacoes" title="Minhas Inscrições">Resgate de creditos</a></li>
						<li><a title="Solicitações para apovação de cursos" href="Admin/solicitacoes" title="Minhas Inscrições">Cursos</a></li>
					</ul>
				</li>

				<li>
					<a href="Admin/Fluxo de caixa" title="Minhas Inscrições"><i class="fa fa-money"></i>Financeiro<span class="label label-success label-dsh-menu"></span></a>
				</li>
				';
        }
		
		public function home(){
			include_once ROOT."template/admin/home.ctp";
		}

		public function sobre(){
			$sobre = $this->adm->getSobre();
			include_once ROOT."template/admin/sobre.ctp";
		}

		public function config(){
			$cfg = $this->adm->getConfig();
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
							<strong>CPF: </strong>".$instrutor['cpf']."<br>
						</div>
						
						<form action=\"controllers/adm/autorizarInstrutor.php\" method=\"POST\">
							<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
							<input type=\"hidden\" name=\"idusuario\" value=\"".$solicitacao['usuario_idusuario']."\">
							<label> Não, 
								<input type=\"radio\" name=\"tipo\" checked value=\"0\">
							</label>
							<label>Sim, 
								<input type=\"radio\" name=\"tipo\" value=\"1\">
							</label>
							<button class=\"btn btn-success btn-lg\" type=\"submit\">Autorizado</button>
						</form>
					   ";
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
							<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
							<input type=\"hidden\" name=\"instrutor_idinstrutor\" value=\"".$instrutor['idinstrutor']."\">
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
			$info += $this->curso->getAulas($solicitacao['curso_idcurso'])[0];
			return "
					<div>
						<strong>Curso: </strong>".$info['titulo']."<br>
						<strong>Intrutor: </strong>".$info['instrutor']."<br>
						<strong>Categoria: </strong>".$info['categoria']."<br>
						<strong>Resumo: </strong>".$info['resumo']."<br>
						<strong>Tópicos: </strong>".$info['ementa']."<br>
						<strong>Quetões registradas: </strong>".$info['n_questoes']."<br>
						<strong>Imagem de capa: </strong><img src=\"".$info['imagem']."\"><br>

						<strong>Resumo da aula: </strong>".$info['objetivos']."<br>
						<label> Material:</label>
						<iframe src=\"".$info['arquivo']."\" frameborder=\"0\"></iframe>
					</div>

					<form action=\"controllers/adm/autorizarCurso.php\" method=\"POST\">
						<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
						<input type=\"hidden\" name=\"idcurso\" value=\"".$solicitacao['curso_idcurso']."\">
						<label> Não, 
							<input type=\"radio\" name=\"locked\" checked value=\"0\">
						</label>
						<label>Sim, 
							<input type=\"radio\" name=\"locked\" value=\"1\">
						</label>
						<button class=\"btn btn-success btn-lg\" type=\"submit\">Liberado</button>
					</form>
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