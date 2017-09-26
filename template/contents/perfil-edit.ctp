  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Perfil</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">User profile edit</li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar perfil</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#conta" data-toggle="tab">Conta</a></li>
                <li><a href="#tab_profissional" data-toggle="tab">Dados Profissionais</a></li>
              </ul>
              <div class="tab-content">

                <div class="active tab-pane" id="conta">
                  <form class="form-horizontal" id="FormeditProfileSave" action="controller/user.php">

                    <div class="form-group">
                      <div class="col-md-10 text-left">
                      <label for="my-picture" class="picture-label ">
                      <img id="preview" src="<?=$foto?>" height="100px" width="100px" />
                      </label>
                      <br>
                      <span class="picture-path">alterar foto ...</span>
                      <div class="preview_block"></div>
                      <input type="file" name="myPicture" id="my-picture" style="display:none"/>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Usuário</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputName" name="inputName" placeholder="Name" required="true" required_message="Ops, por favor, informe seu nome" type="text"
                          value="<?=$nome?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required required_message="Wow, precisamos de seu e-mail" type="text"
                          value="<?=$email?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="passwd" class="col-sm-2 control-label">Senha</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <input class="form-control" id="passwd" name="passwd" placeholder="Senha" type="password">
                          <div class="input-group-btn">
                            <button title="Mostrar senha" class="btn btn-info btn-flat"><i class="fa fa-eye text-black"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> Eu aceito os <a href="#">termos e condições</a>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">

                        <input id="inputName" name="ProfileSave" value="1" type="hidden">
                        <button type="button" id="editProfileSave" class="btn btn-danger form_send_information_bt">Salvar</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="tab_profissional">
                  <form class="form-horizontal"  id="FormeditProfileSaveProfessional" action="controller/user.php">
                    <div class="form-group">
                      <label for="formacao" class="col-sm-2 control-label">Formação</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputFormacao" name="inputFormacao" required required_message="Por favor, nos informe sua formação" placeholder="Formação" type="text"
                          value="<?=$formacao?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputTitulo" name="inputTitulo" required required_message="Por favor, informe um bom título sobre você"  placeholder="Titulo" type="text"
                           value="<?=$titulacao?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="resumo" class="col-sm-2 control-label">Resumo</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputResumo" name="inputResumo" placeholder="Resumo"><?=$sobre?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="abilidades" class="col-sm-2 control-label">Curriculum Lates</label>
                      <div class="col-sm-10">
                        <input class="form-control" placeholder="Lates" name="lates" type="text" value="<?=$lates?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">

                        <input id="inputName" name="ProfileSaveProfessional" value="1" type="hidden">
                        <button type="button" class="btn btn-danger form_send_information_bt">Salvar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>








 