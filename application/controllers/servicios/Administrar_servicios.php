 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_servicios extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('servicios/Administrar_servicios_modelo', 'Servicio');
		$this->load->model('Comunes_modelo');
    }
	
	function index()
	{	
		
		$this->load->view('cabecera');
		$this->load->view('servicios/administrar_servicios');
		$this->load->view('footer.php', array('libreria' => 'assets/js/servicios/servicios.js'));
	}

	function registrarservicio(){
		echo json_encode($this->Servicio->registrarservicio($_POST));
	}
       
    function baja_servicio(){
        echo json_encode($this->Servicio->baja($_POST['id_servicio']));
    }
    
    function habilitar_servicio(){
        echo json_encode($this->Servicio->habilitar($_POST['id_servicio']));
    }
        
    function autocompletarservicio(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarservicio( $q ));
	    } 		
	}

    function obtenerservicio(){
        echo json_encode($this->Servicio->obtenerservicio($_POST['id_servicio']));
    }
       
    function obtenerservicios(){
        echo json_encode($this->Servicio->obtenerservicios($_POST));
    }
}
