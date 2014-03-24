<?php
    
    class admin extends CI_Controller{
			
		function __construct(){
		    parent::__construct();
			$this->load->model('erc_admindb');	
			//$this->session->userdata('logged_in') = 1;
			include ('SimpleEmailService.php');		
		}//end of constructor
		
		function slotstatus(){
			if($this->session->userdata('logged_in')){				
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];			   
	  
			    if($session_data['user'] == 1){
					$this->load->model("test_details");
					$table = $this->test_details->get_current_slot();
					$data = array(
						'table' 	=>	$table
					);		
					//print_r($table);
					$this->load->view("slotstatus",$data);		
				}else{ redirect('home/erc', 'refresh'); }
				}else{
					//If no session, redirect to login page
					redirect('home/erc', 'refresh');
				}	
		}//end of slotstatus
				
		function index(){
			if($this->session->userdata('logged_in')){				
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];			   
	  
			    if($session_data['user'] == 1){
							$total = array();						
							$statetotal = array();	
							$datewise = array();
							$slotTest = array();
							$teamCount = array();
							/*
							$result = $this->erc_admindb->getDateArray(); 
							foreach($result as $row){
									array_push($regdate,$row['regidate']);
							}
							
							//get total reg of date
							foreach($result as $i){
								$result1 = $this->erc_admindb->getRegiCount($i['regidate']); 
									foreach($result1 as $row){
										array_push($total,$row['total']);
									}
							}
							*/
							$total_reg = 0;
							$result = $this->erc_admindb->getDateArray();	
							array_push($datewise,array('Date','Registration'));		
							foreach($result as $row){
								$result1 = $this->erc_admindb->getRegiCount($row['regidate']); 
									foreach($result1 as $row1){
										$total_reg = $total_reg + $row1['total'];	
										array_push($total,array('category'=>$row['regidate'],'registration'=>$total_reg));	
										array_push($datewise,array($row['regidate'],intval($row1['total'])));					
									}
							}
							
							$resultState = $this->erc_admindb->getStateArray(); 
							array_push($statetotal,array('State','Total'));
							foreach($resultState as $row){
								$result1 = $this->erc_admindb->getStateCount($row['state']);					
									foreach($result1 as $row1){						
										array_push($statetotal,array($row['state'],intval($row1['total'])));
									}
							}
							
							$resultSlot = $this->erc_admindb->getSlotDateArray();	
							array_push($slotTest,array('TestDate','Team'));					
							foreach($resultSlot as $row){
								$result1 = $this->erc_admindb->getSlotTeamCount($row['testdate']); 
									foreach($result1 as $row1){							
										array_push($slotTest,array($row['testdate'],intval($row1['total'])));					
									}
							}
							
							$countTestAttempt = $this->erc_admindb->getTestAttempt();
							foreach($countTestAttempt as $row){
								$countTestAttempt = $row['total'];
							}
				
							$countTeamAttempt = $this->erc_admindb->getTeamTestStatus();
							foreach($countTeamAttempt as $row){
								array_push($teamCount,$row['total']);
							}
				            $countFlexStatus = $this->erc_admindb->getFlexStatus();
							$countRobotStatus = $this->erc_admindb->getRobotStatus();
							$countVideoStatus = $this->erc_admindb->getVideoStatus();
							$countDocuStatus = $this->erc_admindb->getDocuStatus(); 
							/*foreach($countFlexStatus as $row){
								array_push($flexCount,$row['total']);
							}*/
										
							$data = array (
									'regdata'=> json_encode($total),
									'statedata'=> json_encode($statetotal),
									'datewise' => json_encode($datewise),
									'slotTest' => json_encode($slotTest),
									'countTestAttempt' => $countTestAttempt,
									'teamCount' => $teamCount,
									'flexCount' =>$countFlexStatus,
									'robotCount' =>$countRobotStatus,
									'videoStatus' => $countVideoStatus,
									'docuStatus' => $countDocuStatus	
						);			
							$this->load->view('admin_view',$data);
					}else{ redirect('home/erc', 'refresh'); }
					}else{
					      //If no session, redirect to login page
					      redirect('home/erc', 'refresh');
					}
		}//end of index
		
		function grp($offset = 0){
			if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];
			   
	  
			    if($session_data['user'] == 1){
					// Load Pagination
					$this->load->library('pagination');
				
			        // Config setup			
					$config['base_url'] = base_url().'/admin/grp/';
					$config['total_rows'] = 160 ;//$this->erc_admindb->getImageCount();
					$config['per_page'] = 160;
					// I added this extra one to control the number of links to show up at each page.
					$config['num_links'] = 5;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div><!--pagination-->';
					$config['first_link'] = '&laquo; First';
					$config['first_tag_open'] = '<li class="prev page">';
					$config['first_tag_close'] = '</li>';
					$config['last_link'] = 'Last &raquo;';
					$config['last_tag_open'] = '<li class="next page">';
					$config['last_tag_close'] = '</li>';
					$config['next_link'] = 'Next &rarr;';
					$config['next_tag_open'] = '<li class="next page">';
					$config['next_tag_close'] = '</li>';
					$config['prev_link'] = '&larr; Previous';
					$config['prev_tag_open'] = '<li class="prev page">';
					$config['prev_tag_close'] = '</li>';
					$config['cur_tag_open'] = '<li class="active"><a href="">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li class="page">';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);	
						
					$result = $this->erc_admindb->getGrpImage($offset);
					$data =array(
						'grpimg' => $result
					);
					$this->load->view('grp',$data);
				}else{ redirect('home/erc', 'refresh'); }
				}else{
				     //If no session, redirect to login page
				     redirect('home/erc', 'refresh');
				}
		}//end of grp
		
		function test(){
			$this->load->view('test');
		}
		
		function slot(){
			$this->load->view('slotView');
		}

        function node(){
        	if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];
				$result = $this->erc_admindb->getHubcount();
	  
			    if($session_data['user'] == 1){			
						$this->load->view('email');
				}else{ redirect('home/erc', 'refresh'); }
			}else{
				     //If no session, redirect to login page
			     redirect('home/erc', 'refresh');
			}
		}//end of email
		
		function to_all(){	
		$emails = $this->input->post('to');
		$message = $this->input->post('message');
		$subject = $this->input->post("subject");
		$sendtype = $this->input->post("sendtype");
		$e = array();
		$elist = explode("\n",$emails);
		foreach($elist as $v)
		{
			$line = explode(",",$v);
			foreach($line as $k)
			{
				$e[]=$k;
			}
		}
		$e = array_unique($e);
		
		str_replace ('class="wysiwyg-color-green"', 'style="color:green"' ,$message);
				
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		foreach($e as $email){
			$m = new SimpleEmailServiceMessage();
			//$m->set_mailtype("html");
			$m->addTo($email);
	
			$m->setFrom('admin@e-yantra.org');
			$m->setSubject($subject);
			
			if($sendtype == "eYRC")
				$m->addcc('eyantra.eyrc@gmail.com');
			if($sendtype == "eLSI")
				$m->addcc('eyantra.elsi@gmail.com');
			if($sendtype == "erts")
				$m->addcc('eyantra.erts@gmail.com');
			
			$m->setMessageFromString("",$message);
			$ses->sendEmail($m);
		}
		redirect('admin/email');	
	}// end of send_email
	
	function getAllTlEmail(){				
			$result = $this->erc_admindb->getAllEmailTl();
			
        	echo json_encode($result);				
	}//end of getCollegeList
	
	function power(){
		if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];
			   
	  
			    if($session_data['user'] == 1){			
						$this->load->view('admin_task');
				}else{ redirect('home/erc', 'refresh'); }
			}else{
				     //If no session, redirect to login page
			     redirect('home/erc', 'refresh');
			}
		
	}
	
	public function getTeamList(){
			if($_GET){								
				$theme = $this->input->get("tm");			
				
				$result = $this->erc_admindb->getTeamList($theme);								
	        	echo json_encode($result); 
			}	
	}//end of getCollegeList
	
	public function getHubList(){
			if($_GET){								
				$theme = $this->input->get("tm");			
				
				$result = $this->erc_admindb->getHubinfo($theme);								
	        	echo json_encode($result); 
			}	
	}//end of getCollegeList
	public function send_ack_mail($email){
		

		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Flex-Printing-Verified";
		$message =
"Dear Participant,

Thank you for sending the image of your arena. Your flex printing looks perfectly fine. Please make sure that you keep the printed flex safe in a dry place avoiding any damage to the arena.

We will keep you posted on your next task very soon.

For any doubt please mail us at : helpdesk@e-yantra.org.
					
Best wishes,
e-Yantra Team";
		$m->addTo($email);	
		//$m->addTo('shaileshjain1990@gmail.com');
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);	
			
	}
	
	public function approveFlag(){
			if($_GET){								
				$teamId = $this->input->get("hubid");					
				//$this->erc_admindb->approveFlag($teamId);	
				//$email = $this->erc_admindb->getUserName($teamId);
				//echo $email;
				//$this->send_ack_mail($email);
			}
				
	        //echo json_encode($result); 	
	}//end of getCollegeList
	
	public function emergency(){
		if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];
			   
	  
			    if($session_data['user'] == 1){			
						$this->load->view('admin_teamDetail');
				}else{ redirect('home/erc', 'refresh'); }
			}else{
				     //If no session, redirect to login page
			     redirect('home/erc', 'refresh');
			}
	}
	
	
	public function emergencyredOn(){
		system('python tcp_client_red.py');
		redirect('admin/emergency','refresh');
	}
	
	public function emergencyyellowOn(){
		system('python tcp_client_yellow.py');
		redirect('admin/emergency','refresh');
	}
	
	public function getTeamDetails(){
		if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in'); 	  
			    $data['loginId'] = $session_data['id'];	
				$data['user'] = $session_data['user']; 
		      	$data['username'] = $session_data['username'];	
				$data['survey'] = $session_data['survey'];
			   
	  
			    if($session_data['user'] == 1){			
						$input = $this->input->post('inputEmail');
						
						if(filter_var($input, FILTER_VALIDATE_EMAIL)){
							$teamId = $this->erc_admindb->getTeamId($input);
							if($teamId != NULL){
								$data['otherResult'] = $this->erc_admindb->getTeamOtherDetails($teamId);	
								$data['result'] = $this->erc_admindb->getTeamDetails($teamId);
							}		
							$this->load->view('admin_teamDetail',$data);
						}else{
							$data['otherResult'] = $this->erc_admindb->getTeamOtherDetails($input);						
							$data['result'] = $this->erc_admindb->getTeamDetails($input);		
							$this->load->view('admin_teamDetail',$data);
						}
				}else{ redirect('home/erc', 'refresh'); }
			}else{
				     //If no session, redirect to login page
			     redirect('home/erc', 'refresh');
			}
	}
		
		
}//end of admin class	
?>		