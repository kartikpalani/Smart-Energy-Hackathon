<?php
    
    class home extends CI_Controller{
			
		function __construct(){
		    parent::__construct();
			$this->load->model('erc_database');
			
		
		}//end of constructor	
    	
		function erc(){   // front page
			$this->load->view('home_view');
		}//end of erc
		
		function reg(){   // front page
			//$this->load->view('newuser');
			$this->load->view('newuser');
		}//end of newuser
		
		//to start registration remove comment
		/*function newuser(){   // front page
			$this->load->view('newuser');			
		}//end of newuser
		*/
		function getCollegeList(){
				
			//$this->load->model('Erc_database');	
			if($_GET){
				$state = $_GET['state'];
			
				$result = $this->erc_database->getCollegeList($state);
			
        		echo json_encode($result);
			}	
		}//end of getCollegeList
		
		function registerUser(){
			
			$this->load->helper(array('form', 'url', 'file'));
			$this->load->library('form_validation');
			
			//$config['upload_path'] = './uploads/';
			//$config['allowed_types'] = 'jpg|png';
			//$config['max_size']	= '100';
			$this->load->library('upload', array('allowed_types'=>'gif|jpg|jpeg|png','max_size'=>'150'));			
			
    		//$this->load->library('upload', $config);
			//$this->upload->initialize($config);
			
			/* REMOVE COMMENT AFTER DONE - TEMP COMMENTED - FORM VALIDATION */
			$this->form_validation->set_rules('fullName', 'Full Name', 'required');			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_username');
			$this->form_validation->set_rules('password', 'Password',  'required');			
			$this->form_validation->set_rules('contactNumber', 'Contact Number',  'required|numeric|exact_length[10]');
			$this->form_validation->set_rules('pincode', 'College Pincode', 'required|numeric|exact_length[6]');
			$this->form_validation->set_rules('address', 'Home Address', 'required');
			$this->form_validation->set_rules('teamMember1_Name', 'Name Of Team Member1', 'required');
			$this->form_validation->set_rules('teamMember1_Email', 'Email Of Team Member1', 'required|valid_email|callback_check_username');
			$this->form_validation->set_rules('teamMember2_Name', 'Name Of Team Member2', 'required');
			$this->form_validation->set_rules('teamMember2_Email', 'Email Of Team Member2', 'required|valid_email|callback_check_username');
			$this->form_validation->set_rules('teamMember3_Name', 'Name Of Team Member3', 'required');
			$this->form_validation->set_rules('teamMember3_Email', 'Email Of Team Member3', 'required|valid_email|callback_check_username');
			$this->form_validation->set_rules('terms', 'Terms', 'required');	
			
			$this->form_validation->set_rules('grpimage', 'Group Image', 'callback_handle_upload');		
						
			if ($this->form_validation->run() == FALSE){
				$this->load->view('newuser');
			}else{				
				if($_POST){
				    //insert login Details 							
				    $login = array(
						'username' => $_POST['email'],
						'password' => $_POST['password'],
						'hash' => md5($_POST['email'])
					);			
					$loginId = $this->erc_database->setLogin($login);				
					
					//insert College Details for team
					$collegeDetail = array(
						'loginId' => $loginId,
						'state'	  => $_POST['state'],
						'collegeName' => $_POST['collegeName'],
						'pincode' => $_POST['pincode']										
					);					
					$this->erc_database->setTeamDetail($collegeDetail);
					
					//insert TeamLeader Details
					$teamLeaderDetail = array(
						'teamId' => $loginId,
						'name'   => $_POST['fullName'],
						'email'  => $_POST['email'],
						'contact'=> $_POST['contactNumber'],
						'branch' => $_POST['branchName'],
						'year' 	 => $_POST['year'],
						'gender' => $_POST['gender'],
						'address' => $_POST['address'],
						'role' => 'TL',
						'active' => 1,
						'hash' => md5($_POST['email'])
					);				
					$teamLeaderId = $this->erc_database->setTeamProfile($teamLeaderDetail);
					
					//insert TeamMember1 Details
					$teamMember1 = array(
						'teamId' => $loginId,
						'name'   => $_POST['teamMember1_Name'],
						'email'  => $_POST['teamMember1_Email'],
						'role' => 'TM',						
						'hash' => md5($_POST['teamMember1_Email'])
					);
					$teamMember1Id = $this->erc_database->setTeamProfile($teamMember1);
						
					//insert TeamMember2 Details
					$teamMember2 = array(
						'teamId' => $loginId,
						'name'   => $_POST['teamMember2_Name'],
						'email'  => $_POST['teamMember2_Email'],
						'role' => 'TM',						
						'hash' => md5($_POST['teamMember2_Email'])
					);
					$teamMember2Id = $this->erc_database->setTeamProfile($teamMember2);
					
					//insert TeamMember3 Details
					$teamMember3 = array(
						'teamId' => $loginId,
						'name'   => $_POST['teamMember3_Name'],
						'email'  => $_POST['teamMember3_Email'],
						'role' => 'TM',						
						'hash' => md5($_POST['teamMember3_Email'])
					);
					$teamMember3Id = $this->erc_database->setTeamProfile($teamMember3);	
					
					
					if($_FILES['grpimage']['size'] > 0){
						
						$fileName = $_FILES['grpimage']['name']; // image file name
					    $tmpName = $_FILES['grpimage']['tmp_name']; // name of the temporary stored file name
					    $fileSize = $_FILES['grpimage']['size']; // size of the uploaded file
					    $fileType = $_FILES['grpimage']['type']; // file type
							 
					    $fp = fopen($tmpName, 'r'); // open a file handle of the temporary file
					    $imgContent = fread($fp, filesize($tmpName)); // read the temp file
					    fclose($fp); // close the file handle
					 
					 	$img = array(
						  	'teamId' => $loginId,
						  	'photo' => $imgContent
						);
						
						$this->erc_database->uplodeGrpPic($img);						 					        
					}
					
					$data = array(
					   	'id' => $loginId,
					   	'username' => $_POST['email'],
						'password' => $_POST['password'],						
						'name'   => $_POST['fullName'],						
						'contact'=> $_POST['contactNumber'],
						'email' => $_POST['email'],
						'role' => 'TL'	
					);
					
					$datamember = array(
						'id1' => $teamMember1Id,
						'id2' => $teamMember2Id,
						'id3' => $teamMember3Id,
						'member1' => $teamMember1,
						'member2' => $teamMember2,
						'member3' => $teamMember3,
						'email' => $_POST['email'],				
					);
					
					$this->send_email($data);
					
				//	$this->send_email($teamMember1);	
					$this->send_member_email($_POST['email'],$teamMember1Id, $teamMember1);	
					$this->send_member_email($_POST['email'],$teamMember2Id, $teamMember2);	
					$this->send_member_email($_POST['email'],$teamMember3Id, $teamMember3);	
																			
					//$this->load->view('successRegi');
					$this->session->set_flashdata('sussregi', 'success');	
					//redirect('/home/newuser', 'refresh');
					redirect('/home/reg', 'refresh');
					        			
				}
			}
		}//end of register	
		
			
		// function send_email is used to send verification link to the team leader registered on portal 
		function send_email($data){
			
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
		$subject = "e-YRC-13-Email-Verification-e-YRC#$data[id]";

		$hash = md5($data['email']);
		
	   $message =
		"Dear $data[name],
			 
		Thanks for signing up in e-Yantra Robotics Competition 2013.
		
		Your team id is e-YRC#$data[id]		
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
 
		------------------------ 
		Username: $data[email]
		Password: $data[password] 
		------------------------ 
 
		Please click this link to activate your account:
		 
		http://e-yantra.org/erc13/index.php/home/activateUser?id=$data[id]&hash=$hash
		
		Slot booking details : Start date -  11:00 AM on 27th August 2013
		
							   Last date - Midnight of 5th September, 2013
							  
		Team leader logs in on e-YRC-13 registration portal for details on slot booking and online test : Read Test FAQ. 
		
		Team Leader can book a time slot only after details of all team members are registered in the portal.Slot booking can be done only once.

		Thank you for participating in the e-Yantra Robotics Competition 2013.
					
		Best wishes,
		e-Yantra Team";

		$m->addTo($data['email']);
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);
		
		
		}// end of send_email
		
		// send_member_email is used to send email to each of team members of the team
		function send_member_email($username,$id,$data){
				
				
			//$hash = md5($datamember['email']);
		//	$ses = new SimpleEmailService('AKIAJ3SRPXZAASJPDLLQ', 'AisvjEGtEMkhYIxLFETw4GvsrTYNfZNLhYTK5pWT0Sad');
			$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
			$m = new SimpleEmailServiceMessage();
		    $subject = "e-YRC-13-Email-Verification-e-YRC#$data[teamId]";
			$message = 
			"Dear $data[name],
					 
			Thanks for signing up in e-Yantra Robotics Competition 2013.
			
			Your team id is e-YRC#$data[teamId]		
			
			Your account has been created, you can login with the credentials sent to the team leader.
			
			Team Leader email id : $username
	 
			Please click this link to activate your account:
			 
			http://e-yantra.org/erc13/index.php/home/activateMember?id=$id&hash=$data[hash]
	
			Thank you for participating in the e-Yantra Robotics Competition 2013.
						
			Best wishes,
			e-Yantra Team";
			
			
			$m->addTo($data['email']);
			$m->setFrom('admin@e-yantra.org');
			$m->addcc('eyantra.eyrc@gmail.com');
			$m->setSubject($subject);
			$m->setMessageFromString($message);
			$ses->sendEmail($m);
			
			

		}//end of send_member_email
		
		function handle_upload(){
			    	
			    if (isset($_FILES['grpimage']) && !empty($_FILES['grpimage']['name']))
			      {
			      if ($this->upload->do_upload('grpimage')){
			        // set a $_POST value for 'image' that we can use later
			        $upload_data    = $this->upload->data();
			        $_POST['grpimage'] = $upload_data['grpimage'];
			        return true;
			      }else if ($_FILES['grpimage']['size'] > 51200){
					$this->form_validation->set_message('handle_upload', "Imgae shoud be less than 50KB in size!");
				    return false;	
				  }
			      /*else
			      {
			        // possibly do some clean up ... then throw an error
			        $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
			        return false;
			      }*/
			    }
			    else
			    {
			      // throw an error because nothing was uploaded
			      $this->form_validation->set_message('handle_upload', "You must upload an group image!");
			      return false;
			    }				
		}//end of handle upload
		
		//check username/email if already exist
		function check_username($username){
				if($this->erc_database->username_available($username)){
        			return TRUE;
    			} else {
        			$this->form_validation->set_message('check_username','Seems like you are already registered...');
        			return FALSE;
    			}
		}//end of check username
		
		function activateUser(){
				if(isset($_GET['id']) && !empty($_GET['id']) AND isset($_GET['hash']) && !empty($_GET['hash'])){  
    				// Verify data  
    				$id = mysql_escape_string($_GET['id']); // Set email variable  
    				$hash  = mysql_escape_string($_GET['hash']); // Set hash variable
    				
    				$query = $this->erc_database->checkEmail($id,$hash);
					
					if($query -> num_rows() == 1){
						$this->erc_database->activateUser($id);
						//echo "Accout activated";
						$data['message'] = "Your account is successfully activated. <br> <a href = ".base_url()."home/login>Click Here </a> to login."; 
						$this->load->view('showMessage',$data);
						//redirect('/home/erc', 'refresh'); 
					}else{
						$data['message'] = "Seems like you are not a Registrated User"; 
						$this->load->view('showMessage',$data);
					}
				}else{  
    				// Invalid approach  
    				$data['message'] = "Invalid URL."; 
					$this->load->view('showMessage',$data);
				} 				
		}//end of activateuser
		
		function activateMember(){
				if(isset($_GET['id']) && !empty($_GET['id']) AND isset($_GET['hash']) && !empty($_GET['hash'])){  
    				// Verify data  
    				$id = mysql_escape_string($_GET['id']); // Set email variable  
    				$hash  = mysql_escape_string($_GET['hash']); // Set hash variable
    				
    				$query = $this->erc_database->checkEmailMember($id,$hash);
					
					if($query -> num_rows() == 1){
						$this->erc_database->activateMember($id);
						//echo "Accout activated";
						$data['message'] = "Your email id is verified successfully. <br>Team Leader can login into the account and complete the remaining registration details."; 
						$this->load->view('showMessage',$data);
					//	redirect('/home/erc', 'refresh'); 
					}else{
						$data['message'] = "Seems like you are not a Registrated User"; 
						$this->load->view('showMessage',$data);
					}
				}else{  
    				// Invalid approach  
    				$data['message'] = "Invalid URL."; 
					$this->load->view('showMessage',$data);
				} 				
		}//end of activateuser
		function aboutus(){
				$this->load->view('aboutus');
		}//end of aboutus
			
		function contactus(){
				$this->load->view('contactus');
		}//end of aboutus
		
		function login(){
				$this->load->view('login');
		}//end of aboutus	
		
		function quizlogin(){
				$this->load->view('takequiz');
		}//end of aboutus
		
		function mlogin(){
			if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['u'] = $session_data['username'];	
			  $data['p'] = $session_data['contact'];
			  $data['teamId'] = $session_data['teamid'];
			   $data['id'] = $session_data['id'];		
			  $this->erc_database->updatetestattempt($data['id']);
			  redirect('http://www.e-yantra.org/erc13/moodle/login/index.php?U='.$data['u'].'&P='.$data['p'],'refresh');
			/* $temp = array();
			  $query = $this->erc_database->getquiztime($data['teamId']);
			  //redirect('http://www.e-yantra.org/erc13/moodle/login/index.php?U='.$data['u'].'&P='.$data['p'],'refresh');
			  foreach($query->result() as $row){
			  		$temp = array(
			  		'quizdate' => $row->date,
			  		'quiztime' => $row->start			  		
			  		);
			  }
			  
			  $quizdate = $temp['quizdate'];
			  $quiztime = $temp['quiztime'];
			  $currentd = date("Y-m-d");
			  $currentt = date("H:i:s");
			  
			  $time1 = strtotime($quizdate. $quiztime);
			  $time2 = strtotime($currentd. $currentt);
			  
			  $quizhour = date('H', $time1);
			  $currenthour = date('H', $time2);
			  $quizmin = date('i',$time1);
			  $currentmin = date('i',$time2);
			  
			  //echo $quizdate."::".$quiztime."::::".$currentd."::".$currentt." - ";
			  //echo $quizhour.$currenthour;		  			
			  
		   	  if($quizdate == $currentd) {
	     	  	    if($quizhour == $currenthour){
	     	  	    	if($currentmin <= 30){
					  	   redirect('http://www.e-yantra.org/erc13/moodle/login/index.php?U='.$data['u'].'&P='.$data['p'],'refresh');   	
						}else echo "Not On Time";
	     	  	    }else echo "Not On Time";   	  	    				
			  }
			  else if ($quizdate > $currentd)echo "Time remaining";
			  else if ($quizdate < $currentd)echo "Quiz Time Expired";
			  else echo "Not valid";	
			  //$this->load->view("welcome_message",$temp);			
			*/}
		}//end of mlogin
		function posttestlogin(){
			if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['u'] = $session_data['username'];	
			  $data['p'] = $session_data['contact'];
			  $data['teamId'] = $session_data['teamid'];
			   $data['id'] = $session_data['id'];		
			  $this->erc_database->updateposttestattempt($data['id']);
			 // http://ec2-184-73-79-36.compute-1.amazonaws.com/moodle/login/index.php?N=$username&C=$contact
			  redirect('http://ec2-184-73-79-36.compute-1.amazonaws.com/moodle/login/index.php?N='.$data['u'].'&C='.$data['p'],'refresh');
					
			}
		}//end of mlogin
		function addcollege(){ 
			//$this->load->view('addCollege');
			$this->load->view('elsi_register');
		}
		function job_apply_mail($name,$email){
				
			$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
			$m = new SimpleEmailServiceMessage();
		    $subject = "e-Yantra-Resume-Uploaded";
			$message = 
			
"Dear $name,

We have received your resume.
					 
Thanks for applying for job position in e-Yantra.
			
We appreciate your interest in working with e-Yantra
			
Details of further process will be e-mailed to short-listed candidates very soon. 
			
			
Best wishes,
e-Yantra Team";
			
			
			$m->addTo($email);
			$m->setFrom('admin@e-yantra.org');
			$m->addcc('eyantra.erts@gmail.com');
			$m->setSubject($subject);
			$m->setMessageFromString($message);
			$ses->sendEmail($m);
			
			

		}//end of send_member_email
		function forjob(){
			$this->load->view('apply');
		}
		
		function addResume(){
			
			$this->load->helper(array('form', 'url', 'file'));
			$this->load->library('form_validation');
			
			$this->load->library('upload', array('allowed_types'=>'gif|jpg|jpeg|png','max_size'=>'150'));			
			
    		/* REMOVE COMMENT AFTER DONE - TEMP COMMENTED - FORM VALIDATION */
			$this->form_validation->set_rules('fullName', 'Full Name', 'required');			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');						
			$this->form_validation->set_rules('contactNumber', 'Contact Number',  'required|numeric|exact_length[10]');			
			$this->form_validation->set_rules('state', 'state', 'callback_select_validate[State]');
			$this->form_validation->set_rules('city', 'City', 'required');		
			$this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|exact_length[6]');	
			$this->form_validation->set_rules('collegeName', 'College / University Name', 'required');
			$this->form_validation->set_rules('qualification', 'Qualification', 'callback_select_validate[Qualification]');				
			$this->form_validation->set_rules('branchName', 'Branch', 'callback_select_validate[Branch]');
			$this->form_validation->set_rules('position', 'Position', 'callback_select_validate[Position]');
			$this->form_validation->set_rules('gender', 'gender', 'callback_select_validate[Gender]');		
			
			$this->form_validation->set_rules('resumedoc', 'Resume', 'callback_handle_resume');		
						
			if ($this->form_validation->run() == FALSE){
				$this->load->view('apply');
			}else{				
				if($_POST){
				    //insert login Details			    
				    $applicant = array(
						'fullName' => $_POST['fullName'],
						'email' => $_POST['email'],
						'contact' => $_POST['contactNumber'],
						'state' => $_POST['state'],
						'place' => $_POST['city'],
						'pincode' => $_POST['pincode'],
						'collegeName' => $_POST['collegeName'],
						'qualy' => $_POST['qualification'],
						'branch' => $_POST['branchName'],
						'position' => $_POST['position'],
						'gender' => $_POST['gender']						
					);					
					$loginId = $this->erc_database->addApplicant($applicant);						
						
					if($_FILES['resumedoc']['size'] > 0){
						
						$fileName = $_FILES['resumedoc']['name']; // image file name
					    $tmpName = $_FILES['resumedoc']['tmp_name']; // name of the temporary stored file name
					    $fileSize = $_FILES['resumedoc']['size']; // size of the uploaded file
					    $fileType = $_FILES['resumedoc']['type']; // file type
							 
					    $tmpDir = uniqid('/tmp/DropboxUploader-');
				        if (!mkdir($tmpDir))
				            throw new Exception('Cannot create temporary directory!');
					    
					    $tmpFile = $tmpDir.'/'.str_replace("/\0", '_', $_FILES['resumedoc']['name']);
        				if (!move_uploaded_file($_FILES['resumedoc']['tmp_name'], $tmpFile))
            				throw new Exception('Cannot rename uploaded file!');
            
						$filename = $_FILES['resumedoc']['name'];
				        $ext = pathinfo($filename, PATHINFO_EXTENSION);	
						
						$uploader = new DropboxUploader('eyantra.erts@gmail.com', 'BKM012XT');// enter dropbox credentials
				        //$uploader->upload($tmpFile, $_POST['dest']);
				      	// $_POST['dest'] = $folder;
				      	$folder = "Resume-2014";
						$uploader->upload($tmpFile, $folder);	
						$this->job_apply_mail($_POST['fullName'],$_POST['email']); 
										 					        
					}																			
					//$this->load->view('successRegi');
					$this->session->set_flashdata('sussregi', 'success');					
					//$this->load->view('apply',$data);
					redirect('/home/forjob', 'refresh');
					//redirect('http://e-yantra.org/home/about-e-yantra/jobs');					        			
				}
			}
		}//end of register	
		
		function select_validate($selectValue,$fieldName){
		    // 'none' is the first option and the text says something like "-Choose one-"
		    if($selectValue == 'none')
		    {
		        $this->form_validation->set_message('select_validate', 'Please select your '.$fieldName);
		        return false;
		    }
		    else // user picked something
		    {
		        return true;
		    }
		}//end of select validate
		
		function handle_resume(){			    	
			 if (isset($_FILES['resumedoc']) && !empty($_FILES['resumedoc']['name'])){
			      if ($this->upload->do_upload('resumedoc')){
			        // set a $_POST value for 'image' that we can use later
			        $upload_data = $this->upload->data();
			        $_POST['resumedoc'] = $upload_data['resumedoc'];
			        return true;
			      }else if ($_FILES['resumedoc']['size'] > 512000){
					$this->form_validation->set_message('handle_resume', "Filde should be small...!");
				    return false;	
				  }      
			    } else {
			      // throw an error because nothing was uploaded
			      $this->form_validation->set_message('handle_resume', "You must upload an your resume!");
			      return false;
			    }				
		}//end of handle upload	
		
    }//end of controller
?>