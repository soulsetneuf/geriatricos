<secction class="col-md-4 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php
            $persona_id = $persona->result_array()[0]['persona_id'];
            $hidden = array(
                'persona_id' => $persona_id,
                'estado' => 1,
                'admin_id' => $admin_id);
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
                echo form_dropdown($arrAtributosSelect, $arrLista);
            ?>
            <br/>
            <?php echo form_label('Concepto :'); ?> <br />
            <?php echo form_input(array('name' => 'concepto','required'=>true)); ?><br />
            <?php echo form_label('Monto :'); ?> <br />
            <?php echo form_input(array('name' => 'monto','id'=>'monto','type'=>'number','required'=>true)); ?><br />
            <?php
            echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");

            ?>
        </div>
    </div>
</secction>
<div class="row">
    <div class="col-md-4">
                <div class="box">
                        <?php echo form_label('Familiar: '); ?> <br />
                        <?php
                        $arrAtributosSelect=array(
                            "name"=>"familiar",
                            "class"=>"form-control",
                            "multiple"=>false,
                            "size"=>"10",
                            "id"=>"list_familia"
                        );
                        if($list_familia!=false)
                            $arrLista=$list_familia;
                        else
                            $arrLista=array(""=>"");
                        echo form_dropdown($arrAtributosSelect, $arrLista);
                        ?>
                </div>
    </div>
</div>
<?php echo form_close();?>