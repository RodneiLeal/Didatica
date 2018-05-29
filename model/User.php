<?php
    use \Hybridauth\Hybridauth;

    class User extends Main{

        protected $get;
        private $msg,
                $result;

        
        function __construct($action = null, $param = null){
            parent::__construct();

            if(!empty($action)) 
                $this->$action($param);
        }

        public function getResult(){
            return $this->result;
        }

        public function getMsg(){
            return $this->msg;
        }

        public function passRecovery($data){
            extract($data);
            $maiusculas = true;
            $numeros = true;
            $simbolos = false;
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
                                 Sua nova senha é: <strong>{$passwd}</strong>
                                 <br><br>
                                 Acesse seu painel de controle e altere a senha gerada
                                 <br><br>
                                 <br><br>
                                 <small>Está é uma mensagem automática, por favor, não responda</small>
                               ";

                    if($this->db->update('usuario', 'email', $email, array('pswd'=>password_hash($passwd, PASSWORD_BCRYPT)))){
                        if($this->EnviaEmail($email, $usuario_nome, 'Didatica Online - Solicitação de nova senha de acesso', $mensagem, '')){
                            $this->result = true;
                            $this->msg = array('type'=>'success', 'title'=>'Solicitação feita com sucesso.', 'msg'=>'Enviamos instruções de recuperação da sua conta para '.$email);
                        }
                    }
                } else {
                    $this->msg = array('type'=>'error', 'title'=>'Oops!', 'msg'=>'e-mail não cadastrado!');
                    $this->result = false;
                }
            }else{
                $this->msg = array('type'=>'error', 'title'=>'Oops!', 'msg'=>'e-mail inválido');
                $this->result = false;
            }
        }

        public function login($login){
            $pid = trim($login['pid']);
            $passwd = trim($login['passwd']);
            
            if(!isset($pid) xor empty($pid)){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'E-mail/Nome de usuário vazio',
                    'msg'=>'É necessario o e-mail ou nome de usuário para acessar o seu perfil.'
                );
                $this->result = false;
                return;
            }
            
            if(!isset($passwd) or empty($passwd)){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Campo senha está vazio',
                    'msg'=>'É necessario uma senha para acessar o seu perfil.'
                );
                $this->result = false;
                return;
            }

            try{
                $sql    = "SELECT * FROM usuario WHERE (usuario.email = '{$pid}' OR usuario.username = '{$pid}') LIMIT 1";
                $stmt   = $this->db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(empty($result)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Desculpe,',
                        'msg'=>'este e-mail ou usuario não está cadastrado.'
                    );
                    return;
                }

                if(password_verify($passwd, $result[0]['pswd'])){
                    session_start();
                    $_SESSION = $result[0];
                    $this->msg = array(
                        'type'=>'success',
                        'title'=>'Olá '.$_SESSION['username'],
                        'msg'=>''
                    );
                    $this->result = true;
                    return;
                }
                else{
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Desculpe,',
                        'msg'=>'a combinação de e-mail/usuario e senha não conhecidem'
                    );
                    return;
                }
            }catch(Exception $e){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops, parece que estamos com algum problema!',
                    'msg'=>$e->getMessage()
                );
            }
        }

        public function registrar(array $signupData){
            extract($signupData);
            try{
                /* verifica se um email foi informado */
                if(!isset($email) or empty($email)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'E-mail obrigatório',
                        'msg'=>'É nescessario informar um e-mail para se cadastrar'
                    );
                    return;
                }
                
                /* verifica se o email informado tem um formato valido */
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'E-mail inválido',
                        'msg'=>'É nescessario informar um e-mail válido para se cadastrar'
                    );
                    return;
                }
                
                /* verifica se existe um email informado */
                if($this->getUser(array('email'=>$email))[0]){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'E-mail já cadastrado!',
                        'msg'=>'Este e-mail já esta cadastrado, caso tenha esquecido sua senha, tente redefini-la clicando em "Esqueci minha senha"'
                    );
                    return;
                }

                /* verifica se um nome de usuario foi informado */
                if(!isset($username) xor empty($username)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Nome de usuário é obrigatório',
                        'msg'=>'O nome de usuário é obrigatório para identificar-se no sistema.'
                    );
                    return;
                }

                /* verifica se o nome de usuario ja exite */
                if(!empty($this->getUser(array('username'=>$username))[0])){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Nome de usuário inválido',
                        'msg'=>'Este nome de usuário ja esta em uso, por favor escolha outro!'
                    );
                    return;
                }
            
                /* Verifica se fo informado uma senha de acesso */
                if(!isset($passwd) xor empty($passwd)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Campo senha está vazio.',
                        'msg'=>'É necessario ter uma senha para acessar os seus curso e seus certificados.'
                    );
                    return;
                }

                /* cria um array com os dados informados */
                $dataUser = array(
                    'username'=>$username,
                    'email'=>$email,
                    'pswd'=>password_hash($passwd, PASSWORD_BCRYPT)
                );

                try{ /* tenta registrar o usuario com os dados informados e fazer o login com o mesmo */
                    $this->db->insert('usuario', $dataUser);
                    $this->login(array('pid'=>$email, 'passwd'=>$passwd));
                }catch(Exception $e){ 
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Oops, encontramos um problema!',
                        'msg'=>$e->getMessage()
                    );
                }

            }catch(Exception $e){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops, encontramos um problema!',
                    'msg'=>$e->getMessage()
                ); 
            }
        }
        
        public function getUser($values, $limit = false){
            $set = array();
            $sql = "SELECT * FROM usuario ";
            
            if(!empty($values) && is_array($values)){
                
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

            if(!file_exists('../../'.$path)){
                mkdir('../../'.$path);
            }

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
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'E-mail inválido',
                        'msg'=>'É nescessario informar um e-mail válido manutenção do seu perfil.'
                    );
                    return;
                }
            }
            
            if(isset($pswd)){
                $dataUser['pswd'] = password_hash($pswd, PASSWORD_BCRYPT);
            }else{
                unset($dataUser['pswd']);
            }

            if($this->db->update('usuario', @array_shift(array_keys($dataUser)), @array_shift($dataUser), $dataUser)){
                $this->msg    = array(
                    'type'=>'success',
                    'title'=>'Perfil atualizado',
                    'msg'=>'Seu Perfil foi atializado com sucesso!'
                );
                $this->result = true;
            }

            $data = array('idusuario'=>$idusuario);
            $user_update = $this->getUser($data, 1)[0];
            
            $_SESSION = $user_update;
        }

        public function sendMessage(array $dataMessage){
            session_start();

            if(empty($dataMessage['assunto'])){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops, encontramos um problema!',
                    'msg'=>'Qual o assunto da mensagem?'
                );
                $this->result = false;
                return;
            }

            if(empty($dataMessage['mensagem'])){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops, encontramos um problema!',
                    'msg'=>'Acho que faltou escrever a mensagem!'
                );
                $this->result = false;
                return;
            }

            try{ 
                $this->db->insert('mensagens', ['de'=>$_SESSION['idusuario']]+$dataMessage);
                $this->msg = array(
                    'type'=>'success',
                    'title'=>'Mensagem enviada.',
                    'msg'=>'Sua mensagem foi enviada com sucesso.'
                );
                $this->result = true;
            }catch(Exception $e){ 
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops, encontramos um problema!',
                    'msg'=>$e->getMessage()
                );
                $this->result = false;
            }
        }

        public function readerMessages($idmensagem=null, $all=false){
            @session_start();
            $data =  array($_SESSION['idusuario']);
            $sql = 'SELECT * FROM view_message WHERE para = ?';
            if(isset($idmensagem)){
                $data = array_merge($data, $idmensagem);
                $sql .= ' AND idmensagem = ?';
                try{
                    /* a data deve ser atualizada uma unica vez */
                    $data_leitura = array('data_leitura'=>date("Y-m-d H:i:s"), 'lida'=>1);
                    $this->db->update('mensagens', 'idmensagem', $idmensagem[0], $data_leitura);
                }catch(Exception $e){

                }
            }
            if($all){
                $sql .= ' AND lida = 0';
            }
        
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }