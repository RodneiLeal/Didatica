<?php
	include '../_biblio.php';

			$enroll				= (int)$_POST['enroll'];
			$transaction_code	= mysqli_real_escape_string($mysqli, $_POST['transaction_code']);
				
				$forca = 4;
				$tamanho = 20;
				
				$vogais = '';
				$consoantes = '';
				if ($forca >= 1) {
					$consoantes .= 'BDGHJLMNPQRSTVWXZKW';
				}
				if ($forca >= 2) {
					$vogais .= "AEIOUY";
				}
				if ($forca >= 4) {
					$consoantes .= '123456789';
				}
			 
				$senha = '';
				$alt = time() % 2;
				for ($i = 0; $i < $tamanho; $i++) {
					if ($alt == 1) {
						$senha .= $consoantes[(rand() % strlen($consoantes))];
						$alt = 0;
					} else {
						$senha .= $vogais[(rand() % strlen($vogais))];
						$alt = 1;
					}
				}
				$certificado = $senha;
				
 
			$campos=
			"
				matricula_certificado_matricula_id,
				matricula_certificado_pagseguro_code,
				matricula_certificado_certificado_code,
				matricula_certificado_data_cadastro,
				matricula_certificado_ativo
			";
			
				$conteudo =
				"
 					'$enroll',
 					'$transaction_code',
					'$certificado',
					'$data_cadastro',
					2
				";
			
			$crud = new crud('matricula_certificado');
			echo $crud->insert($mysqli, $campos, $conteudo);
?>