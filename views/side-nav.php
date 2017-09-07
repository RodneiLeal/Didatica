  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
          <?php
            switch($_SESSION['usuarioTIPO']){
              case 1: # aluno
                echo get_menu_user();
                break;
                
                case 2: #instrutor
                echo get_menu_instructor();
                break;
                
                case 3: #admin
                echo get_menu_admin();
                break;

                default: #em situaçõe de erro ou qaundo não for possivel identificar tipo de usuario, este será conciderado como aluno
                  echo get_menu_user();
            }
          ?>
      </ul>
  
    </section>
    <!-- /.sidebar -->
  </aside>