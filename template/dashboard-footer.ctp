      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; <?=date('Y')?> <a href="http://rodneileal.com.br" target="_blank">Rodnei Leal</a>.</strong> All rights reserved.
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


    <?php if(!$tipo): ?>

      <div class="modal fade" id="novo-instrutor">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title">Título</h3>
            </div>

            <div class="modal-body">

              Aqui vai uma mensagem de boas vindas
            
            </div>

            <div class="modal-footer">
              <button class="btn btn-success btn-lg pull-left form-curriculo closed-modal" data-toggle="modal" data-target="#form-curriculo" >Prosseguir <i class="fa fa-angle-double-right"></i></button>
              <img src="img/logo.png" class="pull-right">
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="form-curriculo" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal">&times;</button>
              <h3>Dados Profissionais</h3>
            </div>

            <div class="modal-body" style="overflow-y: auto;max-height: 400px;">
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="perfil-nome">Nome</label>
                  <input class="form-control" required type="text" name="nome" id="perfil-nome">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="perfil-sobrenome">Sobrenome</label>
                  <input class="form-control" required type="text" name="sobrenome" id="perfil-sobrenome">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="curriculo-titulacao">Titulação</label>
                  <input  class="form-control" required type="text" name="titulacao" id="curriculo-titulacao">
                </div>
                <div class="col-md-6">
                  <label for="curriculo-formacao">Formação</label>
                  <input class="form-control" required type="text" name="formacao" id="curriculo-formacao">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="curriculo-instituicao">Instituição</label>
                  <input class="form-control" required type="text" name="instituicao" id="curriculo-instituicao">
                </div>
                <div class="col-md-6">
                  <label for="curriculo-lattes">Lattes</label>
                  <input class="form-control" type="text" name="lattes" id="curriculo-lattes">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="curriculo-resumo">Resumo</label>
                  <textarea class="form-control editor" name="resumo" id="curriculo_resumo" cols="30" rows="10"></textarea>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-success btn-lg pull-left form-bancario closed-modal" data-toggle="modal" data-target="#form-bancario">Prosseguir <i class="fa fa-angle-double-right"></i></button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade form-bancario" id="form-bancario" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal">&times;</button>
              <h3>Dados Bancarios</h3>
            </div>

            <div class="modal-body" style="overflow-y: auto;max-height: 400px;">

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="conta-cpf">CPF</label>
                  <input class="form-control" required type="text" name="cpf" id="conta-cpf">
                </div>
                <div class="col-md-6">
                  <label for="conta-banco">Banco</label>

                  <select class="form-control" required name="banco" id="conta-banco">
                    <option selected >Selesione seu banco</option>
                    <?php foreach(Main::getBancos() as $banco):?>

                    <option value="<?=$banco['idbancos']?>"><?=$banco['codigo']?> <?=$banco['instituicao']?> - <?=$banco['site']?></option>

                    <?php endforeach ?>
                  </select>
                  
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="conta-agencia">Agência</label>
                  <input class="form-control" required type="text" name="agencia" id="conta-agencia">
                </div>
                <div class="col-md-6">
                  <label for="conta-conta">Conta</label>
                  <input class="form-control" required type="text" name="conta" id="conta-conta">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="conta-operacao">Operação</label>
                  <input class="form-control" required type="text" name="operacao" id="conta-operacao">
                </div>
                <div class="col-md-6">
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <button class="btn btn-success btn-lg salvar-curriculo">Salvar&#160;&#160;<i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>

    <?php endif ?>





    <!-- jQuery -->
    <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="js/vendor/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="js/vendor/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="js/vendor/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="js/vendor/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/vendor/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/vendor/dist/js/demo.js"></script>

    <script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
    <script type="text/javascript" src="js/vendor/plugins/notification/toastr.min.js"></script>
    <script type="text/javascript" src="js/vendor/star-rating/star-rating.js"></script>
    <script type="text/javascript" src="js/vendor/menu/modernizr.custom.js"></script>
    <script type="text/javascript" src="js/vendor/menu/jquery.dlmenu.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- page script -->
  </body>
</html>
