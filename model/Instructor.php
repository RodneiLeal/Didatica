<?php
    class Instructor extends User {

        protected   $idInstrutor,
                    $usuario_idUsuario,
                    $sobre,
                    $titulacao,
                    $formacao,
                    $instituicao,
                    $lates;

        function __construct(){
            parent::__construct();
            $this->idInstrutor       = NULL;
            $this->usuario_idUsuario = NULL;
            $this->sobre             = NULL;
            $this->titulacao         = NULL;
            $this->formacao          = NULL;
            $this->instituicao       = NULL;
            $this->lates             = NULL;
        }

        
        public function getInstrutor(){
            return $instrutor;
        }

        public function getIinstrutores(){
            $instrutores  = array();
            return $instrutores;
        }

        public function saveInstrutor(){
            return $result;
        }

    }
    