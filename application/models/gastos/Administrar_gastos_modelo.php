<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_gastos_modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //Función para registrar y acttualizar datos
    function registrargasto($datos){
        $datosgasto = array(
            "id_tipogasto" => 1,
            "monto" => $datos["monto"],
            "tipopago" => 0
        );
        $this->db->insert("gastos", $datosgasto);
        $id_gasto = $this->db->insert_id();

        $datoscomision = array(
            "id_barbero" => $datos["id_barbero"],
            "id_gasto" => $id_gasto
        );
        $this->db->insert("comisiones", $datoscomision);
    }
}
