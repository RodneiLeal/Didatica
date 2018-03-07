<?php
    class CursoModel extends Main {

        protected $get;
        private $msg,
                $result;

        function __construct($action = null, $param = null){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
        }

        public function getMsg(){
            return $this->msg;
        }

        public function getResult(){
            return $this->result;
        }

        // SELECIONA TODOS OS CURSOS
        public function getCursos(){
            $sql     = "SELECT * FROM view_cursos WHERE locked = 1";
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
            return $result;
        }

        // SELECIONA CURSOS POR CATEGORIA
        public function getCursosPorCategoria($categoria, $subcategoria=null){
            if(!empty($subcategoria)){
                $data	 = array($subcategoria);
                $sql     = "SELECT * FROM view_cursos WHERE subcategoria = ? AND locked = 1";
            }else{
                $data	 = array($categoria);
                $sql     = "SELECT * FROM view_cursos WHERE categoria = ? AND locked = 1";
            }
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
        public function searchCursos($word){
			// $data	 = array($word);
            $sql	 = "SELECT * from view_cursos WHERE titulo LIKE '%$word%' AND locked = 1";
			$stmt	 = $this->db->query($sql);
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
            $sql    .= "WHERE curso_idcurso = ? ";
            $sql    .= " AND locked = 1";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // BUSCA TODAS CATEGORIAS DE CURSOS
        public function getCategorias(){
            $sql     =  "SELECT * FROM categoria";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // BUSCA TODAS AS AULAS DE UM CURSO
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

        // SALVA UM NOVO CURSO NO BANCO DE DADOS
        public function salvaCurso($data){
            if($this->db->insert('curso', $data)){
                return $this->db->last_id;
            }
            return false;
        }

        // SALVA TODAS AS AULAS DE UM CURSO 
        public function salvaAulas($data){
            if($this->db->insert('aula', $data)){
                return $this->db->last_id;
            }
            return false;
        }

        // SALVA TODAS AS QUESTÕES PARA PROVA DE UM DETERMINADO CURSO
        public function salvaQuestoes($data){
            if($this->db->insert('db_questoes', $data)){
                return $this->db->last_id;
            }
            return false;
        }

        // ATUALIZAR BANCO DE QUESTÕES DE UM CURSO
        public function atualizaQuestoes($data){
            var_dump($data);
        }

        // SELECIONA ALEATORIAMENTE UM NUMERO DE QUESTÕES PARA MONTAR A PROVA DO CURSO 
        public function getQuestoes($idcurso, $limite=null){
            $data    = array($idcurso);
            $sql     =  "SELECT * FROM db_questoes WHERE curso_idcurso = ?";
            if(isset($limite))
                $sql .= " ORDER BY RAND() LIMIT $limite";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // CONFERE SE UM QUESTÃO ESTA CERTA OU ERRADA
        public function confereQuestao($data){
            $sql     = "SELECT if(resposta = ?, TRUE, FALSE) as resposta, ";
            $sql    .= "resposta AS correta FROM db_questoes ";
            $sql    .= "WHERE id_questao = ? and curso_idcurso = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // BUSCA TODAS AS PROVAS REALIZADAS POR UM USUARIO INSCRITO EM UM CURSO
        public function getProvas($idinscricao){
            $data    = array($idinscricao);
            $sql     = "SELECT * FROM didatica_db.exame WHERE inscricao_idinscricao = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // SALVA A PROVOA DO USUARIO ATUAL NO BANCO DE DADOS
        public function salvaProva($data){
            if($this->db->insert('exame', $data)){
                return $this->db->last_id;
            }
            return false;
        }

        public function updateCurso($dataCurso){

            if(is_string($this->db->update('curso', $where_field, $where_field_value, $values))){
                return true;
            }
            return false;
        }
        
        public function updateAula($where_field, $where_field_value, $values){
            if(is_string($this->db->update('aula', $where_field, $where_field_value, $values))){
                return true;
            }
            return false;
        }
    }
    