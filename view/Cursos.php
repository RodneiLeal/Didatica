<?php

	class Cursos extends Main implements interfaceController{

		private $cursos,
				$action,
				$param;

		function __construct(){
			parent::__construct();
			$get 				= func_num_args()>=1? func_get_args():array();
			$this->action		= $get[0];
			$this->param		= $get[1];
			$this->title 		= SYS_NAME." - Cursos";
			$this->cursos		= new CursoModel;
		}

		public function index(){
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/cursos.ctp";
			include_once ROOT."template/footer.ctp";
		}
	}