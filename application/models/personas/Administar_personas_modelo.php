 
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Administar_personas_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function registrarbarbero($datos){
		if($datos["id_persona"]==0){
			$id_direccion=1;
			if($datos["tipo"]!=5){
				//direccion de la persona
				$datosregistro=array(
					"calle" => $datos["calle"],
					"numero_interior" => $datos["numero_interior"],
					"colonia" => $datos["colonia"],
					"ciudad" => $datos["ciudad"],
					"estado" => $datos["estado"],
				);
				$this->db->insert('direcciones',$datosregistro);
				log_message("debug",$this->db->last_query());
				$id_direccion = $this->db->insert_id();
			}
			//registro del empleado o cliente en tabla persona
			$datosregistro=array(
				"nombre" => $datos["nombre"],
				"apellido_paterno" => $datos["apellido_paterno"],
				"apellido_materno" => $datos["apellido_materno"],
				"fecha_de_nacimiento" => $datos["fecha_de_nacimiento"],
				"id_direccion" => $id_direccion,
				"telefono" => $datos["telefono"],
				"correo" => $datos["correo"],
				"facebook" => $datos["facebook"],
				"instagram" => $datos["instagram"],			
				"tipo" => $datos["tipo"]
			);
			$this->db->insert('persona',$datosregistro);
			log_message("debug",$this->db->last_query());
			$id_persona = $this->db->insert_id();

			if($datos["tipo"]==2){
				//registrar habilidades tecnicas
				foreach($datos['habilidades'] as $key => $value) {
					$datosregistro=array(
						"id_barbero" => $id_persona,
						"descripcion_habilidad" => $value,
					);			
					$this->db->insert('barbero_habilidades_tecnicas',$datosregistro);
					log_message("debug",$this->db->last_query());
				}
			}
			if($datos["tipo"]!=5){
				//registrar usuario del sistema
				$datosregistro=array(
					"id_persona" => $id_persona,
					"usuario" => $datos["usuario"],
					"password" => MD5($datos["password"]),
				);
				$this->db->insert('sistema_usuarios',$datosregistro);
				log_message("debug",$this->db->last_query());		

				//direccion del contacto
				$datosregistro=array(		
					"calle" => $datos["callecontacto"],
					"numero_interior" => $datos["numerointeriorcontacto"],
					"colonia" => $datos["coloniacontacto"],
					"ciudad" => $datos["ciudadcontacto"],
					"estado" => $datos["estadocontacto"],
				);
				$this->db->insert('direcciones',$datosregistro);
				log_message("debug",$this->db->last_query());
				$id_direccion = $this->db->insert_id();

				//registro del contacto en tabla persona
				$datosregistro=array(
					"nombre" => $datos["nombrecontacto"],
					"apellido_paterno" => $datos["paternocontacto"],
					"apellido_materno" => $datos["maternocontacto"],
					"fecha_de_nacimiento" => "",
					"id_direccion" => $id_direccion,
					"telefono" => $datos["telefonocontacto"],			
					"tipo" => 4 //contacto
				);

				$this->db->insert('persona',$datosregistro);
				log_message("debug",$this->db->last_query());
				$id_contacto = $this->db->insert_id();

				$padecimiento="No aplica";
				if(isset($datos["especifiquepadecimiento"])) $padecimiento=$datos["especifiquepadecimiento"];
				$alergia="No aplica";
				if(isset($datos["especifiquemedicameneto"])) $alergia=$datos["especifiquemedicamneto"];

				$datosregistro=array(
					"id_persona" => $id_persona,
					"id_contacto" => $id_contacto,
					"tipo_de_sangre" => $datos["tiposangre"],
					"indicaciones_medicas" => "Padecimientos: ".$padecimiento."<br>Alergías: ".$alergia,
					"id_parentesco" => $datos["parentescocontacto"],
				);
				$this->db->insert('barbero_perfil',$datosregistro);
			}
	        if(isset($_FILES['btn_foto'])){            
	            $file = $_FILES['btn_foto'];
	            $name = $file['name'];           
	            $path = $_SERVER['DOCUMENT_ROOT'] . "/azul/assets/images/fotospersona/".$id_persona.'.jpg' ;
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

		}else{
			//update
		}
		
		return array("respuesta"=>"ok");
	}

	function obtenerparentesco(){
		$this->db->from("barbero_cat_parentesco");
		$query=$this->db->get();
		return $query->result();
	}

	function verperfil($id_persona){
		$this->db->select("persona.id_persona, persona.apellido_paterno, persona.apellido_materno, persona.nombre, direcciones.calle, direcciones.numero, direcciones.numero_interior, direcciones.colonia, direcciones.ciudad, persona.instagram, persona.facebook, persona.correo, persona.telefono, persona.fecha_de_nacimiento, tipo_de_sangre, indicaciones_medicas, GROUP_CONCAT(descripcion_habilidad) as habilidades, parentesco.id_persona as id_personap, parentesco.nombre as nombrep, parentesco.apellido_paterno as apellido_paternop, parentesco.apellido_materno as apellido_maternop, parentescodireccion.calle as callep, parentescodireccion.numero as numerop, parentescodireccion.numero_interior as numero_interiorp, parentescodireccion.colonia as coloniap, parentescodireccion.ciudad as ciudadp, parentesco.telefono as telefonop, parentesco.correo as correop, persona.tipo");
		$this->db->from("persona");
		$this->db->join("direcciones","persona.id_direccion=direcciones.id_direccion","left");		
		$this->db->join("barbero_perfil", "barbero_perfil.id_persona = persona.id_persona","left");
		$this->db->join("barbero_habilidades_tecnicas", "barbero_habilidades_tecnicas.id_barbero = barbero_perfil.id_persona","left");
		$this->db->join("persona as parentesco","parentesco.id_persona=barbero_perfil.id_contacto","left");
		$this->db->join("direcciones as parentescodireccion"," parentescodireccion.id_direccion= parentesco.id_direccion","left");		
		$this->db->join("barbero_cat_parentesco","barbero_cat_parentesco.id_parentesco=barbero_perfil.id_parentesco","left");

		$this->db->where("persona.id_persona",$id_persona,false);
		$this->db->group_by("persona.id_persona, tipo_de_sangre, indicaciones_medicas, parentesco.id_persona");
		$query=$this->db->get();
		//log_message("error","perfil".$this->db->last_query());
		return $query->row();
	}

	function eliminarperfil($id_persona){
		$this->db->set("activo",0);
		$this->db->where("id_persona",$id_persona);
		$this->db->update("persona");
		log_message("debug",$this->db->last_query());
		return ;
	}

	function validarusuario($usuario){
		$this->db->select("COUNT(id_usuario) as usuarios, MAX(id_usuario)+1 as sugerencia");
		$this->db->from("sistema_usuarios");
		$this->db->where("usuario",$usuario);
		$query=$this->db->get();
		log_message("error","perfil".$this->db->last_query());
		$resultado=$query->row();
		return $resultado;
	}
}