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
    }