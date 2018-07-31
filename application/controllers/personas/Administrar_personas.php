  
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_personas extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('personas/Administar_personas_modelo','Personas');
		$this->load->model('Comunes_modelo');
    }
	

	function index()
	{	

		$this->load->view('cabecera');
		$this->load->view('personas/administrar_personas');
		$this->load->view('personas/modales_personas');
		$this->load->view('footer.php',array('libreria' => 'assets/js/personal/personal.js'));

	}

	function registrarbarbero(){
		echo json_encode($this->Personas->registrarbarbero($_POST));
	}

	function eliminarperfil(){
		echo json_encode($this->Personas->eliminarperfil($_POST["id_persona"]));
	}	

	function verperfil(){
		echo json_encode($this->Personas->verperfil($_POST["id_persona"]));
	}	

	function validarusuario(){
		echo json_encode($this->Personas->validarusuario($_POST['usuario']));
	}

	function obtenerparentesco(){
		echo json_encode($this->Personas->obtenerparentesco());
	}

	function obtenerpersonal(){
		header('Content-Type: application/json');
		log_message("debug","ACTIVOC ".$_POST["activo"]);
		echo json_encode($this->Comunes_modelo->obtenerpersonal($_POST["tipo"], $_POST["activo"]));
	}

	function autocompletar()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletar($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}
}
