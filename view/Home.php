<?php

	class Home extends Main implements interfaceController{

		function __construct(){
			parent::__construct();
			$parameters	 = func_num_args()>=1?func_get_args():array();
			$this->title = SYS_NAME." - Home";
		}

		public function index(){
			include_once ROOT."template/header.ctp";

			include 'controller/_db.php';
			include 'controller/_funcoes.php';
			include 'model/global.php';

			include_once ROOT."template/home.ctp";
			include_once ROOT."template/footer.ctp";
		}

	}