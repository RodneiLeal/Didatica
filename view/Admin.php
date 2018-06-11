<?php

    class Admin extends Main implements interfaceController{

		protected $curso,
				  $user;

		function __construct(){
			parent::__construct();
            $get	      = func_num_args()>=1?func_get_args():array();
            $this->action = $get[0];
			$this->param  = $get[1];
			$this->title  = SYS_NAME." - Administração";
			session_name('adm');
			session_start();
		}
		
		public function index(){
			if(empty($_SESSION)){
				include_once ROOT."template/admin/login.ctp";
				return;
			}
			include_once ROOT."template/admin/index.ctp";
		}
		
		public function painel(){
		}

	}