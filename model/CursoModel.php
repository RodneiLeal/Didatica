<?php
    class CursoModel extends Main {

        protected $get;

        function __construct(){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
        }


        // SELECIONA TODOS OS CURSOS
        public function getCursos(){
            $sql     = "SELECT * FROM view_cursos";
            $stmt    =  $this->db->query($sql);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA CURSOS POR INSTRUTOR
        public function getCursosInstrutor($idinstrutor){
            $data   =  array($idinstrutor);
            $sql    = "SELECT * FROM view_cursos WHERE instrutor_idinstrutor = ?";
            $stmt   = $this->db->query($sql, $data);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA CURSOS POR CATEGORIA
        public function getCursosPorCategoria($categoria){
            $data	 = array($categoria);
            $sql     = "SELECT * FROM view_cursos WHERE categoria = ?";
			$stmt	 = $this->db->query($sql, $data);
			$result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;;
        }
        
        // SELECIONA CURSO POR IDENTIFICAÇÃO(id)
        public function getCursoId($idcurso){
            $data   = array($idcurso);
            $sql    = "SELECT * FROM view_cursos where idcurso = ?";
            $stmt   =  $this->db->query($sql, $data);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA CURSO POR TITULO
        public function searchCursos(){
			$data	 = array($this->search);
            $sql	 = "SELECT * from view_cursos WHERE titulo LIKE '%?%'";
			$stmt	 = $this->db->query($sql, $data);
			$result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
		}

        // SELECIONA TODOS OS COMENTARIOS DE UM CURSO
        public function getCursoComentarios($idcurso){
            $data    = array($idcurso);
            $sql     = "SELECT t1.*, t2.nome, t2.foto AS avatar FROM avaliacao AS t1 ";
            $sql    .= "LEFT JOIN usuario AS t2 ON t2.idusuario = t1.usuario_idusuario "; 
            $sql    .= "WHERE curso_idcurso = ?";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function getCategorias(){
            $sql     =  "SELECT * FROM categoria";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function getAulas($idcurso){
            $data    = array($idcurso);
            $sql     =  "SELECT * FROM aula WHERE curso_idcurso = ?";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function getProvas($idinscricao){
            $data    = array($idinscricao);
            $sql     =  "SELECT * FROM exame WHERE inscricao_idinscricao = ?";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }
    }
    