jQuery(function ($){

  var content = $('.content-wrapper');

  ////CADASTRO USUÁRIO
  $('#register-bt').on('click',function(){

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

    function registerCallback(response){
      switch(response){
        case '0__':
          Notificacao('error','E-mail inválido','E-mail obrigatório');
          $('#register_email').focus();
        break;
        case '1__':
          Notificacao('error','Este e-mail já está cadastrado','E-mail obrigatório');
          $('#register_email').focus();
        break;
        case '2__':
          // mensagem usada qaundo a confirmação por email esta configurada
          // Notificacao('success','Enviamos uma mensagem para o e-mail informado ','Por favor confirme seu cadstro.');
          Notificacao('success','Login realizado com sucesso','Redirecionando...');
          redireciona('dashboard');
        break;
        case '3__':
          Notificacao('error','Algo errado aconteceu, por favor tente mais tarde!','Algo deu errado');
          redireciona('home');
        break;
      }
    }

    $.post("controllers/user/register.php", data, registerCallback);
  });

  ////CADASTRO USUÁRIO VIA REDE SOCIAL
  $('.social-signup').on('click',function(){
    
    var data = {
      rede : $(this).attr('data-target')
    }

    function loginCallback(response){
      console.log(response);
      switch(response){
        case '0__':
          Notificacao('error','E-mail inválido','E-mail obrigatório');
          $('#register_email').focus();
        break;
        case '1__':
          Notificacao('error','Este e-mail já está cadastrado','E-mail obrigatório');
          $('#register_email').focus();
        break;
        case '2__':
          // mensagem usada qaundo a confirmação por email esta configurada
          // Notificacao('success','Enviamos uma mensagem para o e-mail informado ','Por favor confirme seu cadstro.');
          Notificacao('success','Login realizado com sucesso','Redirecionando...');
          redireciona('dashboard');
        break;
        case '3__':
          Notificacao('error','Algo errado aconteceu, por favor tente mais tarde!','Algo deu errado');
          redireciona('home');
        break;
      }
    }

    $.post("controllers/user/register.php", data, loginCallback);
  });

  ////LOGIN USUÁRIO
  $('.login-bt').on('click',function(){

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
          redireciona("Home");
        break;
      }
    }

    $.post("controllers/user/login.php", data, loginCallback);
  });

  ////LOGIN USUÁRIO VIA REDE SOCIAL
  $('.social-signin').on('click',function(){

    var data = {
      rede : $(this).attr('data-taget')
    }

    function loginCallback(response){
      switch(response){
        case '0__':
          Notificacao('error','Ops!','Combinação de e-mail e senha invalidos'); //Alterar esta mensagem de notificação para uma mensagem mais adequada
          $('#LoginFormEmail').focus();
        break;
        case '1__':
          Notificacao('error','Usuário Bloquado!','Entre em contato com os administradores.');
        break;
        case '2__':
          Notificacao('success','Redirecionando...','Login realizado com sucesso');
          redireciona("Home");
        break;
      }
    }

    $.post("controllers/user/login.php", data, loginCallback);
  });

  ////LOGOUT USUÁRIO
  $(".logoff").on('click', function(){
    data = {
      logoff: true
    }

    function logoffCallback(response){
      location.href='home';
    }

    $.post('controllers/user/logout.php', data, logoffCallback);
  });

  ////PERFIL DE USUARIO
  $('.profile').on('click', function(){
    data = {
      idusuario: $(this).attr('data-value')
    };

    function perfilCallback(response){
      content.html(response);
    }

    $.post('controllers/user/perfil.php', data, perfilCallback);
  });
  
  ////VALIDA CERTIFICADO
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

  ////COURSE
  $('#course_start').on('click',function(){

      $(".course_box").hide(50);
      $(".course_load").html("<img src='dist/img/loader.gif'>");

      var course = $(this).attr("course");
      var operation  = 'start';
      $.post("controller/course.php",
      {
          course: course,
          operation: operation

      }, function(data)
      {
          var retorno = data.replace(/^\s+|\s+$/g,"");
          setTimeout(function(){


              if(retorno==1)
              {
                Notificacao('success','Inscrição realizada com sucesso','Já pode acessar seu curso');
                $(".course_load").html("");
                location.href = "dashboard.php?p=course&curso_id="+course+"&enroll=1&act=read";
              }
              else if(retorno==0)
              {
                $(".course_box").show(50);
                $(".course_load").html("");

                Notificacao('error','Ops, houve algo de errado, tente novamente mais tarde','Ops!');
              }
              else if(retorno==2)
              {
                $(".course_box").show(50);
                $(".course_load").html("");

                Notificacao('error','Ops, faça login antes de iniciar um curso','Ops!');
              }
          }, 3000);
      });
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

  //// USER PROFILE
  $('.form_send_information_bt').on('click',function(){

      var $form     = $(this).closest('form');
      var form_id   = $form.attr('id');
      var form_url  = $form.attr('action');
      var form_evento       = $form.attr('event'); //O que ocorrerá se sucesso
      var form_evento_tipo  = $form.attr('event_type'); //O que ocorrerá se sucesso

          var form = $("#"+form_id);
          var dados = $("#"+form_id).serialize();


            var erros = 0;
            $.each(dados.split('&'), function (index, elem)
            {
                var vals          = elem.split('=');
                var input_id      = $("#"+vals[0]);
                var conteudo      = vals[1];
                var form_id       = input_id.attr('id');
                var obrigatorio   = input_id.attr('required');
                var mensagem      = input_id.attr('required_message');

                if ( (obrigatorio != undefined) && (input_id.val()=="" ) )
                {
                    Notificacao('error',mensagem,'Campo obrigatório');
                    input_id.focus();

                    erros = 1;
                }
                //alert(obrigatorio);
            });

            if(erros == 0)
            {
                $.ajax({
                  type: "POST",
                  url: form_url,
                  data: dados,
                  success: function( data )

                  {
                    //alert(data);
                    var resultado        = data.split('___');
                    var tipo_retorno     = resultado[0].replace(/^\s+|\s+$/g,"");
                    var mensagem_retorno = resultado[1];
                    var registro_id      = resultado[2];

                      if(tipo_retorno=='erro')
                      {
                        Notificacao('error',mensagem_retorno,'Houve algo de errado');
                      }
                      else
                      {
                        Notificacao('success',mensagem_retorno,'Tudo certo');

                          if ((form_evento != undefined) && (form_evento != "" ))
                          {

                            if(form_evento_tipo=='redireciona')
                            {
                              var novo_registro = form_evento.replace("Registro",registro_id);
                              redireciona(novo_registro);
                            }
                            else if(form_evento_tipo=='transfer_new_id_for_input')
                            {
                              var event_transfer_id  = $form.attr('event_transfer_id');
                              $("#"+event_transfer_id).val(registro_id);
                            }
                          }
                      }
                  }
                });
            }

  });

  ////FUNCTION VALIDAARQUIVO(CAMPO)
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

  ////COURSE ADD CONTENT
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

  ////ADICIONA IMAGEM USUÁRIO (PERFIL)
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


  ////Solicitar Certificado
  $(".course_get_certified").click(function(){
    var course = $(this).attr("course");

    $.post("controller/course/course_payment_load_code_pagseguro.php", {
      course: course
    }, function(data) {
      var resultado = data.split('-');
      var valor = resultado[0];
      var code = resultado[1];
      if (valor == 0) {
        $('#code').val(code);
        $('#form_pagseguro').submit();
      }
    });
  });

  ////Avaliar Curso
  $(".course_get_rate").click(function(){
    var course = $(this).attr("course");

    $("#modal_avaliar").modal("show");
    $("#FormEnrollRate_matricula").val(course);
  });

  ////Tornar-se Instrutor
  $("#instructor_new_bt").click(function(){
    $(".instructor_new_action").fadeOut(400);
    $(".instructor_new_load").html("<img src='dist/img/loader.gif'>");

    instructor_new = 'instructor_new';

    $.post("controller/user.php",
      {
        instructor_new: instructor_new
      },
      
      function(data){
      
      var retorno = data.replace(/^\s+|\s+$/g,"");
      var retorno = retorno.split("__");

      setTimeout(function(){
        switch(retorno[0]){

          case '0':
            Notificacao('warning',retorno[1],'Completar dados profissionais.');
            setTimeout(function(){
              location.assign("?p=user-edit#tab_profissional");
            }, 5000);

          break;

          case '1':
            Notificacao('success',retorno[1],'Excelente');

            $(".instructor_new_load").html("");
            $(".instructor_new_action").fadeOut(400);
            setTimeout(function(){
              location.reload();
            }, 3000);
          break;

          default:
            Notificacao('error',retorno[1],' Houve algo de errado');
            $(".instructor_new_action").fadeIn(400);
            $(".instructor_new_load").html("");

        }
      }, 3000);

    });
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

  $('.certificado-modelo').on('click', function(){
    alert('Certificado modelo');
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

  	jQuery("#mas").droply(
  	{
		multi:true,
		logoColor: 'white',
		textColor: 'white',
		labelColor: 'white',
		borderColor: 'white',
		backgroundIcon: 'dist/img/icon-droply.png',
		url: "controller/course/processMultipleUploads.php",
		label:'Arquivos permitidos: gif, jpg, png, avi, mp3, wav, mp4, doc, docx, pdf, txt, zip e rar',
		theme: theme,
		backgroundColor: '0391ce',
			dropBox:{
			title:'envie seus arquivos',
			height:80,
			fontSize:26
		},
		stableUploadLbl: 'Enviado com sucesso!',
		deleteConfirmLbl:'Quer realmente deletar este arquivo?',
  	});


});


