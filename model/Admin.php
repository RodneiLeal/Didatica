<?php
    class Admin extends Main{

        public function get*****(){
            $sql     = "";
            $stmt    =  $this->db->query($sql);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }
        
    }
    