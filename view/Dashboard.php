<?php

	class Dashboard extends Main implements interfaceController{

		private $action,
				$parameters;

		function __construct(){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->parameters = $get[1];
			$this->title = SYS_NAME." - Dashboard";
		}

		public function index(){
			
			// include_once ROOT.'controller/_db.php';        
			// include_once ROOT.'model/global.php';
			// include_once ROOT."template/dashboard-header.ctp";
			// include_once ROOT."template/dashboard-navigation.ctp";
			// include_once ROOT."views/dataTables.php";
			// include_once ROOT."template/dashboard-body.ctp";
			// include_once ROOT."template/dashboard-footer.ctp";

			include_once ROOT."template/dashboard.ctp";
		}


	}