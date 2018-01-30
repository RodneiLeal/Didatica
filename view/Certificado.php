<?php

	class Certificado extends Main implements interfaceController{
		
		private $action,
				$param;
		
		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->param = $get[1];
			$this->title = SYS_NAME." - Certificado";
		}
		
		public function index(){
			include_once ROOT."template/certificado.pdf.ctp";
		}
	}