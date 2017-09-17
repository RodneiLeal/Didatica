<?php
    class Curso extends Main {

        protected $get,
                  $idCurso,
                  $instrutor_idInstrutor,
                  $subcategoria_idSubcategoria,
                  $subcategoria_categoria_idCategoria,
                  $titulo,
                  $resumo,
                  $ementa,
                  $imagem,
                  $data_cadastro,
                  $horas_minima;

        function __construct(){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
            $this->get 									= NULL;
            $this->idCurso 								= NULL;
            $this->instrutor_idInstrutor 				= NULL;
            $this->subcategoria_idSubcategoria 			= NULL;
            $this->subcategoria_categoria_idCategoria 	= NULL;
            $this->titulo 								= NULL;
            $this->resumo 								= NULL;
            $this->ementa 								= NULL;
            $this->imagem 								= NULL;
            $this->data_cadastro 						= NULL;
            $this->horas_minima 						= NULL;
        }

        public function getCursos(){
            $sql  = "SELECT t1.*, t2.categoria, t3.nome AS instrutor,";
            $sql .= "(SELECT COUNT(*) FROM avaliacao WHERE curso_idcurso = t1.idcurso) AS votantes, ";
            $sql .= "(SELECT AVG(estrelas) FROM avaliacao WHERE curso_idcurso = t1.idcurso ) AS media ";
            $sql .= "FROM curso AS t1 ";
            $sql .= "LEFT JOIN categoria AS t2 ON t1.categoria_idcategoria = t2.idcategoria ";
            $sql .= "LEFT JOIN usuario AS t3 ON t3.idusuario = t1.instrutor_idinstrutor";
            $stmt   =  $this->db->query($sql);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    