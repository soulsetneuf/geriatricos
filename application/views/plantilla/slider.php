  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>assets/plantilla/dist/img/doctor.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php 
              echo $nombre_usuario;
            ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
          <?php
          if($this->session->userdata('TipoUsusario')=='admin')
          {?>
            <li class="header"></li>
            <li class="deactivated treeview">
                  <a href="#">
                  <i class="fa fa-users" aria-hidden="true"></i> <span>Usuarios</span>
                <span class="pull-right-container">
                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </span>
                  </a>
                <ul class="treeview-menu">
                <li><a href="http://localhost/geriatricos/adulto_mayor/listar/usuarios"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Nuevo usuario</a></li>
                <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
              </ul>
            </li>
            <?php } ?>


            <?php
              if($this->session->userdata('TipoUsusario')=='admin'||$this->session->userdata('TipoUsusario')=='social')
            {?>
            <li class="deactivated treeview">
              <a href="#">
                <i class="fa fa-user" aria-hidden="true"></i><span>Area social</span>
                <span class="pull-right-container">
                  <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </span>
              </a>
                <ul class="treeview-menu">
                  <li><a href="http://localhost/geriatricos/adulto_mayor/listar/ingreso"><i class="fa fa-circle-o"></i> Adulto mayor ingreso</a></li>
                  <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
                  <li><a href="http://localhost/geriatricos/adulto_mayor/listar/egreso"><i class="fa fa-circle-o"></i> Adulto mayor egreso</a></li>
                  <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                  <li><a href="http://localhost/geriatricos/adulto_mayor/listar/gastos"><i class="fa fa-circle-o"></i> Adulto mayor gastos</a></li>
                  <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                  <li><a href="http://localhost/geriatricos/adulto_mayor/listar/asistencia_economica"><i class="fa fa-circle-o"></i> Asistencia economica</a></li>
                  <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                  <li><a href="http://localhost/geriatricos/Informe_Adulto_Mayor"><i class="fa fa-circle-o"></i> Informe Adulto Mayor</a></li>
                  <li class="active treeview">
                    <a href="#">
                      <i class="fa fa-dashboard"></i> <span>Reportes</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="http://localhost/geriatricos/Reporte/donaciones"><i class="fa fa-circle-o"></i>Donaciones</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/Reporte/donaciones_diarias"><i class="fa fa-circle-o"></i>Donaciones por fecha</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/Reporte/adulto_mayor"><i class="fa fa-circle-o"></i>Ingreso Adulto Mayor</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                      <li><a href="http://localhost/geriatricos/Reporte/modalidad"><i class="fa fa-circle-o"></i>Modalidad</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                      <li><a href="http://localhost/geriatricos/Reporte/sexo"><i class="fa fa-circle-o"></i>Sexo</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                    </ul>
                  </li>
                </ul>
              </li>
              <?php } ?>
        
              <?php
                if($this->session->userdata('TipoUsusario')=='admin'||$this->session->userdata('TipoUsusario')=='medico')
              {?>

              <li class="deactivated treeview">
                <a href="#">
                  <i class="fa fa-heartbeat" aria-hidden="true"></i><span>Area médica</span>
                  <span class="pull-right-container">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                  </span>
                </a>
              <?php } ?>
              <?php
                if($this->session->userdata('TipoUsusario')=='admin'||$this->session->userdata('TipoUsusario')=='medico')
              {?>    
                <ul class="treeview-menu">
                  <li class="deactivated treeview">
                    <a href="#">
                      <i class="fa fa-user-md" aria-hidden="true"></i><span>Médico general</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="http://localhost/geriatricos/area_medica/medica_controller/listar/ingreso"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Registrar</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/adulto_mayor/listar/egreso"><i class="fa fa-file-text-o" aria-hidden="true"></i>Listar</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/adulto_mayor/listar/gastos"><i class="fa fa-clipboard" aria-hidden="true"></i>Reporte</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Detalle Gastos</a></li>-->
                    </ul>
                  </li>
                  <?php } ?>
                  
                  <?php
                  if($this->session->userdata('TipoUsusario')=='admin'||$this->session->userdata('TipoUsusario')=='enfermera')
                  {?>
                  <li class="deactivated treeview">
                    <a href="#">
                      <i class="fa fa-plus-square" aria-hidden="true"></i><span>Enfermeria</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                      </span>
                    </a>
                     <ul class="treeview-menu">
                      <li><a href="http://localhost/geriatricos/enfermeria/enfermeria_controller/listar/ingreso"><i class="fa fa-circle-o"></i> Registrar ficha</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/adulto_mayor/listar/egreso"><i class="fa fa-circle-o"></i>Listar ficha</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                    </ul>
                  </li>
                  <?php } ?>

            
                  <?php
                  if($this->session->userdata('TipoUsusario')=='admin'||$this->session->userdata('TipoUsusario')=='odontologo')
                  {?>
                  <li class="deactivated treeview">
                    <a href="#">
                      <i class="fa fa-medkit" aria-hidden="true"></i><span>Odontologia</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="http://localhost/geriatricos/odontologia/odontologia_controller/listar/ingreso"><i class="fa fa-circle-o"></i> Registrar ficha</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
                      <li><a href="http://localhost/geriatricos/adulto_mayor/listar/egreso"><i class="fa fa-circle-o"></i>Listar ficha</a></li>
                      <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar egresos</a></li>-->
                    </ul>
                  </li>
                  <?php } ?>
            <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Listar ingresos</a></li>-->
               </ul>
              </li>
          </ul>
    </section>
    <!-- /.sidebar -->
  </aside>