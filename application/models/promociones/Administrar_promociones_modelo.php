
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_promociones_modelo extends CI_Model {

        public function __construct() {
            parent::__construct();
        }
        
        //Función para registrar y acttualizar datos
        function registrarpromocion($datos){
           $datospromocion = array(
                'descripcion' => $datos['descripcion'],
                'precio_promo' => $datos['precio_promo'],
                'fecha_inicio' => $datos['fecha_inicio'],
                'fecha_fin' => $datos['fecha_fin']
            );
           if($datos['id_promo'] == 0){
            
            $this->db->insert('promociones', $datospromocion);            
            $id_promocion = $this->db->insert_id();
           }else{
                $this->db->where('id_promo', $datos['id_promo']);
                $this->db->update('promociones', $datospromocion);
                $id_promocion = $datos['id_promo']; 
                $this->db->where('id_promo', $datos['id_promo']);
                $this->db->delete('servicios_promo');
                $this->db->where('id_promo', $datos['id_promo']);
                $this->db->delete('productos_promo');
           }
            
                
            foreach ($datos['tipo'] as $key => $value) {
                //log_message('debug',$key);
                $datospromocion = array(
                    'id_promo' => $id_promocion,
                    'cantidad' => $datos['cantidad'][$key],
                    'precio' => $datos['precio'][$key],
                    
                );

                if($value == "s"){
                    $datospromocion['id_servicio'] = $datos['id'][$key];
                    $this->db->insert('servicios_promo', $datospromocion);
                }else{
                    $datospromocion['id_producto'] = $datos['id'][$key];
                    $this->db->insert('productos_promo', $datospromocion);
                }
            }
                
        }


        function obtenerpromociones(){
            $this->db->select("promociones.id_promo, promociones.activo, promociones.vendido, promociones.descripcion,promociones.precio_promo, GROUP_CONCAT(CONCAT(servicios_promo.cantidad,' '), servicios.descripcion SEPARATOR ', ') as servicios, GROUP_CONCAT(CONCAT(productos_promo.cantidad,' '),productos.descripcion SEPARATOR ', ') as productos,  promociones.fecha_inicio, promociones.fecha_fin");
            /*sum(servicios_promo.precio) as precio_promo,*/
            $this->db->from("promociones");
            $this->db->join("servicios_promo", "promociones.id_promo = servicios_promo.id_promo", 'left');
            $this->db->join("servicios", "servicios.id_servicio = servicios_promo.id_servicio", 'left');
            $this->db->join("productos_promo", "promociones.id_promo = productos_promo.id_promo", 'left');
            $this->db->join("productos", "productos_promo.id_producto = productos.id_producto", 'left');
            //$this->db->where('productos_promo.id_promo is not null');
            //$this->db->where('servicios_promo.id_promo is not null');
            $this->db->where('promociones.fecha_fin >=', date('Y-m-d'));
            $this->db->where('promociones.activo', 1, false);
            $this->db->group_by('promociones.id_promo');
            $query=$this->db->get();
            log_message('error', $this->db->last_query());
            return $query->result();
        }

        function obtenerpromocionesvencidas(){
            $this->db->select("promociones.id_promo, promociones.descripcion,promociones.precio_promo, GROUP_CONCAT(servicios.descripcion SEPARATOR ', ') as servicios, GROUP_CONCAT(productos.descripcion SEPARATOR ', ') as productos,  promociones.fecha_inicio, promociones.fecha_fin");
            /*sum(servicios_promo.precio) as precio_promo,*/
            $this->db->from("promociones");
            $this->db->join("servicios_promo", "promociones.id_promo = servicios_promo.id_promo", 'left');
            $this->db->join("servicios", "servicios.id_servicio = servicios_promo.id_servicio", 'left');
            $this->db->join("productos_promo", "promociones.id_promo = productos_promo.id_promo", 'left');
            $this->db->join("productos", "productos_promo.id_producto = productos.id_producto", 'left');
            //$this->db->where('productos_promo.id_promo is not null');
            //$this->db->where('servicios_promo.id_promo is not null');
            $this->db->group_by('promociones.id_promo');
            $query=$this->db->get();
            log_message('error', $this->db->last_query());
            return $query->result();
   }

//Funcion para llenar el formulario  de actualizar
function llenarformularioactualizarservicios($id_promo){
    $this->db->select('promociones.id_promo, servicios_promo.id_promo, promociones.descripcion as descripcion_promo, promociones.fecha_inicio, promociones.fecha_fin, 0 as costo_unitario, servicios_promo.id_servicio, servicios_promo.cantidad, servicios_promo.precio, servicios.descripcion');
    $this->db->from('promociones');
    $this->db->join('servicios_promo','servicios_promo.id_promo ='.$id_promo);
    $this->db->join('servicios', 'servicios.id_servicio = servicios_promo.id_servicio');
    $this->db->where('promociones.id_promo', $id_promo);
    $query=$this->db->get();
    return $query->result();
}

function llenarformularioactualizarproductos($id_promo){
    $this->db->select('*');
    $this->db->from('promociones');
    $this->db->join('productos_promo','promociones.id_promo = productos_promo.id_promo');
    $this->db->join('productos', 'productos.id_producto = productos_promo.id_producto' );
      $this->db->where('promociones.id_promo', $id_promo);
    $query=$this->db->get();
    return $query->result();
}
        

//Obtener los datos del servicio
function obtenerservicio($id_servicio){
    $this->db->select("id_servicio, descripcion, precio,0 as costo_unitario");
    $this->db->from("servicios");
    $this->db->where('id_servicio', $id_servicio);
    $query=$this->db->get();
    $resultado=$query->row();
    return $resultado;
}
//Obtener los datos del producto
function obtenerproducto($id_producto){
    $this->db->select("id_producto, descripcion, precio_venta as precio, costo_unitario");
    $this->db->from("productos");
    $this->db->where('id_producto', $id_producto);
    $query=$this->db->get();
    $resultado=$query->row();
    return $resultado;
    }
  

function eliminarpromocion($id_promo){
    $this->db->set("activo",0);
    $this->db->where("id_promo",$id_promo);
    $this->db->update("promociones");
}
}