<?php
$config=
    array(
    'login/new_user'=>array(
            array(
                'field'=>'usuario_nombre',
                'label'=>' Usuario ',
                'rules'=>'trim|required|min_length[5]|callback_verificar_usuario'
            ),
            array(
                'field'=>'confirmar_contrasena',
                'label'=>' Password ',
                'rules'=>'required'/*matches[confirmar_contrasena]*/
            ),
            array(
                'field'=>'usuario_contrasena',
                'label'=>' Password ',
                'rules'=>"required|matches[confirmar_contrasena]"
            )
        )
    );
?>