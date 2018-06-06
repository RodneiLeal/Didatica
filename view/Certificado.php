<?php

	class Certificado extends Main implements interfaceController{
		
		private $action,
				$param;
		
		function __construct($idinscr){
			parent::__construct();
			$get = func_num_args()>=1? func_get_args():array();
			$this->action = $get[0];
			$this->param = $get[1];
			$this->title = SYS_NAME." - Certificado";
		}
		
		public function index(){

			$certificado = $this->getDadosCertificado()[0];

			extract($certificado);

			include_once(ROOT."template/certificado.pdf.ctp");
			require_once("util/dompdf/dompdf_config.inc.php");

			$this->dompdf = new DOMPDF;
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper('A4', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("certificado.pdf", array("Attachment" => false));
		}

		public function getDadosCertificado(){
			$sql  = 'SELECT * FROM view_certificado WHERE inscricao_idinscricao = ? AND idcurso = ?'; 
			$stmt = $this->db->query($sql, array_values($_POST));

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}


	}