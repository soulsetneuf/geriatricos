<style>
    .caja {
        border-bottom: solid 2px #2980b9;
        padding: 5px;
        margin: 5px;
    }
</style>
<section class="content box col-md-10">
    <div class="row caja">
        <?php
        $entidades=$this->adulto_mayor_model->entidades("%");
        echo form_open(base_url()."Reporte/donaciones_entidad",array("name"=>"form1","id"=>"form1"));
        ?>
        <div class="col-md-3">
            <label for="">Fecha Inicio:</label><br>
            <input type="date" name="fecha_inicio" value="<?php echo $adulto_mayor_fecha_inicio; ?>">
        </div>
        <div class="col-md-3">
            <label for="">Fecha Fin:</label><br>
            <input type="date" name="fecha_fin" value="<?php echo $adulto_mayor_fecha_fin; ?>">
        </div>
        <div class="col-md-3">
            <label for="">Entidad:</label>

            <?php
            $arrLista=array();
            $arrLista["%"]="Todos";
            foreach($entidades->result() as $value)
            {
                $arrLista[$value->nombre_entidad]=$value->nombre_entidad;
            }
            $arrAtributosSelect=array(
                "name"=>"nombre_entidad",
                "class"=>"form-control",
                "id"=>"nombre_entidad"
            );
            echo form_dropdown($arrAtributosSelect, $arrLista);
            ?>
        </div>
        <div class="col-md-1">
            <input type="submit" value="Buscar" class="btn btn-success" id="btn_buscar">
        </div>
        <div class="col-md-1">
            <input type="hidden" value="false" name="imprimir" id="imprimir">
            <input type="submit" value="Imprimir"  class="btn btn-default" id="btn_imprimir" name="btn_imprimir">
        </div>
    </div>
    <?php echo form_close();?>

    <div class="row" style="text-align: center">
        <div class="col-md-18">
            <strong>
               DONACIONES POR MES Y ENTIDAD</strong><br>
        </div>
    </div>
    <br><br>

    <?php
    $sub_totales=array("monto"=>0,"cantidad_donaciones"=>0);
    ?>
    <div class="box-body">
            <table class="table table-bordered table-striped">
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
    </div>
</section>
<script>
    $("#btn_imprimir").on("click",function(){
        $("#imprimir").val(true);
    });
    $("#btn_buscar").on("click",function(){
        $("#imprimir").val(false);
    });

</script>