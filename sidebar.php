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

          <em class="brand-text font-weight-light">Sportgym</em>

      </a>
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class=" user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <em style="color:white"><?php echo $mail_log ?></em>
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
                  <hr>
                  <li class="nav-item">

                      <a href="#" class="nav-link" style="background: none; color: #007bff;">
                          <i class="nav-icon fas fa-laptop-house"></i>

                          <p>
                              Domotica
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <ul>
                              <li class="nav-item" style="display: flex; align-items: baseline;">
                                  <div id="comandoLuce" style="width: 50%;">
                                      <?php
                                        include 'config.php';

                                        $sql = "SELECT * FROM domotica";
                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));


                                        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                            if ($row[1] == 0) {

                                                echo  "<label class=\"toggle\" for=\"myToggleLuce\" style=\"max-width: 40px;margin: 32px auto 20px auto;\">
                                          <input class=\"toggle__input\" type=\"checkbox\" onclick=\"ToggleLuce()\" id=\"myToggleLuce\" value=\"off\" >";
                                            } else {
                                                echo  "<label class=\"toggle\" for=\"myToggleLuce\" style=\"max-width: 40px;margin: 32px auto 20px auto;\">
                                          <input class=\"toggle__input\" type=\"checkbox\" onclick=\"ToggleLuce()\" id=\"myToggleLuce\" value=\"on\" checked>";
                                            }
                                            $rowtemp = $row[2];
                                            $rowluce = $row[1];
                                        }
                                        ?>
                                      <div class="toggle__fill "></div>
                                      </label>
                                  </div>
                                  <div class="">
                                      <?php
                                        if ($rowluce == 0) {
                                            echo "  <img id=\"imgluce\" src=\"./dist/img/lightbulbminimono_105785.png\" alt=\"OFF\" width=\"40\" height=\"40\" style=\"border: 5px solid white;background: white;border-radius: 50%;    margin: auto;\"></span>\"";
                                        } else echo "  <img id=\"imgluce\" src=\"./dist/img/lightbulbflat_106023.png\" alt=\"OFF\" width=\"40\" height=\"40\" style=\"border: 5px solid white;background: white;border-radius: 50%;    margin: auto;\"></span>\"";
                                        ?>


                                  </div>
                              </li>

                          </ul>
                          <li class="nav-item">
                              <div class="range">
                                  <div class="sliderValue">
                                      <span>0°</span>
                                  </div>
                                  <div class="field">
                                      <div class="value left">
                                          0</div>
                                      <input id="temper" type="range" min="0" max="50" value="<?php echo $rowtemp ?>" steps="1">
                                      <div class="value right">
                                          50° </div>
                                  </div>
                              </div>

                          </li>

                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
      <!-- /.sidebar -->
      <script>
          function ToggleLuce() {
              let img = document.getElementById("imgluce")
              let stato = document.getElementById("myToggleLuce").value
              console.log(stato)
              if (stato == "off") {
                  document.getElementById("myToggleLuce").value = "on"
                  img.src = "./dist/img/lightbulbflat_106023.png";

              }
              if (stato == "on") {

                  document.getElementById("myToggleLuce").value = "off"
                  img.src = "./dist/img/lightbulbminimono_105785.png";

              }
          }



          $("#myToggleLuce").change(function() {
              send()
          });
          $("#temper").change(function() {
              send()
          });

          function send() {
              var val = document.getElementById("myToggleLuce").value;
              var temp = document.getElementById("temper").value


              $.ajax({
                  url: "domoticaupload.php",
                  type: "post",
                  data: {
                      temperatura: temp,
                      luce: val
                  },
                  success: function(response) {
                      $(document).Toasts('create', {
                          class: 'bg-success', //bg-info bg-warning
                          title: 'Domotica',
                          subtitle: '',
                          body: "Luci:=" + val + "</br>Temperatura:="+temp
                      })
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                  }

              });

          }
      </script>


  </aside>