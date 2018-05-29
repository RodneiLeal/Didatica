<?php

	class Validar_certificado extends Main implements interfaceController{

		private $action,
				$parameters;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Validar Certificado";
		}

		public function index(){
			session_start();
			extract($_SESSION);
			include_once ROOT."template/valida-certificado.ctp";
		}
	}