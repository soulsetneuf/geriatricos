<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('base');
    }
    public function index()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth','refresh');
            $strNombreTabla="v_usuario";
            $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
            $usuario=$this->base->buscar_registro($strNombreTabla,$arrFiltros,$this,true);
            $nombre_completo=$usuario[0]->persona_nombres." ".$usuario[0]->persona_app_pat." ".$usuario[0]->persona_app_mat;
            $data=array(
                'titulo_pagina' => "Administrador",
                'nombre_usuario'=>$nombre_completo);
            $this->load->view('/plantilla/head',$data);
            $this->load->view('/plantilla/header',$data);
            $this->load->view('/plantilla/slider',$data);
            $this->load->view('/plantilla/dash_board_menu');
            //$this->load->view('/adulto_mayor/show');
            $this->load->view('/plantilla/footer');
    }
}