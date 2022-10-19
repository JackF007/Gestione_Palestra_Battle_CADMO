  <?php
    $radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
    $t = $_SERVER['REQUEST_URI'];
    $tmp = str_replace($radice, '', $t); // pagina

    ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="dashboard.php" class="brand-link">
          <img src="./dist/img/logo.png" alt="Logo" class="brand-image " style="opacity: .8;margin-top: 6px;">

          <span class="brand-text font-weight-light">Sportgym</span>

      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
              </div>
          </div>



          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                  <li class="nav-item">
                      <?php if ($tmp == "dashboard.php") {
                            echo "<a href=\"dashboard.php\" class=\"nav-link active\">";
                        } else echo "<a href=\"dashboard.php\" class=\"nav-link\">";
                        ?>
                      <i class="nav-icon far fa-calendar-alt"></i>
                      <p>
                          Dashboard
                      </p>
                      </a>
                  </li>
                  <?php if ($tmp == "clienti.php"|| $tmp == "register.php") {
                        echo " <li class=\"nav-item  menu-is-opening menu-open\">";
                    } else echo " <li class=\"nav-item\">";
                    ?>
                  <a href="#" class="nav-link">
                      <i class="nav-icon far fa-duotone fa-user nav-icon"></i>
                      <p>
                          Utenti
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <?php if ($tmp == "clienti.php") {
                                echo "<a href=\"utenti.php\" class=\"nav-link active\">";
                            } else echo "<a href=\"utenti.php\" class=\"nav-link\">";
                            ?>
                          <i class="far fa-sharp fa-solid fa-magnifying-glass nav-icon"></i>
                          <p>Ricerca Utente</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <?php if ($tmp == "register.php") {
                                echo "<a href=\"register.php\" class=\"nav-link active\">";
                            } else echo "<a href=\"register.php\" class=\"nav-link\">";
                            ?>
                          
                              <i class="far fa-solid fa-magnifying-glass-plus nav-icon"></i>
                              <p>Aggiungi Utente</p>
                          </a>
                      </li>
                  </ul>
                  </li>

                  <li class="nav-item">
                      <a href="dashboard.php" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Domotica
                          </p>
                      </a>
                  </li>


              </ul>
          </nav>
          <!-- /.sidebar-menu -->


      </div>
      <!-- /.sidebar -->
  </aside>