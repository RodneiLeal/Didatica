<?php

    //namespace model\instructor;     
    /**
    * 
    */
    

    function ExecData($mysqli, $type, $process, $colunas, $registro)
    {
        
        switch ($type)
        {
            case 'site':
            switch ($process)
            {

                case 'configuracoes':

                    $consulta  = mysqli_query($mysqli, "
                        select
                            *
                        from
                            adm_configuracao
                        where
                            adm_configuracao_id = 1
                    ");
                    return $consulta;

                break;
            }


            case 'usuario':
            switch ($process)
            {
                case 'consulta_usuario':

                    if($registro !== 0)
                    {
                        $consulta  = mysqli_query($mysqli, "
                            SELECT *,
                            (SELECT count(curso_id) from curso where b.curso_usuario_id = a.usuario_id) as total_publicacao
                            FROM usuario as a
                            LEFT JOIN curso AS b 
                            ON (a.usuario_id = b.curso_usuario_id) 
                            where usuario_id=$registro
                            limit 1;
                        ");
                        return $consulta;
                    }
                    else
                    {
                        $consulta  = mysqli_query($mysqli,"
                            SELECT *,
                            (SELECT count(curso_id) from curso where curso_usuario_id = usuario_id) as total_publicacao
                            FROM usuario
                            ORDER BY usuario_id DESC 
                        ");
                        return $consulta;
                    }
                break;   
				
				
				
                case 'consulta_usuario_instrutores':
					$consulta  = mysqli_query($mysqli,"
						SELECT *,
						(SELECT count(curso_id) from curso where curso_usuario_id = usuario_id) as total_publicacao
						FROM usuario
						where
							usuario_tipo = 2
						ORDER BY usuario_id DESC 
					");
					return $consulta;
					break;  
				
				
                case 'consulta_usuario_instrutores_pendente_aprovacao':
					$consulta  = mysqli_query($mysqli,"
						SELECT *,
						(SELECT count(curso_id) from curso where curso_usuario_id = usuario_id) as total_publicacao
						FROM usuario,usuario_instrutor_solicitacao
						where
							usuario_tipo = 1 and
							usuario_instrutor_solicitacao_usuario_id = usuario_id
						ORDER BY usuario_id DESC 
					");
					return $consulta;
					break;  
					
					
				
                case 'consulta_usuario_verifica_se_instrutor':
					$consulta  = mysqli_query($mysqli,"
						SELECT *
						FROM usuario_instrutor_solicitacao
						where
							usuario_instrutor_solicitacao_usuario_id = $registro
					");
					return $consulta;
					break;  
					
				
                case 'consulta_total_inscritos':

                    $consulta_inscritos  = mysqli_fetch_assoc(mysqli_query($mysqli, "select count(matricula_id) as total from matricula, curso where matricula_curso_id = curso_id and curso_usuario_id= ".$registro.""));
                    return $consulta_inscritos['total'];
                 break;   
				
                case 'consulta_media_star':

                    $consulta_star  = mysqli_fetch_assoc(mysqli_query($mysqli, "
						select
							COUNT(curso_avaliacao_nota) as total_notas,
							SUM(curso_avaliacao_nota) as soma_notas
						FROM
							curso,
							matricula,
							curso_avaliacao
						WHERE
							curso_avaliacao_matricula_id = matricula_id AND
							matricula_curso_id = curso_id AND
							curso_usuario_id = ".$registro."
					"));
						
						if(empty($consulta_star['total_notas']))
						{
							$total = 0;
						}
						else
						{
							if($consulta_star['total_notas'] > 1)
							{
								$total = $consulta_star['soma_notas'] / $consulta_star['total_notas'];
							}
							elseif($consulta_star['total_notas'] == 1)
							{
								$total=$consulta_star['soma_notas'];
							}
						}

                    return $total;
                 break;   
				 
				 
                case 'consulta_total_publicacao':

                    $consulta  = mysqli_query($mysqli, "select count(curso_id) as total from curso where curso_usuario_id=".$registro."");
                    while($row = mysqli_fetch_array($consulta))
                    {
                        echo $row['total'];
                    }
                break;        


                case 'consulta_usuario_habilidades':

                    $consulta  = mysqli_query($mysqli, "select ".$colunas." from usuario_habilidade where usuario_habilidade_usuario_id=".$registro."");
                    return $consulta;
                break;      
            }





            case 'cursos':
            switch ($process)
            {
                case 'cursos_lista_frontend':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso,
							usuario,
							curso_categoria
						where
							curso_usuario_id = usuario_id and
							curso_categoria.curso_categoria_id = curso.curso_categoria_id and
							curso_ativo = 1
					");
                    return $consulta;
                    break; 
					
                case 'cursos_lista_frontend_curso':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso,
							usuario,
							curso_categoria
						where
							curso_usuario_id = usuario_id and
							curso_categoria.curso_categoria_id = curso.curso_categoria_id and
							curso_ativo = 1 and
							curso_id = $registro
					");
                    return $consulta;
                    break; 
					
					

                case 'cursos_lista_frontend_curso_por_categoria':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso,
							usuario,
							curso_categoria
						where
							curso_usuario_id = usuario_id and
							curso_categoria.curso_categoria_id = curso.curso_categoria_id and
							curso_ativo = 1 and
							curso_categoria.curso_categoria_id = $registro
					");
                    return $consulta;
                    break; 
					
					
                case 'cursos_lista_frontend_curso_por_texto':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso,
							usuario,
							curso_categoria
						where
							curso_usuario_id = usuario_id and
							curso_categoria.curso_categoria_id = curso.curso_categoria_id and
							curso_ativo = 1 and
							(
								curso_titulo LIKE '%".$registro."%' OR
								curso_descricao LIKE '%".$registro."%'
							)
					");
                    return $consulta;
                    break; 
					
					
                case 'cursos_lista_frontend_avaliacao':
                    $consulta  = "
						SELECT
						   usuario_nome,
						   curso_avaliacao_comentario,
						   usuario_foto,
						   curso_avaliacao_data_cadastro
						FROM
						   usuario,
						   curso_avaliacao,
						   matricula,
						   curso
						where
							matricula_curso_id = curso_id and
							matricula_usuario_id = usuario_id and
							curso_avaliacao_matricula_id = matricula_id and
							curso_avaliacao_ativo = 1 and
							curso_id = $registro
						ORDER BY
								curso_avaliacao_data_cadastro DESC
							
					";
                    return $consulta;
                    break; 
					
					
					
					
                case 'cursos_frontend_categoria':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso_categoria
						where
							curso_categoria.curso_categoria_nome = '$registro'
					");
                    return $consulta;
                    break; 
					
					
                case 'cursos_frontend_termo':
                    $consulta  = mysqli_query($mysqli, "
						select
							*
						from
							curso,
							curso_categoria
						where
							curso_categoria.curso_categoria_id = curso.curso_categoria_id and
							curso_ativo = 1 and
							(
								curso_titulo LIKE '%".$registro."%' OR
								curso_descricao LIKE '%".$registro."%'
							)
					");
                    return $consulta;
                    break; 
					
					
					
					
                case 'cursos_lista':
                    if($registro !== 0)
                    {
                        $consulta  = mysqli_query($mysqli, "select ".$colunas." from curso, usuario where curso_id=".$registro." and usuario_id = curso_usuario_id limit 1");
                        return $consulta;
                    }
                    else
                    {
                        $consulta  = mysqli_query($mysqli, "select ".$colunas." from curso where curso_ativo = 1");
                        return $consulta;
                    }
                    break; 


                case 'cursos_lista_ver_por_status':
                        $consulta  = mysqli_query($mysqli, "select ".$colunas." from curso where curso_ativo = $registro");
                        return $consulta;
                    break; 

					
                case 'cursos_lista_busca_filtro':
						
						$busca = explode("__", $registro);
						$busca_texto 		= $busca[0];
						$busca_categoria	= $busca[1];
 						
						$sql_busca_texto = '';
						$sql_busca_categoria = '';
						$sql_busca_ordem = '';
						
						if(!empty($busca_texto))
						{
							$sql_busca_texto = " and  LIKE '%".$busca_texto."%' ";
						}
						
							if(!empty($busca_categoria))
							{
								$sql_busca_categoria = " and curso_categoria_id = $busca_categoria ";
							}

                        $consulta  = mysqli_query($mysqli, "
								select
									".$colunas."
								from
									curso
								where
									curso_ativo = 1
									$sql_busca_texto
									$sql_busca_categoria
							"
						);
							return $consulta;
                    break; 
					
					
					
                case 'meus_cursos_lista':
                        $consulta  = mysqli_query($mysqli, "select ".$colunas." from curso, usuario where usuario_id = curso_usuario_id and usuario_id = '{$_SESSION['usuarioID']}' and curso_ativo =1");
                        return $consulta;

                    break; 


                case 'cursos_lista_por_usuario':
                        $consulta  = mysqli_query($mysqli, "select ".$colunas." from curso, usuario where usuario_id = curso_usuario_id and usuario_id = $registro");
                        return $consulta;

                    break; 
					
					
                case 'curso_estatisticas':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                COUNT(matricula_certificado_id) as total_certificado,
                                COUNT(matricula_id) as total_matriculas,
                                (SELECT COUNT(matricula_id) FROM matricula WHERE date(matricula_data_inscricao)='2017-05-03') as total_matriculas_30_dias,
                                (SELECT COUNT(curso_avaliacao_id) FROM curso_avaliacao WHERE curso_avaliacao_matricula_id = matricula_id and matricula_curso_id = curso_id and curso_avaliacao_ativo = 1) as total_avaliacao,
                                (SELECT COUNT(matricula_certificado_matricula_id) FROM matricula_certificado WHERE matricula_certificado_matricula_id = matricula_id and matricula_certificado_ativo = 1) as total_certificado_pago ,
								(SELECT COUNT(curso_visualizacao_id) FROM curso_visualizacao WHERE curso_visualizacao_curso_id = curso_id) as total_visualizacao
                            from
                                curso,
                                matricula
                            LEFT JOIN
                                matricula_certificado
                            ON
                                 matricula_certificado_matricula_id = matricula_id
                            where
                                curso_id = $registro and
                                matricula_curso_id = curso_id
                        ");
                        return $consulta;
                   
                    break;



                case 'curso_matriculados_widget_8':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                usuario_id,
                                usuario_nome,
                                usuario_foto
                            from
                                usuario,
                                matricula
                            where
                                matricula_curso_id = $registro and
                                matricula_usuario_id = usuario_id
                            limit 8
                        ");
                        return $consulta;
                   
                    break;




                case 'cursos_matricula':

                        $consulta  = mysqli_query($mysqli, "
                                select *
                                from
                                    curso,
                                    matricula
                                where
                                    curso_ativo = 1 and
                                    curso_id = $registro and
                                    matricula_curso_id = curso_id and
                                    matricula_usuario_id = '{$_SESSION['usuarioID']}'
                        ");
                        return $consulta;
                   
                    break;


                case 'cursos_matricula_lista_todos':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                curso_id,
                                matricula_id,
                                curso_titulo,
                                curso_data_cadastro,
                                curso_horas_total,
                                IF( (SELECT COUNT(matricula_certificado_id) FROM matricula_certificado WHERE matricula_certificado_matricula_id = matricula_id) = 0, 'Não emitido','Solicitado') as certificado_status
                            from
                                curso,
                                matricula
                            where
                                matricula_usuario_id = '{$_SESSION['usuarioID']}' and
                                matricula_curso_id = curso_id 
                            order by
                                matricula_data_inscricao asc
                        ");
                        return $consulta;
                   
                    break;




                case 'cursos_certificados_lista_todos':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                ".$colunas."
                            from
                                curso,
                                matricula
									LEFT JOIN
										matricula_certificado
									ON
										matricula_certificado_matricula_id = matricula_id
                            where
                                curso_usuario_id = '{$_SESSION['usuarioID']}' and
                                matricula_curso_id = curso_id and
                                matricula_usuario_id = curso_usuario_id and
                                matricula_certificado_matricula_id = matricula_id
                            order by
                                matricula_data_inscricao asc
                        ");
                        return $consulta;
                   
                    break;




                case 'cursos_certificados_visualiza_certificado':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                *,
                                DATE_FORMAT(matricula_certificado_data_cadastro,'%d %b %y') as certificado_data
                            from
                                matricula_certificado,
                                usuario,
                                curso,
                                matricula,
								curso_exame
                            where
                                matricula_certificado_certificado_code = '$registro' and
                                matricula_certificado_matricula_id = matricula_id and
                                matricula_usuario_id = usuario_id and
                                matricula_curso_id = curso_id and
								curso_exame_curso_id = curso_id and
								curso_exame_usuario_id = usuario_id
                            limit 1
                        ");
                        return $consulta;
                   
                    break;



                case 'curso_categorias_lista':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                *
                            from
                                curso_categoria
                            order by
                                 curso_categoria_nome  asc
                        ");
                        return $consulta;
                   
                    break;
					


                case 'curso_conteudo_titulos':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                curso_item_id,
                                curso_item_titulo,
                                (SELECT COUNT(curso_item_doc_id) FROM curso_item_doc WHERE curso_item_doc_curso_item_id = curso_item_id) as total_arquivos
                            from
                                curso_item
                            where
                                curso_item_curso_id = $registro
                            order by
                                curso_item_data_cadastro asc
                        ");
                        return $consulta;
                   
                    break;



                case 'curso_conteudo_conteudo_item':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                curso_item_descricao
                            from
                                curso_item
                            where
                                curso_item_id = $registro
                        ");
                        return $consulta;
                   
                    break;


                case 'curso_conteudo_conteudo_item_docs':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                curso_item_doc_doc
                            from
                                curso_item_doc
                            where
                                curso_item_doc_curso_item_id = $registro
                        ");
                        return $consulta;
                   
                    break;

					
                case 'curso_conteudo_questoes_exame':

                        $consulta  = mysqli_query($mysqli, "
                            select
								curso_questao_id,
                                curso_questao_pergunta_titulo
                            from
                                curso_questao
                            where
                                curso_questao_curso_id = $registro
                            order by
                                 	curso_questao_data_cadastro asc
                        ");
                        return $consulta;
                   
                    break;
					
					
                    //Interação usuario
                case 'cursos_matricula_avalia_verifica_contem':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                curso_avaliacao_id
                            from
                                curso_avaliacao
                            where
                                curso_avaliacao_matricula_id = $registro
                        ");
                        return $consulta;
                   
                    break;
            }



            case 'financeiro':
            switch ($process)
            {

                case 'financeiro_totalizador':

                        $consulta  = mysqli_query($mysqli, "
                            select 
                                IF(usuario_saldo_ativo=0, Format(SUM(usuario_saldo_valor),2,'de_DE'),'0') as total_ja_recebido,
                                IF(usuario_saldo_ativo=2, Format(SUM(usuario_saldo_valor),2,'de_DE'),'0') as total_em_conta
                            from
                                usuario_saldo
                            where
                                usuario_saldo_usuario_id = '{$_SESSION['usuarioID']}'
                            group by
                                usuario_saldo_ativo

                        ");
                        return $consulta;
                   
                    break;


                case 'financeiro_historico':

                        $consulta  = mysqli_query($mysqli, "
                            select
                                curso_titulo,
                                usuario_nome,
                                Format(SUM(usuario_saldo_valor),2,'de_DE') as total_valor,
                                CASE
                                    usuario_saldo_ativo
                                    WHEN 0 THEN ('Recebido')
                                    WHEN 1 THEN ('Solicitado Saque')
                                    WHEN 2 THEN ('Saldo disponível')
                                END AS totalizador_status
                            from
                                usuario_saldo,
                                curso,
                                matricula,
                                usuario
                            where
                                usuario_saldo_usuario_id = '{$_SESSION['usuarioID']}' and
                                usuario_saldo_matricula_id = matricula_id and
                                matricula_curso_id = curso_id and
                                matricula_usuario_id = usuario_id
                        ");
                        return $consulta;
                   
                    break;

                case 'consulta_pagamento':
                    $consulta = mysqli_query($mysqli, "
                        SELECT matricula_certificado_ativo AS pgto_status, 
                        IF(matricula_certificado_ativo = 3, TRUE, FALSE) AS pgto 
                        FROM matricula_certificado, matricula 
                        WHERE matricula_certificado_matricula_id = matricula_id 
                        AND matricula_usuario_id = $registro
                        ");

                        return $consulta;
                break;

            }


                    case 'adm':
                    switch ($process)
                    {

                        case 'financeiro_saques':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        *,
                                        IF(usuario_saque_solicitacao_data_transferencia = NULL, '',DATE_FORMAT(usuario_saque_solicitacao_data_transferencia,'%d/%m/%Y')) as data_envio                                    from
                                        usuario_saque_solicitacao,
                                        usuario
                                        
                                    LEFT JOIN
                                        usuario_banco
                                    ON
                                        usuario_banco_usuario_id = usuario_id
                                    where
                                        usuario_saque_solicitacao_usuario_id =  usuario_id
                                    order by
                                        usuario_saque_solicitacao_data_cadastro DESC,
                                        usuario_saque_solicitacao_ativo ASC
                                ");
                                return $consulta;
                           
                            break;


                        case 'financeiro_matricula_certificado':

                                $consulta  = mysqli_query($mysqli, "
                                    select
                                        matricula_id,
                                        usuario_nome,
                                        matricula_certificado_pagseguro_code,
                                        matricula_certificado_id,
                                        matricula_certificado_data_cadastro,
                                        curso_titulo
                                    from
                                        matricula_certificado,
                                        matricula,
                                        usuario,
                                        curso
                                    where
                                        matricula_certificado_matricula_id =  matricula_id and
                                        matricula_usuario_id = usuario_id and
                                        curso_id = matricula_curso_id
                                    order by
                                        matricula_certificado_data_cadastro desc
                                ");
                                return $consulta;
                           
                            break;
                    }






                    case 'exame':
                    switch ($process)
                    {
                        case 'curso_perguntas_total':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        COUNT(curso_questao_id) as total_questoes
                                    FROM
                                        curso_questao
                                    where
                                        curso_questao_curso_id =  $registro
                                ");
                                return $consulta;
                           
                            break;
							
							
                        case 'curso_perguntas_retorna':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        *
                                    FROM
                                        curso_questao
                                    where
                                        curso_questao_curso_id =  $registro
                                    order by
                                        RAND() limit 10
                                ");
                                return $consulta;
                           
                            break;
 

                         case 'curso_exame_respostas_envia':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        curso_questao_pergunta_resposta_correta
                                    FROM
                                        curso_questao
                                    where
                                        curso_questao_id =  $registro
                                ");
                                return $consulta;
                           
                            break;


                         case 'curso_exame_verifica_certificado_libera':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        ".$colunas."
                                    FROM
                                        curso_exame
                                    where
                                        curso_exame_curso_id =  $registro and
                                        curso_exame_usuario_id = '{$_SESSION['usuarioID']}' and
										curso_exame_nota >= '60' and
                                        curso_exame_ativo = 1
                                ");
                                return $consulta;

                            break;
                    }


                    case 'mensagem':
                    switch ($process)
                    {

                        case 'mensagens_total':

                                $consulta  = mysqli_query($mysqli, "
                                    select 
                                        count(usuario_mensagem_id) as total
                                    FROM
                                        usuario_mensagem
                                    where
                                        usuario_mensagem_usuario_id =  $registro and
										usuario_mensagem_lido = 2
                                ");
                                return $consulta;
                           
                            break;
 
                        case 'mensagens_todas_nao_lidas':

                                $consulta  = mysqli_query($mysqli, "
                                    select
										usuario_mensagem_id,
										usuario_mensagem_titulo,
										usuario_mensagem_data,
										usuario_mensagem_mensagem,
										usuario_mensagem_lido
                                    FROM
                                        usuario_mensagem
                                    where
                                        usuario_mensagem_usuario_id =  $registro and
										usuario_mensagem_lido = 2
                                ");
                                return $consulta;
                           
                            break;
							
							
                        case 'mensagens_todas':

                                $consulta  = mysqli_query($mysqli, "
                                    select
										usuario_mensagem_id,
										usuario_mensagem_titulo,
										usuario_mensagem_data,
										usuario_mensagem_mensagem,
										usuario_mensagem_lido
                                    FROM
                                        usuario_mensagem
                                    where
                                        usuario_mensagem_usuario_id =  $registro
                                ");
                                return $consulta;
                           
                            break;
							
							
							
                    }

					
					
					
					
					


                    case 'sistema':
                    switch ($process)
                    {

                        case 'dashboard_dados_rapidos':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
                                        COUNT(DISTINCT usuario_online_ip) as usuario_online,
                                        (SELECT COUNT(matricula_certificado_id) FROM matricula_certificado) as total_certificado,
                                        (SELECT COUNT(curso_id) FROM curso) as total_curso,
                                        (SELECT COUNT(usuario_id) FROM usuario) as total_usuarios
                                    FROM
                                        usuario_online
                                ");
                                return $consulta;
                           
                            break;
							
                        case 'dashboard_dados_rapidos_instrutor':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
                                        COUNT(DISTINCT usuario_online_ip) as usuario_online,
                                        (SELECT COUNT(matricula_certificado_id) FROM matricula_certificado) as total_certificado,
                                        (SELECT COUNT(curso_id) FROM curso) as total_curso,
                                        (SELECT COUNT(usuario_id) FROM usuario) as total_usuarios
                                    FROM
                                        usuario_online,
                                        usuario
									WHERE
										usuario_id = $registro and
                                        usuario_online_usuario_id = usuario_id
                                ");
                                return $consulta;
                           
                            break;
							
							
							
							
							
						//GRAFICOS	
						//resumos
                        case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
 										extract(YEAR from curso_visualizacao_data) as ano_consulta,
										extract(MONTH from curso_visualizacao_data) as mes_consulta,
										COUNT(curso_visualizacao_id) as total_acessos
									FROM
										curso_visualizacao, curso, usuario
									where
										curso_visualizacao_curso_id = curso_id and
										curso_usuario_id = $registro
                                ");
                                return $consulta;
                            break;
							
							
                        case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
 										extract(YEAR from matricula_data_inscricao) as ano_consulta,
										extract(MONTH from matricula_data_inscricao) as mes_consulta,
										COUNT(	matricula_id) as total_matriculas
									FROM
										matricula, curso, usuario
									where
										matricula_curso_id = curso_id and
										usuario_id = curso_usuario_id and
										curso_usuario_id = $registro
                                ");
                                return $consulta;
                            break;
							
                        case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_certificados':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
										COUNT(matricula_certificado_id) as total_certificados,
										EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
									FROM
										matricula_certificado, curso, matricula
									where
										matricula_certificado_matricula_id = matricula_id and
										matricula_curso_id = curso_id and
										matricula_certificado_ativo = 1 and
 										curso_usuario_id = $registro
                                ");
                                return $consulta;
                            break;
							
						//resumos
							
							
							
                        case 'dashboard_dados_rapidos_graficos_intrutor_total_acessos':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
 										extract(YEAR from curso_visualizacao_data) as ano_consulta,
										extract(MONTH from curso_visualizacao_data) as mes_consulta,
										COUNT(curso_visualizacao_id) as total_acessos
									FROM
										curso_visualizacao, curso, usuario
									where
										curso_visualizacao_curso_id = curso_id and
										curso_usuario_id = $registro
                                     GROUP BY MONTH(curso_visualizacao_data)
                                ");
                                return $consulta;
                            break;
							
							
                        case 'dashboard_dados_rapidos_graficos_intrutor_total_matriculas':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
 										extract(YEAR from matricula_data_inscricao) as ano_consulta,
										extract(MONTH from matricula_data_inscricao) as mes_consulta,
										COUNT(	matricula_id) as total_matriculas
									FROM
										matricula, curso, usuario
									where
										matricula_curso_id = curso_id and
										usuario_id = curso_usuario_id and
										curso_usuario_id = $registro
                                     GROUP BY MONTH(matricula_data_inscricao)
                                ");
                                return $consulta;
                            break;
							
							
                        case 'dashboard_dados_rapidos_graficos_intrutor_total_certificados':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
										COUNT(matricula_certificado_id) as total_certificados,
										EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
									FROM
										matricula_certificado, curso, matricula
									where
										matricula_certificado_matricula_id = matricula_id and
										matricula_curso_id = curso_id and
										matricula_certificado_ativo = 1 and
 										curso_usuario_id = $registro
									GROUP BY MONTH(matricula_certificado_data_cadastro)
                                ");
                                return $consulta;
                            break;
							
							
							
							
							
					////////ESTA SEMANA
							
						//resumos
							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_esta_semana':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_esta_semana':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_certificados_esta_semana':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;
								
							//resumos
								
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_acessos_esta_semana':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(curso_visualizacao_data)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_matriculas_esta_semana':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(matricula_data_inscricao)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_certificados_esta_semana':
 									
									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										GROUP BY MONTH(matricula_certificado_data_cadastro)
									");
									return $consulta;
								break;
							
							
							
							////////ESTA SEMANA
							
							
							
					///////ULTIMOS 30 DIAS
							
						//resumos
							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_ultimos_30_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_ultimos_30_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_ultimos_30_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;
								
								
							//RESUMO
							
							case 'dashboard_dados_rapidos_graficos_intrutor_total_acessos_ultimos_30_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(curso_visualizacao_data)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_matriculas_ultimos_30_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(matricula_data_inscricao)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_certificados_ultimos_30_dias':
 									
									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										GROUP BY MONTH(matricula_certificado_data_cadastro)
									");
									return $consulta;
								break;
							
							
					///////ULTIMOS 30 DIAS
					
					
					
					
					
							
							
					///////ULTIMOS 90 DIAS
							
						//resumos
							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_acessos_ultimos_90_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_matriculas_ultimos_90_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;


							case 'dashboard_dados_rapidos_graficos_intrutor_resumo_total_ultimos_90_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
									");
									return $consulta;
								break;
								
								
							//RESUMO
							
							case 'dashboard_dados_rapidos_graficos_intrutor_total_acessos_ultimos_90_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from curso_visualizacao_data) as ano_consulta,
											extract(MONTH from curso_visualizacao_data) as mes_consulta,
											COUNT(curso_visualizacao_id) as total_acessos
										FROM
											curso_visualizacao, curso, usuario
										where
											curso_visualizacao_curso_id = curso_id and
											curso_visualizacao_data BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(curso_visualizacao_data)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_matriculas_ultimos_90_dias':

									$consulta  = mysqli_query($mysqli, "
										SELECT
											extract(YEAR from matricula_data_inscricao) as ano_consulta,
											extract(MONTH from matricula_data_inscricao) as mes_consulta,
											COUNT(	matricula_id) as total_matriculas
										FROM
											matricula, curso, usuario
										where
											matricula_curso_id = curso_id and
											usuario_id = curso_usuario_id and
											matricula_data_inscricao BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										 GROUP BY MONTH(matricula_data_inscricao)
									");
									return $consulta;
								break;
								
								
							case 'dashboard_dados_rapidos_graficos_intrutor_total_certificados_ultimos_90_dias':
 									
									$consulta  = mysqli_query($mysqli, "
										SELECT
											COUNT(matricula_certificado_id) as total_certificados,
											EXTRACT(MONTH FROM matricula_certificado_data_cadastro) as mes_consulta
										FROM
											matricula_certificado, curso, matricula
										where
											matricula_certificado_matricula_id = matricula_id and
											matricula_curso_id = curso_id and
											matricula_certificado_ativo = 1 and
											matricula_certificado_data_cadastro BETWEEN CURRENT_DATE()-90 AND CURRENT_DATE() and
											curso_usuario_id = $registro
										GROUP BY MONTH(matricula_certificado_data_cadastro)
									");
									return $consulta;
								break;
							
							
					///////ULTIMOS 90 DIAS
							
							
							
							
						//GRAFICOS	
							
							
							
							
							
							
                        case 'avaliacoes_lista':

                                $consulta  = mysqli_query($mysqli, "
                                    SELECT
                                       *
                                    FROM
                                       usuario,
									   curso_avaliacao,
									   matricula,
									   curso
									where
										matricula_curso_id = curso_id and
										matricula_usuario_id = usuario_id and
										curso_avaliacao_matricula_id = matricula_id
									ORDER BY
											curso_avaliacao_ativo DESC
                                ");
                                return $consulta;
                           
                            break;
                    }

        }
    }




    function EnviaMensagem($mysqli, $usuario_id, $titulo, $mensagem)
    {
			$data_cadastro 	= date("Y-m-d H:i");
		
			$campos=
			"
				usuario_mensagem_usuario_id,
				usuario_mensagem_titulo,
				usuario_mensagem_mensagem,
				usuario_mensagem_data,
				usuario_mensagem_lido
			";
				
					$conteudo =
					"
						'$usuario_id',
						'$titulo',
						'$mensagem',
						'$data_cadastro',
						2
					";

				
				$consulta  = mysqli_query($mysqli, "
				   INSERT INTO usuario_mensagem ($campos) VALUES ($conteudo)
				");
 
	}






        function mostra_imagem($tipo, $caminho) {
 			
            if($tipo=='user'){
                if(empty($caminho)){
                    $imagem = "dist/img/usuario-sem-imagem.png";
                }else{
                    if (!filter_var($caminho, FILTER_VALIDATE_URL) === false){
                        $imagem = $caminho;
                    }else{
                        if(is_file('dist/img/users/'.$caminho)){
                            $imagem = 'dist/img/users/'.$caminho;
                        }else{
                            $imagem = "dist/img/usuario-sem-imagem.png";
                        }
                    }
                }
            }elseif($tipo=='user_frontend'){
                if(empty($caminho)){
                    $imagem = "dist/img/usuario-sem-imagem.png";
                }else{
                    if (!filter_var($caminho, FILTER_VALIDATE_URL) === false){
                        $imagem = $caminho;
                    }else{
                        if(is_file('dist/img/users/'.$caminho)){
                            $imagem = 'dist/img/users/'.$caminho;
                        }else{
                            $imagem = "dist/img/usuario-sem-imagem.png";
                        }
                    }
                }
            }
            elseif($tipo=='curso')
            {
                  if(empty($caminho))
                  {
                    $imagem = "dist/img/curso-sem-imagem.png";
                  }
                  else
                  {
                    if(is_file('dist/img/courses/'.$caminho))
                    {
                      $imagem = 'dist/img/courses/'.$caminho;
                    }
					elseif(is_file('../dist/img/courses/'.$caminho))
                    {
                      $imagem = '../dist/img/courses/'.$caminho;
                    }
					elseif(is_file('../../dist/img/courses/'.$caminho))
                    {
                      $imagem = '../../dist/img/courses/'.$caminho;
                    }
					elseif(is_file('../../../dist/img/courses/'.$caminho))
                    {
                      $imagem = '../../../dist/img/courses/'.$caminho;
                    }
                    else
                    {
                       $imagem = "dist/img/curso-sem-imagem.png";
                    }
                  }
            }
              
              return $imagem;
        }



    function GeraAleatorio($size)
    {
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $return= "";

        for($count= 0; $size > $count; $count++){
            //Gera um caracter aleatorio
            $return.= $basic[rand(0, strlen($basic) - 1)];
        }

        return $return;
    }





    function RetornaStatusPagseguro($status)
    {
        if($status==1)
        {
            $retorna = 'Aguardando Pagamento';
        }
        elseif($status==2)
        {
            $retorna = 'Em análise';
        }
        elseif($status==3)
        {
            $retorna = 'Paga';
        }
        elseif($status==4)
        {
            $retorna = 'Disponível (Valor disponível)';
        }
        elseif($status==5)
        {
            $retorna = 'Em disputa';
        }
        elseif($status==6)
        {
            $retorna = 'Devolvida';
        }
        elseif($status==6)
        {
            $retorna = 'Cancelada';
        }
        return $retorna;
    }



?>
