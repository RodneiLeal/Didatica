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

        public function updateCurriculo($table, $where_field, $where_field_value, $values){
            // if(is_string(
                
               $stmt = $this->db->update($table, $where_field, $where_field_value, $values); //)){
                
                
            //         return true;
            // }
            // return false;

            /********forma correta de funcionamento ----- ANALISAR ----******/
            
            $stmt = $this->db->update($table, $where_field, $where_field_value, $values);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }
    }
    