<secction class="col-lg-5 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php
            $hidden = array(
                'persona_id' =>$persona_id,
                'adulto_mayor_id' =>$adulto_mayor_id,
                'estado' => 1,
                'admin_id' => $admin_id);
            echo form_open(base_url()."adulto_mayor/registrar_gasto", '', $hidden);
            ?>

                        <?php echo form_label('Nombre :'); ?> <br />
                        <?php echo form_input(array('name' => 'nombre','required'=>true)); ?><br />
                        <?php echo form_label('Descripcion :'); ?> <br />
                        <?php echo form_input(array('name' => 'descripcion','required'=>true)); ?><br />
                        <?php echo form_label('Monto :'); ?><br />
                        <?php echo form_input(array('name' => 'monto','value'=>"",'id'=>'monto','step'=>'any','type'=>'number','required'=>true)); ?><br />
                        <?php echo form_label('Unidad :'); ?> <br />
                        <?php echo form_input(array('name' => 'unidad','value'=>"",'id'=>'unidad','type'=>'number','required'=>true)); ?><br/>
            <?php
                echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");

            ?>
        </div>
    </div>
</secction>
<secction class="col-lg-2 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php echo form_label('TOTAL EN BANCO:'); ?> <br />
            <?php echo form_input(array('name' => 'total_ingreso','id'=>'total_ingreso','value'=>$total_ingresos,'readonly'=>true)); ?><br />

            <?php echo form_label('TOTAL :'); ?> <br />
            <?php echo form_input(array('name' => 'total','id'=>'total','readonly'=>true)); ?><br />
        </div>
    </div>
</secction>
<?php echo form_close();?>
<script>
    $("#monto").keyup(function(e) {
        var monto=$("#monto").val();
        var unidad=$("#unidad").val();
        var total_ingreso=$("#total_ingreso").val();
        var resultado=(parseInt(monto)+0)*(parseInt(unidad)+0);
        if(total_ingreso<resultado)
        {
            $("#monto").val(0);
            $("#unidad").val(0);
            $("#total").val(0);
            alert("No puede gastar mas de lo que tiene almacenado en el banco","Administrador: ");
        }
        else
            $("#total").val(resultado);
        if($(this).val()<=0)
            $("#monto").val("");
        console.log(resultado);
    });
    $("#unidad").keyup(function(e) {
        var monto=$("#monto").val();
        var unidad=$("#unidad").val();
        var total_ingreso=$("#total_ingreso").val();
        var resultado=(parseInt(monto)+0)*(parseInt(unidad)+0);
        if(total_ingreso<resultado)
        {
            $("#monto").val(0);
            $("#unidad").val(0);
            $("#total").val(0);
            alert("No puede gastar mas de lo que tiene almacenado en el banco","Administrador: ");
        }
        else
            $("#total").val(resultado);
        if($(this).val()<=0)
            $("#unidad").val("");
        console.log(resultado);
    });
    $("#monto").change(function(e) {
        var monto=$("#monto").val();
        var unidad=$("#unidad").val();
        var total_ingreso=$("#total_ingreso").val();
        var resultado=(parseInt(monto)+0)*(parseInt(unidad)+0);
        if(total_ingreso<resultado)
        {
            $("#monto").val(0);
            $("#unidad").val(0);
            $("#total").val(0);
            alert("No puede gastar mas de lo que tiene almacenado en el banco","Administrador: ");
        }
        else
        $("#total").val(resultado);
        if($(this).val()<=0)
            $("#monto").val("");
        console.log(resultado);
    });
    $("#unidad").change(function(e) {
        var monto=$("#monto").val();
        var unidad=$("#unidad").val();
        var total_ingreso=$("#total_ingreso").val();
        var resultado=(parseInt(monto)+0)*(parseInt(unidad)+0);
        if(total_ingreso<resultado)
        {
            $("#monto").val(0);
            $("#unidad").val(0);
            $("#total").val(0);
            alert("No puede gastar mas de lo que tiene almacenado en el banco","Administrador: ");
        }
        else
            $("#total").val(resultado);
        if($(this).val()<=0)
            $("#unidad").val("");
        console.log(resultado);
    });
</script>