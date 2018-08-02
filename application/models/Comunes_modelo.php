
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Comunes_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	function autocompletar($cadena, $tabla, $campo)	{
		$this->db->select('DISTINCT('.$campo.')');
		$this->db->from($tabla);
		$this->db->like($campo,$cadena);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row[$campo];
                $new_row['value'] = $row[$campo];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
	}

    function autocompletargastos($cadena) {
        $this->db->select('id_tipogasto, concepto');
        $this->db->from("gastostipo");
        $this->db->like("concepto",$cadena);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id_tipogasto"];
                $new_row['value'] = $row["concepto"];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
    }

    function autocompletararticulos($cadena){
        $this->db->select('id_producto as id, descripcion, precio_venta as precio,existencia, "a" as tipo, costo_unitario');
        $this->db->from('productos');
        $this->db->like('descripcion',$cadena);
        $this->db->where("activo",1,false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id"];
                $new_row['value'] = $row["descripcion"];
                $new_row['precio'] = $row["precio"];
                $new_row['costo_unitario'] = $row["costo_unitario"];
                $new_row['existencia'] = $row["existencia"];
                $new_row['tipo'] = $row["tipo"];
                $row_set[] = $new_row;
            }
        }

        $this->db->select('id_servicio as id, descripcion, precio, 0 as existencia, "s" as tipo, 0 as costo_unitario');
        $this->db->from('servicios');
        $this->db->like('descripcion',$cadena);
        $this->db->where("activo", 1, false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id"];
                $new_row['value'] = $row["descripcion"];
                $new_row['precio'] = $row["precio"];
                $new_row['costo_unitario'] = $row["costo_unitario"];
                $new_row['existencia'] = $row["existencia"];
                $new_row['tipo'] = $row["tipo"];
                $row_set[] = $new_row;
            }
        }

        $this->db->select('id_promo as id, descripcion, precio_promo as precio, 0 as existencia, "p" as tipo');
        $this->db->from('promociones');
        $this->db->like('descripcion',$cadena);
        $this->db->where("activo", 1, false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id"];
                $new_row['value'] = $row["descripcion"];
                $new_row['precio'] = $row["precio"];
                $new_row['existencia'] = $row["existencia"];
                $new_row['tipo'] = $row["tipo"];
                $row_set[] = $new_row;
            }
        }
        return $row_set;
    }

	function autocompletarclientes($cadena){
		$this->db->select('id_persona,CONCAT(nombre," ", apellido_paterno," ",apellido_materno) as nombre, correo');
		$this->db->from('persona');
		$this->db->like('CONCAT(nombre," ", apellido_paterno," ",apellido_materno)',$cadena);
		$this->db->where("tipo",5,false);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id_persona"];
                $new_row['value'] = $row["nombre"];
                $new_row['correo'] = $row["correo"];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
	}

	function autocompletarbarberos($cadena)
	{
		$this->db->select('id_persona,CONCAT(nombre," ", apellido_paterno," ",apellido_materno) as nombre, correo');
		$this->db->from('persona');
		$this->db->like('CONCAT(nombre," ", apellido_paterno," ",apellido_materno)',$cadena);
		$this->db->where("tipo",2,false);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id_persona"];
                $new_row['value'] = $row["nombre"];
                $new_row['correo'] = $row["correo"];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
	}

	function autocompletarservicio($descripcion)
	{
		$this->db->select('*');
		$this->db->from('servicios');
		$this->db->like('descripcion',$descripcion);
		$this->db->where('activo', 1);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id_servicio"];
                $new_row['value'] = $row["descripcion"];
                $new_row['precio'] = $row["precio"];
                $new_row['duracion'] = $row["duracion"];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
	}

	function autocompletarproducto($descripcion)
	{
		$this->db->select('*');
		$this->db->from('productos');
		$this->db->like('descripcion',$descripcion);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['id'] = $row["id_producto"];
                $new_row['value'] = $row["descripcion"];
                $row_set[] = $new_row;
            }
            return $row_set;
        }
	}

    function obtenerpersonal($tipo, $activo){                
        log_message("debug", "Activo ".$activo);
        $this->db->from("persona");
        if($tipo==5){ //cliente
            $this->db->select("persona.id_persona, CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) as nombre, facebook, instagram, telefono, correo, persona.tipo");
            $this->db->where("tipo",$tipo,false);
//            $this->db->where("activo", 1,false);
        }else{ //1.-usuario sistema 2.-barbero 3.-empleado 4.-contacto 5.-Cliente
            $this->db->select("persona.id_persona, CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) as nombre, tipo_de_sangre, indicaciones_medicas, GROUP_CONCAT(descripcion_habilidad) as habilidades, persona.tipo");
            $this->db->join("barbero_perfil", "barbero_perfil.id_persona = persona.id_persona");
            $this->db->join("barbero_habilidades_tecnicas", "barbero_habilidades_tecnicas.id_barbero = barbero_perfil.id_persona","left");
            if($tipo!=0) $this->db->where("tipo", $tipo, false);
            $this->db->group_by("persona.id_persona, tipo_de_sangre, indicaciones_medicas");
        }
        if($activo!=2) $this->db->where("activo", $activo, false);
        $query=$this->db->get();
        log_message("debug", $this->db->last_query());
        return $query->result();
    }

}