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
			$this->action 	 = empty($get[0])?'home':$get[0];
			$this->param  	 = empty($get[1])?NULL:$get[1];
			$this->title  	 = SYS_NAME." - Administração";
			$this->adm	  	 = new Adm;
			$this->instrutor = new Instructor;
			$this->curso 	 = new CursoModel;
			session_name('adm');
			session_start();
		}
		
		public function index(){
			if(empty($_SESSION)){
				include_once ROOT."template/admin/login.ctp";
				return;
			}
			$action = $this->action;
			self::$action($this->param);
		}

		public function home(){
			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/home.ctp";
			include_once ROOT."template/admin/footer.ctp";
		}
		
		public function sobre(){
			$sobre = $this->adm->getSobre();
			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/sobre.ctp";
			include_once ROOT."template/admin/footer.ctp";
		}

		public function config(){
			$cfg = $this->adm->getConfig();
			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/config.ctp";
			include_once ROOT."template/admin/footer.ctp";
		}


		public function solicitacoes(){
			$array_solicitacoes = $this->adm->getSolicitacoes();

			$solicitacoes = "
				<div class=\"form-header with-border-bottom\">
					<h3 class=\"form-title\">Solicitações</h3>
				</div>
				
				<div class=\"form-container\">
					<div class=\"box box-primary\">
						<div class=\"box-body\">
							<table id=\"example2\" class=\"table table-bordered table-hover \">
								<thead>
								<tr>
									<th>#</th>
									<th>Solicitação</th>
									<th>Usuário</th>
									<th>Data</th>
								</tr>
								</thead>
								<tbody>";

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
									
								$solicitacoes .=  "
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>Soicitação</th>
									<th>Usuário</th>
									<th>Data</th>
								</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			";

			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/solicitacoes.ctp";
			include_once ROOT."template/admin/footer.ctp";
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

				$ref_0 = @crypt(0);
				$ref_1 = @crypt($instrutor['saldo']);

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
							<strong>Créditos disponíveis: </strong>".$instrutor['saldo']."<br>
						</div>
						
						<form action=\"controllers/adm/resgateDeCreditos.php\" method=\"POST\">
							<input type=\"hidden\" name=\"idsolicitacao\" value=\"".$solicitacao['idsolicitacao']."\">
							<input type=\"hidden\" name=\"instrutor_idinstrutor\" value=\"".$instrutor['idinstrutor']."\">
							<h2>
								Confirmar transferência de créditos
							</h2>
							<label>Saldo
								<input type=\"text\" name=\"debito\" readonly value=\"".$instrutor['saldo']."\">
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


			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/solicitacao.ctp";
			include_once ROOT."template/admin/footer.ctp";
		}

	}