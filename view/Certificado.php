<?php

	class Certificado extends Main implements interfaceController{

		private $action,
				$parameters;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Certificado";
		}

		public function index(){
			include_once ROOT."template/certificado-view.ctp";
		}

		public function getDataCertificate(){
			// $sql = "SELECT * FROM curso_categoria ORDER BY curso_categoria_nome ASC";
			// $query = $this->db->query($sql);
			// return $query->fetchAll();
		}
	}