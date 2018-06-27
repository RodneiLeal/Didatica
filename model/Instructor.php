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
            $sql = 'SELECT * FROM usuario AS t1 JOIN view_instrutor AS t2 ON t1.idusuario = t2.usuario_idusuario WHERE t1.idusuario = ?';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        private function novo_instrutor($param){
            session_name('store');
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

        public function getCreditos($idinstrutor, $interval = 30){
            $data = array($idinstrutor, $interval);
            $sql  = 'SELECT SUM(carteira.credito) as creditos FROM carteira WHERE carteira.instrutor_idinstrutor = ? ';
            $sql .= 'AND carteira.data_registro > (NOW() - INTERVAL ? DAY)';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSaldo($idinstrutor){
            $data = array($idinstrutor);
            $sql  = 'SELECT (SUM(`carteira`.`credito`) - SUM(`carteira`.`debito`)) as saldo FROM carteira WHERE carteira.instrutor_idinstrutor = ? ';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getUltimoPagamento($idinstrutor){
            $data = array($idinstrutor);
            $sql  = 'SELECT carteira.data_registro, carteira.debito FROM carteira ';
            $sql .= 'WHERE carteira.data_registro = (SELECT MAX(carteira.data_registro) AS maior_data ';
            $sql .= 'FROM carteira WHERE carteira.instrutor_idinstrutor = ? AND carteira.debito <> 0)';
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function resgatarCreditos($idusuario){
            if($this->db->insert('solicitacao', $idusuario+['tipo'=>3])){
                $this->msg = array(
                    'type'=>'success',
                    'title'=>'Sua solicitação foi encaminhada!',
                    'msg'=>'Fique atento, enviaremos uma notificação assim que concluirmos o processo de transferência.'
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

        public function getConsultaResgateCredito($idusuario = NULL){
            $data = array($idusuario);
            $sql = "SELECT * FROM didatica_db.view_solicitacao WHERE usuario_idusuario = ? and tipo = 3";
            $stmt = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }
    }
    