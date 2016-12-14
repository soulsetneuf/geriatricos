<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Persona_model extends CI_Model {
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //Cargar base de datos
                $this->load->database();
        }
        public function get_personas()
        {
                $query=$this->db->query('select * from persona;');
                return $query;
        }
        public function get_user()
        {
                $query=$this->db->query("select * from persona
                where persona.persona_id not in(
                select persona.persona_id from adulto_mayor
                join persona
                on persona.persona_id=adulto_mayor.persona_id)
                and persona.user_id=0");
                return $query;
        }
        public function usuario_libre()
        {
                $query=$this->db->query("select * from persona
                where persona.user_id=0
                and persona.persona_id
                not in
                (select persona_id from adulto_mayor)");
                return $query;
        }
        public function get_persona_id($id)
        {
                $this->db->from('persona');
                $this->db->where('persona_id',$id);
                $query = $this->db->get();
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function insertar($data)
        {
                $this->db->insert('persona',$data);
        }
        public function CalculaEdad($fecha)
        {
                list($Y, $m, $d) = explode("-", $fecha);
                return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
        
        }
         public function lista_adulto()
        {
                $query=$this->db->query("select * from persona
                where persona.user_id=0
                and persona.persona_id
                in
                (select persona_id from adulto_mayor)");
                return $query;
        }
        public function historia_clinica($persona_id)
        {
                $query=$this->db->query("
                    select med_ficha_clinica.ficha_fecha ,med_estado_fisico_ingreso.ingreso_tratamiento,
                    med_ficha_clinica.ficha_observaciones,med_ficha_clinica.ficha_id
                    from med_ficha_clinica
                    join persona
                    on persona.persona_id=med_ficha_clinica.persona_id
                    join med_estado_fisico_ingreso
                    on med_ficha_clinica.ingreso_id=med_estado_fisico_ingreso.ingreso_id
                    where persona.persona_id=$persona_id
                ");
                return $query;
        }

}
?>