<?php
$hidden = array(
    'persona_id' => $persona_id,
    'editar'=>false
);
echo form_open(base_url()."login/new_user/$persona_id", '', $hidden);
?>
<section class="content">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-4">
                <div class="box box-info">
                        <div class="box-header with-border">
                            <?php
                                echo form_label('Usuario :');
                                $data = array(
                                        'type'  => 'text',
                                        'name'  => 'usuario_nombre',
                                );
                                echo "<br>";
                                echo form_input($data);
                                echo form_error('usuario_nombre');

                                echo "<br>";

                                echo form_label('Password:');
                                $data = array(
                                    'type'  => 'password',
                                    'name'  => 'usuario_contrasena',
                                );
                                echo "<br>";
                                echo form_input($data);
                                echo form_error('usuario_contrasena');

                                echo "<br>";
                                echo form_label('Confirmar password:');
                                $data = array(
                                    'type'  => 'password',
                                    'name'  => 'confirmar_contrasena',
                                );
                                echo "<br>";
                                echo form_input($data);
                                echo form_error('confirmar_contrasena');
                                echo "<br>";
                                $options_tipo = array(
                                    'admin'         => 'Administrador',
                                    'social'           => 'Trabajador social',
                                    'medico'         => 'Medico gemeral',
                                    'enfermera'         => 'Enfermera',
                                    'odontologo'         => 'Odontologo',
                                );
                                echo "<br>";
                                echo form_label('Tipo :');
                                echo "<br>";
                                echo form_dropdown('usuario_tipo', $options_tipo, 'admin');
                                echo "<br>";
                                echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");
                            ?>
                        </div>
                    </div>
            </div>
        </div>
</section>
<?php
    echo form_close();
?>