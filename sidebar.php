  <?php
    $radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
    $t = $_SERVER['REQUEST_URI'];
    $tmp = str_replace($radice, '', $t); // pagina

    ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <link rel="stylesheet" href="./dist/css/custom.css">
  <aside class="main-sidebar sidebar-dark-primary elevation-4">


      <a href="dashboard.php" class="brand-link">
          <img src="./dist/img/logo.png" alt="Logo" class="brand-image " style="opacity: .8;margin-top: 6px;">

          <span class="brand-text font-weight-light">Sportgym</span>

      </a>
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class=" user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <span style="color:white"><?php echo $mail_log ?></span>
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
                  <?php if ($tmp == "clienti.php" || $tmp == "register.php" || $tmp == "utenti.php") {
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
                          <?php if ($tmp == "utenti.php") {
                                echo "<a href=\"utenti.php\" class=\"nav-link active\">";
                            } else echo "<a href=\"utenti.php\" class=\"nav-link\">";
                            ?>
                          <i class="nav-icon fa fa-solid fa-address-book"></i>
                          <p>Ricerca Utente</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <?php if ($tmp == "register.php") {
                                echo "<a href=\"register.php\" class=\"nav-link active\">";
                            } else echo "<a href=\"register.php\" class=\"nav-link\">";
                            ?>

                          <i class="nav-icon far fa fa-user-plus"></i>
                          <p>Aggiungi Utente</p>
                          </a>
                      </li>
                  </ul>
                  </li>

                  <li class="nav-item">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-laptop-house"></i>

                          <p>
                              Domotica
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <div id="comandoN1">
                                  <label class="toggle" for="myToggle">
                                      <input class="toggle__input" type="checkbox" onclick="toggleDarkMode()" id="myToggle">
                                      <div class="toggle__fill"></div>
                                  </label>
                              </div>
                          </li>
                          <li class="nav-item">
                              <div class="comandoN2">
                                  <input class="radio__input"  type="radio" value="option1" name="radio" id="radio1">
                                  <label class="radio__label" for="radio1">X</label>
                                  <input class="radio__input" type="radio" value="option2" name="radio" id="radio2">
                                  <label class="radio__label" for="radio2">Y</label>
                                  <input class="radio__input" type="radio" value="option3" name="radio" id="radio3">
                                  <label class="radio__label" for="radio3">Z</label>
                              </div>
                          </li>
                          <li class="nav-item">
                          <div class="range">
                              <div class="sliderValue">
                                 <span>100</span>
                                       </div>
                        <div class="field">
                            <div class="value left">
                                0</div>
                        <input type="range" min="10" max="200" value="100" steps="1">
                            <div class="value right">
                                        200</div>
                             </div>
                        </div>
                                
                                            </li>
                              
                                      </ul>
                         </li>





              </ul>


          </nav>

          <!-- /.sidebar-menu -->



      </div>
      <!-- /.sidebar -->

          <script> 
        
       
            let isDarkModeActive = false;


function toggleDarkMode() {
  if (isDarkModeActive) {
    document.querySelectorAll('.image').forEach((result) => {
        result.classList.toggle('invert')
    })
    document.documentElement.classList.toggle('dark-mode')
  } else {
    document.documentElement.classList.remove('dark-mode')
    isDarkModeActive = true;
  }
}
          
    const slideValue = document.querySelector("span");
      const inputSlider = document.querySelector("input");
      inputSlider.oninput = (()=>{
        let value = inputSlider.value;
        slideValue.textContent = value;
        slideValue.style.left = (value/2) + "%";
        slideValue.classList.add("show");
      });
      inputSlider.onblur = (()=>{
        slideValue.classList.remove("show");
      });


        </script>                  
        

  </aside>