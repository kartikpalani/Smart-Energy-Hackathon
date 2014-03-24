<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QuizverifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('erc_database','',TRUE);
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page      
      $this->load->view('takequiz');
    }
    else
    {
      /*$username = $this->input->post('username');
	  $password = $this->input->post('password');      
      redirect('http://www.e-yantra.org/erc13/moodle/login/index.php?U='.$username.'&P='.$password,'refresh');*/
      //redirect('home/mlogin'); //redirecting to moodle
      redirect('teamprofile/intfrd2');
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->erc_database->quizlogin($username, $password);
    
    if($result)
    {
      $sess_array = array(); 	 
	  $teamId;
      foreach($result as $row)
      {
        $sess_array = array(
          'id' => $row->id,
          'teamid' => $row->teamId,
          'username' => $row->email,
          'contact' => $row->contact,
          'active' => $row->active,                         
        );        
        $this->session->set_userdata('quiz_logged_in', $sess_array);		
      }	  
	  return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Login Failed ! Please make sure that you enter the correct details and that you have activated your account');
      return false;
    }
  }
}
?>