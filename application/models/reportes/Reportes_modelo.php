 
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function reporteventas($tipo){
		$this->db->from("ventas");
		$this->db->join("venta_articulos","venta_articulos.id_venta = ventas.id_venta");
		$query = $this->db->get();
		return $query->result();
	}
}