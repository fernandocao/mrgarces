
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_promociones extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('promociones/Administrar_promociones_modelo','Promociones');
		$this->load->model('Comunes_modelo');
    }
	
	function index()
	{	
		$this->load->view('cabecera');
		$this->load->view('promociones/administrar_promociones');
		$this->load->view('footer.php', array('libreria' => 'assets/js/promociones/administrar_promociones.js'));
	}

	function registrarpromocion(){
		echo json_encode($this->Promociones->registrarpromocion($_POST));
	}
    
    function eliminarpromocion(){
		echo json_encode($this->Promociones->eliminarpromocion($_POST["id_promo"]));
	}	

    function obtenerpromociones(){
		echo json_encode($this->Promociones->obtenerpromociones());
	}
	
	function obtenerservicio(){
		echo json_encode($this->Promociones->obtenerservicio($_POST['id_servicio']));
	}		

	function autocompletararticulos(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletararticulos($q));
	    } 		
	}
	
	function autocompletarservicio(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarservicio($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}

	function obtenerproducto(){
		echo json_encode($this->Promociones->obtenerproducto($_POST['id_producto']));
	}		

	function autocompletarproducto()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletarproducto($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}

	/*Funciones para llenar formulario de promociones*/

	function llenarformularioactualizarservicios(){
		echo json_encode($this->Promociones->llenarformularioactualizarservicios($_POST["id_promo"]));
	}	
	
	function llenarformularioactualizarproductos(){
		echo json_encode($this->Promociones->llenarformularioactualizarproductos($_POST["id_promo"]));
	}	
	function autocompletar()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletar($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}
}