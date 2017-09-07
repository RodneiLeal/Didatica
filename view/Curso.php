<?php

	class Curso extends Main implements interfaceController{

		private $action,
				$parameters;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Curso";
		}

		public function index(){
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/curso.ctp";
			include_once ROOT."template/footer.ctp";

		}

	}