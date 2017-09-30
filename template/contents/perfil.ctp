<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perfil</h1>
    <ol class="breadcrumb">
        <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a >Usuário</a></li>
        <li class="active">
            <?=$username?>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- Profile Image -->
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?=$foto?>" alt="<?=$username?>">
                    <h3 class="profile-username text-center"><?=$username?></h3>
                    <p class="text-muted text-center"><?=$tipo?$titulacao:''?></p>


                    <!-- se o usuario for instrutor	-->
                    <?php
                    if($tipo):
                    ?>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Publicações</b>
                            <a class="pull-right">
                                <?=count($this->cursos->getCursosInstrutor($idinstrutor))?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Inscritos</b>
                            <a class="pull-right">
                                <?=count($this->inscricoes->getInscricaoPorUsuario($idinstrutor))?>
                            </a>
                        </li>
                    </ul>
                    <!-- fim do se usuario for instrutor -->
                    <?php endif;?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <?php
            if($tipo): // se tipo de perfil igual a instrutor, então deverá exibir o quadro sobre mim
        ?>

        <!-- About Me Box -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sobre mim</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-graduation-cap margin-r-5"></i> Formação</strong>
                    <p class="text-muted"><?=$formacao?></p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Resumo</strong>
                    <p>
                        <?=$sobre?>
                    </p>
                    <hr>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <?php endif;?>

    </div><!-- /.row -->
</section><!-- /.content -->
