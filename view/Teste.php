<?php

	class Teste implements interfaceController{

		private $action,
				$parameters;

		function __construct(){
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Teste";
		}

		public function index(){
			include_once ROOT."template/teste.ctp";
		}

		public function getDataCertificate(){
			// $sql = "SELECT * FROM curso_categoria ORDER BY curso_categoria_nome ASC";
			// $query = $this->db->query($sql);
			// return $query->fetchAll();
		}
	}