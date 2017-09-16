<?php

    class User extends Main{

        protected $get,
                  $id,
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
            $this->nome           = NULL;
            $this->email          = NULL;
            $this->pswd           = NULL;
            $this->foto           = NULL;
            $this->dataCadastro   = NULL;
            $this->rede           = NULL;
            $this->redeSocialID   = NULL;
            $this->locked         = NULL;
        }

        public function login($pid, $passwd){

            $passwd = md5($passwd);
            $sql    = "SELECT * FROM usuario WHERE (usuario.usuario_email = '{$pid}' OR usuario.usuario_nome = '{$pid}') AND usuario.usuario_pass = '{$passwd}' LIMIT 1";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // extract($result[0]);

            // $this->id             = $id;
            // $this->nome           = $nome;
            // $this->email          = $email;
            // $this->pswd           = $passwd;
            // $this->foto           = $foto;
            // $this->dataCadastro   = $dataCadastro;
            // $this->rede           = $rede;
            // $this->redeSocialID   = $redeSocialID;
            // $this->locked         = $locked;
            
            return $result;
        }
        
        public function registro($data){
            $result = $this->db->insert('usuario', $data);
            if($result){
                $result = $this->db->last_id;
            }
            return $result;
        }

        
        public function findUser($email){
            $sql 	= "SELECT usuario_email FROM usuario WHERE usuario_email = '{$email}' LIMIT 1";
            $stmt 	= $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // extract($result[0]);
    
            // $this->id             = $id;
            // $this->nome           = $nome;
            // $this->email          = $email;
            // $this->pswd           = $passwd;
            // $this->foto           = $foto;
            // $this->dataCadastro   = $dataCadastro;
            // $this->rede           = $rede;
            // $this->redeSocialID   = $redeSocialID;
            // $this->locked         = $locked;

            return $result;
        }

        
    }
    