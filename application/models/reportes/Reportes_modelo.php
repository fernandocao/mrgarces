 
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function reporteventas($datos){
		$this->db->select("ventas.id_venta, venta_articulos.id_articulo, ventas.fecha, ventas.articulos_vendidos, subtotal, total, observaciones, venta_articulos.cantidad, venta_articulos.precio_compra, venta_articulos.precio, productos.descripcion as producto, servicios.descripcion as servicio, promociones.descripcion as promocion, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ',persona.apellido_materno) as cliente");		
		$this->db->from("ventas");
		$this->db->join("persona","persona.id_persona = ventas.id_cliente");
		$this->db->join("venta_articulos","venta_articulos.id_venta = ventas.id_venta");
		$this->db->join("productos","productos.id_producto = venta_articulos.id_articulo","left");		
		$this->db->join("servicios","servicios.id_servicio = venta_articulos.id_articulo","left");		
		$this->db->join("promociones","promociones.id_promo = venta_articulos.id_articulo","left");		
		if( $datos["rango"] == 1 ) $this->db->where("ventas.fecha",$datos["fechainicio"]);
		else
			if( $datos["rango"] == 2) $this->db->where("WEEK(ventas.fecha)=WEEK('".$datos["fechafin"]."')");
			else 
				if( $datos["rango"] == 3) $this->db->where("MONTH(ventas.fecha)=MONTH('".$datos["fechafin"]."')");
				else if( $datos["rango"] == 4) $this->db->where("YEAR(ventas.fecha)=YEAR('".$datos["fechafin"]."')");
					else
						if( $datos["rango"]==6 ){
							$this->db->where("ventas.fecha>=",$datos["fechainicio"]);
							$this->db->where("ventas.fecha<=",$datos["fechafin"]);
						}
		$this->db->order_by("venta_articulos.id_venta");
		$query = $this->db->get();
		log_message("debug", $this->db->last_query());
		return $query->result();
	}
}