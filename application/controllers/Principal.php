<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{	
		
		$this->load->view('cabecera');
		$this->load->view('principal');
		$this->load->view('footer.php');
	}

}
