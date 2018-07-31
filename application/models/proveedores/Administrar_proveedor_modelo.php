<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_proveedor_modelo extends CI_Model {

        public function __construct() {
            parent::__construct();
        }
        
        //Función para registrar y acttualizar datos
        function registrarproveedor($datos){
            //Arreglo de los datos de direccion
            $datosregistrodirecciones=array(
                "calle" => $datos["calle"],
                "numero" => $datos["numero"],
                "numero_interior" => $datos["numero_interior"],
                "colonia" => $datos["colonia"],
                "ciudad" => $datos["ciudad"],
                "estado" => $datos["estado"],
            );
            
            //Arreglo de datos del proveedor
            $datosregistroproveedor=array(
                "nombre_comercial" => $datos["nombre_comercial"],
                "rfc" => $datos["rfc"],                    
                "telefono" => $datos["telefono"],
                "pagina_web" => $datos["pagina_web"],
                "maneja_credito" => $datos["maneja_credito"],
                "correo" => $datos["correo"],
                "nombre_contacto" => $datos["nombre_contacto"],
                "telefono_contacto" => $datos["telefono_contacto"],
                "correo_contacto" => $datos["correo_contacto"],
            );

            if($datos["id_proveedor"]==0){
                //Registro de la direccion del proveedor en la tabla de direcciones
                $this->db->insert('direcciones',$datosregistrodirecciones);
                log_message("debug",$this->db->last_query());
                $id_direccion = $this->db->insert_id();
                $datosregistroproveedor["id_direccion"] = $id_direccion;   
                //registro del proveedor en tabla proveedores
                $this->db->insert('proveedores',$datosregistroproveedor);
                log_message("debug",$this->db->last_query());
                return array("respuesta"=>0);
            }else{
                    $this->db->where('id_direccion',$datos['id_direccion']);
                    $this->db->update('direcciones',$datosregistrodirecciones);
                    $this->db->where('id_proveedor',$datos['id_proveedor']);
                    $this->db->update('proveedores',$datosregistroproveedor);    
                    return array("respuesta"=>1);
                }
        }

        //Funcion para generar las tarjetas
        function obtenerproveedor($activo){
            log_message('error',$activo);
            $this->db->select("id_proveedor, activo,rfc, nombre_comercial, CONCAT(calle,' ', direcciones.numero,' ',direcciones.numero_interior,' ',direcciones.colonia,' ',direcciones.ciudad,' ', direcciones.estado) as direccion, telefono, pagina_web, maneja_credito,correo, nombre_contacto,telefono_contacto, correo_contacto");
            $this->db->from("proveedores");
            $this->db->join("direcciones", "proveedores.id_direccion = direcciones.id_direccion");
            if($activo!=2) $this->db->where("proveedores.activo", $activo, false);
            $query=$this->db->get();
            return $query->result();
        }

        //Funcion para las tarjetas del perfil
        function obtenerperfilproveedor($id_proveedor){
            $this->db->select("id_proveedor, rfc, nombre_comercial, CONCAT(calle,' ', direcciones.numero,' ',direcciones.numero_interior,' ',direcciones.colonia,' ',direcciones.ciudad,' ', direcciones.estado) as direccion, telefono, pagina_web, maneja_credito,correo, nombre_contacto,telefono_contacto, correo_contacto");
            $this->db->from("proveedores");
            $this->db->join("direcciones", "proveedores.id_direccion = direcciones.id_direccion");
            $this->db->where('proveedores.id_proveedor', $id_proveedor);
            $query=$this->db->get();
            return $query->result();
        }

        //Funcion para llenar el formulario de actualizar
        function llenarformularioactualizar($id_proveedor){
            $this->db->select("id_proveedor, proveedores.id_direccion, rfc, nombre_comercial, direcciones.calle , direcciones.numero, direcciones.numero_interior, direcciones.colonia, direcciones.ciudad, direcciones.estado, telefono, pagina_web, maneja_credito,correo, nombre_contacto,telefono_contacto, correo_contacto");
            $this->db->from("proveedores");
            $this->db->join("direcciones", "proveedores.id_direccion = direcciones.id_direccion");
            $this->db->where('proveedores.id_proveedor', $id_proveedor);
            $query=$this->db->get();
            $resultado=$query->row();
            return $resultado;
        }
        
        //Funcion para dar de baja un proveedor
        function eliminarproveedor($id_proveedor){
            $this->db->set("activo",0);
            $this->db->where("id_proveedor",$id_proveedor);
            $this->db->update("proveedores");
            return ;
        }

        //Funcion para habilitar a un proveedor
        function habilitarproveedor($id_proveedor){
            $this->db->set("activo",1);
            $this->db->where("id_proveedor",$id_proveedor);
            $this->db->update("proveedores");
            return ;
        }
        
	}
