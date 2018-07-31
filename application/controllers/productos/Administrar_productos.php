<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_productos extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('productos/Administrar_productos_modelo', 'Producto');
		$this->load->model('Comunes_modelo');
    }
	
	function index()
	{	
		$this->load->view('cabecera');
		$this->load->view('productos/administrar_productos');
		$this->load->view('proveedores/administrar_proveedor_modal');		
		$this->load->view('footer.php', array('libreria' => 'assets/js/productos/productos.js', 'libreriaextra'=>'assets/js/proveedores/administrar_proveedor.js'));
	}

	function registrarproductos(){
		echo json_encode($this->Producto->registrarproductos($_POST));
	}
    
    function obtenerproducto(){
		echo json_encode($this->Producto->obtenerproductos( $_POST["tipo"] ));
	}

	function obtenerproductobaja(){
		echo json_encode($this->Producto->obtenerproductosbaja());
	}  
    
    function perfil_productos(){
		echo json_encode($this->Producto->perfil_producto($_POST['id_producto']));
	}
    
    function bajaproducto(){
		echo json_encode($this->Producto->baja_producto($_POST['id_producto']));
	}
    
    function habilitarproducto(){
		echo json_encode($this->Producto->habilitar_producto($_POST['id_producto']));
	}
    
    function llenarformulario(){
		echo json_encode($this->Producto->llenarformulario($_POST['id_producto']));
	}
    
    function llenarcategoria(){
		echo json_encode($this->Producto->llenarcategoria($_POST['tipo_producto']));
	}

	function llenarproveedor(){
		echo json_encode($this->Producto->llenarproveedor());
	}
    
    /*function obtenercategoria(){
		echo json_encode($this->Productos->obtenercategoria());
	}*/
    
	function autocompletar()
	{
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);      
	      echo json_encode($this->Comunes_modelo->autocompletar($q, $_GET['tabla'], $_GET['campo']));
	    } 		
	}
}
