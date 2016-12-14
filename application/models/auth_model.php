<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
	public function login($username,$password) //    Consulta para buscar en la tabla usuario 
	{
		$this->db->where('usuario_nombre',$username);
		$this->db->where('usuario_contrasena',$password);
		$q = $this->db->get('usuario');
		if($q->num_rows()>0)
		{
			return $q;
		}
		else{
			$this->session->set_flashdata('usuario_incorrecto','LOS DATOS INTRODUCIDOS SON INCORRECTOS!!!!!');
			redirect(base_url().'Auth','refresh');
		}
	}
	/**----------------------------------------------------------------------
	 * 
	 *-----------------------------------------------------------------------
	 **/
	public function recuperar_datos($username,$password)
	{
		/*$this->db->where('usuario_nombre',$username);
		$this->db->where('usuario_contraeña',$username);
		$this->db->where('usuario persona ',);*/

		$this->db->select('*');
		$this->db->from('persona p');
		$this->db->join('usuario u', 'p.persona_id = u.usuario_persona');
		$this->db->where('u.usuario_nombre', $username);
		$this->db->where('u.usuario_contrasena', $password);
		$consulta= $this->db->get();
		if ($consulta->num_rows==1) {
			return $consulta;
		}
		$datos= $consulta->result();
		return $datos;
	}
	public function get_data()
	{
		return $this->_data;
	}
}
