<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Administrar_productos_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
    
    function registrarproductos($producto)

    {
        
        /*Registro tb_producto*/
        
        //log_message('debug', print_r($producto['noserie']));
        
        $datosproducto=array(            
            "id_producto" => $producto["id_producto"],
            "id_proveedor" => $producto["id_proveedor"],
            "sucursal" => $producto["sucursal"],
            "descripcion" => $producto["descripcion"],
            "categoria" => $producto["categoria"],
            "marca" => $producto["marca"],
            "modelo" => $producto["modelo"],
            "unidad_medida" => $producto["unidad_medida"],
            "existencia" => $producto["existencia"],
            "costo_unitario" => $producto["costo_unitario"],
            "precio_venta" => $producto["precio_venta"],
            "stock" => $producto["stock"],
            "codigo_interno" => $producto["codigo_interno"],
        );
        
        
        if($datosproducto['id_producto'] == 0){
            $this->db->insert('productos', $datosproducto);
            $id_producto = $this->db->insert_id();
        }else{
            $this->db->where('id_producto', $datosproducto['id_producto']);
            $this->db->update('productos', $datosproducto);                        
            $id_producto = $datosproducto['id_producto'];
        }
        
        /*if(isset($producto["noserie"])){
	        foreach ($producto["noserie"] as $key => $value) {
		        $datosproducto=array(
		            "noserie" => $value,
		            "id_producto" => $id_producto
		        );
	        
		        $this->db->insert('productos_noserie',$datosproducto);
		        $id_noserie = $this->db->insert_id();
                
	    	}
        }*/
                        
        if(isset($_FILES['btn_foto'])){            
            $file = $_FILES['btn_foto'];
            $name = $file['name'];           
            $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/foto_productos/".$id_producto.'.jpg' ;
            if(file_exists($path)) {
                chmod($path,0755); 
                unlink($path); 
            }            
            if (move_uploaded_file($file['tmp_name'], $path)) {
                $resp=array("mensaje"=>"Fotografía almacenada con exito.");
            }else{
                $resp=array("mensaje"=>"No fue posible guardar la fotografía.");
            }
        }
        
    }
    
    function obtenerproductos($tipo){
        $this->db->select("productos.id_producto,productos.sucursal,productos.categoria,productos.marca,productos.descripcion,productos.existencia,productos.id_proveedor,productos.precio_venta, proveedores.nombre_comercial");
        $this->db->from("productos");    
        $this->db->join("proveedores","proveedores.id_proveedor = productos.id_proveedor");                
        if( $tipo!= 2 ) $this->db->where("productos.activo", $tipo, false);
        $query = $this->db->get();
        return $query->result();                
    }
   
    function perfil_producto($id_producto){
        $this->db->select("productos.id_producto,productos.sucursal,productos.descripcion,productos.categoria,productos.marca,productos.modelo,productos.unidad_medida,productos.existencia,productos.costo_unitario,productos.precio_venta,productos.stock,productos.codigo_interno, proveedores.nombre_comercial");
        $this->db->from("productos");        
        $this->db->join("proveedores","proveedores.id_proveedor = productos.id_proveedor");
        $this->db->where("id_producto", $id_producto);
        $query = $this->db->get();
        return $query->result();        
        
    }
    
    function baja_producto($id_producto){
        $this->db->set("activo", 0);        
        $this->db->where("id_producto", $id_producto);    
        $this->db->update("productos");
    }
    
    function habilitar_producto($id_producto){
        $this->db->set("activo", 1);        
        $this->db->where("id_producto", $id_producto);    
        $this->db->update("productos");
    }
    
    function llenarformulario($id_producto){
        $this->db->select("productos.id_producto,productos.sucursal,productos.descripcion,productos.categoria,productos.marca,productos.modelo,productos.unidad_medida,productos.existencia,productos.costo_unitario,productos.precio_venta,productos.stock,productos.codigo_interno, productos.id_proveedor");
        $this->db->from("productos");                
        $this->db->where("id_producto", $id_producto);
        $query = $this->db->get();
        return $query->result();        
        
    }
    
    function llenarcategoria($tipo_producto){
        $this->db->select("distinct(categoria)");        
        $this->db->from("productos");
        //$this->db->like("categoria", $tipo_producto);
        $query = $this->db->get();
        log_message("debug",$this->db->last_query());
        return $query->result();
    }

    function llenarproveedor(){
        $this->db->select("id_proveedor, nombre_comercial");        
        $this->db->from("proveedores");
        //$this->db->like("categoria", $tipo_producto);
        $query = $this->db->get();
        #log_message("debug",$this->db->last_query());
        return $query->result();
    }
        
}
