<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
    }
	
	public function index()
	{	
		$data['token'] = $this->token();
		$data['titulo'] = 'Login';
		$this->load->view('login',$data);
	}

	public function nuevo_usuario(){
        $this->form_validation->set_rules('usuario', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
        
        //lanzamos mensajes de error si es que los hay
        //log_message("debug","aaa");
		if($this->form_validation->run() == FALSE){
			//log_message("debug","ddd");
			$this->index();
		}else{
			log_message("debug","eee");
			$usuario = $this->input->post('usuario');
			$password = sha1($this->input->post('password'));
			$verifica = $this->login_model->login_user($usuario,$password);
			if($verifica == TRUE){
				//log_message("debug","fff");
				$data = array(
                'is_logued_in' 	=> 		TRUE,
                'id_usuario' 	=> 		$check_user->id,
                //'perfil'		=>		$check_user->perfil,
                'perfil'		=>		"Administrador",
                'usuario' 		=> 		$check_user->usuario
        		);		
				$this->session->set_userdata($data);
				redirect('punto_venta/punto_venta');
			}
		}

	}
	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function cerrar_sesion()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
