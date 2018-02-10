<section class="content-header">
    <h1>Editar Perfil</h1>
    <ol class="breadcrumb">
        <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a >Usuário</a></li>
        <li class="active">
            <?=$username?>
        </li>
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
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="avatar-view">
                                    <img class="imagePreview img-circle" src="<?=$foto?>" height="100px" width="100px" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Usuário</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="username" name="username" placeholder="Nome de usuario" required type="text" value="<?=$username?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Nome</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="nome" name="nome" placeholder="Nome" required type="text" value="<?=$nome?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Sobrenome</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required type="text" value="<?=$sobrenome?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Email</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="email" name="email" placeholder="Email" required  type="text" value="<?=$email?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Senha</label>
                            </div>
                            <div class="col-md-11">
                              <div class="input-group">
                                <input class="form-control" id="passwd" name="passwd" placeholder="Senha" type="password">
                                <span title="Mostrar senha" class="hide-password input-group-addon btn btn-info btn-flat">Mostrar</span>
                              </div>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <button type="button" id="updateUserProfile" class="btn btn-danger">Salvar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    
                    <?php if($tipo): ?>

                    <input type="hidden" id="idinstrutor" value="<?=$idinstrutor?>">
    
                    <!-- Formulario para conta de instrutor -->
                    <div class="tab-pane" id="profissional">

                      <div class="row">
                        <div class="col-md-12">

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Titulo</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="titulo" name="titulo" required placeholder="Titulo" type="text" value="<?=$titulacao?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Formação</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="formacao" name="formação" required placeholder="Formação" type="text" value="<?=$formacao?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Instituição</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" id="instituicao" name="instituição" required placeholder="Instituição" type="text" value="<?=$instituicao?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Resumo</label>
                            </div>
                            <div class="col-md-11">
                              <textarea class="form-control editor" id="resumo" name="resumo" placeholder="Resumo"><?=$resumo?></textarea>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Currículo Lattes</label>
                            </div>
                            <div class="col-md-11">
                              <input class="form-control" placeholder="Lattes" id="lattes" name="lattes" type="text" value="<?=$lattes?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-12">
                              <button type="button" class="btn btn-danger updateCurriculo">Salvar</button>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>

                    <!-- Formulario para registro da conta bancaria do instrutor-->
                    <div class="tab-pane" id="bancario">
                      <div class="row">
                        <div class="col-md-12">

                          <input id="idconta" type="hidden" value="<?=$idconta?>">

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>CPF</label>
                            </div>
                            <div class="col-md-11">
                              <input id="cpf" class="form-control" name="operacao" type="text" value="<?=$cpf?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Banco</label>
                            </div>
                            <div class="col-md-11">
                              <select id="banco" class="form-control">

                                <?php foreach($bancos as $banco):
                                  $selected =  $banco['idbancos'] == $banco_idbanco ? 'selected' : '';
                                ?>

                                <option <?=$selected?> value="<?=$banco['idbancos']?>"><?=$banco['codigo']?> <?=$banco['instituicao']?> - <?=$banco['site']?></option>

                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Agência</label>
                            </div>
                            <div class="col-md-11">
                              <input type="text" id="agencia" class="form-control" name="Agência" placeholder="Agência" value="<?=$agencia?>" required>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Conta</label>
                            </div>
                            <div class="col-md-11">
                              <input id="conta" class="form-control" placeholder="Conta" name="conta" type="text" value="<?=$conta?>" required>
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-1">
                              <label>Operação</label>
                            </div>
                            <div class="col-md-11">
                              <input id="operacao" class="form-control" placeholder="Operação" name="operacao" type="text" value="<?=$operacao?>">
                            </div>
                          </div>
      
                          <div class="form-group row">
                            <div class="col-md-12">
                              <button type="button" class="btn btn-danger updateBanckInformation">Salvar</button>
                            </div>
                          </div>
        
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

  <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <form class="avatar-form" action="controllers/util/crop.php" enctype="multipart/form-data" method="post">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Editor de imagem</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file" >
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>

                  <div class="col-md-3">
                    <div class="avatar-preview preview-circle-lg"></div>
                    <div class="avatar-preview preview-circle-md"></div>
                    <div class="avatar-preview preview-circle-sm"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-rotate-left"></i></button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45&deg;</button>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-rotate-right"></i></button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30&deg;</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45&deg;</button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block avatar-save">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->