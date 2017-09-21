<?php

    class User extends Main{

        protected $get;
        
        function __construct(){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
        }

        public function login($pid, $passwd){
            $passwd = hash('sha256', $passwd);
            $sql    = "SELECT * FROM usuario WHERE (usuario.email = '{$pid}' OR usuario.nome = '{$pid}') AND usuario.pswd = '{$passwd}' LIMIT 1";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        
        public function saveUser($data){
            $result = $this->db->insert('usuario', $data);
            return $result;
        }

        public function findUser($email){
            $sql 	= "SELECT email FROM usuario WHERE email = '{$email}' LIMIT 1";
            $stmt 	= $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }