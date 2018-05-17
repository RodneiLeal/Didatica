<?php
    class Instructor extends User {

        private $msg,
                $result;

        function __construct($action = null, $param = null){
            parent::__construct();

            if(!empty($action)) 
                $this->$action($param);
        }

        public function getMsg(){
            return $this->msg;
        }

        public function getResult(){
            return $this->result;
        }
        
        public function getInstrutor($idusuario){
            $data   = array($idusuario);
            $sql    = "SELECT * FROM view_instrutor WHERE usuario_idusuario = ?";
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function getSolicitacaoInstrutor($idusuario){
            $data   = array($idusuario);
            $sql    = "SELECT * FROM solicitacao WHERE usuario_idusuario = ? ";
            $sql   .= "AND tipo = 1";
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function perfil($idusuario){
            $data = array($idusuario);
            $sql = 'SELECT * FROM usuario AS t1 LEFT JOIN instrutor AS t2 ON t1.idusuario = t2.usuario_idusuario WHERE t1.idusuario = ?';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        private function novo_instrutor($param){
            session_start();
            $perfil    = ['idusuario'=>$_SESSION['idusuario']]+$param['perfil'];
            $conta     = ['usuario_idusuario'=>$_SESSION['idusuario']]+$param['conta'];
            $curriculo = ['usuario_idusuario'=>$_SESSION['idusuario']]+$param['curriculo'];

            if(self::atualizar_perfil($perfil)&&
               self::salvar_curriculo($curriculo)&&
               self::salvar_conta($conta)&&
               $this->solicitacao(['usuario_idusuario'=>$_SESSION['idusuario'], 'tipo'=>1])
            ){
                $this->msg = array(
                    'type'=>'success',
                    'title'=>'Sua solicitação foi encaminhada!',
                    'msg'=>'Fique atento, enviaremos uma mensagem assim que concluirmos o processo de anáise das informações enviadas.'
                );
                $this->result = true;
                return;
            }
             
            $this->msg = array(
                'type'=>'error',
                'title'=>'Oops!',
                'msg'=>'Aconteceu algo errado!'
            );
            $this->result = false;
            return;
        }

        private function atualizar_perfil($data){
            return $this->db->update('usuario', @array_shift(array_keys($data)), @array_shift($data), $data);
        }

        private function salvar_curriculo($data){
            return $this->db->insert('instrutor', $data);
        }
        
        private function salvar_conta($data){
            return $this->db->insert('conta', $data);
        }

        public function updateCurriculo($table, $where_field, $where_field_value, $values){
            $stmt = $this->db->update($table, $where_field, $where_field_value, $values);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }
        
        public function updateBanckInformation($table, $where_field, $where_field_value, $values){
            $stmt = $this->db->update($table, $where_field, $where_field_value, $values);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }

        public function resumoFinanceiro($data){
            $_30 = $_15 = $_07 = $saldo = $ultimo_pagamento = number_format(0, 2, ',', '.');
            $data = array($data);
            $sql  = 'SELECT * FROM view_carteira WHERE instrutor = ?';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($result)){
                extract($result[0]);
                $_30     = number_format($_30, 2, ',', '.');
                $_15     = number_format($_15, 2, ',', '.');
                $_07     = number_format($_07, 2, ',', '.');
                $saldo   = number_format($saldo, 2, ',', '.');
                $ultimo_pagamento   = number_format($ultimo_pagamento, 2, ',', '.');
            }

            $html = "<div class=\"row\"> 
                        <div class=\"col-md-9\"> 
                            <div class=\"small-box bg-primary\"> 
                                <div class=\"inner\"> 
                                    <h3>Ganhos estimados</h3> 
                                    <div class=\"row\"> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 30 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_30}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 15 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_15}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                        <div class=\"col-md-4\"> 
                                            <div class=\"inner\"> 
                                                <h5>Últimos 7 dias</h5> 
                                                <p class=\"painel-financeiro\">R$ {$_07}</p> 
                                                <p style=\"font-size: 1px;\"><br></p> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
 
                        <div class=\"col-md-3\"> 
                            <div class=\"small-box bg-primary\"> 
                                <div class=\"inner\"> 
                                    <h3>Saldo atual</h3> 
                                    <p class=\"painel-financeiro\">R$ {$saldo}</p> 
                                    <p style=\"font-size: 13px;\">Último pagamento 
                                        <br> 
                                    valor: R$ {$ultimo_pagamento} 
                                    </p> 
                                </div> 
                            </div> 
                        </div> 
                    </div>";

            return $html;
        }
    }
    