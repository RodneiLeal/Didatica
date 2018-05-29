
<section class="content">
  <div class="box">
    <div class="box-body no-margin no-padding">
      <div class="col-md-12 with-border-left no-padding">
        <div class="form-header with-border-bottom">
            <h3 class="form-title"><?=$assunto?></h3>
            <button type="button" data-toggle="modal" data-target="#send-message" class="form-btn">Responder</button>
        </div>

        <div class="box-body form-container">
          <div class="row form-row">
            <div class="col-md-12">
              <p class="form-text"><span class="message-header">De: </span><?=$remetente?></p>
              <p class="form-text"><span class="message-header">Assunto: </span><?=$assunto?></p>
              <p class="form-text"><span class="message-header">Data: </span><?=$data_envio?></p>
            </div>
          </div>
          
          <div class="row form-row">
            <div class="col-md-12">
                <p class="form-text"><span class="message-header">Mensagem: </span><?=$mensagem?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" role="dialog" id="send-message">
  <div class="modal-dialog">

    <form  id="form-message" action="controllers/mensagem.php" method="POST">

      <input type="hidden" name="para" value="<?=$de?>">

      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <img src="<?=$foto?>" class="img-circle" alt="<?=$remetente?> - <?=$remetente?>" />
          </div>
          <h3 class="widget-user-username"><?=$remetente?></h3>
        </div>

        <div class="box-body">
          <div class="row" style="padding:30px 10px 0 10px">
            <div class="col-md-12">
                <div class="form-goup">
                  <label> Assunto:</label>
                    <input type="text" class="form-control" name="assunto" value="Re.: <?=$assunto?>">
                </div>

                <div class="form-group">
                  <label>Mensagem</label>
                  <textarea class="form-control" name="mensagem" rows="7" cols="35" style="resize:none"><?=$mensagem?><br></textarea>
                </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button class="pull-right btn btn-warning btn-xl send-message"><i class="fas fa-paper-plane"></i> Enviar</button>
        </div>
      </div>
    </form>

  </div>
</div>