<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reportes/reportes_modelo','reportes');
		$this->load->model('Comunes_modelo');
    }
	
	function index(){	
		$this->load->view('cabecera');
		$this->load->view('reportes/reportes');
		$this->load->view('footer.php', array('libreria' => 'assets/js/reportes/reportes.js'));
	}

	function reportes(){
		echo json_encode($this->reportes->reportes( $_POST ));
	}

}
