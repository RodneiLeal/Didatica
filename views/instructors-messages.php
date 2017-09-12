  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Enviar Mensagem</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Mensagem</li>
    </ol>
  </section>
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Enviar Mensagem para Instrutores</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">

                  <form class="form-horizontal"  id="FormeditProfileSaveProfessional" action="controller/user/instructor_messages_send.php">
                    <div class="form-group">
                      <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                      <div class="col-sm-10">
                        <input class="form-control" id="messages_send_all_instructors_title" name="messages_send_all_instructors_title" required required_message="Por favor, informe um bom título"  placeholder="Titulo" type="text" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="resumo" class="col-sm-2 control-label">Mensagem</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="messages_send_all_instructors_message" required required_message="Por favor, informe um bom título" name="messages_send_all_instructors_message" placeholder="Mensagem"></textarea>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">

                        <input id="messages_send_all_instructors" name="messages_send_all_instructors" value="1" type="hidden">
                        <button type="button" class="btn btn-primary form_send_information_bt">Enviar</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>

  </section>








 