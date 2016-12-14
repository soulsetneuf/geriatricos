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
    <div style="text-align: center">
            <strong>
                POBLACION POR SEXO Y MODALIDAD DE ACOGIMIENTO SEGUN CENTRO<br>
                DEPARTAMENTO DE  POTOSI</strong><br>
        Fecha:(<?= $adulto_mayor_fecha_inicio;?> - <?= $adulto_mayor_fecha_fin;?>)
    </div>
    <br>
    <?php
    $total_registros=$this->adulto_mayor_model->total_registros($adulto_mayor_cen_acogida,$adulto_mayor_fecha_inicio,$adulto_mayor_fecha_fin)->result()[0]->total;
    $sub_totales=array("c_f"=>0,"c_m"=>0,"d_f"=>0,"d_m"=>0,"total"=>0);
    //print_r($total_registros);
    //exit;
    ?>
    <label for="">Población Total: </label>
    <label for=""><?php echo $total_registros;?> </label><br>
        <?php
        if($total_registros!=0) {
            ?>

            <div>
                <table border="1" style="text-align: center;align:center;" width="90%">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">CENTROS DE ACOGIDA</th>
                        <th colspan="4">CIRCUNSTANCIAL</th>
                        <th colspan="4">DEFINITIVA</th>
                        <th>TOTAL</th>
                        <th>TOTAL(%)</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>F</th>
                        <th>M</th>
                        <th>TOTAL</th>
                        <th>TOTAL(%)</th>
                        <th>F</th>
                        <th>M</th>
                        <th>TOTAL</th>
                        <th>TOTAL(%)</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    $nro = 1;
                    $sub_totales_total = 0;
                    $centros_acogida = $this->adulto_mayor_model->centros_acogida($adulto_mayor_cen_acogida);
                    foreach ($centros_acogida->result() as $value) {
                        $resultado_circunstancial = $this->adulto_mayor_model->poblacion_sexo_modalidad_acogimiento($value->adulto_mayor_cen_acogida, 'CIRCUNSTANCIAL', $adulto_mayor_fecha_inicio, $adulto_mayor_fecha_fin);
                        $resultado_definitivo = $this->adulto_mayor_model->poblacion_sexo_modalidad_acogimiento($value->adulto_mayor_cen_acogida, 'DEFINITIVO', $adulto_mayor_fecha_inicio, $adulto_mayor_fecha_fin);
                        //print_r($resultado_circunstancial->result()[0]);

                        $total_circunstancial = $resultado_circunstancial->result()[0]->masculino + $resultado_circunstancial->result()[0]->femenino;
                        $total_definitivo = $resultado_definitivo->result()[0]->masculino + $resultado_definitivo->result()[0]->femenino;
                        $total_porcentaje = $total_circunstancial + $total_definitivo;
                        if ($total_porcentaje == 0)
                            $total_porcentaje = 1;
                        ?>
                        <tr>
                            <td><?php echo $nro++; ?></td>
                            <td><?php echo $value->adulto_mayor_cen_acogida; ?></td>
                            <td><?php echo $resultado_circunstancial->result()[0]->masculino; ?></td>
                            <td><?php echo $resultado_circunstancial->result()[0]->femenino; ?></td>
                            <td><?php echo $total_circunstancial; ?></td>
                            <td><?php echo round(($total_circunstancial * 100) / $total_porcentaje); ?>%</td>
                            <td><?php echo $resultado_definitivo->result()[0]->masculino; ?></td>
                            <td><?php echo $resultado_definitivo->result()[0]->femenino; ?></td>
                            <td><?php echo $total_definitivo; ?></td>
                            <td><?php echo round(($total_definitivo * 100) / $total_porcentaje); ?>%</td>
                            <td><?php echo $total_porcentaje; ?></td>
                            <td><?php echo round(($total_porcentaje * 100) / $total_registros); ?>%</td>
                        </tr>
                        <?php
                        //$sub_totales=array("c_f"=>0,"c_m"=>0,"d_f"=>0,"d_m"=>0,"total"=>0);
                        $sub_totales["c_m"] = $sub_totales["c_m"] + $resultado_circunstancial->result()[0]->masculino;
                        $sub_totales["c_f"] = $sub_totales["c_f"] + $resultado_circunstancial->result()[0]->femenino;

                        $sub_totales["d_m"] = $sub_totales["d_m"] + $resultado_definitivo->result()[0]->masculino;
                        $sub_totales["d_f"] = $sub_totales["d_f"] + $resultado_definitivo->result()[0]->femenino;

                        $sub_total_circunstancial = $sub_totales["c_m"] + $sub_totales["c_f"];
                        $sub_total_definitivo = $sub_totales["d_m"] + $sub_totales["d_f"];
                        $total_general = $sub_total_circunstancial + $sub_total_definitivo;
                        if ($total_general == 0)
                            $total_general = 1;

                        $sub_totales_total = $sub_totales_total + $total_porcentaje;
                    }
                    ?>
                    <tr>
                        <th colspan="2">TOTALES</th>
                        <th><?php echo $sub_totales["c_m"]; ?></th>
                        <th><?php echo $sub_totales["c_f"]; ?></th>
                        <th><?php echo $sub_total_circunstancial; ?></th>
                        <th><?php echo round(($sub_total_circunstancial * 100) / $total_general); ?>%</th>
                        <th><?php echo $sub_totales["d_m"]; ?></th>
                        <th><?php echo $sub_totales["d_f"]; ?></th>
                        <th><?php echo $sub_total_definitivo; ?></th>
                        <th><?php echo round(($sub_total_definitivo * 100) / $total_general); ?>%</th>
                        <th><?php echo $sub_totales_total; ?></th>
                        <th><?php echo round(($sub_totales_total * 100) / $total_registros); ?>%</th>
                    </tr>
                </table>
                Usuario, fecha de impresion: <?= $nombre_usuario.",".date("d/m/Y"); ?>
            </div>
            <?php
        }
        ?>