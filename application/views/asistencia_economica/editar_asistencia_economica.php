<?php
    $datos_asistencia_economica=$datos_asistencia_economica->result_array()[0];
?>
<secction class="col-lg-5 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php
            $persona_id = $persona->result_array()[0]['persona_id'];
            $estado=0;
            $hidden = array(
                'persona_id' => $persona_id,
                'admin_id' => $admin_id,
                'estado' => $estado,
                'asistenacia_eco_id'=>$datos_asistencia_economica['id']
            );
            echo form_open(base_url()."adulto_mayor/registrar_asistencia_economica", '', $hidden);
            ?>

            <?php echo form_label('Entidad :'); ?> <br />
            <?php
            $arrAtributosSelect=array(
                "name"=>"nombre_entidad",
                "class"=>"form-control",
                "multiple"=>false,
                "size"=>"10",
                "id"=>"nombre_entidad"
            );
            $arrLista=array(
                "EI"=>"EI",
                "SEDEGES"=>"SEDEGES",
                "PSOCAP"=>"PSOCAP",
                "VOCES LIBRES"=>"VOCES LIBRES",
                "PAN"=>"PAN"
            );
            echo form_dropdown($arrAtributosSelect, $arrLista,$datos_asistencia_economica['nombre_entidad']);
            ?><br />
            <?php echo form_label('Concepto :'); ?> <br />
            <?php echo form_input(array('name' => 'concepto','value'=>$datos_asistencia_economica['concepto'],'required'=>true)); ?><br />
            <?php echo form_label('Monto :'); ?> <br />
            <?php echo form_input(array('name' => 'monto','id'=>'monto','type'=>'number','value'=>$datos_asistencia_economica['monto'],'required'=>true)); ?><br />
            <?php
            echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");

            ?>
        </div>
    </div>
</secction>
<?php echo form_close();?>