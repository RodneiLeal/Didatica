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


		private function getInfoCandidato($idusuario){
			$info = $this->instrutor->perfil($idusuario)[0];
			return $info;
		}
		
		private function getInfoCurso($idcurso){

			$info = $this->curso->getCursoId($idcurso);
			return $info;
		}
		
		private function getInfoFinanceiras($idusuario){

			$instrutor = self::getInfoCandidato($idusuario);
			$financeiro = $this->instrutor->getSaldo($instrutor['idinstrutor'])[0];
			$info = $instrutor+$financeiro;
			return $info;
		}

		public function solicitacao($idsolicitacao){
			$solicitacao_data = $this->adm->getSolicitacoes($idsolicitacao[0])[0];

			switch ($solicitacao_data['tipo']) {
				case 1:
					$solicitacao = self::getInfoCandidato($solicitacao_data['usuario_idusuario']);
				break;

				case 2:
					$solicitacao = self::getInfoCurso($solicitacao_data['curso_idcurso']);
				break;
				case 3:
					$solicitacao = self::getInfoFinanceiras($solicitacao_data['usuario_idusuario']);
				break;
			}

			include_once ROOT."template/admin/header.ctp";
			include_once ROOT."template/admin/solicitacao.ctp";
			include_once ROOT."template/admin/footer.ctp";
		}

	}