<?php

	class ViewController{

		private $controller, // pagina a ser executada 
				$action,     // ação a ser executada dentro da pagina
				$parameters; // parametros da ação 

			// URL exemplo: exemplo.com/controller/action/param1/param2/param3/...
		
		function __construct(){

			$this->get_url_data();

			if(!isset($this->controller)){
				$this->controller = "Home";
			}

			new IndexController(new $this->controller($this->action, $this->parameters));
		}

		private function chk_array ( $array, $key ) {
			if (isset($array[$key]) && !empty($array[$key])):
				return $array[$key];
			endif;
			return null;
		}

		private function get_url_data(){

			if(isset($_GET['path'])){
				$path = $_GET['path'];

				$path = rtrim($path, '/');
				// $path = filter_var($path, FILTER_SANITIZE_URL);
				$path = explode("/", $path);

				$this->controller  = str_replace(' ', '_', ucfirst($this->chk_array($path, 0)));

				$this->action 	   = $this->chk_array($path, 1);
				if($this->chk_array($path, 2)){
					unset($path[0]);
					unset($path[1]);
					$this->parameters = array_values($path);
				}
			}
		}
	}