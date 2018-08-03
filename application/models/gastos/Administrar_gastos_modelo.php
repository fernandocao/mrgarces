<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_gastos_modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //Función para registrar y acttualizar datos
    function registrargasto($datos){
    $id_tipogasto = $datos['id_tipogasto'];
    if($datos['id_gasto'] != 0){
        $nuevosdatos = array (
            'fecha' => $datos['fecha'],
            'tipopago' => $datos['tipopago'],
            'monto' => $datos['monto'],
            'observaciones' => $datos['observaciones']
        );
        
        $this->db->where('id_gasto',$datos['id_gasto']);
        $this->db->update('gastos',$nuevosdatos);

    }else{
        

        if ($datos['id_tipogasto'] == 0){
            $concepto = array (
                'concepto' => $datos['gastostipo']
            );
            $this->db->insert('gastostipo', $concepto);
            $id_tipogasto = $this->db->insert_id();
        }
    

        $datosgasto = array(
            "id_tipogasto" => $id_tipogasto,
            "monto" => $datos["monto"],
            "tipopago" => $datos["tipopago"]
        );
        if( isset($datos["observaciones"])) $datosgasto["observaciones"] = $datos['observaciones'];
        if( isset($datos["fecha"])) $datosgasto["fecha"] = $datos["fecha"];

        $this->db->insert("gastos", $datosgasto);
        //log_message("debug",$this->db->last_query());
        }
        $id_gasto = $this->db->insert_id();

        if( isset($datos["id_barbero"]) ){
            if( $datos["id_barbero"] > 0 ){
                $datoscomision = array(
                    "id_barbero" => $datos["id_barbero"],
                    "id_gasto" => $id_gasto
                );
                $this->db->insert("comisiones", $datoscomision);
                //log_message("debug",$this->db->last_query());
            }
        }
    }

    function obtenergastos($activo){
        $this->db->select('gastos.id_gasto, gastostipo.concepto, date(gastos.fecha) as fecha, gastos.monto, gastos.tipopago, gastos.observaciones,gastos.activo');
        $this->db->from('gastos');
        $this->db->join('gastostipo', 'gastos.id_tipogasto = gastostipo.id_tipogasto');
         if($activo!=2) $this->db->where("gastos.activo", $activo, false);
        $query=$this->db->get();
        return $query->result();
    }

    function eliminargasto($id_gasto){
            $this->db->set("activo",0);
            $this->db->where("id_gasto",$id_gasto);
            $this->db->update("gastos");
            return ;
    }

    function habilitargasto($id_gasto){
            $this->db->set("activo",1);
            $this->db->where("id_gasto",$id_gasto);
            $this->db->update("gastos");
            return ;
    }

    function llenarformularioactualizar($id_gasto){
        $this->db->select("gastos.id_gasto, gastostipo.concepto, gastostipo.id_tipogasto, date(gastos.fecha) as fecha, gastos.monto, gastos.tipopago, gastos.observaciones");
        $this->db->from("gastos");
        $this->db->join("gastostipo", "gastostipo.id_tipogasto = gastos.id_tipogasto");
        $this->db->where('gastos.id_gasto', $id_gasto);
        $query=$this->db->get();
        $resultado=$query->row();
        return $resultado;
        }
}
