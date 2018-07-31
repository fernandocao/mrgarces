  
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Punto_venta extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('punto_venta/Punto_venta_modelo','ventas');
		$this->load->model('Comunes_modelo');
    }
	

	function index(){	
		$this->load->view('cabecera');
		$this->load->view('punto_venta/punto_venta');
		$this->load->view('personas/modales_personas');
		$this->load->view('footer.php',array('libreria' => 'assets/js/punto_venta/punto_venta.js','libreriaextra' => 'assets/js/personal/personal.js'));
	}

	function autocompletarclientes(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarclientes($q));
	    } 		
	}

	function autocompletararticulos(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletararticulos($q));
	    } 		
	}	

	function realizarventa(){
		header('Content-Type: application/json');
		echo json_encode($this->ventas->realizarventa($_POST));

	}	

	function mostrarhistorial(){
		echo json_encode($this->ventas->mostrarhistorial( $_POST["id_cliente"] ));
	}

	function obtenerpersonal(){
		echo json_encode($this->Comunes_modelo->obtenerpersonal($_POST["tipo"], 1 ));
	}

	function obtenerservicios(){
		echo json_encode($this->ventas->obtenerservicios($_POST["id_cliente"]));
	}

}

