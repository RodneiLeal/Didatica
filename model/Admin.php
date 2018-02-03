<?php
    class Admin extends Main{

        function __construct(){
            parent::__construct();
            $get = func_num_args()>=1?func_get_args():array();
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
    }