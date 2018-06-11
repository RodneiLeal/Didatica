<?php

	class Cursos extends Main implements interfaceController{
		
		private $cursos,
				$action,
				$param;
		
		
		
		function __construct(){
			parent::__construct();
			
			
			$get 				= func_num_args()>=1? func_get_args():array();
			$this->action		= $get[0];
			$this->param		= $get[1];
			$this->title 		= SYS_NAME." - Cursos";
			$this->cursos		= new CursoModel;

			
			// verificar se metodo get esta programado
			// verificar se metodo existe
			// chamar metodo passando o parametro adequado
			// retornar resultado
		}

		public function index(){
			session_name('store');
			session_start();
			extract($_SESSION);
			
			if(array_key_exists('search', $_GET)){
				$cursos = $this->cursos->searchCursos($_GET['search']);
				if($cursos){
					$msg = "<div class=\"col-md-12\">
								<h5 class=\" clearfix pull-left\" style=\"color:#fff\">
									Resultado da busca de cursos com a palavra ".$_GET['search']."
								</h5>
							</div>";
				}
				else{
					$msg = "<div class=\"col-md-12\">
								<h5 class=\" clearfix pull-left\" style=\"color:#fff\">
									infelizmente não temos nenhum curso com a palavra ".$_GET['search']."
								</h5>
							</div>";	
				}
			}
			else{
				$cursos = $this->cursos->getCursosPorCategoria($this->action, $this->param[0]);
				$categoria_curso = isset($this->param[0])?$this->param[0]:$this->action;
				
				
				if($cursos){

					$msg = "<div class=\"col-md-12\">
								<h1 class=\"page-title clearfix pull-left\">
									$categoria_curso
								</h1>
							</div>
					
							<div class=\"col-md-12\">
								<h5 class=\" clearfix pull-left\" style=\"color:#fff\">
									Os maiores especialistas em $categoria_curso
								</h5>
							</div>";
					}
					else{
						
						$msg = "<div class=\"col-md-12\">
									<h1 class=\"page-title clearfix pull-left\">
										$categoria_curso
									</h1>
								</div>
							
								<div class=\"col-md-12\">
									<h5 class=\" clearfix pull-left\" style=\"color:#fff\">
										Não encontramos nenhum curso para $categoria_curso
									</h5>
								</div>";
				}



			}


			include_once ROOT."template/header.ctp";
			include_once ROOT."template/cursos.ctp";
			include_once ROOT."template/footer.ctp";

		}
			
	}