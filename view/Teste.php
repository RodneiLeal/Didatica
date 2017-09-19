<?php

	class Teste implements interfaceController{

		private $action,
				$param;

		function __construct(){
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->param = $get[1];
			$this->title = SYS_NAME." - Teste";
		}

		public function index(){
			include_once ROOT."template/teste.ctp";
		}
	}