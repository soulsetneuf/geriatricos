<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();

        $this->load->model('adulto_mayor_model');
        $this->load->model('persona_model');
        $this->load->model('usuario_model');
        $this->load->library('session');
        $this->load->library('base');
        $this->load->library('pagina');
        $this->load->helper('form');
    }
    public function index()
    {
        echo "djflkdsa";
    }
    public function registrar()
    {
        $data['admin_id']=$this->session->userdata('id');
        $this->load->view('usuarios/registrar',$data);
    }
    public function registrar_usuario()
    {
        echo "Registrar usuario";
    }
    public function lista_usuario_2()
    {

        $this->pagina->datos_usuario($this);

        $this->pagina->nombre_campos('nombre_campos_form', array('Nick', 'cod'));
        $this->pagina->nombre_campos('nombre_campos_tabla', array('usuario_nombre', 'usuario_id'));


        $data = $this->pagina->getArrData();
        $this->pagina->header($data, $this);


        $data["arr_tabla"] = $this->usuario_model->get_usuarios();


        $data["enlaces"] = array(
            "0" => array("nombre enlace" => "Informe Seguimiento", "direccion" => base_url() . "Informe_Adulto_Mayor/seguimiento/"),
            "1" => array("nombre enlace" => "VER", "direccion" => base_url() . "Informe_Adulto_Mayor/seguimiento/"),
        );
        $this->load->view('/genericas/tabla', $data);

        print_r($data["arr_tabla"]);
    }


}