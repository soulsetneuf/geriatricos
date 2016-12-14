<?php
    if($list_seguimiento!=false)
    {
        $list_seguimiento=$list_seguimiento->result()[0];
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
                'informe_seguimiento_id'=>$list_seguimiento->informe_seguimiento_id,
                'editar'=>true
            );
            echo form_open(base_url()."Informe_Adulto_Mayor/registrar_seguimiento", '', $hidden);
            ?>
            <?php

            echo "<h3>FORMULARIO PARA GENERAL INFORME DE SEGUIMIENTO</h3>";
            echo "<table>";
            echo "<tr>
            <td>";
            echo form_label('Fecha de Seguimiento :');
            echo "</td><td>";
            $data = array(
                'type'  => 'date',
                'name'  => 'fecha_seguimiento',
                'value' => $list_seguimiento->fecha_seguimiento,
            );
            echo form_input($data);
            echo "</td>
            <td>";
            echo form_label('A requerimiento de: ');
            echo "</td>
            <td>";
            ?>
            <?php
                $options = array(
                    "JUZGADO DE PARTIDO MIXTO LIQUIDADOR Y DE SENTENCIA (PROVINCIAL)"         => "JUZGADO DE PARTIDO MIXTO LIQUIDADOR Y DE SENTENCIA (PROVINCIAL)",
                    "JUZGADO PUBLICO EN MAT. NNA #1"           => "JUZGADO PÚBLICO EN MAT. NNA #1",
                    "JUZGADO PUBLICO EN MAT. NNA #2"         => "JUZGADO PÚBLICO EN MAT. NNA #2",
                    "SEDEGES - UASF"        => "SEDEGES - UASF",
                );
                $data = array(
                    'name'  => 'a_requerimiento',
                    'id'  => 'a_requerimiento',
                    'style'=>"width:250px",
                );
                //$shirts_on_sale = array('small', 'large');
                echo form_dropdown($data, $options, $list_seguimiento->a_requerimiento);
            ?>
            <br>
            <?php
            echo "</td>
            </tr>
            <tr>
                <td>";
            echo form_label('1. Situación Familiar: ');
            echo "
                </td>
                <td>";
            $data = array(
                'name'        => 'situacion_familiar',
                'id'          => 'situacion_familiar',
                'rows'        => '2',
                'cols'        => '30',
                'style'       => 'width:70%',
                'value'       => trim($list_seguimiento->situacion_familiar),
            );
            echo form_textarea($data);
            echo "
                </td>
                <td>
            </tr>
            <tr>
                <td>";
            echo form_label('2. Aspecto Legal: ');
            echo "
                </td>
                <td>";
            $data = array(
                'name'        => 'aspecto_legal',
                'id'          => 'aspecto_legal',
                'rows'        => '2',
                'cols'        => '30',
                'style'       => 'width:70%',
                'value'       => trim($list_seguimiento->aspecto_legal),
            );
            echo form_textarea($data);
            echo "
                </td>
                <td>";
            echo form_label('3. Estado de Salud: ');
            echo "
                </td>
                <td>";
            $data = array(
                'name'        => 'estado_salud',
                'id'          => 'estado_salud',
                'rows'        => '2',
                'cols'        => '30',
                'style'       => 'width:70%',
                'value'       => trim($list_seguimiento->estado_salud),
            );
            echo form_textarea($data);
            echo "
                </td>
            </tr>
            <tr>
            <td>";
            echo form_label('PARTICIPACION DENTRO DEL PROGRAMA DE PREEGRESO Y EGRESO: ');
            echo "
            </td>
            <td>";
            $data = array(
                'name'        => 'participacion_programa',
                'id'          => 'participacion_programa',
                'rows'        => '2',
                'cols'        => '30',
                'style'       => 'width:70%',
                'value'       => trim($list_seguimiento->participacion_programa),
            );
            echo form_textarea($data);
            echo "
            </td>
            <td>";
            echo form_label('RECOMENDACIONES: ');
            echo "
            </td>
            <td>";
            $data = array(
                'name'        => 'recomentacion',
                'id'          => 'recomentacion',
                'rows'        => '2',
                'cols'        => '30',
                'style'       => 'width:70%',
                'value'       => trim($list_seguimiento->recomentacion),
            );
            echo form_textarea($data);
            echo "
            </td>
                        </tr>
                        </table>";
            ?>
            <?php
            echo form_error('dname');
            echo form_submit('mysubmit', 'Guardar',"class='btn btn-success'");
            ?>
            <br/>

            <?php echo form_close(); ?>
        </div>
    </div>
</secction>