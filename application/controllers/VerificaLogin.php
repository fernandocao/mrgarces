  
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class VerificaLogin extends CI_Controller {
 
 function __construct(){
   parent::__construct();
   $this->load->model('user_login');
 }
 
 function index()
 {
   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
    echo "<script>
alert('Usuario o contraseña incorrecto. Intentelo nuevamente');
window.location.href='login';
</script>";
    
   }
   else
   {
     //Go to private area
     redirect('inicio', 'refresh');
   }
 
 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
 
   //query the database
   $result = $this->user_login->login($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>