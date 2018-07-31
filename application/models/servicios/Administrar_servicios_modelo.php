
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Administrar_servicios_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
    
    function registrarservicio($detalle){
        
        $this->db->truncate('paqueteservicios');
        
    }
    
    function listaServicio(){
        $this->db->select("id_servicio, descripcion, precio, duracion");
        $this->db->from("servicios");
        $this->db->where("activo", 1);
        $query = $this->db->get();
        return $query->result();
    }
    
    function llenarServicio($id_servicio){
        $this->db->select('id_servicio, descripcion, precio, duracion');
        $this->db->from('servicios');
        $this->db->where('id_servicio', $id_servicio);
        $query = $this->db->get();
        return $query->result();
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
    
    function baja_lista(){
        $this->db->select("id_servicio, descripcion");
        $this->db->from("servicios");
        $this->db->where("activo", 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    function llenar(){
        $this->db->select('id_servicio, descripcion');
        $this->db->from('servicios');
        $query = $this->db->get();
        return $query->result();
    }
    
    function obtenerservicio($id_servicio){
        $this->db->select('*');
        $this->db->from('servicios');
        $this->db->where('id_servicio', $id_servicio);
        $query = $this->db->get();
        $resultado = $query->row();
        return $resultado;
    }
    
    function registrarpaquete($datos){
        
        $nombrepaquete = array(                        
            "id_paquete" => $datos["id_paquete"],
            "descripcion" => $datos["descripcion"],
            "precio" => $datos["precio"]
        );
            
        if($nombrepaquete["id_paquete"] == 0){
            $this->db->insert('paquetes', $nombrepaquete);
            $id_paquete = $this->db->insert_id();

            foreach($datos["id"] as $key => $value){
                $nombrepaquete=array(
                    "id_paquete" => $id_paquete                
                );

                $nombrepaquete['id_servicio'] = $datos['id'][$key];
                $this->db->insert('paqueteservicios', $nombrepaquete);
                $id_paqueteservicio = $this->db->insert_id();
            }
        }else{
            $this->db->where('id_paquete', $nombrepaquete["id_paquete"]);
            $this->db->update('paquetes', $nombrepaquete);
            $id_paquete = $nombrepaquete["id_paquete"];
            
            foreach($datos["id"] as $key => $value){
                $nombrepaquete = array(                    
                    "id_paquete" => $id_paquete
                );
                $nombrepaquete["id_paquete"] = $datos['id'][$key];
                $this->db->update('paqueteservicios', $nombrepaquete);
                $id_paqueteservicio = $this->db->insert_id();
            }
        }
    }
    
    function paquetes(){
        $this->db->select("paquetes.id_paquete, paquetes.descripcion, paquetes.precio, GROUP_CONCAT(servicios.descripcion) AS servicios");
        $this->db->from("paquetes");     
        $this->db->join("paqueteservicios","paqueteservicios.id_paquete = paquetes.id_paquete");
        $this->db->join("servicios", "paqueteservicios.id_servicio = servicios.id_servicio");   
        $this->db->group_by("paquetes.id_paquete");
        $query = $this->db->get();
        return $query->result();
    }

    function ver_paquete($id_paquete)

    {
        $this->db->select("paquetes.id_paquete, paquetes.descripcion, paquetes.precio, servicios.id_servicio ,servicios.descripcion as nombreservicio");
        $this->db->from("paquetes");
        $this->db->where('paquetes.id_paquete', $id_paquete);        
        $this->db->join("paqueteservicios","paqueteservicios.id_paquete = paquetes.id_paquete");
        $this->db->join("servicios", "paqueteservicios.id_servicio = servicios.id_servicio");   
        //$this->db->group_by("paquetes.id_paquete");

        $query = $this->db->get();
        log_message('error', $this->db->last_query());
        return $query->result();
    }
        
}
