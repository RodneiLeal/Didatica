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


  <?php
      $data_user = ExecData($mysqli, 'usuario','consulta_usuario','*',$_SESSION['usuarioID']);
      $row = mysqli_fetch_assoc($data_user);
  ?>


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
                        <label for="inputName" class="col-sm-2 control-label">Foto do perfil</label>

                       <div class="col-md-10 text-left">

                          <div class="preview_block"></div>
                          <img id="preview" src="<?php echo mostra_imagem('user',$row['usuario_foto']);?>" height="100px" width="100px" />
                          <br>
                          <input type="file" name="file-3[]" class="inputfile inputfile-3 ProfileUpdateImage" image_type="logotipo" preview="minha_loja_logo_preview" id="upload_logo" />
                          <label for="upload_logo"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>alterar foto&hellip;</span></label>
                      
                       </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Usuário</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputName" name="inputName" placeholder="Name" required="true" required_message="Ops, por favor, informe seu nome" type="text"
                          value="<?php echo $row['usuario_nome'];?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required required_message="Wow, precisamos de seu e-mail" type="text"
                          value="<?php echo $row['usuario_email'];?>"
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
                          value="<?php echo $row['usuario_formacao'];?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="inputTitulo" name="inputTitulo" required required_message="Por favor, informe um bom título sobre você"  placeholder="Titulo" type="text"
                           value="<?php echo $row['usuario_titulo'];?>"
                        >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="resumo" class="col-sm-2 control-label">Resumo</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputResumo" name="inputResumo" placeholder="Resumo"><?php echo $row['usuario_sobre'];?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="abilidades" class="col-sm-2 control-label">Habilidades</label>
                      <div class="col-sm-10">
                          <?php
                              $habilidades_usuario = '';
                              $data_user = ExecData($mysqli, 'usuario','consulta_usuario_habilidades','*',$_SESSION['usuarioID']);
                              while($row_habilidades = mysqli_fetch_array($data_user))
                              {
                                $habilidades_usuario .= $row_habilidades['usuario_habilidade_habilidade'].', ';
                              }
                          ?>
                        <input class="form-control" placeholder="Habilidades" name="inputHabilidades" value="<?php echo $habilidades_usuario;?>" data-role="tagsinput" id="tags" type="text">
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








 