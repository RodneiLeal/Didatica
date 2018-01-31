<?php
    class Admin extends Main{

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


        /**
         * Gera um codigo para o certificado e grava este no banco de dados
         * 
         * @since 0.1
         * @access public
         * @param array $data são os dados a serem inseridos na tabela
         * @return int id ultimo valor de identificação da gravação no banco de dados 
         */
        public function gerarCertificado($data){
            
            // gera um codigo unico para identificação do certificado
            $codigo = hash();

            // prepara os dados para gravação
            $data = array( 'inscricao_idinscricao' => $inscr, 'codigo' => $codigo);

            // grava informações no banco de dados
            $this->db->insert('certificado', $data);

            // pega a ultima identificação da gravação no banco de dados
            $this->db->lastId;
        }
    }