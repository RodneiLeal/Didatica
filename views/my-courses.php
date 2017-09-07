<div class="content-wrapper">
  <section class="content-header">
    <h1>Cursos</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Exemplos</a></li>
      <li class="active">Cursos</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <a href="dashboard.php?p=my-courses-add" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Adicionar Curso</a>
      </div>
    </div>
    <br>
    <div class="row">

<?php
    $retorno = ExecData($mysqli, 'cursos','meus_cursos_lista','*', 0);
   // echo $retorno;
    while($row = mysqli_fetch_array($retorno))
    {
 
        echo 
        '
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="?p=course&curso_id='.$row['curso_id'].'">'.$row['curso_titulo'].'</a></h3>
                    <div id="stars" class="starrr pull-right" data-rating=4>(32)4.07 </div>
                  <img class="img-responsive  course_list" src="'.mostra_imagem('curso',$row['curso_imagem']).'" alt="'.$row['curso_titulo'].'">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <span class="desccription">
                      '.$row['curso_resumo'].'
                  </span>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button class="btn btn-default btn-xs"><i class="fa fa-share"></i> Compartilhar</button>
                </div><!-- /.box-footer -->
              </div>
            </div>
        ';
     }
?>




    </div>
  </section>
</div>