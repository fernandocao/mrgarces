<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_gastos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('gastos/administrar_gastos_modelo','gastos');
		$this->load->model('Comunes_modelo');
    }
	
	function index(){	
		$this->load->view('cabecera');
		$this->load->view('gastos/administrar_gastos');
		$this->load->view('footer.php', array('libreria' => 'assets/js/gastos/administrar_gastos.js'));
	}

	function registrargasto(){
		echo json_encode($this->gastos->registrargasto($_POST));
	}

  	function obtenergastos(){
		echo json_encode($this->gastos->obtenergastos($_POST["activo"]));
	}

	function eliminargasto(){
		echo json_encode($this->gastos->eliminargasto($_POST["id_gasto"]));
	}	
	
	function habilitargasto(){
		echo json_encode($this->gastos->habilitargasto($_POST["id_gasto"]));
	}	
    
    function llenarformularioactualizar(){
		echo json_encode($this->gastos->llenarformularioactualizar($_POST["id_gasto"]));
	}	

	function autocompletargastos()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletargastos($q));
	    } 		
	}
    
}
