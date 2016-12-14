<style>
    .caja {
        border-bottom: solid 2px #2980b9;
        padding: 5px;
        margin: 5px;
    }
    .centrada{ align:center; text-align:center; }
    table{
        font-size: 10px;
    }
    th{
        background-color: #34495e;
        color: whitesmoke;
        padding: 10px;
        margin: 10px;
    }
    td{
        padding: 10px;
        margin: 10px;
    }
</style>

    <div class="row" style="text-align: center">
        <div class="col-md-18">
            <strong>
                DONACIONES POR MES Y ENTIDAD</strong><br>
            Fecha:(<?= $adulto_mayor_fecha_inicio;?> - <?= $adulto_mayor_fecha_fin;?>)
        </div>
    </div>
    <br><br>
    <?php
    $sub_totales=array("monto"=>0,"cantidad_donaciones"=>0);
    ?>
    <div>
        <table border="1" style="text-align: center;align:center;" width="90%">
            <tr>
                <th>No</th>
                <th>NOMBRE ENTIDAD</th>
                <th>MES</th>
                <th>CANTIDAD DE DONACIONES</th>
                <th>TOTAL DONACIONES</th>
            </tr>
            <?php
            $nro = 1;
            $entidades = $this->adulto_mayor_model->entidades($nombre_entidad);
            foreach ($entidades->result() as $value) {
                $monto_entidad = $this->adulto_mayor_model->donacion_entidad($value->nombre_entidad, $adulto_mayor_fecha_inicio, $adulto_mayor_fecha_fin);
                //print_r($monto_entidad->result()[0]);
                //echo $monto_entidad->result()[0]->mes;
                //exit;
                if($monto_entidad!=false)
                {
                    foreach ($monto_entidad->result() as $value_entidad) {
                        ?>
                        <tr>
                            <td><?php echo $nro++; ?></td>
                            <td><?php echo $value->nombre_entidad; ?></td>
                            <td><?php echo $value_entidad->mes; ?></td>
                            <td><?php echo $value_entidad->cantidad_donaciones; ?></td>
                            <td><?php echo $value_entidad->monto ?></td>
                        </tr>
                        <?php
                        $sub_totales["monto"] = $sub_totales["monto"] + $value_entidad->monto;
                        $sub_totales["cantidad_donaciones"] = $sub_totales["cantidad_donaciones"] + $value_entidad->cantidad_donaciones;
                    }
                }
            }
            ?>
            <tr>
                <th colspan="3">TOTALES</th>
                <th><?php echo $sub_totales["cantidad_donaciones"]; ?></th>
                <th><?php echo $sub_totales["monto"]; ?></th>
            </tr>
        </table>
        Usuario, fecha de impresion: <?= $nombre_usuario.",".date("d/m/Y"); ?>