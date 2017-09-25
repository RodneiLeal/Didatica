<?php
    class Inscricao extends Main{

        function __construct(){
            parent::__construct();
            $get = func_num_args()>=1?func_get_args():array();
        }

        // SELECIONA TODAS AS INSCRIÇÕES EM UM DETEMINADO CURSO E PARA UM DETERMINADO USUARIO
        public function getInscricaoPorCursoUsuario($idusuario, $idcurso){
            $data    = array($idcurso, $idusuario);
            $sql     = "SELECT * FROM view_inscricao WHERE curso_idcurso = ? AND usuario_idusuario = ?";
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
            if(empty($result)){
                return false;
            }
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
    }
    