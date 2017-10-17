  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Editar Perfil</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">User profile edit</li>
    </ol>
  </section>
  <input type="hidden" id="id" value="<?=$idusuario?>">
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">Editar perfil</h3>
          </div>

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#perfil" data-toggle="tab">Perfil</a></li>

                    <?php if($tipo): ?>

                    <li><a href="#profissional" data-toggle="tab">Dados Profissionais</a></li>
                    <li><a href="#bancario" data-toggle="tab">Dados Bancarios</a></li>

                    <?php endif ?>

                  </ul>

                  <div class="tab-content">

                    <div class="tab-pane active" id="perfil">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-md-10">
                            <label for="imageFile" class="picture-label ">
                              <img class="imagePreview circle" src="<?=$foto?>" height="100px" width="100px" />
                            </label>
                            <br>
                            <span class="imageName">alterar foto ...</span>
                            <input type="file" name="myPicture" id="imageFile" class="imageFile" style="display:none"/>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 control-label">Usuário</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="username" name="username" placeholder="Nome de usuario" required type="text"
                                value="<?=$username?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="nome" name="nome" placeholder="Nome" required type="text"
                                value="<?=$nome?>">
                            </div>
      
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 control-label">Sobrenome</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required type="text"
                                value="<?=$sobrenome?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input class="form-control" id="email" name="email" placeholder="Email" required  type="text"
                                value="<?=$email?>"
                              >
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <label for="passwd" class="col-sm-2 control-label">Senha</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input class="form-control" id="passwd" name="passwd" placeholder="Senha" type="password">
                                <span title="Mostrar senha" class="hide-password input-group-addon btn btn-info btn-flat">Mostrar</span>
                              </div>
      
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-10">
      
                              <button type="button" id="updateUserProfile" class="btn btn-danger">Salvar</button>
                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php if($tipo): ?>
    
                    <!-- Formulario para conta de instrutor -->
                    <div class="tab-pane" id="profissional">
                      <div class="row">
                        <div class="col-md-12">
                          <form >
                            <div class="form-group row">
                              <label for="formacao" class="col-sm-2 control-label">Formação</label>
                              <div class="col-sm-10">
                                <input class="form-control" id="inputFormacao" name="inputFormacao" required placeholder="Formação" type="text"
                                  value="<?=$formacao?>"
                                >
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                              <div class="col-sm-10">
                                <input class="form-control" id="inputTitulo" name="inputTitulo" required placeholder="Titulo" type="text"
                                  value="<?=$titulacao?>"
                                >
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="resumo" class="col-sm-2 control-label">Resumo</label>
                              <div class="col-sm-10">
                                <textarea class="form-control editor" id="inputResumo" name="inputResumo" placeholder="Resumo"><?=$sobre?></textarea>
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="abilidades" class="col-sm-2 control-label">Curriculum Lates</label>
                              <div class="col-sm-10">
                                <input class="form-control" placeholder="Lates" name="lates" type="text" value="<?=$lates?>">
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <div class="col-sm-offset-2 col-sm-10">
        
                                <input id="" name="ProfileSaveProfessional" value="1" type="hidden">
                                <button type="button" class="btn btn-danger form_send_information_bt">Salvar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Formulario para registro da conta bancaria do instrutor-->
                    <div class="tab-pane" id="bancario">
                      <div class="row">
                        <div class="col-md-12">
                          <form>
                            
                            <div class="form-group row">
                              <label for="abilidades" class="col-sm-2 control-label">CPF</label>
                              <div class="col-sm-10">
                                <input class="form-control" name="operacao" type="text" value="<?=$cpf?>">
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="formacao" class="col-sm-2 control-label">Banco</label>
                              <div class="col-sm-10">
                                <input class="form-control" id="banco" name="banco" required placeholder="Banco numero" type="text"
                                  value="<?=$banco?>"
                                >
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="abilidades" class="col-sm-2 control-label">Site</label>
                              <div class="col-sm-10">
                                <input class="form-control" placeholder="Operação" name="operacao" type="text" value="<?=$site?>">
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="resumo" class="col-sm-2 control-label">Agência</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="agencia" name="Agência" placeholder="Agência" value="<?=$agencia?>" required>
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="abilidades" class="col-sm-2 control-label">Conta</label>
                              <div class="col-sm-10">
                                <input class="form-control" placeholder="Conta" name="conta" type="text" value="<?=$conta?>" required>
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <label for="abilidades" class="col-sm-2 control-label">Operação</label>
                              <div class="col-sm-10">
                                <input class="form-control" placeholder="Operação" name="operacao" type="text" value="<?=$operacao?>">
                              </div>
                            </div>
        
                            <div class="form-group row">
                              <div class="col-sm-offset-2 col-sm-10">
                                <input id="" name="ProfileSaveProfessional" value="1" type="hidden">
                                <button type="button"  data-toggle="modal" data-target="#conta-bancaria"  class="closed-modal btn btn-danger form_send_information_bt">Salvar</button>
                              </div>
                            </div>
        
                          </form>
                        </div>
                      </div>
                    </div>

                    <?php endif ?>

                  </div>
                </div>
            



              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>