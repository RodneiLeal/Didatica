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
              
              if($minhasInscricoes):
                foreach($minhasInscricoes as $minhaInscricao):
            ?>
                <tr>

                  <!-- ao clicar no nome do curso, deverá acessar a pagina do curso -->
                  <td><a class="btn btn-link" href="Dashboard/inscricao/<?=$minhaInscricao['idinscricao']?>"><?=$minhaInscricao['titulo']?></a></td>

                  <td><?=$this->inscricoes->formataData($minhaInscricao['data_inscricao'], 'dh')?></td>
                  
                  <?php
                    if(!empty($minhaInscricao['certificado_idcertificado'])){
                      echo "<td>{$this->inscricoes->formataData($minhaInscricao['data_finalizacao'], 'd')}</td>";
                    }else{
                      echo "<td>Em andamento</td>";
                    }
                  ?>
                  <!-- este botão irá exibir um certificado modelo com dados parciais do usuário, enquanto não for concluido o curso e não for efetuado o pagamento do certificado. Após o pagamento será exibido o numero do certificado e o status de curso concluido. -->
                  
                  <td><a class="btn btn-xs btn-info certificado-modelo" href="Dashboard/certificado/<?=$minhaInscricao['idinscricao']?>">Certificado modelo</a></td>
                </tr>
            <?php
                endforeach;
              endif
            ?>
            
          </table>
        </div>
      </div>
    </div>
  </div>
</section>