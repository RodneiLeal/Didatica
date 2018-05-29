<?php

	class Curso extends Main implements interfaceController{

		private $curso,
				$action,
				$param;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action	= $get[0];
			$this->param 	= $get[1];
			$this->title 	= SYS_NAME." - Curso";
			$this->curso 	= new CursoModel;
			$this->inscricao= new Inscricao; 

		}

		public function index(){
			session_start();
			extract($_SESSION);
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/curso.ctp";
			include_once ROOT."template/footer.ctp";
		}


	}