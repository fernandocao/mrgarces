  
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Punto_venta_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function realizarventa($datos){
		if($datos["id_venta"]==0){
	        $dato = $this->session->userdata('logged_in');	        
			$datosventa = array(
				"id_cliente" => $datos["id_cliente"],
				"id_empleado" => $datos["barbero"],
				"descuento" => $datos["descuento"],
				"subtotal" => $datos["gsubtotal"],
				"total" => $datos["gtotal"],
				"observaciones" => $datos["observaciones"]
			);
			$this->db->insert("ventas", $datosventa);		
			$id_venta= $this->db->insert_id();

			foreach ($datos['ids'] as $indice => $valor) {
                //log_message("debug", $datos['tipos'][$indice]);
                $datosarticulo = array(
                    'id_venta' => $id_venta,
                    'id_articulo' => $valor,
                    'tipo' => $datos['tipos'][$indice],
                    'cantidad' => $datos['cantidades'][$indice],
                    'precio' => $datos['precios'][$indice]
                );
                $this->db->insert('venta_articulos', $datosarticulo);                
                if($datos['tipos'][$indice] == 'a'){
                	$this->db->set('existencia','existencia-'.$datos['cantidades'][$indice],false);
                	$this->db->where('id_producto',$valor,false);
                	$this->db->update('productos');
                	//log_message("error",$this->db->last_query());
                }
                if($datos['tipos'][$indice] == 'p'){
                	$this->db->set('vendido',1);
                	$this->db->where('id_promo',$valor,false);
                	$this->db->update('promociones');                	
                }
            }

		}else{

		}
		return 0;
	}

	function obtenerservicios($id_cliente){
		$this->db->select('count(ventas.id_cliente) as cuantos');
		$this->db->from('ventas');
		$this->db->join('venta_articulos','venta_articulos.id_venta = ventas.id_venta');
		$this->db->where('ventas.id_cliente', $id_cliente, false);
		$this->db->group_by('ventas.id_cliente');
		$query = $this->db->get();
		$row = $query->row();
		return $row->cuantos;
	}

	function mostrarhistorial($id_cliente){
		$this->db->select('*');
		$this->db->from('ventas');
		$this->db->join('venta_articulos','venta_articulos.id_venta = ventas.id_venta and venta_articulos.tipo="s"');
		$this->db->join('servicios','servicios.id_servicio = venta_articulos.id_articulo');
		$this->db->where('ventas.id_cliente', $id_cliente, false);
		//$this->db->group_by('ventas.id_cliente');
		$this->db->order_by('ventas.id_venta','desc');
		$this->db->limit(6);
		$query = $this->db->get();
		//log_message("debug", $this->db->last_query());
		return $query->result();
	}

}