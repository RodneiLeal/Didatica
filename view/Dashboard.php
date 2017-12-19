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
			$this->action 	  = $get[0];
			$this->parameters = $get[1];
			$this->title	  = SYS_NAME." - Dashboard";
			$this->instrutor  = new Instructor;
			$this->cursos     = new CursoModel;
			$this->inscricoes = new Inscricao;
			$this->admin 	  = new Admin;

		}

		public function index(){
			include_once ROOT."template/dashboard-header.ctp";
			include_once ROOT."template/dashboard-content.ctp";
			include_once ROOT."template/dashboard-footer.ctp";
		}

		// INCLUIR AQUI OUTRAS FUNÇÕES UTILIZADAS PELA DASHBOARD


	}