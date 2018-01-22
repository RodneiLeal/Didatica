<?php
    class Instructor extends User {

        function __construct(){
            parent::__construct();
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

        public function saveCurriculo($data){
            return $this->db->insert('instrutor', $data);
        }
        
        public function saveBanckInformation($data){
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
            
            $data = array($data);
            $sql  = 'SELECT * FROM view_carteira WHERE instrutor = ?';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

            if(empty($result)){
                $_30 = $_15 = $_07 = $saldo = $ultimo_pagamento = 0;
                $resgate = '--';
            }else{
                extract($result);
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
    