<?php
    class CursoModel extends Main {

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
            $sql     = "SELECT t1.*, t2.categoria, t3.nome AS instrutor, ";
            $sql    .= "(SELECT COUNT(*) FROM avaliacao WHERE curso_idcurso = t1.idcurso) AS votantes, ";
            $sql    .= "(SELECT AVG(estrelas) FROM avaliacao WHERE curso_idcurso = t1.idcurso ) AS media ";
            $sql    .= "FROM curso AS t1 ";
            $sql    .= "LEFT JOIN categoria AS t2 ON t1.categoria_idcategoria = t2.idcategoria ";
            $sql    .= "LEFT JOIN usuario AS t3 ON t3.idusuario = t1.instrutor_idinstrutor ";
            $sql    .= "WHERE t1.locked = 1";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getCurso($idcurso){
            $sql     = "SELECT t1.*, t2.categoria, t3.nome AS instrutor, t3.foto, ";
            $sql    .= "(SELECT COUNT(*) FROM avaliacao WHERE curso_idcurso = t1.idcurso) AS votantes, ";
            $sql    .= "(SELECT AVG(estrelas) FROM avaliacao WHERE curso_idcurso = t1.idcurso ) AS media ";
            $sql    .= "FROM curso AS t1 ";
            $sql    .= "LEFT JOIN categoria AS t2 ON t1.categoria_idcategoria = t2.idcategoria ";
            $sql    .= "LEFT JOIN usuario AS t3 ON t3.idusuario = t1.instrutor_idinstrutor ";
            $sql    .= "WHERE  t1.locked = 1 AND t1.idcurso = {$idcurso}";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getCursoComentarios($idcurso){
            $sql     = "SELECT t1.*, t2.nome FROM avaliacao AS t1 ";
            $sql    .= "LEFT JOIN usuario AS t2 ON t2.idusuario = t1.usuario_idusuario "; 
            $sql    .= "WHERE curso_idcurso = {$idcurso}";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        public function getInscricao($idusuario, $idcurso){
            $sql     = "SELECT * FROM inscricao WHERE curso_idcurso = {$idcurso} AND usuario_idusuario = {$idusuario}";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    