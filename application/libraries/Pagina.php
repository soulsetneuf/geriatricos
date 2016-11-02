<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Pagina {
    var $arrData=array();
      public function header($data,$ci)
      {
            $ci->load->view('/plantilla/head', $data);
            $ci->load->view('/plantilla/header', $data);
            $ci->load->view('/plantilla/slider', $data);
            $ci->load->view('/plantilla/dash_board_menu', $data);
      }
    public function datos_usuario($CI)
    {
        $strNombreTabla="v_usuario";
        $arrFiltros = array('usuario_id' => $CI->session->userdata('id'));
        $usuario=$CI->base->buscar_registro($strNombreTabla,$arrFiltros,$CI,true);
        $nombre_completo=$usuario[0]->persona_nombres." ".$usuario[0]->persona_app_pat." ".$usuario[0]->persona_app_pat;
        $this->arrData['titulo_pagina']="Administrador";
        $this->arrData['nombre_usuario']=$nombre_completo;
        $this->arrData['edad']=$CI->persona_model->CalculaEdad($usuario[0]->persona_fecha_nac);
    }
    public function datos_personales_adulto_mayor($id,$CI)
    {
        $adulto_mayor=$CI->base->buscar_registro('v_persona_adulto_mayor',array('persona_id'=>$id),$CI,true);
        $this->arrData['total_ingresos']=$adulto_mayor[0]->adulto_mayor_total_ingresos;
        $this->arrData['adulto_mayor_id']=$adulto_mayor[0]->adulto_mayor_id;
        $this->arrData['persona_id']=$adulto_mayor[0]->persona_id;
    }
    public function datos_personales($id,$CI)
    {
        $persona=$CI->persona_model->get_persona_id($id);
        $this->arrData['persona_id']=$persona->result()[0]->persona_id;
    }
    public function nombre_campos($nombre,$arrCampos)
    {
        $this->arrData[$nombre]=$arrCampos;
    }
    public function getArrData()
    {
        return $this->arrData;
    }
}
?>