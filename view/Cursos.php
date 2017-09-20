<?php

	class Cursos extends Main implements interfaceController{

		private $action,
				$parameters,
				$search;

		function __construct(){
			parent::__construct();
			$get 				= func_num_args()>=1? func_get_args():array();
			$this->action		= $get[0];
			$this->parameters	= $get[1];
			$this->search		= $_GET['search'];
			$this->title 		= SYS_NAME." - Cursos";
		}

		public function index(){
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/cursos.ctp";
			include_once ROOT."template/footer.ctp";
		}
	}