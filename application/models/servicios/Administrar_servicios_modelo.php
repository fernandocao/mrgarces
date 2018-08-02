 
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Administrar_servicios_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
    
    function registrarservicio($datos){
        if($datos["id_servicio"]==0){
            $datos["id_servicio"]=null;
            $this->db->insert("servicios", $datos);
            return "registrado";
        }else{
            $this->db->where("id_servicio", $datos["id_servicio"], false);
            $this->db->update("servicios",$datos);
            return "actualizado";
        }
    }
    
    function obtenerservicios(){
        $this->db->select("id_servicio, descripcion, precio, duracion");
        $this->db->from("servicios");
        $this->db->where("activo", 1);
        $query = $this->db->get();
        return $query->result();
    }

    function obtenerservicio($id_servicio){
        $this->db->select("id_servicio, descripcion, precio, duracion");
        $this->db->from("servicios");
        $this->db->where("activo", 1);
        $this->db->where("id_servicio", $id_servicio, false);
        $query = $this->db->get();
        return $query->row();
    }

    function baja($id_servicio){
        $this->db->set("activo", 0);
        $this->db->where('id_servicio', $id_servicio);
        $this->db->update('servicios');
    }
    
    function habilitar($id_servicio){
        $this->db->set("activo", 1);
        $this->db->where('id_servicio', $id_servicio);
        $this->db->update('servicios');
    }
}
