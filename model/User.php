<?php

    class User extends Main{

        protected $get,
                  $id,
                  $tipo,
                  $nome,
                  $email,
                  $pswd,
                  $foto,
                  $dataCadastro,
                  $rede,
                  $redeSocialID,
                  $locked;
        
        
        function __construct(){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
            $this->id             = NULL;
            $this->tipo           = NULL;
            $this->nome           = NULL;
            $this->email          = NULL;
            $this->pswd           = NULL;
            $this->foto           = NULL;
            $this->dataCadastro   = NULL;
            $this->rede           = NULL;
            $this->redeSocialID   = NULL;
            $this->locked         = NULL;
        }

        private function setDataUser($data){
            extract($data);
            
            $this->id             = $idusuario;
            $this->tipo           = $tipo;
            $this->nome           = $nome;
            $this->email          = $email;
            $this->pswd           = $pswd;
            $this->foto           = $foto;
            $this->dataCadastro   = $dataCadastro;
            $this->rede           = $rede;
            $this->redeSocialID   = $redeSocialID;
            $this->locked         = $locked;

        }

        public function login($pid, $passwd){

            $passwd = hash('sha256', $passwd);
            $sql    = "SELECT * FROM usuario WHERE (usuario.email = '{$pid}' OR usuario.nome = '{$pid}') AND usuario.pswd = '{$passwd}' LIMIT 1";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            self::setDataUser($result[0]);
            
            return $result;
        }
        
        public function saveUser($data){
            $result = $this->db->insert('usuario', $data);
            if($result){
                $result = $this->db->last_id;
            }
            return $result;
        }

        
        public function findUser($email){
            $sql 	= "SELECT email FROM usuario WHERE email = '{$email}' LIMIT 1";
            $stmt 	= $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            self::setDataUser($result[0]);

            return $result;
        }

        
    }
    