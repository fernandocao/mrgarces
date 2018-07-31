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

	function registrarproveedor(){
		echo json_encode($this->Proveedor->registrarproveedor($_POST));
	}
    
    function eliminarproveedor(){
		echo json_encode($this->Proveedor->eliminarproveedor($_POST["id_proveedor"]));
	}	
	function habilitarproveedor(){
		echo json_encode($this->Proveedor->habilitarproveedor($_POST["id_proveedor"]));
	}	
    
    function llenarformularioactualizar(){
		echo json_encode($this->Proveedor->llenarformularioactualizar($_POST["id_proveedor"]));
	}	
    
    function obtenerperfilproveedor(){
		echo json_encode($this->Proveedor->obtenerperfilproveedor($_POST["id_proveedor"]));
	}	
    function obtenerproveedor(){
		echo json_encode($this->Proveedor->obtenerproveedor());
	}
	function obtenerproveedorbaja(){
		echo json_encode($this->Proveedor->obtenerproveedorbaja());
	}
	function obtenerproveedortodos(){
		echo json_encode($this->Proveedor->obtenerproveedortodos());
	}
	
	function autocompletar()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletar($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}
}
