<?php
 $persona=$persona->result_array()[0];
 $edad=CalculaEdad($persona['persona_fecha_nac']);
 function CalculaEdad($fecha)
 {
        list($Y, $m, $d) = explode("-", $fecha);
        return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
    }
?>
<div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-yellow">
            <div class="widget-user-image">

                <?php
                if ($persona['persona_sexo'] == 'M') {
                    ?>
                    <img class="img-square"  src="<?php echo base_url(); ?>assets/plantilla/dist/img/anciano.jpg" alt="User Avatar">
                <?php
                }
                else {
                    ?>
                    <img class="img-square" src="<?php echo base_url(); ?>assets/plantilla/dist/img/avatar1.png" alt="User Avatar">
                <?php
                }
                ?>


            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username"><?php echo $persona['persona_nombres'] . " " . $persona['persona_app_pat'] . " " . $persona['persona_app_mat']; ?></h3>

        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li><a href="#">Edad <span class="pull-right badge bg-blue"><?= $edad ?> A&ntilde;os</span></a></li>
                <input type="hidden" value="<?= $edad ?>" name="adulto_mayor_edad_ingreso">
                <li><a href="#">Sexo
                        <span class="pull-right badge bg-aqua">
                            <?php
                            if ($persona['persona_sexo'] == 'M') {
                                echo 'Masculino';
                            } else {
                                echo 'Femenino';
                            }
                            ?>
                        </span></a></li>
                <li><a href="#">Fecha de nacimiento <span
                            class="pull-right badge bg-green"><?php echo $persona['persona_fecha_nac']; ?></span></a></li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
</div>