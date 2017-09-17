<?php

	class Home extends Main implements interfaceController{

		protected $cursos;

		function __construct(){
			parent::__construct();
			$parameters	  = func_num_args()>=1?func_get_args():array();
			$this->title  = SYS_NAME." - Home";
			$this->cursos = new Curso; 

		}

		public function index(){
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/home.ctp";
			include_once ROOT."template/footer.ctp";

		}


	}