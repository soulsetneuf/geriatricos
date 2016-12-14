<secction class="col-lg-8 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
<?php
    $persona_id = $persona->result_array()[0]['persona_id'];
    $hidden = array(
        'persona_id' => $persona_id,
        'admin_id' => $admin_id);
    echo form_open(base_url()."adulto_mayor/registrar_egreso", '', $hidden);
?>
<?php echo form_label('Autorizacion :'); ?> <?php echo form_error('dname'); ?><br />
<?php
$options_autorizado = array(
'FISCALIA'         => 'FISCALIA',
'JUZGADO DE PARTIDO MIXTO LIQUIDADOR Y DE SENTENCIA (PROVINCIAL)'           => 'JUZGADO DE PARTIDO MIXTO LIQUIDADOR Y DE SENTENCIA (PROVINCIAL)',
'JUZGADO PÚBLICO EN MAT. NNA #2'         => 'JUZGADO PÚBLICO EN MAT. NNA #2',
'xlarge'        => 'Extra Large Shirt',
);
echo form_dropdown('autorizado', $options_autorizado, 'large');

$options_autorizado = array(
    'FALLECIMIENTO'         => 'FALLECIMIENTO',
    'FUGA'           => 'FUGA',
    'MALA CONDUCTA'         => 'MALA CONDUCTA',
    'REINSERCIÓN FAMILIAR'        => 'REINSERCIÓN FAMILIAR',
);
echo "<br>";
echo form_label('Motivo de egreso :');
echo "<br>";
echo form_dropdown('motivo', $options_autorizado, 'large');

echo "<br>";
echo form_label('Fecha autorización :');
$data = array(
    'type'  => 'date',
    'name'  => 'fecha_autorizacion',
);
echo "<br>";
echo form_input($data);
echo "<br>";
echo form_label('Hora de autorización :');
$data = array(
    'type'  => 'time',
    'name'  => 'hora_autorizacion',
);
echo "<br>";
echo form_input($data);

echo "<br>";
echo form_label('Fecha de egreso :');
$data = array(
    'type'  => 'date',
    'name'  => 'fecha_egreso',
);
echo "<br>";
echo form_input($data);

echo "<br>";
echo form_label('Hora de egreso :');
$data = array(
    'type'  => 'time',
    'name'  => 'hora_egreso',
);
echo "<br>";
echo form_input($data);


echo "<br>";
echo form_label('Observaciones :');
$data = array(
    'type'  => 'text',
    'name'  => 'observaciones',
);

echo "<br>";
echo form_input($data);
echo "<br>";

echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");
?>

<?php echo form_close(); ?>
       </div>
     </div>
    </secction>