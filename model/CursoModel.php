<?php
    class CursoModel extends Main {

        protected $get;
        private $msg,
                $result;

        function __construct($action = null, $param = null){
            parent::__construct();
            $this->get = func_num_args()>=1?func_get_args():array();

             if(!empty($action)) 
                $this->$action($param);
        }

        public function getMsg(){
            return $this->msg;
        }

        public function getResult(){
            return $this->result;
        }

        // SELECIONA TODOS OS CURSOS
        public function getCursos(){
            $sql     = "SELECT * FROM view_cursos WHERE locked = 1";
            $stmt    =  $this->db->query($sql);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA CURSOS POR INSTRUTOR
        public function getCursosInstrutor($idinstrutor){
            $data   =  array($idinstrutor);
            $sql    = "SELECT * FROM view_cursos WHERE instrutor_idinstrutor = ?";
            $stmt   = $this->db->query($sql, $data);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // SELECIONA CURSOS POR CATEGORIA
        public function getCursosPorCategoria($categoria, $subcategoria=null){
            if(!empty($subcategoria)){
                $data	 = array($subcategoria);
                $sql     = "SELECT * FROM view_cursos WHERE subcategoria = ? AND locked = 1";
            }else{
                $data	 = array($categoria);
                $sql     = "SELECT * FROM view_cursos WHERE categoria = ? AND locked = 1";
            }
			$stmt	 = $this->db->query($sql, $data);
			$result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;;
        }
        
        // SELECIONA CURSO POR IDENTIFICAÇÃO(id)
        public function getCursoId($idcurso){
            $data   = array($idcurso);
            $sql    = "SELECT * FROM view_cursos where idcurso = ?";
            $stmt   =  $this->db->query($sql, $data);
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SELECIONA CURSO POR TITULO
        public function searchCursos($word){
            $sql	 = "SELECT * from view_cursos WHERE titulo LIKE '%$word%' AND locked = 1";
			$stmt	 = $this->db->query($sql);
			$result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
		}

        // SELECIONA TODOS OS COMENTARIOS DE UM CURSO
        public function getCursoComentarios($idcurso){
            $data    = array($idcurso);
            $sql     = "SELECT t1.*, t2.nome, t2.foto AS avatar FROM avaliacao AS t1 ";
            $sql    .= "LEFT JOIN usuario AS t2 ON t2.idusuario = t1.usuario_idusuario "; 
            $sql    .= "WHERE curso_idcurso = ? ";
            $sql    .= " AND locked = 1";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // BUSCA TODAS CATEGORIAS DE CURSOS
        public function getCategorias(){
            $sql     =  "SELECT * FROM categoria";
            $stmt    =  $this->db->query($sql);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // BUSCA TODAS AS AULAS DE UM CURSO
        public function getAulas($idcurso){
            $data    = array($idcurso);
            $sql     =  "SELECT * FROM aula WHERE curso_idcurso = ?";
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // SALVA UM CURSO NO BANCO DE DADOS
        public function salvar_curso($data){
            session_name('store');
            session_start();
            $instrutor = new Instructor;
            $path   = 'uploads/users/'.$_SESSION['username'].'/cursos/'.$data['titulo'].'/';
            
            if(!file_exists($path)){
                @mkdir(ROOT.$path, 0777, true);
            }

            $instrutor = $instrutor->perfil($_SESSION['idusuario'])[0];
            $src = $data['imagem'];
            $data['imagem'] = str_replace('bucket/', $path, $data['imagem']);
            $data = array_merge($data, ['instrutor_idinstrutor'=>$instrutor['idinstrutor']]);
            $data = array_filter($data);

            if(!isset($data['idcurso'])){
                $data = array_merge($data, ['imagem'=>'img/curso/no-image.jpeg']);
                if(($this->db->insert('curso', $data))){
                    $this->result = $this->db->last_id;
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Curso salvo.',
                        'msg'   =>'Seu novo curso foi salvo como rascunho, quando concluir todas as etapas seguintes clique em "Enviar para análise."'
                    );
                    return;
                }
            }
            else{ 
                // $data = array_merge($data, ['locked'=>0]);
                $this->result = $data['idcurso'];

                if(isset($data['imagem'])){
                    rename('../../'.$src, '../../'.$data['imagem']);
                }

                if($this->db->update('curso',  @array_shift(array_keys($data)),  @array_shift($data), $data)){
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Curso atuallizado.',
                        'msg'   =>'As informações do seu curso foram atualizadas, no entanto é necessário enviar novamente para análise"'
                    );
                    return;
                }
            }

            $this->result = false;
            $this->msg = array(
                'type'  =>'error',
                'title' =>'Oops!',
                'msg'   =>'Algo deu errado ao tentar salvar o seu curso.'
            );
            return;
        }

        // SALVA TODAS AS AULAS DE UM CURSO 
        public function salvar_aulas($data){
            session_name('store');
            session_start();

            $curso = self::getCursoId($data['curso_idcurso'])[0];
            $path   = 'uploads/users/'.$_SESSION['username'].'/cursos/'.$curso['titulo'].'/';
            $arquivo = $data['arquivo'];
            unset($data['arquivo']);
            $data = array_merge($data, ['arquivo'=>$path.$arquivo['name']]);
            $data = array_filter($data);

            if(!isset($data['titulo'])){
                $this->result = false;
                $this->msg = array(
                    'type'  =>'error',
                    'title' =>'Oops, faltou o titulo!',
                    'msg'   =>'Sua aula precisa de um titulo.'
                );
                return;
            }

            if(!isset($data['objetivos'])){
                $this->result = false;
                $this->msg = array(
                    'type'  =>'error',
                    'title' =>'Xiii, faltou o resumo!',
                    'msg'   =>'É necessário que você faça um resumo da sua aula, isso ajudará muito os seu alunos.'
                );
                return;
            }

            if(empty($arquivo['name'])){
                $this->result = false;
                $this->msg = array(
                    'type'  =>'error',
                    'title' =>'Nossa, você esqueceu de adicionar o material!',
                    'msg'   =>'O material é muito importante para seus alunos poderem estudar.'
                );
                return;
            }
            
            if (!isset($data['idaula'])) {
               if(move_uploaded_file($arquivo['tmp_name'], '../../'.$path.$arquivo['name']) && ($this->db->insert('aula', $data))){
                    $this->result = true;
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Aula salva.',
                        'msg'   =>'Esta aula foi salva como rascunho, quando concluir todas as etapas seguintes clique em "Enviar para análise."'
                    );
                    return;
                }
            }
            else{
                $this->result = true;
                if(move_uploaded_file($arquivo['tmp_name'], '../../'.$path.$arquivo['name']) && $this->db->update('aula',  @array_shift(array_keys($data)),  @array_shift($data), $data)){
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Aula atuallizada.',
                        'msg'   =>'As informações desta aula foram atualizadas"'
                    );
                    return;
                }
            }

            $this->result = false;
            $this->msg = array(
                'type'  =>'error',
                'title' =>'Oops!',
                'msg'   =>'Algo deu errado ao tentar salvar esta aula.'
            );
            return;
        }

        // SALVA TODAS AS QUESTÕES PARA PROVA DE UM DETERMINADO CURSO
        public function salvar_questoes($data){
            extract($data);

            foreach($questoes as $questao){
                $questao = array_merge($questao, ['curso_idcurso'=>$data['curso_idcurso']]);
                $questao = array_filter($questao);
                
                #verificar antes de inserir ou atualizar
                // se questao não é vazia, se existe no minimo 3 opções e se tem uma resposta para estas opções

                if(!isset(
                    $questao['questao'], 
                    $questao['opcao_1'],
                    $questao['opcao_2'], 
                    $questao['opcao_3'],
                    $questao['resposta']
                )){
                    $this->result = false;
                    $this->msg = array(
                        'type'  =>'error',
                        'title' =>'Oops!',
                        'msg'   =>'Parece que você tem questões incompletas ou vazias.'
                    );
                    return;
                }

                if(isset($questao['id_questao']) && $this->db->update('db_questoes',  @array_shift(array_keys($questao)),  @array_shift($questao), $questao)){
                    $this->result = true;
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Questão atualizada',
                        'msg'   =>'Esta questão foi atualizada com sucesso!'
                    );
                    return;
                }
                else{

                    $this->db->insert('db_questoes', $questao);

                    $this->result = true;
                    $this->msg = array(
                        'type'  =>'success',
                        'title' =>'Questões salvas',
                        'msg'   =>'Suas questões foram adicionadas ao banco de questões do curso.'
                    );
                }
            }
        }

        // ATUALIZAR BANCO DE QUESTÕES DE UM CURSO
        public function atualizaQuestoes($data){
            var_dump($data);
        }

        // RECUPERA TODAS AS QUESTÕES DE UM CURSO OU SELECIONA ALEATORIAMENTE UM NUMERO DE QUESTÕES PARA MONTAR UMA PROVA 
        public function getQuestoes($idcurso, $id_questao=null, $limite=null){
            $data    = array($idcurso);
            $sql     =  "SELECT * FROM db_questoes WHERE curso_idcurso = ?";

            if(isset($id_questao))
                $sql .= " AND id_questao = $id_questao";

            if(isset($limite))
                $sql .= " ORDER BY RAND() LIMIT $limite";
                
            $stmt    =  $this->db->query($sql, $data);
            $result  =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        // CONFERE SE UM QUESTÃO ESTA CERTA OU ERRADA
        public function confereQuestao($data){
            $sql     = "SELECT if(resposta = ?, TRUE, FALSE) as resposta, ";
            $sql    .= "resposta AS correta FROM db_questoes ";
            $sql    .= "WHERE id_questao = ? and curso_idcurso = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // BUSCA TODAS AS PROVAS REALIZADAS POR UM USUARIO INSCRITO EM UM CURSO
        public function getProvas($idinscricao){
            $data    = array($idinscricao);
            $sql     = "SELECT * FROM didatica_db.exame WHERE inscricao_idinscricao = ?";
            $stmt    = $this->db->query($sql, $data);
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // SALVA A PROVOA DO USUARIO ATUAL NO BANCO DE DADOS
        public function salvaProva($data){
            if($this->db->insert('exame', $data)){
                return $this->db->last_id;
            }
            return false;
        }

        public function getSolicitacaoAnalise($idcurso){
            $data   = array($idcurso);
            $sql    = "SELECT * FROM solicitacao WHERE curso_idcurso = ? ";
            $sql   .= "AND tipo = 2";
            $stmt   = $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return false;
            }
            return $result;
        }

        public function analisar_curso($data){
            session_name('store');
            session_start();
            // var_dump(['usuario_idusuario'=>$_SESSION['idusuario'], 'tipo'=>2]+$data);

            if($this->solicitacao(['usuario_idusuario'=>$_SESSION['idusuario'], 'tipo'=>2] + $data)){
                $this->msg = array(
                    'type'=>'success',
                    'title'=>'Solicitação de anáise encaminhada!',
                    'msg'=>'Seu curso foi enviado para análise. Assim que seu curso for aprovado ele aparecerá na página principal juntamente com os cursos em destaque.<br>Caso haja algum problema com seu curso você será notificado no campo de mensagens das correções necessarias a serem feitas.<br><br>Boa sorte!'
                );
                $this->result = true;
                return;
            }
        }
        
        public function comentario($comentario){

            if(empty($comentario['comentario'])){
                 $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops!',
                    'msg'=>'Seu comentario precisa de um titulo!'
                );
                return;
            }

            $data = array($comentario['usuario_idusuario'], $comentario['curso_idcurso']);
            $sql  = 'SELECT * FROM didatica_db.avaliacao WHERE usuario_idusuario = ? AND curso_idcurso = ?';
            $stmt =  $this->db->query($sql, $data);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!isset($comentario['estrelas'])){
                 $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops!',
                    'msg'=>'É preciso dar uma nota para completar sua avaliação.'
                );
                return;
            }

            if(empty($result)){
                if($this->db->insert('avaliacao', $comentario)){
                    $this->msg = array(
                        'type'=>'success',
                        'title'=>'Comentario registrado.',
                        'msg'=>'Agradecemos o seu comentario.'
                    );
                    $this->result = $this->db->last_id;
                    return;
                }
                else{
                    $this->msg = array(
                        'type'=>'error',
                        'title'=>'Oops!',
                        'msg'=>'Algo deu errado ao tentar registrar seu comentario.'
                    );
                    $this->result = $this->db->last_id;
                    return;
                }
            }
            else{
                $this->msg = array(
                    'type'=>'error',
                    'title'=>'Oops!',
                    'msg'=>'Você já avaliou este curso'
                );
                return;
            }
        }
        
    }
    