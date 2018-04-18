  <section class="content-header">
    <h1>Meus Cursos</h1>
    <ol class="breadcrumb">
      <li><a href="Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Meus Cursos</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">

      <?php
        
        if($meusCursos):
          foreach($meusCursos as $meuCurso):
            $imagem = empty($meuCurso['imagem'])?'img/curso/no-image.png':$meuCurso['imagem'];
            $media  = number_format($meuCurso['media'], 2, '.', ' ');
      ?>
       
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">
                <a href="Dashboard/curso/<?=$meuCurso['idcurso']?>"> <i class="fa fa-edit"></i>
                  <?=$meuCurso['titulo']?>
                </a>
              </h3>
              <div class="starrr" data-rating="<?=$media?>" title="Média entre <?=$meuCurso['votantes']?> Opiniões de alunos"><span><?=$media?> </span></div>
              <img class="img-responsive  course_list" src="<?=$imagem?>" alt="">
          </div>
          <div class="box-footer">
            
            <a href="curso/<?=$meuCurso['idcurso']?>/<?=Main::preparaURL($meuCurso['categoria'])?>/<?=Main::preparaURL($meuCurso['titulo'])?>" class="btn btn-default btn-xs editar-curso">
            

            </i>Visualizar curso</a>

      

          </div><!-- /.box-footer -->
        </div>
      </div>
      
      <?php
          endforeach;
        endif;
      ?>

    </div>
  </section>