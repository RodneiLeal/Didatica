<?php

    class User extends Main{

        protected $get;
        private $msg,
                $result;

        
        function __construct($action = null, $param = null){
            parent::__construct();

            if(!empty($action)) 
                $this->$action($param); /* todas as ações deverão passar por esta variavel */

        }

        public function getResult(){
            return $this->result;
        }

        public function getMsg(){
            return $this->msg;
        }

        public function passRecovery($email, $maiusculas = true, $numeros = true, $simbolos = false){

            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                if($usuario = $this->getUser(array('email'=>$email))[0]){

                    extract($usuario);

                    $lmin = 'abcdefghijklmnopqrstuvwxyz';
                    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $num = '1234567890';
                    $simb = '!@#$%';

                    $passwd = '';
                    $caracteres = '';
                    $caracteres .= $lmin;

                    if ($maiusculas) $caracteres .= $lmai;
                    if ($numeros) $caracteres .= $num;
                    if ($simbolos) $caracteres .= $simb;

                    $len = strlen($caracteres);
                    
                    for ($n = 1; $n <= 10; $n++){
                        $rand = mt_rand(1, $len);
                        $passwd .= $caracteres[$rand-1];
                    }

                    $usuario_nome = $nome.' '.$sobrenome;
                    
                    $mensagem = "Olá, {$usuario_nome}.
                                 <br><br>
                                 Recentemente você solicitou uma nova senha de acesso à Didatica Online<br><br>
                                 Sua nova senha é: {$passwd}
                                 <br><br>
                                 Acesse seu painel de controle e altere a senha gerada
                                 <br><br>
                                 <br><br>
                                 <small>Está é uma mensagem automática, por favor, não responda</small>
                               ";

                    if($this->db->update('usuario', 'email', $email, array('pswd'=>hash('sha256', $passwd)))){
                        if($this->EnviaEmail($email, $usuario_nome, 'Didatica Online - Solicitação de nova senha de acesso', $mensagem, '')){
                            $this->result = $passwd;
                            $this->msg = array('type'=>'success', 'title'=>'Solicitação feita com sucesso.', 'msg'=>'Enviamos instruções de recuperação da sua conta para '.$email);
                        }
                    }
                } else {
                    $this->msg = array('type'=>'error', 'title'=>'', 'msg'=>'e-mail não cadastrado!');
                }
            }else{
                $this->msg = array('type'=>'error', 'title'=>'', 'msg'=>'e-mail inválido');
            }
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

        public function updateUser(array $dataUser){
            session_start();
            extract($dataUser);
            
            $src = $foto;
            $path =  'uploads/users/'.$_SESSION['username'].'/';

            if($_SESSION['username'] != $username && rename('../../'.$path, '../../uploads/users/'.$username)){
                $path = str_replace($_SESSION['username'], $username, $path);
                $dataUser['foto'] = str_replace($_SESSION['username'], $username, $foto);
            }
            
            if($_SESSION['foto'] != $foto){
                $dataUser['foto'] = str_replace('bucket/', $path, $src);
                rename('../../'.$src, '../../'.$dataUser['foto']);
            }

            if($email == $_SESSION['email']){
                unset($dataUser['email']);
            }else{
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo '0__';
                    exit;
                }
            }
            
            if(isset($pswd)){
                $dataUser['pswd'] = hash('sha256', $pswd);
            }else{
                unset($dataUser['pswd']);
            }

            if($this->db->update('usuario', @array_shift(array_keys($dataUser)), @array_shift($dataUser), $dataUser)){
                $this->result = true;
                $this->msg    = array('type'=>'success', 'title'=>'Perfil atualizado',  'msg'=>'Seu Perfil foi atializado com sucesso!');
            }

            $data = array('idusuario'=>$idusuario);
            $user_update = $this->getUser($data, 1)[0];
            
            $_SESSION = $user_update;
        }

    }