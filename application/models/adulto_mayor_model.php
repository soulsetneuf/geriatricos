<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adulto_mayor_model extends CI_Model {
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                //Cargar base de datos
                $this->load->database();
        }
        public function buscar($id)
        {
                $this->db->select('adulto_mayor.*');
                $this->db->from('persona');
                $this->db->join('adulto_mayor', 'persona.persona_id = adulto_mayor.persona_id');
                $this->db->where('adulto_mayor.persona_id',$id);
                $query = $this->db->get();
                return $query;
        }
        public function get_AdultoMayor()
        {
                $this->db->select('persona.*');
                $this->db->from('persona');
                $this->db->join('adulto_mayor', 'persona.persona_id = adulto_mayor.persona_id');
                $this->db->where('adulto_mayor.estado','1');
                $this->db->where('persona.user_id =','0');
                $query = $this->db->get();
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function getListCentroAcogida()
        {
                $query=$this->db->query("
                select DISTINCT adulto_mayor.adulto_mayor_cen_acogida
                from adulto_mayor");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function adulto_mayor_registrados()
        {
                $query=$this->db->query("
              select
                adulto_mayor.adulto_mayor_cen_acogida,
                count(*)
                from adulto_mayor
                GROUP BY adulto_mayor.adulto_mayor_cen_acogida
                ORDER BY adulto_mayor.adulto_mayor_cen_acogida;
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function ingresos_diarios()
        {
                $query=$this->db->query("
                select sum(monto),nombre_entidad
                from adulto_mayor_asistencia_economica
                group by nombre_entidad
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function centros_acogida($adulto_mayor_cen_acogida)
        {
                $query=$this->db->query("
                select DISTINCT adulto_mayor_cen_acogida
                from adulto_mayor
                where adulto_mayor.adulto_mayor_cen_acogida is not Null
                and adulto_mayor.adulto_mayor_cen_acogida like '%$adulto_mayor_cen_acogida%'
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public  function entidades($nombre_entidad)
        {
                $query=$this->db->query("
                select DISTINCT nombre_entidad
                from adulto_mayor_asistencia_economica
                where nombre_entidad is not Null
                and nombre_entidad like '%$nombre_entidad%'
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function poblacion_sexo_modalidad_acogimiento($centro_acogimiento,$modalidad,$fecha_inicio,$fecha_fin)
        {
                $query=$this->db->query("
                select count(*) as total,
                COALESCE (sum(case WHEN am.adulto_mayor_modalidad = 'CIRCUNSTANCIAL' THEN 1 ELSE 0 end),0) as CIRCUNSTANCIAL,
                COALESCE (sum(case WHEN am.adulto_mayor_modalidad = 'DEFINITIVO' THEN 1 ELSE 0 end),0) as DEFINITIVO,
                COALESCE (sum(case WHEN pe.persona_sexo = '1' THEN 1 ELSE 0 end),0) as MASCULINO,
                COALESCE (sum(case WHEN pe.persona_sexo = '0' THEN 1 ELSE 0 end),0) as FEMENINO
                from adulto_mayor as am
                join persona as pe
                on pe.persona_id=am.persona_id
                WHERE am.adulto_mayor_cen_acogida='$centro_acogimiento'
                AND
                am.adulto_mayor_modalidad = '$modalidad'
                and am.fecha_registro >='$fecha_inicio'
                and am.fecha_registro <='$fecha_fin'
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function donacion_entidad($nombre_entidad,$fecha_inicio,$fecha_fin)
        {
                $query=$this->db->query("
                        SELECT
                        nombre_entidad,
                        extract(month from am.fecha) as mes,
                        sum(monto) as monto,
                        count(*) as cantidad_donaciones
                        FROM adulto_mayor_asistencia_economica as am
                        where am.fecha >='$fecha_inicio'
                        and am.fecha <='$fecha_fin'
                        and nombre_entidad like '%$nombre_entidad%'
                        GROUP BY 1,2
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function total_gastado($persona_id)
        {
                $query=$this->db->query("
                select sum(monto*unidad) as total_gastado
                from adulto_mayor_gastos
                where persona_id=$persona_id
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function total_registros($adulto_mayor_cen_acogida,$fecha_inicio,$fecha_fin)
        {
                $query=$this->db->query("
                select count(*) as total
                from adulto_mayor
                where adulto_mayor.adulto_mayor_cen_acogida is not Null
                and adulto_mayor.adulto_mayor_cen_acogida like '%$adulto_mayor_cen_acogida%'
                and adulto_mayor.fecha_registro >='$fecha_inicio'
                and adulto_mayor.fecha_registro <='$fecha_fin'
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function donaciones_fecha()
        {
                $query=$this->db->query("
                select sum(monto),fecha
                from adulto_mayor_asistencia_economica
                group by fecha
                ");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function modalidad()
        {
                $query=$this->db->query("
                select adulto_mayor_modalidad,count(*) AS cantidad
                from adulto_mayor
                group by adulto_mayor_modalidad");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function sexo()
        {
                $query=$this->db->query("
                select persona_sexo
                ,count(*)
                from adulto_mayor
                join persona
                on adulto_mayor.persona_id=persona.persona_id
                group by persona_sexo;");
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function detalle_seguimiento($persona_id)
        {
                $query=$this->db->query("
                select * from informe_seguimiento
                where persona_id=".$persona_id);
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function detalle_informe_social($persona_id)
        {
                $query=$this->db->query("
                select * from informe_social
                where persona_id=".$persona_id);
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function informe_seguimiento($seguimiento_id)
        {
                $query=$this->db->query("
                select * from informe_seguimiento
                where informe_seguimiento_id=".$seguimiento_id);
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function informe_social($social_id)
        {
                $query=$this->db->query("
                select * from informe_social
                where informe_social_id=".$social_id);
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }
        public function grupo_familiar($persona_id)
        {
                $query=$this->db->query("
                select * from grupo_familiar
                where persona_id=".$persona_id);
                if ($query->num_rows() > 0)
                        return $query;
                else
                        return false;
        }

}
?>