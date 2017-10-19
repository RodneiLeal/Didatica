<?php

    class User extends Main{

        protected $get;
        
        function __construct(){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();
        }

        public function login($pid, $passwd){
            $passwd = hash('sha256', $passwd);
            $sql    = "SELECT * FROM usuario WHERE (usuario.email = '{$pid}' OR usuario.username = '{$pid}') AND usuario.pswd = '{$passwd}' LIMIT 1";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function getUserSocial($rede){
            $urlCallback = 'http://didatica.online/controllers/user/login.php?rede=';
            
            switch($rede){
                case 'facebook':
                    $config =  [
                        'callback' => $urlCallback.$rede,
                        'keys'     => [ 'key' => '159280651284190', 'secret' => 'd4043ce62d63f634064d32b0a967ca97' ]
                    ];
                break;
                case 'google':
                    $config = [
                        'callback' => $urlCallback.$rede,
                        'keys'     => [ 'key' => '540948825743-n8vqmgotkgl7cfetgkhh1911411mhcsc.apps.googleusercontent.com', 'secret' => 'izUV01B0E4Pkrrhs8o6EWgqM' ]
                    ];
                break;
                case 'linkedin':
                    $config = [
                        'callback' => $urlCallback.$rede,
                        'keys'     => [ 'key' => '772eq6xy5cqbub', 'secret' => 'YI9PeFJtODF4E2Zc' ]
                    ];
                break;
            }
            
            try{
                $hybridauth = new Hybridauth( $config );
                
                $adapter = $hybridauth->authenticate($rede);
                $userProfile = $adapter->getUserProfile();
                $adapter->disconnect();
            }catch(\Exception $e){
                echo 'Oops, we ran into an issue! ' . $e->getMessage();
            }

            $dataUser = array(
                'identifier'=> $userProfile->identifier,
                'email'     => $userProfile->email,
                'foto'      => $userProfile->photoUrl,
                'nome'      => $userProfile->firstName,
                'sobrenome' => $userProfile->lastName,
                'username'  => $userProfile->displayName
            );
    
            return $config;
        }
        
        public function saveUser($data){
            if($this->db->insert('usuario', $data)){
                $data = array($this->db->last_id);
                $sql = "SELECT * FROM usuario WHERE idusuario = ?";
                $stmt = $this->db->query($sql, $data);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(empty($result)){
                    return false;
                }
                return $result;
            }
            return false;
        }

        public function getUser($values, $limit = false){
            $set = array();
            $sql = "SELECT * FROM usuario ";
            
            if(!empty($values)  && is_array($values)){
                
                foreach($values as $column=>$value){
                    $set[] = " `$column` = ? ";
                }
                $where  = "WHERE ";
                $where .= implode(" AND ", $set);
                
                $data   =  array_values($values);
                $sql   .= $where;
            }
    
            if( $limit >= 1){
                $limit = "LIMIT $limit";
                $sql .= $limit;
            }

            $stmt 	= $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function updateUser($table, $where_field, $where_field_value, $values){
            if(is_string($this->db->update($table, $where_field, $where_field_value, $values))){
                return true;
            }
            return false;

            /********forma correta de funcionamento ----- ANALISAR ----******/
            
            // $stmt = $this->db->update($table, $where_field, $where_field_value, $values);
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            // return $result;
        }

    }