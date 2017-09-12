<?php

	class Cursos extends Main implements interfaceController{

		private $action,
				$parameters,
				$search;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action		= $get[0];
			$this->parameters	= $get[1];
			$this->search		= $_GET;
			$this->title = SYS_NAME." - Cursos";
		}

		public function index(){
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/cursos.ctp";
			include_once ROOT."template/footer.ctp";
		}

		public function getCursos(){
			$data	= array($this->action);
			$sql	= "SELECT t1.*, t2.usuario_nome FROM curso AS t1, usuario AS t2 WHERE t1.curso_categoria_id = (SELECT curso_categoria_id FROM curso_categoria WHERE curso_categoria_nome = ? ) AND t2.usuario_id = t1.curso_usuario_id";
			$query	= $this->db->query($sql, $data);
			return $query->fetchAll();
		}

	}