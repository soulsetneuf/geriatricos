<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('adulto_mayor_model');
        $this->load->model('persona_model');
        $this->load->library('session');
        $this->load->library('base');
        $this->load->library('pagina');
        $this->load->helper('form');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'form'));
        $this->load->database('default');
    }
    public function index()
    {
        redirect('/');
    }
    public function new_user($id)
    {
        $strNombreTabla = "v_usuario";
        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);

        $nombre_completo = $usuario[0]->persona_nombres . " " . $usuario[0]->persona_app_pat . " " . $usuario[0]->persona_app_mat;
        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);

        $nombre_campos_tabla = array("persona_ci", "persona_nombres", "persona_app_pat", "persona_app_mat","persona_id");
        $nombre_campos_form = array("CI", "Nombres", "Apellido Paterno", "Apellido Materno","COD");
        $data["arr_tabla"] = $this->persona_model->get_personas();

        $data["enlaces"] = array(
            "0" => array("nombre enlace" => "Nuevo usuario", "direccion" => base_url() . "login/new_user/"));
        $data["nombre_campos_tabla"] = $nombre_campos_tabla;
        $data["nombre_campos_form"] = $nombre_campos_form;
        $this->pagina->header($data, $this);
        ////////////////////////////////////////////////////////////////////////////////////////

        if($this->form_validation->run() == TRUE)
        {
                $data = array(
                    'usuario_nombre' => $this->input->post('usuario_nombre'),
                    'usuario_contrasena' => md5($this->input->post('usuario_contrasena')),
                    'usuario_tipo' => $this->input->post('usuario_tipo'),
                );
                $this->db->insert('usuario', $data);
                $maxid = 0;
                $row = $this->db->query('SELECT MAX(usuario_id) AS maxid FROM usuario')->row();
                if ($row) {
                    $maxid = $row->maxid;
                }
                $this->db->set('user_id', $maxid,FALSE);
                $this->db->where('persona_id', $id);
                $this->db->update('persona');
                redirect('/listar/usuarios');
        }
        else
        {
            if ($this->base->datos_repetidos('persona',$this,array('persona_id'=>$id,'user_id'=>0))==true)
            {
                $data["persona_id"] =$id;
                $this->load->view('/autenticacion/new_user', $data);
            }
           else
            {
                $editar=$this->input->post('editar');
                if($editar==true)
                {
                            $data = array(
                                'usuario_nombre' => $this->input->post('usuario_nombre'),
                                'usuario_contrasena' => md5($this->input->post('usuario_contrasena')),
                                'usuario_tipo' => $this->input->post('usuario_tipo'),
                            );
                            $usuario_id=$this->input->post('usuario_id');
                            $this->db->set($data);
                            $this->db->where('usuario_id', $usuario_id);
                            $this->db->update('usuario');
                            redirect('/adulto_mayor/listar/usuarios');
                }
                else
                {
                    $this->load->view('genericas/mensaje',
                        array('mensaje'=>'Esta persona ya tiene cuenta de usuario
                        <br>
                        <a href='.base_url().'/listar/usuarios>Registrar Nuevo Usuario</a>','estilo'=>"alert alert-danger alert-dismissible")
                    );
                }
            }
        }
        
        $this->load->view('/plantilla/footer', $data);
    }
    public function list_personas()
   {
        $strNombreTabla = "v_usuario";

        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);
        $nombre_completo = $usuario[0]->persona_nombres." " .$usuario[0]->persona_app_pat . " " .$usuario[0]->persona_app_pat;
        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);
        $nombre_campos_tabla = array("persona_ci", "persona_nombres", "persona_app_pat", "persona_app_mat","persona_id");
        $nombre_campos_form = array("CI", "Nombres", "Apellido Paterno", "Apellido Materno","COD");
        $data["arr_tabla"] = $this->persona_model->get_user();
        $data["enlaces"] = array(
            "0" => array("nombre enlace" => "Crear cuenta", "direccion" => base_url() . "login/new_user/"),
        );
        $data["nombre_campos_tabla"] = $nombre_campos_tabla;
        $data["nombre_campos_form"] = $nombre_campos_form;
        $this->pagina->header($data, $this);
        $this->load->view('/genericas/tabla', $data);
        $this->load->view('/plantilla/footer', $data);
    }
    /*
   public function edit_user($persona_id){
       if (! $this->session->userdata('logged_in'))
           redirect('Auth');

       //$id_persona=$this->base->buscar_id_persona('adulto_mayor_asistencia_economica',array('id'=>$id_asistencia_economica),$this);
       //$this->pagina->verificarURL($id_asistencia_economica,$this,base_url()."adulto_mayor/detalle_asistencia_economica/",'adulto_mayor_asistencia_economica',array("id"=>$id_asistencia_economica));
       $this->pagina->datos_usuario($this);
       $data=$this->pagina->getArrData();

       $this->pagina->header($data, $this);

       $this->db->select('usuario.*');
       $this->db->from('persona');
       $this->db->join('usuario', 'usuario.usuario_id = persona.user_id');
       $this->db->where('persona.persona_id',$persona_id);
       $query = $this->db->get();

       $data['persona_id']=$persona_id;
       $data['arrUsuario']=$query;
       $this->load->view('/autenticacion/edit_user', $data);

       $this->load->view('/plantilla/footer', $data);
   }*/
    public function edit_user($usuario_id){
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        //$id_persona=$this->base->buscar_id_persona('adulto_mayor_asistencia_economica',array('id'=>$id_asistencia_economica),$this);
        //$this->pagina->verificarURL($id_asistencia_economica,$this,base_url()."adulto_mayor/detalle_asistencia_economica/",'adulto_mayor_asistencia_economica',array("id"=>$id_asistencia_economica));
        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $this->pagina->header($data, $this);

        $this->db->select('usuario.*');
        $this->db->from('persona');
        $this->db->join('usuario', 'usuario.usuario_id = persona.user_id');
        $this->db->where('usuario.usuario_id',$usuario_id);
        $query = $this->db->get();

        $data['usuario_id']=$usuario_id;
        $data['arrUsuario']=$query;
        $this->load->view('/autenticacion/edit_user', $data);

        $this->load->view('/plantilla/footer', $data);
    }
    public function token()
    {
        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }
    public function logout_ci()
    {
        $this->session->sess_destroy();
        $this->index();
    }
    public function verificar_usuario($usuario_nombre){
        $query = $this->db->get_where('usuario',array('usuario_nombre'=>$usuario_nombre));
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('verificar_usuario','El nombre del usuario ya ha sido registrado');
            return false;
        }
        else
        {
            return true;
        }
    }
}
?>