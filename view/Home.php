<?php

	class Home extends Main implements interfaceController{

		protected $curso,
				  $user;

		function __construct(){
			parent::__construct();
			$parameters	  = func_num_args()>=1?func_get_args():array();
			$this->title  = SYS_NAME." - Home";
			$this->user	  = new User;
			$this->cursos = new CursoModel; 

		}

		public function index(){
			session_start();
			extract($_SESSION);
			include_once ROOT."template/header.ctp";
			include_once ROOT."template/home.ctp";
			include_once ROOT."template/footer.ctp";
		}

	}