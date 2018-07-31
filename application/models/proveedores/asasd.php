<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Administar_proveedores_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function registrarproveedor($datos)
	{
		//Registro de la direccion del proveedor en la tabla de direcciones
		$datosregistro=array(
			"calle" => $datos["calle"],
			"numero_interior" => $datos["numero_interior"],
			"colonia" => $datos["colonia"],
			"ciudad" => $datos["ciudad"],
			"estado" => $datos["estado"],
		);
		$this->db->insert('direcciones',$datosregistro);
		log_message("debug",$this->db->last_query());
		$id_direccion = $this->db->insert_id();

		//registro del empleado o cliente en tabla persona
		$datosregistro=array(
			"nombre_comercial" => $datos["nombre_comercial"],
			"rfc" => $datos["rfc"],
            "id_direccion" => $id_direccion,
			"pagina_web" => $datos["pagina_web"],
			"maneja_credito" => $datos["maneja_credito"],
			"nombre_contacto" => $datos["nombre_contacto"],
			"telefono_contacto" => $datos["telefono_contacto"],
            "correo_contacto" => $datos["correo_contacto"],
		);
		$this->db->insert('proveedores',$datosregistro);
		log_message("debug",$this->db->last_query());
		}
		return array("respuesta"=>"ok");
	}
