<?php

    class Adm extends Main{


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
                                 Recentemente você solicitou uma nova senha de acesso ao Painel ADM Didatica Online<br><br>
                                 Sua nova senha é: <strong>{$passwd}</strong>
                                 <br><br>
                                 Acesse seu painel de Administrativo e altere a senha gerada
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
            $user = trim($login['user']);
            $passwd = trim($login['pswd']);
            
            if(!isset($user) xor empty($user)){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'E-mail/Nome de usuário vazio',
                    'msg'=>'É necessario o e-mail ou nome de usuário para acessar o seu painel adminstrativo.'
                );
                $this->result = false;
                return;
            }
            
            if(!isset($passwd) or empty($passwd)){
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Campo senha está vazio',
                    'msg'=>'É necessario uma senha para acessar o seu painel adminstrativo.'
                );
                $this->result = false;
                return;
            }

            try{
                $sql    = "SELECT * FROM adm "; 
                $sql   .= "WHERE (adm.email = '{$user}' OR adm.username = '{$user}') ";
                $sql   .= "LIMIT 1";
                $stmt   = $this->db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(empty($result)){
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Desculpe,',
                        'msg'=>'este e-mail ou usuário não está cadastrado.'
                    );
                    return;
                }

                if(password_verify($passwd, $result[0]['pswd'])){
                    session_name('adm');
                    session_start();
                    $_SESSION = $result[0];
                    $this->msg = array(
                        'type'=>'success',
                        'title'=>'Olá '.$result[0]['username'],
                        'msg'=>''
                    );
                    $this->result = true;
                    return;
                }
                else{
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Desculpe,',
                        'msg'=>'a combinação de e-mail/usuário e senha não conhecidem'
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

        public function getSobre(){
            $sql = "SELECT * FROM didatica_db.sobre";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        }

        public function getConfig(){
            $sql = "SELECT * FROM didatica_db.config";
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        }

        public function setConfig($data){
            if($this->db->update('config',  @array_shift(array_keys($data)),  @array_shift($data), $data)){
                $this->msg = array(
                    'type'  =>'success',
                    'title' =>'Ok!.',
                    'msg'   =>'Informações atualizadas"'
                );
                $this->result = true;
                return;
            }
        }

        public function getSolicitacoes($idsolicitacao = NULL){
            $sql = "SELECT * FROM didatica_db.view_solicitacao ";
            if(!empty($idsolicitacao)){
                $sql .= "WHERE idsolicitacao = {$idsolicitacao}";
            }
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
        public function autorizarCurso($aut){
            $this->db->delete('solicitacao', @array_shift(array_keys($aut)), @array_shift($aut));
            if($aut['locked']){
                if($this->db->update('curso', @array_shift(array_keys($aut)), @array_shift($aut), $aut)){
                    $this->msg = array('type'=>'success', 'title'=>'Autorizado', 'msg'=>'Curso Autorizado');
                    $this->result = true;
                    return;
                }
            }
            $this->msg = array('type'=>'error', 'title'=>'Autorizacao', 'msg'=>'Curso não foi autorizado');
            $this->result = false;
            return;
        }

        public function autorizarInstrutor($aut){
            $this->db->delete('solicitacao', @array_shift(array_keys($aut)), @array_shift($aut));
            if($aut['tipo']){
                if($this->db->update('usuario', @array_shift(array_keys($aut)), @array_shift($aut), $aut)){
                    $this->msg = array('type'=>'success', 'title'=>'Autorizado', 'msg'=>'Usuário autorizado a publicar cursos.');
                    $this->result = true;
                    return;
                }
            }
            $this->msg = array('type'=>'error', 'title'=>'Autorizacao', 'msg'=>'Usuário não autorizado a publicar cursos.');
            $this->result = false;
            return;
        }

        public function resgatarCreditos($aut){
            if($this->crypt_verify($aut['debito'], $aut['referencia'])){
             $this->db->delete('solicitacao', @array_shift(array_keys($aut)), @array_shift($aut));
                if( $this->db->insert('carteira', $aut)&&($this->db->insert('debitos', ['valor'=>$aut['debito'], 'carteira_idcarteira'=>$this->db->last_id]))){
                    $this->msg = array('type'=>'success', 'title'=>'Transferência', 'msg'=>'Transferência registrada.');
                    $this->result = true;
                    return;
                }
            }
            $this->msg = array('type'=>'error', 'title'=>'Transferência', 'msg'=>'Transferência não registrada.');
            $this->result = false;
            return;
        }

        public function getCreditosApagar(){
            $sql  = "SELECT nome, ";
            $sql .= "(SELECT (SUM(credito) - SUM(debito)) ";
            $sql .= "FROM didatica_db.carteira ";
            $sql .= "WHERE carteira.instrutor_idinstrutor = view_instrutor.idinstrutor) ";
            $sql .= "AS saldo FROM view_instrutor";
            
            $stmt =  $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }