<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adulto_Mayor extends CI_Controller
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
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');


        $strNombreTabla = "v_usuario";
        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);

        $nombre_completo = $usuario[0]->persona_nombres . " " . $usuario[0]->persona_app_pat . " " . $usuario[0]->persona_app_pat;

        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);

        $nombre_campos_tabla = array("persona_ci", "persona_nombres", "persona_app_pat", "persona_app_mat");
        $nombre_campos_form = array("CI", "Nombres", "Apellido Paterno", "Apellido Materno");
        $enlaces = array("0" => array("nombre enlace" => "Registrar Adulto Mayor", "direccion" => base_url() . "adulto_mayor/registrar/",), "1" => array("nombre enlace" => "Actualizar", "direccion" => "actulizar.php",), "2" => array("nombre enlace" => "Eliminar", "direccion" => "Eliminar.php",));
        $data["persona"] = $this->persona_model->get_personas();
        $data["enlaces"] = $enlaces;
        $data["nombre_campos_tabla"] = $nombre_campos_tabla;
        $data["nombre_campos_form"] = $nombre_campos_form;

        $this->pagina->header($data, $this);

        $this->load->view('/adulto_mayor/show');

        $this->load->view('/plantilla/footer', $data);
    }

    public function buscar()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $strNombreTabla = "v_usuario";
        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);
        $nombre_completo = $usuario[0]->persona_nombres . " " . $usuario[0]->persona_app_pat . " " . $usuario[0]->persona_app_pat;

        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);
        $ci = $this->input->post('ci');
        $data["persona"] = $this->adulto_mayor_model->buscar($ci);
        $this->load->view('/adulto_mayor/buscar', $data);
    }

    public function registrar($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $this->pagina->datos_usuario($this);
        $this->pagina->nombre_campos('nombre_campos_form', array('Nombre', 'Apellido Paterno', 'Apellido Materno', 'cod'));
        $this->pagina->nombre_campos('nombre_campos_tabla', array('persona_nombres', 'persona_app_pat', 'persona_app_mat', 'persona_id'));
        $this->pagina->datos_personales($id, $this);
        $data = $this->pagina->getArrData();

        $data['persona'] = $this->persona_model->get_persona_id($id);
        $this->pagina->header($data, $this);

        $registrado = $this->base->datos_repetidos('v_persona_adulto_mayor', $this, array('persona_id' => $id));
        if ($registrado == false)
        {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Select genericas
                $dataSelect = $this->base->select_array('adulto_mayor_tipologias', "l_Tipologias", "Tipologias", "2", $this, false, "l_Tipologias");
                $data['select_tipologias'] = $this->load->view('/genericas/select', $dataSelect, true);

                $dataSelect = $this->base->select_array("adulto_mayor_tipologias", "l_TipologiasList[]", "", "2", $this, true, "l_TipologiasList");
                $data['select_tipologias_vacia'] = $this->load->view('/genericas/select', $dataSelect, true);
                $dataSelect = $this->base->select_array('adulto_mayor_problematica', "l_ProvFamiliar", "Problematica", "2", $this, false, "l_ProvFamiliar");
                $data['select_problematica'] = $this->load->view('/genericas/select', $dataSelect, true);
                $dataSelect = $this->base->select_array("adulto_mayor_problematica", "l_ProvFamiliarList[]", "", "2", $this, true, "l_ProvFamiliarList");
                $data['select_problematica_vacia'] = $this->load->view('/genericas/select', $dataSelect, true);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $data['datos_usuario'] = $this->load->view('/genericas/datos_usuario', $data, true);
                $this->load->view('/adulto_mayor/registrar', $data);
        }
        else
        {
            $this->load->view('genericas/mensaje',
                array('mensaje'=>'El adulto mayor ya fue registrado anteriormente
                    <br>
                        <a href='.base_url().'adulto_mayor/listar/ingreso>Regresar Adulto Mayor</a>'
                ,'estilo'=>"alert alert-warning alert-dismissible")
            );

        }
        $this->load->view('/plantilla/footer', $data);

    }

    public function registrar_ingreso()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $arrForm = array('adulto_mayor_cen_acogida','persona_id', 'adulto_mayor_solicitud',
            'adulto_mayor_modalidad', 'adulto_mayor_observacion',
            'adulto_mayor_edad_ingreso','observaciones','direccion_familia');
        $datos = $this->base->form_array($arrForm, $this);
        $this->db->insert('adulto_mayor', $datos);


        $this->db->select_max('persona_id');
        $idAdlm = $this->db->get('adulto_mayor')->result()[0]->persona_id;

        $this->base->list_array($this->input->post('l_TipologiasList'), 'tipologia_id', $idAdlm, 'persona_id', 'tipologia_adulto', $this);
        $this->base->list_array($this->input->post('l_ProvFamiliarList'), 'problematica_id', $idAdlm, 'persona_id', 'problematica_adulto', $this);
        redirect("adulto_mayor/listar/ingreso", "refresh");
    }

    public function listar($tipo)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        //$this->pagina->datos_personales($id,$CI);
        $this->pagina->datos_usuario($this);
        $this->pagina->nombre_campos('nombre_campos_form', array('Nombre', 'Apellido Paterno', 'Apellido Materno', 'cod'));
        $this->pagina->nombre_campos('nombre_campos_tabla', array('persona_nombres', 'persona_app_pat', 'persona_app_mat', 'persona_id'));

        $data = $this->pagina->getArrData();

        $data["arr_tabla"] = $this->adulto_mayor_model->get_AdultoMayor();
        if ($tipo == "egreso") {
            $data["enlaces"] = array("0" => array("nombre enlace" => "Registrar egreso", "direccion" => base_url() . "adulto_mayor/egreso/"));
        }
        if ($tipo == "gastos") {
            $data["enlaces"] = array(
                "0" => array("nombre enlace" => "Registrar gastos", "direccion" => base_url() . "adulto_mayor/gastos/"),
                "1" => array("nombre enlace" => "Ver detalle", "direccion" => base_url() . "adulto_mayor/detalle_gastos/")
            );
        }
        if ($tipo == "asistencia_economica") {
            $data["enlaces"] = array(
                "0" => array("nombre enlace" => "Registrar asistencia economica", "direccion" => base_url() . "adulto_mayor/asistencia_economica/"),
                "1" => array("nombre enlace" => "Ver detalle", "direccion" => base_url() . "adulto_mayor/detalle_asistencia_economica/")
            );
        }
        if($tipo == "usuarios")
        {


            $this->pagina->nombre_campos('nombre_campos_form', array('Usuario', 'Tipo','cod'));
            $this->pagina->nombre_campos('nombre_campos_tabla', array('usuario_nombre', 'usuario_tipo', 'usuario_id'));

            $data = $this->pagina->getArrData();

            $data["nuevo"] = true;
            $data["enlace_bonton"] = base_url() . "login/list_personas/";

            $data["arr_tabla"] = $this->usuario_model->get_usuarios();
            $data["enlaces"] = array(
                "0" => array("nombre enlace" => "Editar", "direccion" => base_url() . "login/edit_user/",));
        }
        if ($tipo == "ingreso") {
            $data["arr_tabla"] = $this->persona_model->usuario_libre();
            $data["enlaces"] = array(
                "0" => array("nombre enlace" => "Registrar Adulto mayor", "direccion" => base_url() . "adulto_mayor/registrar/",));

            //$data["arr_tabla"] = $this->persona_model->get_personas();

        }
        $this->pagina->header($data, $this);

        if($data["arr_tabla"]==false)
        {
            $this->load->view('genericas/mensaje',
                array('mensaje'=>'No se encontraron registros,
                        <br> Por favor registre un nuevo Adulto Mayor
                        <br>
                        <a href='.base_url().'adulto_mayor/listar/ingreso>Adulto mayor</a>','estilo'=>"alert alert-danger alert-dismissible")
            );
        }
        else
            $this->load->view('/genericas/tabla', $data);

        $this->load->view('/plantilla/footer', $data);

    }
    public function asistencia_economica($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $strNombreTabla = "v_usuario";
        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));
        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);
        $nombre_completo = $usuario[0]->persona_nombres . " " . $usuario[0]->persona_app_pat . " " . $usuario[0]->persona_app_pat;

        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);

        $data['persona'] = $this->persona_model->get_persona_id($id);
        $data['edad'] = $this->persona_model->CalculaEdad($usuario[0]->persona_fecha_nac);
        $data['admin_id'] = $this->session->userdata('id');

        $this->pagina->header($data, $this);


        if($this->usuario_model->getGrupoFamiliar($id)!=false)
            $data['list_familia'] = $this->pagina->my_form_dropdown($this->usuario_model->getGrupoFamiliar($id)->result_array(),'id','familiar');
        else
            $data['list_familia'] = false;

        //echo $data['list_familia'];

        //print_r($data['list_familia']);


        $this->load->view('/genericas/datos_usuario', $data);
        $this->load->view('/adulto_mayor/asistencia_economica', $data);
        $this->load->view('/plantilla/footer', $data);
    }
    public function  editar_asistencia_economica($id_asistencia_economica)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $id_persona=$this->base->buscar_id_persona('adulto_mayor_asistencia_economica',array('id'=>$id_asistencia_economica),$this);
        $this->pagina->verificarURL($id_asistencia_economica,$this,base_url()."adulto_mayor/detalle_asistencia_economica/",'adulto_mayor_asistencia_economica',array("id"=>$id_asistencia_economica));
        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $this->pagina->header($data, $this);

        $data['persona'] = $this->persona_model->get_persona_id($id_persona);
        $this->load->view('/genericas/datos_usuario', $data);


        $data['datos_asistencia_economica']=$this->base->buscar_registro('adulto_mayor_asistencia_economica',array('id'=>$id_asistencia_economica),$this,false);


        $this->load->view('/asistencia_economica/editar_asistencia_economica', $data);

        $this->load->view('/plantilla/footer', $data);
    }
    public function  editar_gastos($id_gasto)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $id_persona=$this->base->buscar_id_persona('adulto_mayor_gastos',array('id'=>$id_gasto),$this);
        $this->pagina->verificarURL($id_gasto,$this,base_url()."adulto_mayor/listar/gastos/",'adulto_mayor_gastos',array("id"=>$id_gasto));
        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $this->pagina->header($data, $this);
        $data['persona'] = $this->persona_model->get_persona_id($id_persona);
        $this->load->view('/genericas/datos_usuario', $data);


        $data['adulto_mayor_gastos']=$this->base->buscar_registro('adulto_mayor_gastos',array('id'=>$id_gasto),$this,false);

        ////////////////////////////////////////////////////////////////////////
        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id_persona);
        $query = $this->db->get('adulto_mayor_asistencia_economica')->result();
        $total_ingresos = $query[0]->monto;


        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id_persona);
        $query = $this->db->get('adulto_mayor_gastos')->result();
        $total_gastos = $query[0]->monto;

        $data['total_ingresos'] = $total_ingresos - $total_gastos;
        ////////////////////////////////////////////////////////////////////////


        $this->load->view('/gastos/editar_gasto', $data);
        $this->load->view('/plantilla/footer', $data);
    }
    public function egreso($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();
        $data['persona'] = $this->persona_model->get_persona_id($id);

        $this->pagina->header($data, $this);

        $this->load->view('/genericas/datos_usuario', $data);
        $this->load->view('/adulto_mayor/egreso', $data);

        $this->load->view('/plantilla/footer', $data);
    }

    public function registrar_egreso()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');


        $arrForm = array('autorizado', 'motivo', 'admin_id', 'persona_id',
            'observaciones', 'fecha_autorizacion', 'hora_autorizacion',
            'fecha_egreso', 'hora_egreso');
        $datos = $this->base->form_array($arrForm, $this);
        $this->db->insert('adulto_mayor_egreso', $datos);

        $persona_id=$this->input->post('persona_id');
        $adulto_mayor_id=$this->adulto_mayor_model->buscar($persona_id)->result()[0]->adulto_mayor_id;
        //echo $persona_id;/*

        $this->db->set('estado',0, FALSE);
        $this->db->where('adulto_mayor_id', $adulto_mayor_id);
        $this->db->update('adulto_mayor');



        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $this->pagina->header($data, $this);

        $this->load->view('genericas/mensaje',
            array('mensaje'=>'Datos registrados correctamente
                        <a href='.base_url().'adulto_mayor/listar/egreso>Adulto mayor Egreso</a>','estilo'=>"alert alert-success alert-dismissible")
        );

        $this->load->view('/plantilla/footer', $data);
    }

    public function gastos($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $strNombreTabla = "v_usuario";
        $arrFiltros = array('usuario_id' => $this->session->userdata('id'));

        $usuario = $this->base->buscar_registro($strNombreTabla, $arrFiltros, $this, true);
        $nombre_completo = $usuario[0]->persona_nombres . " " . $usuario[0]->persona_app_pat . " " . $usuario[0]->persona_app_pat;

        $adulto_mayor = $this->base->buscar_registro('v_persona_adulto_mayor', array('persona_id' => $id), $this, true);
        $total_ingresos = $adulto_mayor[0]->adulto_mayor_total_ingresos;
        $adulto_mayor_id = $adulto_mayor[0]->adulto_mayor_id;
        $persona_id = $adulto_mayor[0]->persona_id;

        $data = array(
            'titulo_pagina' => "Administrador",
            'nombre_usuario' => $nombre_completo);

        $data['persona'] = $this->persona_model->get_persona_id($id);
        $data['edad'] = $this->persona_model->CalculaEdad($usuario[0]->persona_fecha_nac);

        $data['admin_id'] = $this->session->userdata('id');
        $data['adulto_mayor_id'] = $adulto_mayor_id;
        $data['persona_id'] = $persona_id;

        //////////////////////////////////////////////////////////////////////////
        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_asistencia_economica')->result();
        $total_ingresos = $query[0]->monto;


        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_gastos')->result();
        $total_gastos = $query[0]->monto;

        $data['total_ingresos'] = $total_ingresos - $total_gastos;
        //////////////////////////////////////////////////////////////////////////


        $this->pagina->header($data, $this);

        $this->load->view('/genericas/datos_usuario', $data);
        $this->load->view('/adulto_mayor/gastos', $data);

        $this->load->view('/plantilla/footer', $data);
    }

    public function registrar_gasto()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $estado = $this->input->post('estado');
        $persona_id = $this->input->post('persona_id');
        $monto = $this->input->post('total');

        $arrForm = array('nombre', 'descripcion', 'admin_id', 'persona_id', 'unidad', 'monto', 'total');
        $datos = $this->base->form_array($arrForm, $this);
        if($estado==0)
        {
            $gastos_id=$this->input->post('gastos_id');
            $this->db->set('monto', $monto, FALSE);
            $this->db->where('id', $gastos_id);
            $this->db->update('adulto_mayor_gastos');
        }
        else
        {
            $this->db->insert('adulto_mayor_gastos', $datos);
        }
        redirect("/adulto_mayor/detalle_gastos/$persona_id");
    }
    public function registrar_asistencia_economica()
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        //Estado 1 insertar,0 actualizar
        $estado = $this->input->post('estado');
        $persona_id = $this->input->post('persona_id');
        $monto = $this->input->post('monto');
        $arrForm = array('admin_id', 'persona_id', 'nombre_entidad', 'monto', 'concepto','familiar');
        $datos = $this->base->form_array($arrForm, $this);

        if ($estado==0)
        {
            $asistencia_eco_id=$this->input->post('asistenacia_eco_id');
            $this->db->set('monto',$monto, FALSE);
            $this->db->where('id', $asistencia_eco_id);
            $this->db->update('adulto_mayor_asistencia_economica');
        }
        else
        {
            $this->db->insert('adulto_mayor_asistencia_economica', $datos);
            ////////////////////////////////////////////// M
            $this->db->set('adulto_mayor_total_ingresos', 'adulto_mayor_total_ingresos+' . $monto, FALSE);
            $this->db->where('persona_id', $persona_id);
            $this->db->update('adulto_mayor');
        }
        redirect("/adulto_mayor/detalle_asistencia_economica/$persona_id");
    }
    public function detalle_gastos($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $this->pagina->verificarURL($id,$this,base_url()."adulto_mayor/listar/gastos/",'adulto_mayor_gastos',array("persona_id"=>$id));
        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $data['persona'] = $this->persona_model->get_persona_id($id);
        $this->pagina->header($data, $this);
        $this->load->view('/genericas/datos_usuario', $data);
        /////////////////////////////////////////////////////////////////////////////////////

        $data['nombre_campos_form'] = array('Nombre', 'Descripcion', 'Fecha', 'Monto', 'Unidad', 'Total', 'Codigo');
        $data['nombre_campos_tabla'] = array('nombre', 'descripcion', 'fecha', 'monto', 'unidad', 'total', 'id');
        $data["arr_tabla"] = $this->base->buscar_registro('adulto_mayor_gastos', array('persona_id' => $id), $this, false);


        $data["enlaces"] = array(
            "0" => array("nombre enlace" => "Eliminar", "direccion" => base_url() . "adulto_mayor/eliminar_detalle_gastos/"),
            "1" => array("nombre enlace" => "Editar", "direccion" => base_url() . "adulto_mayor/editar_gastos/")
        );


        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        $adulto_mayor = $this->base->buscar_registro('v_persona_adulto_mayor', array('persona_id' => $id), $this, true);
        $data['adulto_mayor_id'] = $adulto_mayor[0]->adulto_mayor_id;
        $data['persona_id'] = $adulto_mayor[0]->persona_id;


        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_asistencia_economica')->result();
        $data['total_ingresos'] = $query[0]->monto;

        $this->load->view('/genericas/total_ingresos', $data);


        //total_gastado($persona_id)
        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_gastos')->result();
        $data['total_gastos'] = $query[0]->monto;


        $this->load->view('/genericas/total_gastos', $data);

        $data['contenido_neto'] = $data['total_ingresos'] - $data['total_gastos'];
        $this->load->view('/genericas/contenido_neto', $data);


        $this->load->view('/genericas/tabla', $data);
        $this->load->view('/plantilla/footer', $data);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    public function detalle_asistencia_economica($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $this->pagina->verificarURL($id,$this,base_url()."adulto_mayor/listar/asistencia_economica/",'adulto_mayor_asistencia_economica',array("persona_id"=>$id));
        $this->pagina->datos_usuario($this);
        $data=$this->pagina->getArrData();

        $data['persona'] = $this->persona_model->get_persona_id($id);
        $this->pagina->header($data, $this);
        $this->load->view('/genericas/datos_usuario', $data);



        $data['nombre_campos_form'] = array('Nombre', 'Concepto', 'Fecha', 'Monto', 'Codigo');
        $data['nombre_campos_tabla'] = array('nombre_entidad', 'concepto', 'fecha', 'monto', 'id');

        $data["arr_tabla"] = $this->base->buscar_registro('adulto_mayor_asistencia_economica', array('persona_id' => $id), $this, false);

        $data["enlaces"] = array(
            "0" => array("nombre enlace" => "Eliminar", "direccion" => base_url() . "adulto_mayor/eliminar_asistencia_economica/"),
            "1" => array("nombre enlace" => "Editar", "direccion" => base_url() . "adulto_mayor/editar_asistencia_economica/"));

        $adulto_mayor = $this->base->buscar_registro('v_persona_adulto_mayor', array('persona_id' => $id), $this, true);
        $data['adulto_mayor_id'] = $adulto_mayor[0]->adulto_mayor_id;
        $data['persona_id'] = $adulto_mayor[0]->persona_id;

        //////////////////////////////////////////////////////////
        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_asistencia_economica')->result();
        $data['total_ingresos'] = $query[0]->monto;
        $this->load->view('/genericas/total_ingresos', $data);


        $this->db->select_sum('monto');
        $this->db->where('persona_id', $id);
        $query = $this->db->get('adulto_mayor_gastos')->result();
        $data['total_gastos'] = $query[0]->monto;
        $this->load->view('/genericas/total_gastos', $data);

        $data['contenido_neto'] = $data['total_ingresos'] - $data['total_gastos'];
        $this->load->view('/genericas/contenido_neto', $data);

        /////////////////////////////////////////////////////////


        $this->load->view('/genericas/tabla', $data);
        $this->load->view('/plantilla/footer', $data);
    }
    public function  eliminar_detalle_gastos($id)
    {
        if (! $this->session->userdata('logged_in'))
            redirect('Auth');

        $this->db->where('id', $id);
        $query = $this->db->get('adulto_mayor_gastos')->result();
        $id_persona = $query[0]->persona_id;

        $this->base->eliminar_registro('adulto_mayor_gastos', array('id' => $id), $this);
        redirect(base_url()."/adulto_mayor/detalle_gastos/$id_persona");
    }
    public function  eliminar_asistencia_economica($id)
    {
        
        if (! $this->session->userdata('logged_in'))
           redirect('Auth');

        $this->db->where('id', $id);
        $query = $this->db->get('adulto_mayor_asistencia_economica')->result();
        $id_persona = $query[0]->persona_id;

        $this->base->eliminar_registro('adulto_mayor_asistencia_economica', array('id' => $id), $this);
        //$this->load->view('genericas/mensaje',array('id_persona'=>$id_persona,'mensaje'=>'Datos eliminados correctamente','estilo'=>"small-box bg-aqua"));
        //echo base_url()."/adulto_mayor/detalle_asistencia_economica/$id_persona";
        redirect(base_url()."adulto_mayor/detalle_asistencia_economica/$id_persona");    
    }
}
