  <section class="content-header">
    <h1>Minhas Inscrições</h1>
    <ol class="breadcrumb">
      <li><a href="Dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Minhas Inscrições</li>
    </ol>
  </section>
  <section class="content">


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Cursos</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                
                <th>Curso</th>
                <th>Data de Inscrição</th>
                <th>Data Finalização</th>
                <th>Certificado</th>
              </tr>
              <?php 
                
                if($minhasInscricoes = $this->inscricoes->getInscricaoPorUsuario($idusuario)):
                  foreach($minhasInscricoes as $minhaInscricao):
              ?>
                  <tr>

                    <!-- ao clicar no nome do curso, deverá acessar o curso
                    em href recebe o id do curso (curso_idcurso) -->
                    <td><a href=""><?=$minhaInscricao['titulo']?></a></td>
                    <td><?=$this->inscricoes->formataData($minhaInscricao['data_inscricao'], 'dh')?></td>
                    
                    <?php
                      if($minhaInscricao['status']){
                        echo "<td>{$this->inscricoes->formataData($minhaInscricao['data_finalizacao'], 'd')}</td>";
                      }else{
                        echo "<td>Em andamento</td>";
                      }
                    ?>
                    <!-- este botão irá exibir um certificado modelo com dados parciais do usuário, enquanto não for concluido o curso e não for efetuado o pagamento do certificado. Após o pagamento será exibido o numero do certificado e o status de curso concluido. -->
                    
                    <td><a class="btn btn-xs btn-info certificado-modelo" href="Dashboard?p=certificado-model">Certificado</a></td>
                  </tr>
              <?php
                  endforeach;
                endif
              ?>
             
            </table>
                        <!-- <td>'.$row['certificado_status'].'</td> -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>

      

      
  </section>