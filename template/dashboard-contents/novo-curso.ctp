  <section class="content-header">
    <h1>Novo curso</h1>
    <ol class="breadcrumb">
      <li><a><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a>Cursos</a></li>
      <li class="active">Novo Curso</li>
    </ol>
  </section>

<section class="content">
  <form action="controllers/curso/salvarCurso.php" method="post" id="curso">
  <div class="row content-center">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="box box-primary">
        <div class="box-header with-border text-center">
          <h3 class="form-title">Crie um novo curso</h3>
        </div>
        <div class="box-body">
          <div class="row form-row content-center">
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
              <label class="form-label">Comece informando o titulo do seu curso</label>
              <div class="input-container input-box form-control">
                <input type="text" placeholder="ex.: Design de produtos com Ilustrator" maxlength="40" name="curso[titulo]" value="">
                <span class="input-counter"></span>
              </div>
            </div>
        </div>
        
        <div class="row  form-row content-center">
          <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
              <label class="form-label">Em qual categoria o seu curso se encaixa?</label>
              <div class="form-control input-box">

                  <?=$select?>

              </div>
          </div>
        </div>
        
        <div class="footer">
            <button name="salvarcurso" class="form-btn pull-right" style="margin: 0 20px;">Salve e continue!</button>
        </div>
      </div>
    </div>
  </div>

  </form>
</section>




















