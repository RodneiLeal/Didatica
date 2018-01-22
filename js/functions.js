jQuery(function ($){

  
  var content = $('.content-wrapper');
  var jElement = $('.kopa-course-search-2-widget');
  var acertos = 0;
  var jcrop_api;


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

  $('#congratulations').modal('show');

  // SOLICITAR CERTIFICADO
    $("#certificate-request").click(function (event) {
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

      console.log(Nquestoes);

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

  // NOVO CURSO
                     /*  falta somente a validacao das informações  */
    //CURSO PREVIEW 
    $('.curso-titulo').on('change keyup', function(){
      $('.preview-curso-titulo').text($(this).val());
      $('[name="aula[titulo]"]').val($(this).val());
    });

    $('textarea#ementa').on('change keyup', function(){
      console.log($(this).val());

      // $('[name="aula[objetivos]"]').val(CKEDITOR.instances['ementa'].getData());
    })

    $('.curso-subcategoria').on('change keyup', function(){
      $('.preview-curso-subcategoria').text($('.curso-subcategoria option:selected').text());
    });

    $('.curso-categoria').on('change keyup', function(){
      $('.preview-curso-categoria').text($('.curso-categoria option:selected').text());
    });
    
    $('.remove-ask').on('click', function(){
      $(this).parents('.panel').remove();
    });

    i = 1;
    $('.add-ask').on('click', function(){
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
            'name':"provas["+i+"][questao]",
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
                'name':"provas["+i+"][resposta]"
              });
            })},
            $('<input>').attr({
              'class': "form-control",
              'name':'provas['+i+'][opcao_'+q+']',
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
    
    $('.prox-etapa').on('click', function(){
      var section = $(this).parents('section');
      section.addClass('display-hidden');
      section.next().removeClass('display-hidden');
    });

    $('.etapa-anterior').on('click', function(){
      var section = $(this).parents('section');
      section.addClass('display-hidden');
      section.prev().removeClass('display-hidden');
    });

  // FIM NOVO CURSO

  // TORNAR-SE INSTRUTOR
    $('.form-curriculo').on('click', function(){
      $('#novo-instrutor').modal('hide');
    });

    $('.form-bancario').on('click', function(){
      $('#form-curriculo').modal('hide');
    });

    $('.salvar-curriculo').on('click', function(event){

      event.preventDefault();

      var perfil     = new Object();
      var curriculo = new Object();
      var conta  = new Object();

      var idusuario = $('#idusuario').val();

      perfil.idusuario             = idusuario;
      curriculo.usuario_idusuario  = idusuario;
      conta.usuario_idusuario      = idusuario;

      if(!isEmpty($('#perfil-nome').val()))
        perfil.nome =  $('#perfil-nome').val();

      if(!isEmpty($('#perfil-sobrenome').val()))
        perfil.sobrenome =  $('#perfil-sobrenome').val();
      
      if(!isEmpty(CKEDITOR.instances['curriculo_resumo'].getData()))
        curriculo.resumo =  CKEDITOR.instances['curriculo_resumo'].getData();

      if(!isEmpty($('#curriculo-titulacao').val()))
        curriculo.titulacao =  $('#curriculo-titulacao').val();
        
      if(!isEmpty($('#curriculo-formacao').val()))
        curriculo.formacao =  $('#curriculo-formacao').val();
        
      if(!isEmpty($('#curriculo-instituicao').val()))
        curriculo.instituicao =  $('#curriculo-instituicao').val();
        
      if(!isEmpty($('#curriculo-lattes').val()))
        curriculo.lattes =  $('#curriculo-lattes').val();
        
      if(!isEmpty($('#conta-banco').val()))
        conta.bancos_idbancos =  $('#conta-banco').val();

      if(!isEmpty($('#conta-agencia').val()))
        conta.agencia =  $('#conta-agencia').val();

      if(!isEmpty($('#conta-conta').val()))
        conta.conta =  $('#conta-conta').val();

      if(!isEmpty($('#conta-operacao').val()))
        conta.operacao =  $('#conta-operacao').val();

      if(!isEmpty($('#conta-cpf').val()))
        conta.cpf =  $('#conta-cpf').val();

        // PODE SER MELHORADO PARA FAZER UM UNICO ENVIO PARA PROCESSAMENTO DA MESMA FORMA COMO FOI FEITO COM O INSERIR CURSO
        // NECESSARIO AVALIAR CAMPOS EM BRANCO E PARAR PROGRAMA CASO ALGUM CAMPO ESTEJA FALTANDO

      $.post('controllers/user/update.php', perfil, updateUserCallback);

      function updateUserCallback(response){
        if(response){
          Notificacao('success', '', 'Seu perfil foi atualizado!');
          $.post('controllers/instrutor/saveCurriculo.php', curriculo, saveCurriculoCallback);
        }
      }
      
      function saveCurriculoCallback(response){
        if(response){
          Notificacao('success', '', 'Seu currículo foi arquivado!');
          $.post('controllers/instrutor/saveBanckInformation.php', conta, saveBanckInformationCallback);
        }
      }
      
      function saveBanckInformationCallback(response){
        if(response){
          Notificacao('success', '', 'Seus dados bancarios foram arquivados!');
          data = {usuario_idusuario: idusuario, tipo: 1};
          $.post('controllers/solicitacao.php', data, solicitacaoCallback);
        }
      }
      
      function solicitacaoCallback(response){
        if(response){
          Notificacao('success', 'Seu solicitação foi enviada!', 'Fique atento, enviaremos uma mensagem assim que concluirmos o processo.');
          $('#form-bancario').modal('hide');
          setInterval(redireciona(window.location.href), 3000);
        }
      }
    });
  // FIM TORNAR-SE INSTRUTOR

  // TOLLTIP
  $('[data-toggle="popover"]').popover({
    trigger:'hover'
  });

  // INICIAR CURSO
  $('.iniciar-curso').on('click',function(){
      var data = new Object();

      data.curso_idcurso     = $(this).attr('data-curso');
      data.usuario_idusuario = $(this).attr('data-user');
      
      function inscricaoCallback(response){
        redireciona('Dashboard?p=curso&inscr='+response);
      }
      
      $.post("controllers/curso/inscricao.php", data, inscricaoCallback);
  });

  // ACESSAR CURSO INSCRITO
  $('.acessar-curso').on('click', function(){
    redireciona('Dashboard?p=curso&inscr='+$(this).attr('data-inscr'));
  });

  // MENU MOBILE DA PAGINA INICIAL
  $( '#dl-menu' ).dlmenu({
    animationClasses : { classin : 'dl-animate-in-5', classout : 'dl-animate-out-5' }
  });

  // ATUALIZAR INFORMAÇÕES DE PERFIL DO USUARIO
  $('#updateUserProfile').on('click', function(event){

    event.preventDefault();

    var data = new Object();

    data.idusuario = $('#id').val();

    /*****VERIFICAR COMO ENVIAR OS DADOS DE IMAGEM PARA O DOCUMENTO DE PROCESSO*****/
    // if(!isEmpty($('#imageFile').val()))
    //   data.img        = getFileImge;

    if(!isEmpty($('#username').val()))
      data.username  = $('#username').val();
    
    if(!isEmpty($('#nome').val()))
      data.nome      = $('#nome').val();

    if(!isEmpty($('#sobrenome').val()))
      data.sobrenome = $('#sobrenome').val();

    if(!isEmpty($('#email').val()))
      data.email     = $('#email').val();
    
    if(!isEmpty($('#passwd').val()))
      data.pswd       = $('#passwd').val();

    function getFileImge(){
      var img =  new FormData();
      img.append($('#imageFile').attr('name'), $('#imageFile')[0].files[0]);
      return img;
    }
    
    function userUpdateCallback(response){
      Notificacao('success', 'Perfil Atualizado', 'Seu perfil atualizado com sucesso!');
      redireciona(window.location.href);
    }

    $.post('controllers/user/update.php', data, userUpdateCallback);

  });

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
  
  // ESTRELAS DE OPINIÕES
  $(".starrr").starrr();
  
  // EDITOR DE TEXTO
  $('.editor').each(function(){
    CKEDITOR.replace($(this).attr('id'), {
      height: '165'
    })
  });

  // CADASTRO USUÁRIO
  $('#register-bt').on('click', function(event){

    event.preventDefault();

    if (isEmpty($("#register_name").val())){
      Notificacao('error','Informe um nome de usuário','Nome obrigatório');
      $('#register_name').focus();
      return 1;
    }

    if (isEmpty($("#register_email").val())){
      Notificacao('error','Informe seu e-amail para cadastro','E-mail obrigatório');
      $('#register_email').focus();
      return 1;
    }

    if (isEmpty($("#register_pass").val())){
      Notificacao('error','Informe sua senha para cadastro','Senha obrigatório');
      $('#register_pass').focus();
      return 1;
    }

    var data = {
      username: $("#register_name").val(),
      email: $("#register_email").val(),
      passwd: $("#register_pass").val()
    };

    $.post("controllers/user/register.php", data, registerCallback);
  });

  // LOGIN USUÁRIO
  $('#login-bt').on('click', function(event){

    event.preventDefault();

    if (isEmpty($("#user_email").val())){
      Notificacao('error','Informe seu e-mail de cadastro','E-mail obrigatório');
      $('#user_email').focus(); return 1;
    }

    if (isEmpty($("#user_pass").val())){
      Notificacao('error','Informe sua senha de cadastro','Senha obrigatório');
      $('#user_pass').focus(); return 1;
    }

    var data = {
      pid: $("#user_email").val(),
      passwd: $("#user_pass").val()
    }
    
    $.post("controllers/login.php", data, loginCallback);
  });

  // CADASTRO USUÁRIO VIA REDE SOCIAL <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< REVISAR
  $('.social-signup').on('click', function(){
    
    var data = {
      rede : $(this).attr('data-target')
    }

    $.post("controllers/user/register.php", data, registerCallback);
  });

  // LOGIN USUÁRIO VIA REDE SOCIAL <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< REVISAR
  $('.social-signin').on('click', function(){

    var data = {
      rede : $(this).attr('data-taget')
    }

    $.post("controllers/login.php", data, loginCallback);
  });

  // LOGOUT USUÁRIO
  $(".logoff").on('click', function(){
    data = {
      logoff: true
    }

    function logoffCallback(response){
      location.href='home';
    }

    $.post('controllers/logout.php', data, logoffCallback);
  });

  // SELECIONA SUBCATEGORIA
  $('.curso-categoria').on('change', function(){
    $.ajax({
      url: 'controllers/subcategorias.php',
      method: 'POST',
      data: {categoria_idcategoria:$(this).val()}
    }).done(function(response){
      $('.curso-subcategoria').html(response);
    });
  });

/*******************************  FUNÇÕES PUBLICAS  *************************************/

  function loginCallback(response){
    switch(response){
      case '0__':
        Notificacao('error','Ops!','Combinação de e-mail e senha invalidos');
        $('#LoginFormEmail').focus();
      break;
      case '1__':
        Notificacao('error','Usuário Bloquado!','Entre em contato com os administradores.');
      break;
      case '2__':
        Notificacao('success','Redirecionando...','Login realizado com sucesso');
        redireciona(window.location.href);
      break;
    }
  }

  function registerCallback(response){
    switch(response){
      case '0__':
        Notificacao('error','E-mail inválido','E-mail obrigatório');
        $('#register_email').focus();
      break;
      case '1__':
        Notificacao('error','Este usuário já existe', 'Nome de usuário ja cadastrado, por favor escolha ouro nome de usuário!');
        $('#register_name').focus();
      break;
      case '2__':
        Notificacao('error','Este e-mail já está cadastrado','E-mail obrigatório');
        $('#register_email').focus();
      break;
      case '3__':
        // mensagem usada qaundo a confirmação por email esta configurada
        // Notificacao('success','Enviamos uma mensagem para o e-mail informado ','Por favor confirme seu cadstro.');
        Notificacao('success','Login realizado com sucesso','Redirecionando...');
        redireciona(window.location.href);
      break;
      case '4__':
        Notificacao('error','Algo errado aconteceu, por favor tente mais tarde!','Algo deu errado');
        redireciona('home');
      break;
    }
  }


















  /******************************************** DESTE PONTA PARA BAIXO AS FUNÇÕES PRECISAM SER REVIZADAS ********************************************/



  // ADICIONA IMAGEM USUÁRIO (PERFIL)
  $(".ProfileUpdateImage").on("change", function(){
    var file = this.files[0].name;
    
    TamanhoString = file.length;
    extensao   = file.substr(TamanhoString - 4,TamanhoString);
    if (TamanhoString == 0 ){
        Notificacao('error','Nenhuma arquivo selecionado','Arquivo inválido');
        return false;
    }else if(file.size > 100000){
      Notificacao('error','Arquivo muito grande, reduza-o um pouco','Arquivo grande');
      return false;
    }else{
      var ext = new Array('.jpg','.png','.bmp');
      for(var i = 0; i < ext.length; i++){
        if (extensao == ext[i]){
          flag = "ok";
          break;
        }else{
          flag = "erro";
        }
      }
      if (flag=="erro"){
        Notificacao('error','Envie apenas arquivos de imagens','Arquivo inválido');
        return false;
      }
    }
  
    // var file_data = file.prop('files')[0];
    $("#preview").fadeOut(500);
    $(".preview_block").html("<img src='dist/img/loader.gif'>");
  
    var form_data = new FormData();
    form_data.append('file', this.files[0]);
    var operation = 'ProfileImage';
  
      $.ajax({
          url: 'controller/user.php?operation='+operation, // point to server-side PHP script
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          //data: form_data,
          type: 'post',
          success: function(resultado)
          {
            if(resultado==0)
            {
              Notificacao('error','Houve algo de errado no envio','Tente novamente');
              return false;
            }
            else
            {
              Notificacao('success','Arquivo enviado e salvo','Sucesso');
  
  
  
              setTimeout(function(){
                var preview = document.getElementById('preview');
                var input = document.getElementById('upload_logo');
  
                if (input.files && input.files[0])
                {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                    preview.setAttribute('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                } else {
                  preview.setAttribute('src', '');
                }
  
                  $(".preview_block").html("");
                  $("#preview").fadeIn(500);
  
              }, 2000);
              return false;
            }
          }
  
      });
    //$("#formulario").submit();
    return true;
  });
  
  // VALIDA CERTIFICADO
  $('#certified-validate').on('click', function(){

    if (isEmpty($("#certified-validate-code").val())){
        Notificacao('error','Por favor, informe o código do Certificado');
        $('#certified-validate-code').focus(); return 1;
    }

    $(".certified-return").html("<img src='dist/img/loader.gif'>");

    var data =  {
      code: $("#certified-validate-code").val(),
    }

    function validateCertificateCallback(response){
      // alert(response);

      // switch(response){
      //   case '0__':
      //     Notificacao('error','Dados não localizados','Não localizamos este registro');
      //     $('.certified-return').html("<img src='dist/img/checkout/erro.png'> <BR> O Certificado informado não é válido <hr>");
      //   break;
      //   case '1__':
      //     Notificacao('success','Dados localizados','Este cerificado é válido');
      //     $('.certified-return').html("<img src='dist/img/checkout/sucesso.png'> <BR><br> Certificado de: "+ response + "<hr>");
      //   break;
      // }
    }

    $.post("controller/certified-validate.php", data, validateCertificateCallback);
  });



  $('.course-title-item-show-content').on('click',function(){
      var course_item = $(this).attr("course-item");

      $(".course-content-item").addClass("hidden");
      $(".course-content-item-docs").addClass("hidden");

      $(".course-content-item-"+course_item).removeClass("hidden");
      $(".course-content-item-docs-"+course_item).removeClass("hidden");

      $(".course-content-item-"+course_item).html("<img src='dist/img/loader.gif'>");

      var operation  = 'show-content';
      $.post("views/content/course/course-content-item-show.php",
      {
          course_item: course_item,
          operation: operation

      }, function(data)
      {
          var content = data.split('{separate_content_files}');
          var content_descrition = content[0];
          var content_docs       = content[1];

          setTimeout(function(){

                $(".course-content-item-"+course_item).html(content_descrition);
                $(".course-content-item-docs-"+course_item).html(content_docs);

          }, 2000);
          //alert(retorno);
      });
  });



  // FUNCTION VALIDA ARQUIVO(CAMPO)
  $("#product_file_image_1").on("change", function(){

      var file = this.files[0].name;
      //var object_file  = jQuery(this).attr("data-preview");
      //var object_close = jQuery(this).attr("data-close");

      TamanhoString = file.length;
      extensao   = file.substr(TamanhoString - 4,TamanhoString);
      if (TamanhoString == 0 )
      {
        Notificacao('error','Nenhuma arquivo selecionado','Arquivo inválido');
        return false;
      }
      else if(file.size > 100000)
      {
        Notificacao('error','Arquivo muito grande, reduza-o um pouco','Arquivo grande');
        return false;
      }
      else
      {
      //var ext = new Array('.asp','.htm','html','.php','.cgi');
      var ext = new Array('.jpg','.png','.bmp');

      for(var i = 0; i < ext.length; i++)
      {
        if (extensao == ext[i])
        {
          flag = "ok";
          break;
        }
        else
        {
          flag = "erro";
        }
      }
        if (flag=="erro")
        {
          Notificacao('error','Envie apenas arquivos de imagens','Arquivo inválido');
          //$("#product_file_image_1").val("Nenhum arquivo");
          return false;
        }
      }

        // var file_data = file.prop('files')[0];

      var form_data = new FormData();
      form_data.append('file', this.files[0]);
      var operation = 'course_creator_2';
      var curso = $("#course_register").val();

        //form_data.append('file', file_data);
        //alert(form_data);
        $.ajax({
            url: 'controller/course.php?course='+curso+'&operation='+operation, // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
              //data: form_data,
            type: 'post',
            success: function(resultado)
            {
              if(resultado==0)
              {
                Notificacao('error','Houve algo de errado no envio','Tente novamente');
                return false;
              }
          else
          {
            Notificacao('success','Arquivo enviado e salvo','Sucesso');



            $("#preview").fadeOut(50);
            $(".preview_block").html("<img src='dist/img/loader.gif'>");

            setTimeout(function(){
              var preview = document.getElementById('preview');
              var input = document.getElementById('product_file_image_1');

              if (input.files && input.files[0])
              {
                var reader = new FileReader();
                reader.onload = function (e) {
                  preview.setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
              } else {
                preview.setAttribute('src', '');
              }

                $(".preview_block").html("");
                $("#preview").fadeIn(500);

            }, 2000);
            return false;
          }
        }

          });

      //$("#formulario").submit();
      return true;

  });

  // COURSE ADD CONTENT
  $('#inputCourseContentAdd').on('click',function(){
     var formData = new FormData($("#FormeditCourseEditContentSave")[0]);

    $(".cd-main-content-load").html("<img src='dist/img/loader.gif'>");
    $("#inputCourseContentAdd").hide(100);

    $.ajax({
      url: 'controller/course.php',
      type: 'POST',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: function (returndata) {

        Notificacao('success','Excelente, seu conteúdo foi adicionado com sucesso','Tudo certo');

        setTimeout(function(){
          $('#file_input_files').val("");
          $(".cd-main-content-load").html("");
          $('#box_content_add_button').removeClass("btn-danger").addClass("btn-primary");
          $('#box_content_add_button').html("<i class='fa fa-plus'></i> Adicionar conteúdo");
          $('.box_content_add').hide(400);
          $("#inputCourseContentAdd").show(100);
          $("#inputCourseContentTitle").val("");
          $("#inputCourseContentResume").val("");
          var course_register_content  = $("#course_register_content").val();
          load_content_data("courselistcontent","views/content/course/course-content-item-show-edit.php?course="+course_register_content);
        }, 2000);
      }
    });
  });

  $('#inputCourseContentNewAdd').on('click',function(){
      $('#box_content_add_button').removeClass("btn-danger").addClass("btn-primary");
      $('#box_content_add_button').html("<i class='fa fa-plus'></i> Adicionar conteúdo");
      $('.box_content_add').hide(400);

      $(".cd-main-content").fadeOut(400);
      $("#inputCourseContentNewAdd").addClass("hidden");
      $("#inputCourseContentAdd").show(100);

      $("#inputCourseContentTitle").val("");
      $("#inputCourseContentResume").val("");

      var course_register_content  = $("#course_register_content").val();
      load_content_data("courselistcontent","views/content/course/course-content-item-show-edit.php?course="+course_register_content);
  });

  $('#inputCourseQuestionAnswer_bt').on('click',function(){
      var course_register_content     = $(this).attr("course");

      var answer_correct              = $(".inputCourseQuestionAnswer_correct:checked").val();

      var inputCourseQuestionTitle    = $("#inputCourseQuestionTitle").val();

      var inputCourseQuestionAnswer1  = $("#inputCourseQuestionAnswer1").val();
      var inputCourseQuestionAnswer2  = $("#inputCourseQuestionAnswer2").val();
      var inputCourseQuestionAnswer3  = $("#inputCourseQuestionAnswer3").val();
      var inputCourseQuestionAnswer4  = $("#inputCourseQuestionAnswer4").val();
      var inputCourseQuestionAnswer5  = $("#inputCourseQuestionAnswer5").val();

      if (inputCourseQuestionTitle == null || inputCourseQuestionTitle == ''){ Notificacao('error','Informe a pergunta da questão','Campo obrigatório'); $('#inputCourseQuestionTitle').focus(); return 1;}

      if (inputCourseQuestionAnswer1 == null || inputCourseQuestionAnswer1 == ''){ Notificacao('error','Informe a opção de resposta 1','Campo obrigatório'); $('#inputCourseQuestionAnswer1').focus(); return 1;}
      if (inputCourseQuestionAnswer2 == null || inputCourseQuestionAnswer2 == ''){ Notificacao('error','Informe a opção de resposta 2','Campo obrigatório'); $('#inputCourseQuestionAnswer2').focus(); return 1;}
      if (inputCourseQuestionAnswer3 == null || inputCourseQuestionAnswer3 == ''){ Notificacao('error','Informe a opção de resposta 3','Campo obrigatório'); $('#inputCourseQuestionAnswer3').focus(); return 1;}
      if (inputCourseQuestionAnswer4 == null || inputCourseQuestionAnswer4 == ''){ Notificacao('error','Informe a opção de resposta 4','Campo obrigatório'); $('#inputCourseQuestionAnswer4').focus(); return 1;}
      if (inputCourseQuestionAnswer5 == null || inputCourseQuestionAnswer5 == ''){ Notificacao('error','Informe a opção de resposta 5','Campo obrigatório'); $('#inputCourseQuestionAnswer5').focus(); return 1;}

      if (answer_correct == null || answer_correct == ''){ Notificacao('error','É necessário selecionar a pergunta correta','Campo obrigatório'); return 1;}


      var operation  = 'course_creator_add_question';
      $.post("controller/course.php",
      {
          course_register_content: course_register_content,
          answer_correct: answer_correct,
          inputCourseQuestionTitle: inputCourseQuestionTitle,
          inputCourseQuestionAnswer1: inputCourseQuestionAnswer1,
          inputCourseQuestionAnswer2: inputCourseQuestionAnswer2,
          inputCourseQuestionAnswer3: inputCourseQuestionAnswer3,
          inputCourseQuestionAnswer4: inputCourseQuestionAnswer4,
          inputCourseQuestionAnswer5: inputCourseQuestionAnswer5,
          operation: operation

      }, function(data)
      {
          var retorno = data.replace(/^\s+|\s+$/g,"");


              var resultado        = data.split('___');
              var tipo_retorno     = resultado[0].replace(/^\s+|\s+$/g,"");
              var mensagem_retorno = resultado[1];

                if(tipo_retorno=='erro')
                {
                  Notificacao('error',mensagem_retorno,'Houve algo de errado');
                }
                else
                {
                  Notificacao('success',mensagem_retorno,'Tudo certo');

                    $("#inputCourseQuestionAnswer_div").fadeOut(400);
                }

        $('#box_question_add_button').trigger("click");
        load_content_data("courselistcontentquestion","views/content/course/course-question-item-show-edit.php?course="+course_register_content);

          //alert(retorno);
      });
  });

  


  $('#exam_finish').on('click', function(){
    var course_register_content     = $(this).attr("course");
    var questao_pergunta_1              = $(".1:checked").attr("name");
    var questao_resposta_1              = $(".1:checked").val();

    var questao_pergunta_2              = $(".2:checked").attr("name");
    var questao_resposta_2              = $(".2:checked").val();

    var questao_pergunta_3              = $(".3:checked").attr("name");
    var questao_resposta_3              = $(".3:checked").val();

    var questao_pergunta_4              = $(".4:checked").attr("name");
    var questao_resposta_4              = $(".4:checked").val();

    var questao_pergunta_5              = $(".5:checked").attr("name");
    var questao_resposta_5              = $(".5:checked").val();

    var questao_pergunta_6              = $(".6:checked").attr("name");
    var questao_resposta_6              = $(".6:checked").val();

    var questao_pergunta_7              = $(".7:checked").attr("name");
    var questao_resposta_7              = $(".7:checked").val();

    var questao_pergunta_8              = $(".8:checked").attr("name");
    var questao_resposta_8              = $(".8:checked").val();

    var questao_pergunta_9              = $(".9:checked").attr("name");
    var questao_resposta_9              = $(".9:checked").val();

    var questao_pergunta_10              = $(".10:checked").attr("name");
    var questao_resposta_10              = $(".10:checked").val();

    /*
    if (questao_resposta_1 == null || questao_resposta_1 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".1").focus(); return 1;}
    if (questao_resposta_2 == null || questao_resposta_2 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".2").focus(); return 1;}
    if (questao_resposta_3 == null || questao_resposta_3 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".3").focus(); return 1;}
    if (questao_resposta_4 == null || questao_resposta_4 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".4").focus(); return 1;}
    if (questao_resposta_5 == null || questao_resposta_5 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".5").focus(); return 1;}
    if (questao_resposta_6 == null || questao_resposta_6 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".6").focus(); return 1;}
    if (questao_resposta_7 == null || questao_resposta_7 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".7").focus(); return 1;}
    if (questao_resposta_8 == null || questao_resposta_8 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".8").focus(); return 1;}
    if (questao_resposta_9 == null || questao_resposta_9 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".9").focus(); return 1;}
    if (questao_resposta_10 == null || questao_resposta_10 == ''){ Notificacao('error','Responda todas as questões','Campo obrigatório'); $(".10").focus(); return 1;}
    */

    $('#modal_exam_finish').modal("show");

    var operation  = 'course_exam_finish';

    $.post("controller/exam.php", {
      course_register_content: course_register_content,

      questao_pergunta_1: questao_pergunta_1,
      questao_resposta_1: questao_resposta_1,

      questao_pergunta_2: questao_pergunta_2,
      questao_resposta_2: questao_resposta_2,

      questao_pergunta_3: questao_pergunta_3,
      questao_resposta_3: questao_resposta_4,

      questao_pergunta_4: questao_pergunta_4,
      questao_resposta_4: questao_resposta_4,

      questao_pergunta_5: questao_pergunta_5,
      questao_resposta_5: questao_resposta_5,

      questao_pergunta_6: questao_pergunta_6,
      questao_resposta_6: questao_resposta_6,

      questao_pergunta_7: questao_pergunta_7,
      questao_resposta_7: questao_resposta_7,

      questao_pergunta_8: questao_pergunta_8,
      questao_resposta_8: questao_resposta_8,

      questao_pergunta_9: questao_pergunta_9,
      questao_resposta_9: questao_resposta_9,

      questao_pergunta_10: questao_pergunta_10,
      questao_resposta_10: questao_resposta_10,

      operation: operation

    }, function(data){
      var retorno = data.replace(/^\s+|\s+$/g,"");
      var resultado        = data.split('___');
      var tipo_retorno     = resultado[0].replace(/^\s+|\s+$/g,"");
      var mensagem_retorno = resultado[1];

      setTimeout(function(){
        $('#modal_exam_wait').html('');
        $('#modal_exam_title').html('Verificado');

        if(tipo_retorno=='erro'){
          Notificacao('error',mensagem_retorno,'Ops!');
        }else if(tipo_retorno=='reproved') {
            Notificacao('error',mensagem_retorno,'Ops!');
            $('#modal_exam_loading').attr('src', 'dist/img/checkout/erro.png');
            $('#modal_exam_result').html('Você não foi aprovado, não desanime, pode tentar novamente');
        }else{
          $('#modal_exam_view_certified').fadeIn(500);
          $('#modal_exam_loading').attr('src', 'dist/img/checkout/sucesso.png');
          $('#modal_exam_result').html('Você já pode acessar seu curso e solicitar seu certificado');
          Notificacao('success',mensagem_retorno,'Tudo certo');
          //location.href="index-.php?p=course&curso_id="+course_register_content+"&enroll=1&act=read";
        }
      }, 3000);
    });
  });




  // Avaliar Curso
  $(".course_get_rate").click(function(){
    var course = $(this).attr("course");

    $("#modal_avaliar").modal("show");
    $("#FormEnrollRate_matricula").val(course);
  });






});


	function load_content_data(div, file)
	{
		setTimeout(function(){
		  $("#"+div).html("<img src='dist/img/loader.gif'>");
		  $("#"+div).load(file);
		}, 3000);
	}


	function lembrar_senha()
	{
		var email = $("#user_email").val();

		if(email = "")
		{
			$("#user_email").focus();
			Notificacao('error','Por favor, informe seu e-mail','Ops');
		}
		else
		{

			 $.post('controller/user.php',{user_email: $("#user_email").val(),ResetPass:'recover_access' },function(data)
			 {
				if(data==0)
				{
					$("#user_email").focus();
					Notificacao('error','Por favor, informe um e-mail válido','Ops');
				}
				else if(data==1)
				{
					$("#user_email").focus();
					Notificacao('error','não encontramos seu cadastro','Ops');
				}
				else
				{

					$("#user_email").focus();
					Notificacao('success','Sua nova senha foi enviada por e-mail','Sucesso');
				}

			 })
		}
	}



	function lembrar_senha_site()
	{
		var email = $("#reset-email").val();

		if(email = "")
		{
			$("#reset-email").focus();
			Notificacao('error','Por favor, informe seu e-mail','Ops');
		}
		else
		{

			 $.post('controller/user.php',{user_email: $("#reset-email").val(),ResetPass:'recover_access' },function(data)
			 {
				if(data==0)
				{
					$("#reset-email").focus();
					Notificacao('error','Por favor, informe um e-mail válido','Ops');
				}
				else if(data==1)
				{
					$("#reset-email").focus();
					Notificacao('error','não encontramos seu cadastro','Ops');
				}
				else
				{

					$("#reset-email").focus();
					Notificacao('success','Sua nova senha foi enviada por e-mail','Sucesso');
				}

			 })
		}
	}


	$(document).ready(function(){
    
		$('.user_messages_received').on('click',function(){
			var mensagem_id 			= $(this).attr("mensagem_id");
			var mensagem_conteudo 		= $(this).attr("mensagem");
			var mensagem_conteudo_data 	= $(this).attr("data");

				$("#user_messages_read_data").html("");
				$("#user_messages_read_mensagem").html("<div style='margin:0 auto;text-align:center;width:100%'><img src='dist/img/loader.gif'></div>");

				setTimeout(function()
				{
					$.post('controller/user.php',{mensagem_id: mensagem_id,MensagemLer:'MensagemLer' },function(data)
					{
						$("#user_messages_read_mensagem").html(mensagem_conteudo);
						$("#user_messages_read_data").html(mensagem_conteudo_data);

						$("#block_user_messages_"+mensagem_id).css({"font-weight":"normal"});
					})
				}, 1000);
		});

    ///COURSE
    ///Busca por filtro
		$('#courses_list_search').on('click',function(){
			$("#courses_list").html("<div style='margin:0 auto;text-align:center;width:100%'>'<img src='dist/img/loader.gif'></div>");

			var busca_texto 	= $("#search_form_title").val();
			var busca_categoria = $("#search_form_category").val();

			var operation  = 'search_form';
			$.post("views/content/course/courses_search_result.php",
			{
				busca_texto: busca_texto,
				busca_categoria: busca_categoria,
				operation: operation

			}, function(data){
				setTimeout(function(){
					$("#courses_list").html(data);
				}, 2000);
				//alert(retorno);
			});
    });
    
  });
  


  // // // // // // parcialmente revizado até este ponto




  $('.finaceiro_saque_solicita').on('click',function(){

      $("#modal_solicita_saque").modal("show");

      var operation  = 'solicita_saque';
      $.post("controller/financeiro.php",
      {
          operation: operation

      }, function(data)
      {
          var retorno = data.replace(/^\s+|\s+$/g,"");
          setTimeout(function(){

          var content = retorno.split('___');
          var content_descrition = content[0];
          var mensagem_retorno   = content[1];


              if(content_descrition=='erro')
              {
                Notificacao('error',mensagem_retorno,'Houve algo de errado');
                $("#modal_solicita_saque").modal("hide");
              }
              else
              {
                $("#modal_solicita_saque_loading").attr("src", "dist/img/checkout/sucesso.png");
                $("#modal_solicita_saque_wait").html("");
                $("#modal_solicita_saque_resultado").html("Solicitação encaminhada<BR> Agora é só aguardar a transferência");

                Notificacao('success',mensagem_retorno,'Excelente');
              }
          }, 2000);
          //alert(retorno);
      });
  });


  $('.adm-withdrawal-modal-confirm-withdrawal').on('click',function()
  {
        $("#adm-withdrawal-modal").modal("show");
        $("#adm-withdrawal-modal-data-bank").html("<img src='dist/img/loader.gif'>");
        var data_bank = $(this).attr("data_bank");
        var data_register_id = $(this).attr("data_register");

          setTimeout(function(){
              $("#adm-withdrawal-modal-data-bank").html(data_bank);

              $(".adm-withdrawal-modal-confirm-withdrawal-bt").attr("data_register_id", data_register_id);
          }, 2000);
  });



  $('.adm-withdrawal-modal-confirm-withdrawal-bt').on('click',function(){
      var data_register_id = $(this).attr("data_register_id");
      var operation  = 'adm_confirma_saque';

      $.post("controller/financeiro.php",
      {
          data_register_id: data_register_id,
          operation: operation

      }, function(data)
      {
          var retorno = data.replace(/^\s+|\s+$/g,"");


          var content = retorno.split('___');
          var content_descrition = content[0];
          var mensagem_retorno   = content[1];


              if(content_descrition=='erro')
              {
                Notificacao('error',mensagem_retorno,'Houve algo de errado');
              }
              else
              {
                $("#adm-withdrawal-modal").modal("hide");
                Notificacao('success',mensagem_retorno,'Excelente');
              }

      });
  });

  $('.print_certificate').on('click', function(){
    $.get('./my-certificates-view.php');
  });

  function isEmpty(value){
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
  }

  function redireciona(url){
    location.href=url;
  }
















  $('#box_content_add_button').on('click',function()
  {
    var elemento = document.getElementById('box_content_add_button');
    if(elemento.className.indexOf('btn-primary') != -1){
        $('#box_content_add_button').removeClass("btn-primary").addClass("btn-danger");
        $('#box_content_add_button').html("<i class='fa fa-trash'></i> Cancelar conteúdo");
        $('.box_content_add').show(400);
    }
    else
    {
        $('#box_content_add_button').removeClass("btn-danger").addClass("btn-primary");
        $('#box_content_add_button').html("<i class='fa fa-plus'></i> Adicionar conteúdo");
        $('.box_content_add').hide(400);

        $(".cd-main-content").fadeOut(400);
    }
  });




  $('#box_question_add_button').on('click',function()
  {
    var elemento = document.getElementById('box_question_add_button');
    if(elemento.className.indexOf('btn-primary') != -1){
        $('#box_question_add_button').removeClass("btn-primary").addClass("btn-danger");
        $('#box_question_add_button').html("<i class='fa fa-trash'></i> Cancelar questão");
        $('#inputCourseQuestionAnswer_div').fadeIn(400);
    }
    else
    {
        $('#box_question_add_button').removeClass("btn-danger").addClass("btn-primary");
        $('#box_question_add_button').html("<i class='fa fa-plus'></i> Adicionar questão");
        $('#inputCourseQuestionAnswer_div').fadeOut(400);

     }
  });

  //função de notificações
  function Notificacao(tipo, titulo, mensagem)
  {

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














jQuery(document).ready(function()
{

  	var theme = 'default';

  	jQuery("#mas").empty();

  	// jQuery("#mas").droply(
  	// {
		// multi:true,
		// logoColor: 'white',
		// textColor: 'white',
		// labelColor: 'white',
		// borderColor: 'white',
    // backgroundIcon: 'dist/img/icon-droply.png',
    
    // url: "controller/course/processMultipleUploads.php",
    
		// label:'Arquivos permitidos: gif, jpg, png, avi, mp3, wav, mp4, doc, docx, pdf, txt, zip e rar',
		// theme: theme,
		// backgroundColor: '0391ce',
		// 	dropBox:{
		// 	title:'envie seus arquivos',
		// 	height:80,
		// 	fontSize:26
		// },
		// stableUploadLbl: 'Enviado com sucesso!',
		// deleteConfirmLbl:'Quer realmente deletar este arquivo?',
  	// });


});


