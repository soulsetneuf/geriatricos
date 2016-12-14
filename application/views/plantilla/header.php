<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo --><!-- Add the class icon to your logo image or logo icon to add the margining -->
      <a class="logo"><img src="<?= base_url() ?>assets/plantilla/dist/img/mayor.png" width="41" height="50"  /> Adulto Mayor</a>
        
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation </span>

      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url() ?>assets/plantilla/dist/img/doctor.jpg" class="img-circle" alt="User Image" width="25" height="25

              "  >
            <span class="hidden-xs">

              <?php 
                echo $nombre_usuario;
               ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url() ?>assets/plantilla/dist/img/doctor.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php 
                    echo $nombre_usuario;
                    echo "<br>";
                    echo $titulo_pagina;
                   ?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url() ?>/login/logout_ci" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>