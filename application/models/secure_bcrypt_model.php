<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_bcrypt_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    //guardamos los datos del usuario en la tabla users
    public function save_pass($usuario_nombre,$hash)
    {
        echo "funcion2";
        $data = array(
            'usuario_nombre'		=>		$usuario_nombre,
            'usuario_contrasena'		=>		$hash
        );
        return $this->db->insert('usuario',$data);
    }
    //hacemos login con los datos del usuario usuario
    public function login($usuario_nombre,$hash)
    {
        //obtenemos los datos del usuario que quiere iniciar sesión
        $this->db->where('usuario_nombre',$usuario_nombre);
        $query = $this->db->get('usuario');
        //si el nombre de usuario coincide y sólo existe uno procedemos
        if($query->num_rows() == 1)
        {
            $user = $query->row();
            //en pass guardamos el hash del usuario que tenemos en la base
            //de datos para comprobarlo con el método check_password de Bcrypt
            $pass = $user->usuario_contrasena;

            //esta es la forma de comprobar si el password del
            //formulario coincide con el codificado de la base de datos
            if($this->bcrypt->check_password($hash, $pass))
            {
                return $query->row();
            }else{
                $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
                redirect(base_url().'secure_bcrypt/login','refresh');
            }
        }
    }
}