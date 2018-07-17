<div class="form-header with-border-bottom">
    <h3 class="form-title">Configurações</h3>
</div>



  <section class="content">
    <div class="box box-primary">
      <div class="box-body no-margin no-padding">
        <div class="col-md-3">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="nav nav-stacked nav-steps">
                  <li><a href="Admin/config/financeira">Finaceira</a></li>
                  <li><a href="Admin/config/provas">Provas</a></li>
                  <li><a href="Admin/config/certificado">Certificado</a></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-9 with-border-left no-padding">
            <form action="controllers/adm/config.php" method="POST" enctype="multipart/form-data">
              <div class="form-header with-border-bottom">
                <h3 class="form-title"><?=$titulo?></h3>
                  <button class="form-btn">Salvar</button>
              </div>

              <div class="form-container "><?=$sessao?></div>

              <div class="form-tools with-border-bottom"></div>
              <div class="form-header">
                <h3 class="form-title"></h3>
                <button class="form-btn">Salvar</button>
              </div>
            </form>
          </div>
      </div>
    </div>
  </section>