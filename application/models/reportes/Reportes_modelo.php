 
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function reportes($datos){
		switch ( $datos["tipo"] ){
			case 1:
				return $this->reporteventas($datos);
				break;
			case 2:
				return $this->reportecomisiones($datos);
				break;
			case 3:
				return $this->reportegastos($datos);
				break;
			case 4:
				return $this->reporteinventarios($datos);
				break;

		}
	}

	function reporteventas($datos){
		$this->db->select("ventas.id_venta, venta_articulos.id_articulo, ventas.fecha, ventas.articulos_vendidos, subtotal, total, observaciones, venta_articulos.cantidad, venta_articulos.precio_compra, venta_articulos.precio, productos.descripcion as producto, servicios.descripcion as servicio, promociones.descripcion as promocion, CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ',persona.apellido_materno) as cliente");		
		$this->db->from("ventas");
		$this->db->join("persona","persona.id_persona = ventas.id_cliente");
		$this->db->join("venta_articulos","venta_articulos.id_venta = ventas.id_venta");
		$this->db->join("productos","productos.id_producto = venta_articulos.id_articulo","left");		
		$this->db->join("servicios","servicios.id_servicio = venta_articulos.id_articulo","left");		
		$this->db->join("promociones","promociones.id_promo = venta_articulos.id_articulo","left");		
		if( $datos["rango"] == 1 ) $this->db->where("DATE(ventas.fecha)=CURDATE()");
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
		//log_message("debug", $this->db->last_query());
		return $query->result();		
	} 

	function reportecomisiones($datos){
		$this->db->select("comisiones.id_comision, concat(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as barbero, gastos.fecha, gastos.monto, gastos.observaciones");		
		$this->db->from("comisiones");
		$this->db->join("persona","persona.id_persona = comisiones.id_barbero");
		$this->db->join("gastos","gastos.id_gasto = comisiones.id_gasto");
		if( $datos["rango"] == 1 ) $this->db->where("DATE(gastos.fecha)=CURDATE()");
		else
			if( $datos["rango"] == 2) $this->db->where("WEEK(gastos.fecha)=WEEK('".$datos["fechafin"]."')");
			else 
				if( $datos["rango"] == 3) $this->db->where("MONTH(gastos.fecha)=MONTH('".$datos["fechafin"]."')");
				else if( $datos["rango"] == 4) $this->db->where("YEAR(gastos.fecha)=YEAR('".$datos["fechafin"]."')");
					else
						if( $datos["rango"]==6 ){
							$this->db->where("gastos.fecha>=",$datos["fechainicio"]);
							$this->db->where("gastos.fecha<=",$datos["fechafin"]);
						}
		$this->db->order_by("comisiones.id_comision");
		$query = $this->db->get();
		//log_message("debug", $this->db->last_query());
		return $query->result();		
	}

	function reportegastos($datos){
		$this->db->select("gastos.id_gasto, gastostipo.concepto, gastos.fecha, gastos.monto, gastos.observaciones");		
		$this->db->from("gastos");
		$this->db->join("gastostipo","gastostipo.id_tipogasto = gastos.id_tipogasto");
		if( $datos["rango"] == 1 ) $this->db->where("DATE(gastos.fecha)=CURDATE()");
		else
			if( $datos["rango"] == 2) $this->db->where("WEEK(gastos.fecha)=WEEK('".$datos["fechafin"]."')");
			else 
				if( $datos["rango"] == 3) $this->db->where("MONTH(gastos.fecha)=MONTH('".$datos["fechafin"]."')");
				else if( $datos["rango"] == 4) $this->db->where("YEAR(gastos.fecha)=YEAR('".$datos["fechafin"]."')");
					else
						if( $datos["rango"]==6 ){
							$this->db->where("gastos.fecha>=",$datos["fechainicio"]);
							$this->db->where("gastos.fecha<=",$datos["fechafin"]);
						}
		$this->db->order_by("gastos.id_gasto");
		$query = $this->db->get();
		//log_message("debug", $this->db->last_query());
		return $query->result();		
	}	

	function reporteinventarios($datos){
		//$this->db->select("gastos.id_gasto, gastostipo.concepto, gastos.fecha, gastos.monto, gastos.observaciones");		
		$this->db->from("productos");
		//$this->db->join("gastostipo","gastostipo.id_tipogasto = gastos.id_tipogasto");
		/*
		if( $datos["rango"] == 1 ) $this->db->where("DATE(gastos.fecha)=CURDATE()");
		else
			if( $datos["rango"] == 2) $this->db->where("WEEK(gastos.fecha)=WEEK('".$datos["fechafin"]."')");
			else 
				if( $datos["rango"] == 3) $this->db->where("MONTH(gastos.fecha)=MONTH('".$datos["fechafin"]."')");
				else if( $datos["rango"] == 4) $this->db->where("YEAR(gastos.fecha)=YEAR('".$datos["fechafin"]."')");
					else
						if( $datos["rango"]==6 ){
							$this->db->where("gastos.fecha>=",$datos["fechainicio"]);
							$this->db->where("gastos.fecha<=",$datos["fechafin"]);
						}
		*/
		$this->db->where("activo",1);
		$this->db->order_by("productos.descripcion");
		$query = $this->db->get();
		//log_message("debug", $this->db->last_query());
		return $query->result();
	}

}