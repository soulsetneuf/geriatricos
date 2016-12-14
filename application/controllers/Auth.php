<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{
		if(isset($_POST['password'])){ 
       		$this->load->model('auth_model');
       		$query=$this->auth_model->login($this->input->post('username'),md5($this->input->post('password')));
     		$session = array(
       						'id' => $query->result()[0]->usuario_id, 
       						'Usuario' => $query->result()[0]->usuario_nombre, 
       						'Password' => $query->result()[0]->usuario_contrasena,
       						'TipoUsusario' => $query->result()[0]->usuario_tipo,
       						'logged_in' => TRUE 
       		);
       		$this->session->set_userdata($session);      			
            switch ($this->session->userdata('TipoUsusario'))
			{
	            case 'admin':
	                redirect('admin/Admin_controller','refresh');
	                break;
	            case 'social':
					redirect('admin/Admin_controller','refresh');
	                break;  
	            case 'medico':
					redirect('area_medica/medica_controller','refresh');
	                break;
	            case 'enfermera':
					redirect('enfermeria/enfermeria_controller','refresh');
	                break;
	            case 'odontologo':
					redirect('odontologia/odontologia_controller','refresh');
	                break;   
	            default:        
	                $this->load->view('autenticacion/login');
	                break;
	    	}
        }
        $this->session->set_flashdata('incorrecto', 'Usuario incorrecto!');
        $this->load->view('autenticacion/login');
        
	}
	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth','refresh');
	}

}