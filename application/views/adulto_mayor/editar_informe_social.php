<?php
if($list_social!=false)
{
    $list_social=$list_social->result()[0];
}
?>
<secction class="col-lg-8 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php
            $persona_id = $persona->result_array()[0]['persona_id'];
            $hidden = array(
                'persona_id' => $persona_id,
                'admin_id' => $admin_id,
                'informe_social_id'=>$list_social->informe_social_id,
                'editar'=>true
            );
            echo form_open(base_url()."Informe_Adulto_Mayor/registrar_informe_social", '', $hidden);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo form_label('A :'); ?> <?php echo form_error('dname'); ?>
                    <?php
                    echo form_dropdown('a_persona_id',$list_usuarios, $list_social->a_persona_id);
                    echo "<br>";
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo form_label('DE :'); ?> <?php echo form_error('dname');
                    $arrayDE = array($this->session->userdata('id')=> $this->session->userdata('Usuario'));
                    echo form_dropdown('de_persona_id',$arrayDE, $list_social->de_persona_id);
                    ?>
                    <?php
                    echo "<br>";
                    echo form_label('Fecha :');
                    $data = array(
                        'type'  => 'date',
                        'name'  => 'fecha',
                        'value'=>$list_social->fecha
                    );
                    echo form_input($data);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    echo form_label('Referencia Social: ');
                    echo "<br>";
                    $data = array(
                        'name'  => 'referencia_social',
                        'id'          => 'txt_area',
                        'rows'        => '3',
                        'cols'        => '10',
                        'style'       => "width: 248px; margin: 0px; height: 66px;",
                        'value'       => trim($list_social->referencia_social)
                    );
                    echo form_textarea($data);
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo form_label('Diagnostico Social: ');
                    $data = array(
                        'name'  => 'diag_social',
                        'id'          => 'txt_area',
                        'rows'        => '3',
                        'cols'        => '10',
                        'style'       => "width: 248px; margin: 0px; height: 66px;",
                        'value'       => trim($list_social->diag_social)
                    );
                    echo "<br>";
                    echo form_textarea($data);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    echo form_label('Fuentes de Informacion: ');
                    $data = array(
                        'name'  => 'fuentes_informacion',
                        'id'          => 'txt_area',
                        'rows'        => '3',
                        'cols'        => '10',
                        'style'       => "width: 248px; margin: 0px; height: 66px;",
                        'value'       => trim($list_social->fuentes_informacion)
                    );

                    echo "<br>";
                    echo form_textarea($data);
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo form_label('Concluciones o Sugerencias: ');
                    $data = array(
                        'name'  => 'conclusiones',
                        'id'          => 'txt_area',
                        'rows'        => '3',
                        'cols'        => '10',
                        'style'       => "width: 248px; margin: 0px; height: 66px;",
                        'value'       => trim($list_social->conclusiones)
                    );

                    echo "<br>";
                    echo form_textarea($data);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Grupo Familiar</label>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Parentesco</th>
                        </tr>
                        <?php
                        if($list_grupo_familiar!=false)
                            foreach($list_grupo_familiar->result() as $fila)
                            {
                                ?>
                                <tr>
                                    <td><?= $fila->nombre; ?></td>
                                    <td><?= $fila->ap_paterno ?></td>
                                    <td><?= $fila->ap_materno ?></td>
                                    <td><?= $fila->parentesto ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                        <tr>

                        </tr>

                    </table>
                </div>
            </div>

            <?php
            echo "<br>";
            echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");
            ?>

            <?php echo form_close(); ?>
        </div>
    </div>
</secction>