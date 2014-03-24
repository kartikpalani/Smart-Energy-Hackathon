<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

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
      //$this->load->view('home_view');
      $this->load->view('login');
    }
    else
    {
      //Go to private area
      redirect('teamprofile', 'refresh');
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->erc_database->login($username, $password);
    
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'id' => $row->teamId,
          'username' => $row->username,
          'user' => $row->user,
          'active' => $row->active,
          'survey' => $row->survey,
          'eyrc' => $row->eyrc,
          'eyrcId' => $row->id,
          'theme' => $row->theme                 
        );
        $this->session->set_userdata('logged_in', $sess_array);
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