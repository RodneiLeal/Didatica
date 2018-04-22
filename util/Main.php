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
			$sql = "SELECT t1.idcategoria, t1.categoria FROM didatica_db.categoria AS t1, didatica_db.curso AS t2 WHERE t2.categoria_idcategoria = t1.idcategoria AND t2.locked = 1 GROUP BY t1.idcategoria";
			$query = $this->db->query($sql);
			return $query->fetchAll();
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

        public function formataData($data, $mode='d'){
            if(!empty($data)){
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
            return $data;
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

        public function object2array($object) { 
            return @json_decode(@json_encode($object),1); 
        }

        public function logMsg( $msg, $level = 'info', $file = 'return.log' ){
            // variável que vai armazenar o nível do log (INFO, WARNING ou ERROR)
            $levelStr = '';
            switch ( $level ){
                case 'info':
                    $levelStr = 'INFO';
                break;
                case 'warning':
                    $levelStr = 'WARNING';
                break;
                case 'error':
                    $levelStr = 'ERROR';
                break;
            }
        
            $date = date( 'Y-m-d H:i:s' );
        
            // formata a mensagem do log
            // 1o: data atual
            // 2o: nível da mensagem (INFO, WARNING ou ERROR)
            // 3o: a mensagem propriamente dita
            // 4o: uma quebra de linha
            $msg = sprintf( "[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL );
            file_put_contents( $file, $msg, FILE_APPEND );
        }

        public function EnviaEmail($destinatario_email, $destinatario_nome, $assunto, $mensagem, $link){ 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, MAILGUN_LINK);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                        array('from' => 'Didática Online Contato <nao-responda@didaticaonline.com.br>',
                            'to' => $destinatario_nome .'<'.$destinatario_email.'>',
                            'subject' => $assunto,
                            'html' => $mensagem));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
    }
    