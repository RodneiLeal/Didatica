jQuery(function ($){

  var content = $('.content-wrapper');
  var jElement = $('.kopa-course-search-2-widget');
  var acertos = 0;

  $('#example2').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true
  });
  
  $('#congratulations').modal('show');
  
  $('.btn-voltar').on('click', function(){
    redireciona('Dashboard/inscricoes');
  });
  
  $('.btn-refazer').on('click', function(){
    location.reload();
  });


  // ENVIAR MENSAGEM
    $('.send-message').on('click', function(event){
      event.preventDefault();
      this.$form  = $(document).find('#form-message');
      this.$url   = this.$form.attr('action');
      this.$formdata = new FormData($('#form-message')[0]);

      function sendMessageAulaCallback(response){
        this.$response = JSON.parse(response);
        this.$message = this.$response.message;
        this.$result = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);

        if (this.$result) {
          $("#send-message").modal("toggle");
        }
      }

      $.ajax({
        type: 'POST',
        url: this.$url,
        data: this.$formdata,
        processData: false,
        contentType: false,
      }).done(sendMessageAulaCallback);


    });
  // FIM

  // GERENCIADOR DE CURSO

    $('button[name="salvarcurso"]').on('click', function(event) {
      event.preventDefault();
      this.$form      = $(document).find('#curso');
      this.$curso     = this.$form.find('[name="curso[idcurso]"]');
      this.$url       = this.$form.attr('action');
      this.$titulo    = this.$form.find('[name="curso[titulo]"]');
      this.$categoria = this.$form.find('[name="curso[categoria]"] :selected');
      this.$imagem    = this.$form.find('[name="curso[imagem]"]');

      try{
        this.$descricao = CKEDITOR.instances['editor1'].getData();
        this.$ementa    = CKEDITOR.instances['editor2'].getData();
      }catch(e){
        console.log(e);
      }

      // validar todo os elementos antes de enviar para processamento

       this.$data = {
        idcurso:               this.$curso.val() === undefined ? '' : this.$curso.val(),
        titulo:                this.$titulo.val() === undefined ? '' : this.$titulo.val(),
        categoria_idcategoria: this.$categoria.val() === undefined ? '' : this.$categoria.val(),
        imagem:                this.$imagem.val() === undefined ? '' : this.$imagem.val(),
        resumo:                this.$descricao === undefined ? '' : this.$descricao,
        ementa:                this.$ementa === undefined ? '' : this.$ementa
      }

      var idcurso = this.$curso.val();
      console.log();

      function salvarCursoCallback(response){
        this.$response = JSON.parse(response);
        this.$message  = this.$response.message;
        this.$result   = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);

        if(this.$result){
          if (isEmpty(idcurso)){
            redireciona('Dashboard/curso/'+this.$result);
          }
          setTimeout(function(){
            redireciona('Dashboard/curso/'+idcurso+'/Grade do curso');
          }, 3000);
        }
      }

      $.post(this.$url, this.$data, salvarCursoCallback);
    });

    
    $('button[name="salvaraula"]').on('click', function(event) {
      event.preventDefault();
      this.$form      = $(document).find('#aula');
      this.$url       = this.$form.attr('action');
      this.$curso     = this.$form.find('[name="curso_idcurso"]');

      try{
        this.$objetivos = CKEDITOR.instances['editor3'].getData();
      }catch(e){
        console.log(e);
      }
      
      this.$formdata = new FormData($('#aula')[0]);
      this.$formdata.set('objetivos', this.$objetivos);

      idcurso = this.$curso.val();

      function salvarAulaCallback(response){
        this.$response = JSON.parse(response);
        this.$message  = this.$response.message;
        this.$result   = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if (this.$result) {
          setInterval(function(){
            redireciona('Dashboard/curso/'+ idcurso + '/Banco de questões')
          },3000);
        }
      }

      $.ajax({
        type: 'POST',
        url: this.$url,
        data: this.$formdata,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $('body').loading('start');
        },
        complete:function() {
          $('body').loading('stop');
        }
      }).done(salvarAulaCallback);
    });


    $('button[name="salvarquestoes"]').on('click', function(event) {
      event.preventDefault();
      this.$form      = $(document).find('#questoes');
      this.$url       = this.$form.attr('action');
      var curso = this.$form.find('[name="curso_idcurso"]').val();

      this.$data = $('[name^=questoes]').serializeArray();
      this.$data.unshift({ name: 'curso_idcurso', value: curso});

      function salvarQuestoesCallback(response){
        this.$response = JSON.parse(response);
        this.$message  = this.$response.message;
        this.$result   = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);

        if (this.$result) {
          setInterval(function(){
            redireciona('Dashboard/curso/'+ curso + '/Banco de questões/')
          },3000);
        }

        console.log(response);
      }
      
      $.ajax({
        type: 'POST',
        url: this.$url,
        data: this.$data,
        beforeSend: function () {
          $('body').loading('start');
        },
        complete: function () {
          $('body').loading('stop');
        }
      }).done(salvarQuestoesCallback);
    });

  // FIM
  
  // CONTADOR DE CARACTERES
    $('.input-container').each(function(){
      $container = $(this);
      $input     = $container.find('[maxlength]');
      $bxCounter = $container.find('.input-counter');
      $maxLength = $input.attr('maxlength');
      $bxCounter.html($maxLength);

      $input.on('input keydown keyup', function(){
        $container              = $(this).parent();
        $maxLength              = $(this).attr('maxlength');
        $caractersInserted      = $(this).val().length;
        $caractersRemaining     = $maxLength - $caractersInserted;
        $bxCounter = $container.find('.input-counter');
        $bxCounter.html($caractersRemaining);
      });
    });
  // FIM

  // VALIDAR CERTIFICADO
    $('#certified-validate').on('click', function () {
      var $code = $("#certified-validate-code")
      if(isEmpty($code.val())){
        Notificacao('error', 'Campo código vazio', 'Para validar o seu certificado é necessario inserir o codigo de validação impresso no rodapé do certificado.');
        return;
      }

      $(".certified-return").html("<img src='img/loader.gif'>");
            
      var data = {
        code: $code.val(),
      }
      
      function validateCertificateCallback(response) {
        var response = JSON.parse(response);
        var message = response.message;
        Notificacao(message.type, message.title, message.msg);

        $('.certified-return').html(response.result);
      }

      $.post("controllers/curso/certificado/validar_certificado.php", data, validateCertificateCallback);
    });
  // FIM

  // RESET PASSWORD
    $('.reset-passwd').on('click', function(event){
      event.preventDefault();
      this.$form = $(document).find('#pass-recovery');
      this.$url  = this.$form.attr('action');
      this.$email =  this.$form.find('[name="email"]');

      this.$data = {
        email: this.$email.val()
      }

      function resetPasswdCallback(response){
        this.$response = JSON.parse(response);
        this.$message = this.$response.message;
        this.$result = this.$response.result;
        this.$email.focus();
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if (this.$result) {
          setTimeout(function(){location.reload()}, 4000);
        }
      }

      $.post(this.$url, this.$data, resetPasswdCallback);

    });
  // FIM

  // FACEBOOK API
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11&appId=159280651284190';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  // FIM

  // REMOVE A IMAGEM QUANDO ROLAR A PAGINA PARA CIMA
    $(window).scroll(function () {
      this.$img = jElement.find('img#capa');
      if ($(this).scrollTop() > 250) {
        jElement.css({
          'position': 'fixed',
          'top': '10px'
        });

        this.$img.css({ 'display': 'none' });
      } else {
        jElement.css({
          'top': '100px'
        });
        this.$img.css({ 'display': 'block' });
      }
    });
  // FIM 

  // SOLICITAR CERTIFICADO
    $(".solicitar-certificado").click(function (event) {
      event.preventDefault();

      var course = $(this).attr("course");
      $('body').loading('start');

      data = {
        inscr: $('#inscr').val()
      }

      function pgs_getCodeCallback(response) {
        PagSeguroLightbox({
          code: response
        },{
          success: successCallback(response),
          abort: abortCallback
        });
        
        function successCallback(redirectCode){
          $('body').loading('stop');
        }
        
        function abortCallback(){
          $('body').loading('stop');
        }
      }
      
      $.post("controllers/curso/certificado/pagamento/redirectCode.php", data, pgs_getCodeCallback);
    });
    
  // FIM
  
  // PROVA
    // INICIA O CRONOMETRO REGRESSIVO
    $('.iniciar-prova, #good-luck').on('click', function(){
      Nquestoes = $('#nquestoes').val();
      
      function date(t=0){
        var d = new Date();
        return d.getTime() + (t*60000);
      }

      $('.clock').countdown(date(Nquestoes), function(event){
        $(this).html('Finaliza em '+event.strftime('%M:%S'))
      }).on('finish.countdown', function (event) {
        $(this).html('Tempo esgotado!');
        var prova = $('#prova').serializeArray();
        finalizarProva(prova);
        $('#finalizar-prova').attr('disabled', 'disabled');
      });
    });

    // MOSTRA MODAL INICIAL
      $('#good-luck').modal('show');
    // FIM

    // CONFERE QUETÃO MARCADA
      $('.opcao').on('change', function(event){
        opt = $(this);

        function confereQuestaoCallback(response){
          response = JSON.parse(response);
          $('[name="' + opt.attr('name') + '"]').attr('disabled', 'disabled');
          opt.removeAttr('disabled', 'disabled');
          opt.css({'display':'none'});

          if(response[0].resposta==1){ 
            opt.before('<i class="fa fa-check green"></i>');
            acertos++;
          }else{
            opt.before('<i class="fa fa-times red"></i>');
          }
        }

        opcao = $('#curso, [name="'+opt.attr('name')+'"]').serialize();

        $.ajax({
          url: 'controllers/curso/confereQuestao.php',
          type: 'POST',
          datatype: 'application/json',
          data: opcao,
          success: confereQuestaoCallback
        });

      });
    // FIM

    // FINALIZAR A PROVA
      $('#finalizar-prova').on('click', function (event) {
        event.preventDefault();
        var prova = $('#prova').serializeArray();
        if(prova.length>2){
          $('#finalizar-prova, input[type=radio]').attr('disabled', 'disabled');
          finalizarProva(prova);
        }else{
          Notificacao('error', 'Sua prova está em branco!', 'Nenhuma questão foi marcada');
        }
      });

      function finalizarProva(prova){
        $('.clock').countdown('stop');

        prova.unshift({name:'acertos', value:acertos}, {'name':'nquestoes', 'value':Nquestoes});
        
        function provaCallback(response){
          response = JSON.parse(response);
          if (response.avaliacao){
            $('#good-work').modal('show');
            $('.nota').html(response.nota+'%');
          }else{
            $('#too-bad').modal('show');
            $('.nota').html(response.nota+'%');
          }
          $('.respostas').html('Você acertou <strong>'+acertos+'</strong> questões');
          setInterval(function(){
            redireciona('Dashboard?p=curso&inscr=' + prova[2].value);
          },600000);
        }
        
        $.ajax({
          url: 'controllers/curso/saveProva.php',
          type: 'POST',
          datatype: 'application/json',
          data: prova,
          success: provaCallback
        });
      }
    // FIM

  // FIM
 
    $('.remove-ask').on('click', function(){
      $(this).parents('.panel').remove();
    });

  // ADICIONA UM NOVO FORMULARIO DE QUESTÃO
    i = 1;
    $('.add-ask').on('click', function(event){
      event.preventDefault();
      i++;
      var template  = $('<div>').addClass('box box-primary panel template');
            
      var boxheader = $('<div>').addClass('box-header')
      var h4 = $('<h4>').addClass('box-title'); 
      h4.append(function(){
        var a = $('<a>').attr({
          'data-toggle':'collapse',
          'data-parent':'#accordion',
          'aria-expanded':'true'});
        return a.text('Questão '+i);
      });
      var div = $('<div>').addClass('box-tools pull-left');
      div.append(function(){
       var a = $('<a>').addClass('btn btn-box-tool remove-ask remove-ask');
        a.append(function(){
          return $('<i>').addClass("fa fa-trash fa-2x");
        });
        a.on('click', function(){
          $(this).parents('.panel').remove();
        });
        return a;
      });
      boxheader.append(h4, div);
      
      var panel = $('<div>').addClass("collapse in panel-collapse")
      panel.attr({
        'aria-expanded':"true",
        'id':"panel-1",
        'href':'#panel-'+i
      });
      
      panel.append(function(){
        
        var div = $('<div>').addClass("box-body");
        var row1 = $('<div>').addClass("row");
        row1.append(function(){
          var div = $('<div>').addClass("col-md-12");
          var label = $('<label>').text('Questão');
          var input = $('<input>').addClass('form-control');
          input.attr({
            'type':"text",
            'name':"questoes["+i+"][questao]",
            'placeholder':"Questão"
          });
          return div.append(label, input);
        });

        var row2 = $('<div>').addClass("row");
        var divcol1 = $('<div>').addClass("col-md-6");
        var divcol2 = $('<div>').addClass("col-md-6");
        row2.append(
          divcol1.append($('<label>').text('Opções'), optionsGroup(1), optionsGroup(2), optionsGroup(3)),
          divcol2.append($('<label>').text('Opções'), optionsGroup(4), optionsGroup(5)));
                
        function optionsGroup(q){
          var divgroup = $('<div>').addClass('input-group');
          return divgroup.append(function(){
            var span = $('<span>').addClass('input-group-addon');
            return span.append(function(){
              return $('<input>').attr({
                'type':"radio",
                'value':q,
                'name':"questoes["+i+"][resposta]"
              });
            })},
            $('<input>').attr({
              'class': "form-control",
              'name':'questoes['+i+'][opcao_'+q+']',
              'type':"text",
              'placeholder':"Resposta"
            })
          );
        }

        return div.append(row1, row2);
      });

      template.append(boxheader, panel);
      
      $('.question-box').append(template);
    });
    
  // FIM

  // ENVIAR CURSO PARA ANALISE
    $('.publish').on('click', function(event){
      event.preventDefault();
      this.$form = $(document).find('#analisar_curso');
      this.$url = this.$form.attr('action');
      this.$formdata = new FormData($('#analisar_curso')[0]);

      function analiseCallback(response) {
        this.$response = JSON.parse(response);
        this.$message = this.$response.message;
        this.$result = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if (this.$result) {
          setInterval(function(){
            location.reload();
          }, 4000);
        }
      }

      $.ajax({
        type: 'POST',
        url: this.$url,
        data: this.$formdata,
        processData: false,
        contentType: false,
        beforeSend: function () {
          $('body').loading('start');
        },
        complete: function () {
          $('body').loading('stop');
        }
      }).done(analiseCallback);
    });

  // FIM

  // TORNAR-SE INSTRUTOR
    $('.form-curriculo').on('click', function(){
      $('#novo-instrutor').modal('hide');
    });

    $('.form-bancario').on('click', function(){
      $('#form-curriculo').modal('hide');
    });

    $('.salvar-curriculo').on('click', function(event){

      event.preventDefault();

      this.$form        = $(document).find('#novoInstrutor');
      this.$url         = this.$form.attr('action');
      this.$nome        = this.$form.find('[name="nome"]');
      this.$sobrenome   = this.$form.find('[name="sobrenome"]');
      this.$titulacao   = this.$form.find('[name="titulacao"]');
      this.$formacao    = this.$form.find('[name="formacao"]');
      this.$instituicao = this.$form.find('[name="instituicao"]');
      this.$lattes      = this.$form.find('[name="lattes"]');
      this.$resumo      = CKEDITOR.instances['curriculo_resumo'];
      this.$cpf         = this.$form.find('[name="cpf"]')
      this.$banco       = this.$form.find('[name="banco"] :selected')
      this.$agencia     = this.$form.find('[name="agencia"]')
      this.$conta       = this.$form.find('[name="conta"]')
      this.$operacao    = this.$form.find('[name="operacao"]')

      this.$data = {
        perfil: {
          nome: this.$nome.val(),
          sobrenome: this.$sobrenome.val()
        },
        curriculo: {
          titulacao: this.$titulacao.val(),
          formacao: this.$formacao.val(),
          instituicao: this.$instituicao.val(),
          lattes: this.$lattes.val(),
          resumo: this.$resumo.getData()
        },
        conta: {
          cpf: this.$cpf.val(),
          bancos_idbancos: this.$banco.val(),
          agencia: this.$agencia.val(),
          conta: this.$conta.val(),
          operacao: this.$operacao.val()
        }
      }
      
      function updateUserCallback(response){
        console.log(response);
        this.$response = JSON.parse(response);
        this.$message = this.$response.message;
        this.$result = this.$response.result;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if(this.$result){
          setInterval(function(){
            location.reload();
          }, 3000);
        }
      }

      $.post(this.$url, this.$data, updateUserCallback);

    });
  // FIM

  // TOLLTIP
    $('[data-toggle="popover"]').popover({
      trigger:'hover'
    });
  // FIM

  // INICIAR CURSO
    $('.iniciar-curso').on('click',function(){
      
        data = {
          'curso_idcurso':$(this).attr('data-curso'),
          'usuario_idusuario': $(this).attr('data-user')
        }
        
        function inscricaoCallback(response){
          response = JSON.parse(response);
          var message = response.message;
          Notificacao(message.type, message.title, message.msg);

          if(response.result){
            redireciona('Dashboard/inscricao/' + response.result);
          }

        }
        
        $.post("controllers/curso/inscricao.php", data, inscricaoCallback);
    });
  // FIM

  // ACESSAR CURSO INSCRITO
    $('.acessar-curso').on('click', function(){
      redireciona('Dashboard/inscricao/' + $(this).attr('data-inscr'));
    });
  // FIM

  // MENU MOBILE DA PAGINA INICIAL
    $( '#dl-menu' ).dlmenu({
      animationClasses : { classin : 'dl-animate-in-5', classout : 'dl-animate-out-5' }
    });
  // FIM

  // ATUALIZAR INFORMAÇÕES DE PERFIL DO USUARIO
    $('#updateUserProfile').on('click', function(event){

      event.preventDefault();

      var data = new Object();

      data.idusuario = $('#id').val();
      data.foto = $('.imagePreview').attr('src');

      if(!isEmpty($('#username').val()))
        data.username  = $('#username').val();
      
      if(!isEmpty($('#nome').val()))
        data.nome      = $('#nome').val();

      if(!isEmpty($('#sobrenome').val()))
        data.sobrenome = $('#sobrenome').val();

      if(!isEmpty($('#tel').val()))
        data.telefone = $('#tel').val();

      if(!isEmpty($('#email').val()))
        data.email     = $('#email').val();
      
      if(!isEmpty($('#passwd').val()))
        data.pswd       = $('#passwd').val();

        console.log(data);

      function userUpdateCallback(response){
        response =  JSON.parse(response);
        var message = response.message;
        Notificacao(message.type, message.title, message.msg);
        // location.reload();
      }

      $.post('controllers/user/update.php', data, userUpdateCallback);

    });
  // FIM

  // ATUALIZAR CURRICULO DO INSTRUTOR 
    $('.updateCurriculo').on('click', function(event){

      event.preventDefault();

      var data = new Object();

      if(!isEmpty($('#id').val()))
        data.idinstrutor = $('#idinstrutor').val();

        if(!isEmpty(CKEDITOR.instances['resumo'].getData()))
          data.resumo = CKEDITOR.instances['resumo'].getData();

      if(!isEmpty($('#titulo').val()))
        data.titulacao = $('#titulo').val();
        
      if(!isEmpty($('#formacao').val()))
        data.formacao = $('#formacao').val();

      if(!isEmpty($('#instituicao').val()))
        data.instituicao = $('#instituicao').val();

      if(!isEmpty($('#lattes').val()))
        data.lattes = $('#lattes').val();
        
      function curriculoCallback(response){
        console.log(response);
        if(response){
          Notificacao('success', 'Currículo Atualizado', 'Seu currículo foi atualizado com sucesso!');
          redireciona(window.location.href);
        }
      }

      $.post('controllers/instrutor/updateCurriculo.php', data, curriculoCallback);
    });
  // FIM

  // ATUALIZAR DADOS BANCARIOS DO INSTRUTOR
    $('.updateBanckInformation').on('click', function(event){

      event.preventDefault();

      var data = new Object();

      data.idconta           = $('#idconta').val();
      data.usuario_idusuario = $('#id').val();
      data.bancos_idbancos   = $('#banco').val();

      if(!isEmpty($('#agencia').val()))
        data.agencia = $('#agencia').val();

      if(!isEmpty($('#conta').val()))
        data.conta = $('#conta').val();

      if(!isEmpty($('#operacao').val()))
        data.operacao = $('#operacao').val();

      if(!isEmpty($('#cpf').val()))
        data.cpf = $('#cpf').val();

      function banckInformationCallback(response){
        switch(response){
          case '1__':
            Notificacao('success', 'Dados Bancarios Atualizado', 'Seus dados bancarios forma atualizados com sucesso!');
            redireciona('Dashboard');
          break;
        }
      }

      $.post('controllers/instrutor/updateBanckInformation.php', data, banckInformationCallback);
    });
  // FIM
  
  // ESTRELAS DE OPINIÕES
    $(".starrr").starrr();
  // FIM

  // EDITOR DE TEXTO
    $('.editor').each(function(){
      CKEDITOR.replace($(this).attr('id'), {
        height: '165'
      })
    });
  // FIM

  // CADASTRO USUÁRIO
    $('.signup').on('click', function(event){
      event.preventDefault();
      
      this.$nome = $("#register_name");
      this.$email = $("#register_email");
      this.$pass = $("#register_pass");

      this.$data = {
        username: this.$nome.val(),
        email: this.$email.val(),
        passwd: this.$pass.val()
      };

      function registerCallback(response) {
        this.$response = JSON.parse(response);
        this.$message = this.$response.message;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if (this.$response.result) {
          setTimeout(function () {
            location.href = 'home'
          }, 3000);
        }       
      }


      $.post('controllers/user/register.php', this.$data, registerCallback);

    });
  // FIM

  // LOGIN USUÁRIO
    $('button#login').on('click', function(event){
      event.preventDefault();

      this.$form  = $(document).find('#form-login');
      this.$email = this.$form.find("#user_email")
      this.$pswd  = this.$form.find("#user_pass")
      this.$url   = this.$form.attr('action');

      this.$data = {
        pid: this.$email.val(),
        passwd: this.$pswd.val()
      }

      function loginCallback(response) {
        this.$response = JSON.parse(response);
        this.$message  = this.$response.message;
        Notificacao(this.$message.type, this.$message.title, this.$message.msg);
        if(this.$response.result){
            location.reload();
        }
      }
      
      $.post(this.$url, this.$data, loginCallback);
    });
  // FIM

  // LOGOUT USUÁRIO
    $(".logoff").on('click', function(){
      data = {
        logoff: true
      }

      function logoffCallback(response){
        location.reload();
      }

      $.post('controllers/logout.php', data, logoffCallback);
    });
  // FIM

/*******************************  FUNÇÕES PUBLICAS  *************************************/
  
  function isEmpty(value){
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
  }
  
  function redireciona(url){
    location.href=url;
  }
  
  function Notificacao(tipo, titulo, mensagem){
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr[tipo](mensagem, titulo);
  }
 
  // Avaliar Curso
  $(".course_get_rate").click(function(){
    var course = $(this).attr("course");

    $("#modal_avaliar").modal("show");
    $("#FormEnrollRate_matricula").val(course);
  });
});
