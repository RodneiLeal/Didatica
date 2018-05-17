<section class="content">

        <?php if($tipo): /* este trecho de codigo deve ser reduzino para uma função */
             echo $resumoFinanceiro;
        endif;?>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-tools pull-left">
                        <a href="Dashboard/editar perfil" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                    </div>
                </div>

                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?=$foto?>" alt="<?=$username?>">
                    <h3 class="profile-username text-center"><?=$username?></h3>
                    <p class="text-muted text-center"><?=$tipo?$titulacao:''?></p>

                    <?php if($tipo): ?>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Publicações</b>
                            <a class="pull-right">
                                <?=$publicacoes?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Inscritos</b>
                            <a class="pull-right">
                                <?=$inscritos?>
                            </a>
                        </li>
                    </ul>
                    
                    <?php endif;?>

                </div>
            </div>
        </div>

        <?php if($tipo): /* este trecho de codigo deve ser reduzino para uma função */?> 

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sobre mim</h3>
                    <div class="box-tools pull-left">
                        <a href="Dashboard/editar perfil" class="btn btn-box-tool"><i class="fa fa-pencil"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-graduation-cap margin-r-5"></i> Formação</strong>
                    <p class="text-muted"><?=$formacao?></p>
                    <hr>
                    <strong><i class="fa fa-university margin-r-5"></i> Instituição</strong>
                    <p class="text-muted"><?=$instituicao?></p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Resumo</strong>
                    <p class="text-muted"><?=$resumo?></p>
                    <hr>
                    <strong><i class="fa fa-address-card margin-r-5"></i> Lattes</strong>
                    <p class="text-muted"><a href="//<?=$lattes?>" target="_blank"><?=$lattes?></a></p>

                </div>
            </div>
        </div>
        <?php endif;?>
    </div>

        

</section>

