<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Base {
   function insertar_no_repetidos($tabla,$controlador,$filtros){
   	   if(!datos_repetidos($tabla,$controlador,$filtros)){
       echo'<script>alert("Error. !alguien ya ah registrado ese código!")</script>';
       }
       else
       	$controlador->db->insert($tabla,$controlador->input->post());
      }
    function datos_repetidos($strNombreTabla,$controlador,$arrFiltros)
    {
      	$query = $controlador->db->get_where($strNombreTabla,$arrFiltros);
      	if ($query->num_rows() > 0)
      		return true;
      	else
      		return false;
    }
   function buscar_registro($strNombreTabla,$arrFiltros,$CI,$boolResult)
   {
        $query=$CI->db->get_where($strNombreTabla,$arrFiltros);
        if ($query->num_rows() > 0)
            if($boolResult)
                return $query->result();
            else
                return $query;
        else
          return false;
   }
    function buscar_id_persona($strNombreTabla,$arrFiltros,$CI)
    {
        $CI->db->where($arrFiltros);
        $query = $CI->db->get($strNombreTabla);
        if ($query->num_rows() > 0)
                return $query->result()[0]->persona_id;
        else
            return false;
    }
    function eliminar_registro($rtNombreTabla,$arrFiltros,$CI)
    {
        $CI->db->where($arrFiltros);
        $CI->db->delete($rtNombreTabla);
    }
    function form_array($arrForm,$CI)
    {
        $arrTabla=array();
        foreach($arrForm as $value){
            $arrTabla[$value]=$CI->input->post($value);
        }
        return $arrTabla;
    }
    function select_array($nombreTabla,$nombreSelect,$nombreLabel,$dimension,$CI,$blanco,$id)
    {
        if($blanco)
            $dataSelect['arrSelect']=$CI->db->get_where($nombreTabla,array("id"=>"-12"));
        else
            $dataSelect['arrSelect']=$CI->db->get($nombreTabla);
        $dataSelect['nombreSelect']=$nombreSelect;
        $dataSelect['nombreLabel']=$nombreLabel;
        $dataSelect['tamanoSelect']=$dimension;
        $dataSelect['idSelect']=$id;
        return $dataSelect;
    }
    function list_array($listID,$listNombre,$id,$nombreID,$nombreTabla,$CI)
    {
        if(isset($listID))
        {
            foreach ($listID as $value)
            {
                $datos=array(
                    $listNombre=>$value,
                    $nombreID=>$id
                );
                $CI->db->insert($nombreTabla,$datos);
            }
        }
    }
    function update_array($strNombreTabla,$arrayDatos,$arrFiltros,$CI)
    {
        $CI->db->where($arrFiltros);
        $CI->db->update($strNombreTabla, $arrayDatos);
    }
 }
?>