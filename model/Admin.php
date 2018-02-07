<?php
    class Admin extends Main{

        private $msg,
                $result;

        function __construct(){
            parent::__construct();
            $get = func_num_args()>=1?func_get_args():array();
        }

        public function getMsg(){
            return $this->msg;
        }

        public function getResult(){
            return $this->result;
        }

        public function buscaTransacaoCode($code){
            $data   = array($code);
            $sql    = "SELECT * FROM caixa WHERE code = ?";
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function buscaTransacaoInscr($inscr){
            $data   = array($inscr);
            $sql    = "SELECT * FROM caixa WHERE inscricao_idinscricao = ?";
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function gravarTransacao($data){
            if($this->db->insert('caixa', $data)){
                return $this->db->last_id;
            }
        }
        
        public function atualizarTransacao($where_field_value, $values){
            if(is_string($this->db->update('caixa', 'code', $where_field_value, $values))){
                return true;
            }
            return false;
        }

        public function pagarComissao($data){

            $sql    = 'SELECT * FROM didatica_db.view_inscricao WHERE idinscricao = '. $data['inscricao_idinscricao'];
            $stmt   = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $instrutor= $result[0]['instrutor_idinstrutor'];
            $ref      = $data['code'];
            $comissao = $data['valor']*COMISSAO;
            
            $data = array('instrutor_idinstrutor' => $instrutor,
                          'referencia' => $ref,
                          'credito' => $comissao);

            $this->db->insert('carteira', $data);
        }
    
        public function gerarCertificado($transacao){
            $idinscr = $transacao['items']['item']['id'];
            $code    = $transacao['code'];
            $codigo  = $idinscr.'/'.$code.'/'.hash('crc32b', $idinscr.$code);
            $data    = array( 'inscricao_idinscricao' => $idinscr, 'codigo' => $codigo);
            $this->db->insert('certificado', $data);
            return $this->db->last_id;
        }

        public function atualizaInscricao( $where_field_value, $values){
            if(is_string($this->db->update( 'inscricao', 'idinscricao', $where_field_value, $values))){
                return true;
            }
            return false;
        }

        public function validarCertificado($code){
            $inscr = new Inscricao;
            if((count($code = explode('/', $code))==3) && (hash('crc32b', $code[0].$code[1])==$code[2] && !empty($inscr = $inscr->getInscricaoId($code[0])[0]))){
                $this->result = '<p>Este certificado pertence a <strong>'.$inscr['usuario'].'</strong>, que concluiu de forma satisfatória o curso de <strong>'.$inscr['titulo'].'</strong> inicado em <strong>'.$this->formataData($inscr['data_inscricao']).'</strong> e concluido em <strong>'.$this->formataData($inscr['data_finalizacao']).'</strong></p>';
                $this->msg = array('type'=>'success', 'title'=>'Ceritificado válido', 'msg'=>'O código deste certificado é valido.');
            }else{
                $this->result = false;
                $this->msg = array('type'=>'error', 'title'=>'Certificado inválido', 'msg'=>'Este certificado não consta em nossa base de dados.');
            }
        }
    }