  
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require BASEPATH . '../vendor/autoload.php';

class Administrar_citas extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('citas/Administar_citas_modelo','citas');
		$this->load->model('Comunes_modelo');
    }
	

	function index(){	
		$this->load->view('cabecera');
		$this->load->view('citas/administrar_citas');
		$this->load->view('footer.php',array('libreria' => 'assets/js/citas/citas.js'));
	}

	function autocompletarclientes(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarclientes($q));
	    } 		
	}	

	function autocompletarbarberos(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarbarberos($q));
	    } 		
	}	

	function autocompletarservicio(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarservicio($q));
	    } 		
	}	

	function agendarcita(){
		echo json_encode($this->citas->agendarcita($_POST));
	}

	function listarcitas(){
		echo json_encode($this->citas->listarcitas($_POST["mes"]));
	}

	function obtenercitas(){
	    echo json_encode($this->citas->obtenercitas($_POST['id_barbero'], $_POST['fecha']));
	}
}

