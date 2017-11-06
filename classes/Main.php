<?php

    class Main{

        protected   $title,
                    $db;

        function __construct(){
			$this->db = new dbc();
        }

        public function getTitle(){
			return $this->title;
        }
        
        public function solicitacao($data){
            return $this->db->insert('solicitacao', $data);
        }

        public function getCategoriaCursos(){
			$sql = "SELECT * FROM categoria ORDER BY categoria ASC";
			$query = $this->db->query($sql);
			return $query->fetchAll();
        }

        public function getSubcategoriaCursos($idsubcategoria=null){
            $sql    = "SELECT * FROM subcategoria  ";
            if(isset($idsubcategoria)){
                $sql   .= "WHERE categoria_idcategoria = {$idsubcategoria} ";
            }
            $sql   .= "ORDER BY subcategoria ASC";
            $query   = $this->db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getBancos($idbanco = false){
            $sql   = "SELECT * FROM bancos ";
            $whare = "WHARE idbancos = {$idbanco} ";
            $order = "ORDER BY codigo ASC";

            if($idbanco){
                $sql .= $whare;
            }

            $sql .= $order;
			$query = $this->db->query($sql);
			return $query->fetchAll();
        }

        public function formataData($data, $mode){
            $data = new DateTime($data);
            switch($mode){
                case 'dh':
                    return $data->format('d/m/Y H:i:s');
                case 'd':
                    return $data->format('d/m/Y');
                default:
                    return $data->format('d/m/Y');
            }
        }
        
        public function preparaURL($string){
            $table = array(
                    'Š'=>'S', 'š'=>'s', 'Ð'=>'D', 'd'=>'d', 'Ž'=>'Z',
                    'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
                    'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
                    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
                    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
                    'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
                    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
                    'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
                    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
                    'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
                    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
                    'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
                    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
                    'ÿ'=>'y', 'R'=>'R', 'r'=>'r',
                );

                $string = strtr($string, $table);
                $string = strtolower($string);
                $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
                $string = preg_replace("/[\s-]+/", " ", $string);
                $string = preg_replace("/[\s_]/", "-", $string);
                return $string;
        }
        
    }
    