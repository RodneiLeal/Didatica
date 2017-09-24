<?php

	class Dashboard extends Main implements interfaceController{

		private $action,
				$parameters,
				$instructor;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Dashboard";
			$this->instructor = new Instructor;

		}

		public function index(){
			include_once ROOT."template/dashboard.ctp";
		}


	}