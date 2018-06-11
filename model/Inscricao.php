<?php
    class Inscricao extends Main{

        private $result,
                $msg;

        function __construct(){
            parent::__construct();
            $get = func_num_args()>=1?func_get_args():array();
        }

        public function getResult(){
            return $this->result;
        }

        public function getMsg(){
            return $this->msg;
        }

        // SELECIONA INSCRIÇÃO POR UMA IDENTIFICAÇÃO
        public function getInscricaoId($idinscr){
            $data    = array($idinscr);
            $sql     = "SELECT * FROM view_inscricao WHERE idinscricao = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA TODAS AS INSCRIÇÕES EM UM DETEMINADO CURSO E PARA UM DETERMINADO USUARIO
        public function getInscricaoPorCursoUsuario($idusuario, $idcurso){
            $data    = array($idcurso, $idusuario);
            $sql     = "SELECT * FROM view_inscricao WHERE idcurso = ? AND usuario_idusuario = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA TODAS AS INSCRIÇÕES EM UM DETERMINADO CURSO
        public function getInscricoesPorCurso($idcurso){
            $data    = array($idcurso);
            $sql     = "SELECT * FROM view_inscricao WHERE idcurso = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA TODAS AS INSCRIÇÕES DE UM DETERMINADO USUARIO
        public function getInscricaoPorUsuario($idusuario){
            $data    = array($idusuario);
            $sql     = "SELECT * FROM view_inscricao WHERE usuario_idusuario = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // SELECIONA TODAS INSCRIÇÕES PARA OS CURSOS DE UM INSTRUTOR
        public function getInscricaoPorinstrutor($idinstrutor){
            $data    = array($idinstrutor);
            $sql     = "SELECT * FROM view_inscricao WHERE instrutor_idinstrutor = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function inscreverUsuario($data){
            session_name('store');
            session_start();
            $curso = new CursoModel;
            $curso = $curso->getCursoId($data['curso_idcurso'])[0];
            
            if($_SESSION['idusuario'] === $curso['idusuario']){
               $this->msg = array('type'=>'error', 'title'=>'Inscrição não permitida.', 'msg'=>'você não pode inscrever-se em seu proprio curso');
               $this->result = false;
            }
            else{
                if($this->db->insert('inscricao', $data)){
                    $this->msg = array('type'=>'success', 'title'=>'Inscrição realizada com sucesso.', 'msg'=>'Bons estudos.');
                    $this->result = $this->db->last_id;
                }
            }
        }
    }
    