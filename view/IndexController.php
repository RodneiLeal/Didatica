<?php
	
	interface interfaceController{
		public function index();
	}

	class IndexController{

		private $controller;
		
		function __construct(interfaceController $controller){
			$this->controller = $controller;
			$this->controller->index();
			return;
		}
	}