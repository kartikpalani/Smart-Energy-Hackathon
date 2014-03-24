<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Teamprofile extends CI_Controller {

  function __construct(){
    parent::__construct();
	$this->load->model('erc_database');
	include ('SimpleEmailService.php');		
  }//end of constuctor

  function index(){
    if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];
			   
	  
			  if($session_data['user'] == 0){			  	  	
				
				  $collegeDetail = $this->erc_database->getCollegeDetail($session_data['id']);					    
				  $data['collegeDetail'] = $collegeDetail;   
				  
				  $teamMember = $this->erc_database->getTeamMember($session_data['id']); 
				  $data['teamLeader'] = $teamMember;
				  //echo json_encode($teamMember);
				  
				  $grpimg = $this->erc_database->getGrpPic($session_data['id']);
				  $data['grpimg'] = $grpimg;
				  
				  $shippingaddress = $this->erc_database->check_shipping_address($session_data['id']);
				  
				  $data['shippingaddress'] = $shippingaddress;
				  
				  $this->load->view('teamprofile_view', $data);
			   }else{
					//echo 'Admin';			
					//$this->load->view('admin_view', $data);
					redirect('/admin');
			   }
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}	
  }//end of index function
  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home/erc', 'refresh');
  }//end of logout
  
  function logout1()
  {
    $this->session->unset_userdata('quiz_logged_in');
    session_destroy();
    redirect('home/quizlogin', 'refresh');
  }//end of logout
  
  function getTeamMemberProfile(){
  		
	if($_GET){
		$memberId = $_GET['memberId'];	
		$memberDetail = $this->erc_database->getTeamMemberProfile($memberId);  
		echo json_encode($memberDetail);
		}
  }//getTEamMemberDetails
  
  function updateUserDetail(){
	if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];
			  $data['theme'] = $session_data['theme'];	 
	  
			  if($session_data['user'] == 0){			  	  	
				
				  $collegeDetail = $this->erc_database->getCollegeDetail($session_data['id']);					    
				  $data['collegeDetail'] = $collegeDetail;   
				  
				  $teamMember = $this->erc_database->getTeamMember($session_data['id']); 
				  $data['teamLeader'] = $teamMember;
				  
				  $grpimg = $this->erc_database->getGrpPic($session_data['id']);
				  $data['grpimg'] = $grpimg;
				  //echo json_encode($teamMember);
				  if($_POST){
					$id = $_POST["memberId"];	
					$profile = array(
						'contact'=> $_POST["contact"],
						'branch'=> $_POST["branchName"],
						'year'=> $_POST["year"],
						'gender'=> $_POST["gender"],
						'address'=> $_POST["address"]
					);
					$this->erc_database->updateMemberProfile($id,$profile);  
				  }
			      
			      $this->load->view('teamprofile_view', $data);
			   }else{
					//echo 'Admin';			
					$this->load->view('admin_view', $data);
			   }
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}
  }//end of updateUser
  
  function sendCollegeDetails(){
  		if($_POST){
  			$detail = array(	
  				'from' => $_POST["fromemail"],
  				'state' => $_POST["state_1"],
  				'collegeName' =>  $_POST["collegeName_1"],
  				'collegePin' => $_POST["pincode_1"],
  				'collegeAddress' =>  $_POST["collegeaddress"]  				
			);
		    
		    $this->send_email($detail);		
			$this->session->set_flashdata('msg', 'success');	
			redirect('/home/newuser', 'refresh');				
		}
		//echo "Collge details";
  }//end of sendCollegeMail
  
  function send_email($data){
			
		
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Email-Add-New-College";
		$message = $data['collegeAddress'];
		$message =
"Dear Participant,
				 
We have received your college details. 
		
The details given by you are as follows : 
		
--------------------------------------------
College Name :  $data[collegeName]
College Address : 
$data[collegeAddress]
College Pincode : $data[collegePin]
College State : $data[state]
-------------------------------------------
		
The college name will be added to our list in within 24 hours. 
	
For any doubt please mail us at : helpdesk@e-yantra.org.
					
Best wishes,
e-Yantra Team";
		$m->addTo($data['from']);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('helpdesk@e-yantra.org');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_email
	
//Send acknowledgement mail of college added	
	
function send_acknow($email){
			
		
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-College-Added";
	
		$message =
"Dear Participant,
				 
We have added your college name in the college list.

You can now complete the registration process.

For details visit : http://portal.e-yantra.org/home/newuser


Best wishes,
e-Yantra Team";
		$m->addTo($email);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('helpdesk@e-yantra.org');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_email
	

	function bookslot(){
		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];
			  
			  $result = $this->erc_database->checkBookedSlot($data['loginId']);
			  
			  if($result != FALSE){
				  foreach ($result as $i) {
				  	  $data['date'] = $i->date;
					  $data['booked'] = $i->start;
				  }
			  }else $data['booked'] = "NONE";
			  
			  $result = $this->erc_database->checkProfileComplete($data['loginId']);			
			  $data['profilecomp'] = $result;
			  	  			 			  
			  $this->load->view("bookslot_view",$data);
		}else{
			  redirect('home/erc', 'refresh');
		}	  
	}//end of bookslot
	
	function getSlot(){				
			//$this->load->model('Erc_database');	
			$bookingSlot = array ('00:00:00','01:00:00','02:00:00','05:00:00','06:00:00','07:00:00','08:00:00','09:00:00','10:00:00','12:00:00','13:00:00','14:00:00','15:00:00','17:00:00','18:00:00','19:00:00','20:00:00','21:00:00','22:00:00','23:00:00');
			$availableSlot = array();
			if($_GET){
				$date = $_GET['date'];			
				$result = $this->erc_database->getSlot($date);
                //print_r ($result);
				if(count($result) > 0){
					foreach($bookingSlot as $i){
						//$counts = array_count_values($result);
						
						//echo $counts[$i];
						$count = count(array_keys($result, $i));
						//echo $count.$i;
						if($count < 8){
							array_push($availableSlot, array('start' => $i));
						}						
					}
					echo json_encode($availableSlot);
				}else{
					foreach($bookingSlot as $i)
						array_push($availableSlot, array('start' => $i));
					
					echo json_encode($availableSlot);
				}			
        		
			}		
	}//end of getSlot
	
	
function send_slotbook($username,$password,$slotbook){
			
		
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Time-Slot-booked-e-YRC#$slotbook[teamId]";
		$message =
"Dear Participant,
				 
Your Time slot for the online quiz test is booked successfully. 

The online test is scheduled on Date: $slotbook[date] Start Time: $slotbook[start] 

For details visit : http://portal.e-yantra.org/home/quizlogin

Username : $username 

Password : $password

The syllabus and practice test is avaialbe at above link.

Note :  

Each time slot is open exactly for one hour and duration of the online test is 30 minutes. All the 4 team members must login within first half hour of their assigned time slot, after which the time slot closes; No logins are allowed after 30 minutes from the beginning of a time slot assigned to a team. 

Best wishes,
e-Yantra Team";
		$m->addTo($username);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_email
		
	//exam slot is used to book the online quiz date
	function examslot(){					
		if($this->session->userdata('logged_in')){
	      	 $session_data = $this->session->userdata('logged_in'); 	  
		     $data['loginId'] = $session_data['id'];	
			 $data['user'] = $session_data['user']; 
	      	 $data['username'] = $session_data['username'];	
			 if($_POST){			
				$slot_data = array(
				'date'=> $_POST["datepicker"],
			    'start'=> $_POST["timeslot"],
				'teamId'=> $_POST["teamid"]						
				);
			$this->erc_database->addSlot($slot_data);  
			$result = $this->erc_database->getTeamMemberDetails($_POST["teamid"]);
			//$j = 1;
			//$teammember = array();
			foreach ($result as $i) {
				$this->send_slotbook($i->email,$i->contact,$slot_data);
				//$teammember['email'.$j] = $i->email;
				//$teammember['contact'.$j] = $i->contact;
				//$j++;
			}
			 //$this->send_slotbook($teammember);		
			}
			//$this->load->view('bookslot_view', $data);
			redirect('teamprofile/bookslot', 'refresh'); 
		}else{
			redirect('home/erc', 'refresh');
		}			
	}//end of exam slot
	
	function addCollegeDetails(){
		
		if($_POST){
			//insert login Details 							
			$collegeDetail = array(
				'state'	  => $_POST['state'],
				'collegeName' => $_POST['collegeName'],
				'pincode' => $_POST['pincode']
			);
			$email = $_POST['email'];
			$this->erc_database->addCollege($collegeDetail);
			 $this->send_acknow($email);		
			redirect('home/addcollege');
		}
	}//end of addCollegeDetails
	
	function submitsurvey(){		
		if($_POST){
  			$detail = array(	
  				'teamId' => $_POST["teamId"],
  				'received' => $_POST["poster"],
  				'source' => $_POST["source"],
  				'other' =>  $_POST["inputOther"]  				  				
			);
			$emailid = $_POST["email"];
			
		    $this->erc_database->updateflag($_POST["teamId"]);
			$this->erc_database->addSurvey($detail);
		    
			
			$this->session->set_flashdata('msg', 'success');			
			redirect('teamprofile','refresh');	
							
		}
	}//end of submitsurvey
	
	function testfaq(){
	if($this->session->userdata('logged_in')){
			
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	 
	  
			  if($session_data['user'] == 0){			
			      $this->load->view('testfaq',$data);
			   }else{
					//echo 'Admin';			
					$this->load->view('admin_view', $data);
			   }
	}else if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	 
			  				  
			   $this->load->view('testfaq',$data);
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}
  }//end of testfaq
	
  function checkProfileComplete(){
  		if($_GET){
			$teamId = $_GET['teamId'];	
			$result = $this->erc_database->checkProfileComplete($teamId);			
			echo json_encode($result);
		}  	
  }	//end of checkProfileComplete
  
  function intfrd(){
  		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];			   
	  
			  if($session_data['user'] == 0){				  
				  $this->load->view('intfrd',$data);
			   }else{					
				  redirect('/admin');
			   }
		  }else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
  }  	
  }
  //this is for after quizlogin 
  function intfrd1(){
  		if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];	  
			  $result = $this->erc_database->getSlotBookedData($data['loginId']);
			  $ressult_test_attempt = $this->erc_database->check_test_attempt($session_data['id']);
			  
			  foreach ($result as $i) {
				  	  $data['date'] = $i->date;
					  $data['start'] = $i->start;
			  }
			  
			  foreach ($ressult_test_attempt as $i) {
				  	  $data['test_attempt'] = $i->testattempt;					  
			  }
			  			  				  
			  $this->load->view('intfrd1',$data);
			   
		  }else{
	      //If no session, redirect to login page
	      redirect('home/quizlogin', 'refresh');
  }  	
  }
  
   //this is for after quizlogin 
  function intfrd2(){
  		if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];	  
			  $result = $this->erc_database->getSlotBookedData($data['loginId']);
			  $ressult_test_attempt = $this->erc_database->check_posttest_attempt($session_data['id']);
			  $check_feedback = $this->erc_database->check_postfeedback_status($data['username']);	  
			  	
			  	if($ressult_test_attempt == 0){		  			  				  
			 		 $this->load->view('intfrd2',$data);
				
			  	}else if($check_feedback == FALSE){
			  		$this->load->view('postsurvey',$data);
		  		}
				else{
			  		$this->load->view('result',$data);
			  	} 
		   
		  }else{
	      //If no session, redirect to login page
	      redirect('home/quizlogin', 'refresh');
  }  	
  }
  //this is for the syllabus view page
  function syllabus(){
  		if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $this->load->view('syllabus',$data);
			   
		  }else{
	      //If no session, redirect to login page
	      redirect('home/quizlogin', 'refresh');
  	
  		}
  	}// end of function syllabus
		  
  function sndinvite(){
  		 if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];			   
	  
			  if($session_data['user'] == 0){
			  	  $file = fopen("contact.txt");				  
				  $frdContact = $_POST['frdcontact'] ;				  
				  for($i=0; $i < sizeof($frdContact);$i++){
				  	//echo $frdContact[$i];
					file_put_contents($file, $frdContact[$i].";", FILE_APPEND | LOCK_EX);  
				  }
				  fclose($file);
			   	  redirect('/teamprofile');	  
			   }else{					
				  redirect('/admin');
			   }
		  }else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
  		  }
  }
  
  function send_invite($email){
			
		
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-Yantra-Invitation";
	
		$message =
"Dear User,


e-Yantra provides a platform for students to demonstrate their programming skills in Embedded system and Robotics. 

For details please refer to : http://www.e-yantra.org/

We also request you that Do 'Like' us on Facebook to get all the latest news & updates regarding not just the competition but also other interesting robotic stuffs happening around us. You can also participate in our polls, discussions and provide us with some invaluable feedback to help us progress.

Visit : https://www.facebook.com/eyantra


Best wishes,
e-Yantra Team";
		$m->addTo($email);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_email
	
	function to_all(){
			
		$email = "shrey.sms1993@yahoo.in,11bitkarthikeyan@gmail.com,vegassimha@gmail.com,nikmogare281993@gmail.com,koul.oshin@gmail.com,anirudhsaxena@hotmail.com,trupti.220395@gmail.com,rambhiavineet@gmail.com,binit.bkumar.18@gmail.com,g.shiva59@yahoo.in,vishal.karathiya@yahoo.in,arunrtx@gmail.com,sumitpadamwar@gmail.com,shivamarrora@gmail.com,ronfratom@gmail.com,srinidhim3@gmail.com,vinayak.sansiya@gmail.com,deepakkillerboy@gmail.com,sunny23june@gmail.com,vibhorsharma0001@GMAIL.COM,kganesamanianthanu@gmail.com,Shashank3793@gmail.com,swap22.8@gmail.com,yogeshbobade18@gmail.com,adisainaath@gmail.com,shellyec1089@gmail.com,abhivankit@gmail.com,anushaeceswec@gmail.com,ashutosh.tadkase@gmail.com,msp.patil00@gmail.com,ravalmaitry@yahoo.com,diptissakpal93@gmail.com,mdpota@gmail.com,shivafarkade@gmail.com,kumarmsec1119@gmail.com,theressa.bernard@gmail.com,hotrock.sayan2@gmail.com,ikushal008@gmail.com,rameshkadam61@gmail.com,ganeshram997@gmail.com,jitendrapoddar24@gmail.com,dhomblechaitali01@gmail.com,nityanandthakur7@gmail.com,sumanthnr93@gmail.com,nitesh151193@gmail.com,misalajay2@gmail.com,palyantra2013@gmail.com,shyamferrari12@gmail.com,vinu.logurani@gmail.com,abgharge@yahoo.com,feliceguy@gmail.com,amberasit1993@gmail.com,gaurav.chhabra2010@gmail.com,sukhumar123@gmail.com,arv3100ind@gmail.com,nivikiot@gmail.com,virenrohra3@gmail.com,vishal.145@hotmail.com,sspsourabhpatil@gmail.com,abhay.sancheti43@gmail.com,shrinath.sridharan@gmail.com,Mr.arunprakash@gmail.com,dcdark.dipu@gmail.com,vivekangadi@gmail.com,rashmi.hkulkarni@rediffmail.com,mtbhalodia7@gmail.com,rajatnituk@gmail.com,shiwani14393@gmail.com,aag2995@gmail.com,avi_ias2006@yahoo.co.in,preeti.ochani@yahoo.com,sinashu4089@gmail.com,hotncoolharry@gmail.com,rahul.bhambere@gmail.com,sridevimepcoeee@gmail.com,grgokul00@gmail.com,shankar.kumar11092@gmail.com,tarun.kr1471@gmail.com,rjyogesh93@gmail.com,1shashankpv@gmail.com,jadhavan94@gmail.com,navjot.buntisidd@gmail.com,velu.7979@gmail.com,keerthanamsraj@gmail.com,thilaga1992@gmail.com,sangeeth.k92@gmail.com,sbm010492@yahoo.in,piyushverma2011@gmail.com,amardipsabale@yahoo.com,rahulchaturvedi212@gmail.com,baraiyaramesh75@gmail.com,rakesh.r@students.iiit.ac.in,dinkar06@gmail.com,shubhamsingh0160@gmail.com,karuslika@gmail.com,royabhay99@gmail.com,aareeb.khan.khan@gmail.com,usharanikankipati@gmail.com,rgk2303@gmail.com,ameya555@gmail.com,pvimalerts@gmail.com,t.naveenmani@gmail.com,dfasdasd@gadsfa.com,anirudhprasad18@yahoo.com,vishalpatilvip@gmail.com,vedika.atrey@gmail.com,gopipgm@gmail.com,ashwinsiet510@gmail.com,mandarmg2912@gmail.com,skywater1994@gmail.com,nirmal222lamrin@hotmail.com,shashankkadam29@gmail.com,ngpnaveen@gmail.com,richard.noronha24@gmail.com,arjun4june@gmail.com,gyanendrapandey756@gmail.com,salman.sam07@gmail.com,madugulamounika@gmail.com,mugundhansboa@gmail.com,akashmasne@gmail.com,dhaval_chauhan2155@yahoo.in,AIRFORCEHARISH@GMAIL.COM,danishaju@gmail.com,maheshkumarsel@gmail.com,karthick.eee@outlook.com,someshwardutta@gmail.com,ninuprasad07@gmail.com,gargirvarma@gmail.com,ramakrishnanbijoy@gmail.com,chinmaylad@ymail.com,venkatkrish20@gmail.com,vignesh31794@gmail.com,rahulsamrat007@gmail.com,prashantdhekane222@gmail.com,pranjali2610@gmail.com,akash24k@gmail.com,b.saravanakumar007@gmail.com,JIVABHAIJADEJA081@GMAIL.COM,sonawaneprafull00@gmail.com,vivekarya6233@gmail.com,deshpande.uday6@gmail.com,krantikumarpatil021@gmail.com,kjaggal@gmail.com,mratikpat12@gmail.com,dipanshu.daga12@gmail.com,krunalm91@gmail.com,joshipallum@gmail.com,merinsania@gmail.com,sshlkmr998@gmail.com,biradarkishor@gmail.com,deeksha94smg@gmail.com,sampatnamrata@gmail.com,kushalparmar93@gmail.com,rohit15augt@gmail.com,amey2994@gmail.com,zealhunters2014@gmail.com,ronakss.rj@gmail.com,niki.nikithareddy@gmail.com,devisettymoulica@gmail.com,uts.saxena08@gmail.com,r_suraj18@rediffmail.com,deepalijoshi16@gmail.com,rajith.tharakkal@siesgst.ac.in,arunbalasankar@gmail.com,chaitanyabhandari01@gmail.com,upreethieee@gmail.com,chinmay.9@gmail.com,viddu93@gmail.com,hpharrry67@gmail.com,nikhil.chandan1@gmail.com,vimalertsb@gmail.com,akhilvarghesepaul007@gmail.com,prudhvinandan2@gmail.com,sabyasachi.moulik@yahoo.co.in,sagarbhambu@gmail.com,shaungreat.usa@gmail.com,zahranmhaskar@gmail.com,ankitanand2007@gmail.com,abhishek150891@gmail.com,shubham.sonarghare@gmail.com,gopikrish.rgk03@gmail.com,saurabh1201994@gmail.com,malathibalu94@gmail.com,sasiperumal.r@gmail.com,dikshaparihar32@gmail.com,yuvrajbhandari85@gmail.com,vkpise@gmail.com,vkpise@gmail.com,poojabchaudhari@gmail.com,sahil.lakhwani@rediffmail.com,pratikshakamble.etc@mmcoe.edu.in,pradeepameceee2014@gmail.com,paunjisucksassp1@gmail.com,karishmaharogeri@gmail.com,maheshravi415@gmail.com,neectron@gmail.com,desaleyogesh27@gmail.com,b.saravanakumar1992@gmail.com,abhi_shetty@hotmail.com,singhanshu1992@gmail.com,kokare.darshan@gmail.com,surajpremkumar12@gmail.com,akhilrawat08@gmail.com,chaitanyadoke@gmail.com,dhruvmishra00@gmail.com,mayuptl@gmail.com,mohitpk93@gmail.com,sainip43@gmail.com,hakuothelightmaster@gmail.com,kalyankoushik20@gmail.com,anikesh.rockz@gmail.com,somusangaraju@gmail.com,kalyanisumavishnu@gmail.com,agpadmanaban@gmail.com,vbkumara23@gmail.com,sidharthjohn@gmail.com,pnshdr@gmail.com,dkinnu.kinnu@gmail.com,rajas.srg@gmail.com,sivakaviya@gmail.com,smit.nalkande@gmail.com,jomj.jom@gmail.com,allanscaria08@gmail.com,akshaykhatri639@gmail.com,kumarvivek389@gmail.com,kietsanjana@gmail.com,lakshadeep.naik@gmail.com,tanay.vaidya1@gmail.com,jsavaliya08@gmail.com,swaetharama@gmail.com,PASSION.0975@GMAIL.COM,roopam.mahi92@gmail.com,divya.ukkalam@gmail.com,prashantagejapati@gmail.com,abhakhs@gmail.com,kishoriafzulpurkar@gmail.com,mahimatarika@yahoo.com,abythayil@gmail.com,neha7angel@gmail.com,indu2159@gmail.com,smswapnil1991@gmail.com,agarwal.shristy1@gmail.com,anishfrozone@gmail.com,sumedhkulkarni7@gmail.com,ismeyantra@gmail.com,sanket.drake@gmail.com,mirroramar@gmail.com,Adityalandge1994@hotmail.com,Nair.deepakg@gmail.com,ajnituk@yahoo.com,ajinkya.jadhav85@gmail.com,er.deepsharma93@rediffmail.com,madhuri070293@gmail.com,mayurij2611@gmail.com,shitalssbt1994@gmail.com,PREMKUMARKNK@gmail.com,supriyapatil64@ymail.com,kulsungepankaj@gmail.com,prasadsawant7@gmail.com,nikhilbharatkar10@gmail.com,chaitanyaramji@ymail.com,shreyas.deshpande19@gmail.com,konammsgariprathyusha@gmail.com,maniishing@gmail.com,neeharikavirat@yahoo.com,lakshyagarg.nitc@gmail.com,arunrj143@gmail.com,sangavee94@gmail.com,gtkirankumar31@gmail.com,chaudharimira3@gmail.com,pranav.agarwal1@gmail.com,kalpeshbadgujar3@gmail.com,deelovesakky@gmail.com,contactdarun@gmail.com,anu.talupula@gmail.com,anu.aggarwal296@gmail.com,akshayijantkar23@gmail.com,skp.saurabh5@gmail.com,pritisudha5@gmail.com,pratikkhandait@gmail.com,anunaymahajan@hotmail.com,naveenkumar273@gmail.com,mayurirathod1993@gmail.com,sanketchaudhari@hotmail.com,shantanu.guptacomp@gmail.com,rjtkataria1993@gmail.com,rohit.bobade@gmail.com,rajdeepak8051@gmail.com,vineshrajav@gmail.com,salma.eyantra@gmail.com,ashwin4435@gmail.com,ambergargrish@yahoo.com,vkgkulkarni@gmail.com,ulkakhadke@gmail.com,d_rujul@yahoo.co.in,verma.kanak4@gmail.com,udayakumareee2014@gmail.com,darshansonar2@gmail.com,v.selvagiri@gmail.com,bhushans.kale@gmail.com,vysakh.mohan93@gmail.com,ynsetcem007@gmail.com,gethsiyalpriya@yahoo.com,amritkumbhakar@gmail.com,debasishmishra51@gmail.com,anandha007krishnan@gmail.com,shrivardhangore@gmail.com,shailendrapatil147@gmail.com,ketan.kaul02@gmail.com,guptaaakash59@gmail.com,mehtakamesh1234@gmail.com,kishan9016248488@yahoo.com,ruchinchaudhary99@gmail.com,ronak199323@gmail.com,akshi1311@gmail.com,vchaudhari8993@gmail.com,pooji2201@gmail.com,hrishikeshadn@gmail.com,komalgt4@gmail.com,sashi.dheeraj@gmail.com,amruta_duduskar25@yahoo.com,shahmalay1993@gmail.com,a.thali1994@gmail.com,jishnuv@ieee.org,amitnitd@gmail.com,shravalrana@gmail.com,varun_dua2003@yahoo.com,HarshavardhanG3@gmail.com,k.madagouda@gmail.com,rahul.mhatre93@gmail.com,arwaarif1994@gmail.com,vishal.bhattacharjee55@gmail.com,nits.rajgk@gmail.com,sangrambhavar@gmail.com,amarmardhekar@rediffmail.com,aapbrothers@gmail.com,singamaneniphani.teja@students.iiit.ac.in,abhi2counts@gmail.com,pratikpatil500@ymail.com,psruthi8294@gmail.com,hnchauhan9@gmail.com,mahendra8320@gmail.com,madan.avhad@gmail.com,sagarika.madnani@yahoo.in,nazdac@yahoo.com,deepgandhi8@gmail.com,SID.THAKRAR@GMAIL.COM,brindians@gmail.com,skatkar11@gmail.com,beena.nagas@gmail.com,mohandass.psgrobo@gmail.com,kaluvateja19@gmail.com,abhi66sekhar@gmail.com,gm.vigne5h07@gmail.com,nikhildinpure@gmail.com,hardijoshi07@gmail.com,abhinavp9873@gmail.com,nikhilraman@yahoo.com,nitesh.sakpal@gmail.com,aish466@gmail.com,shyamnandank158@gmail.com,aparichitshiv@gmail.com,chvinay17@gmail.com,shashanknigam40@gmail.com,hstmdn1204@gmail.com,sakesyed@gmail.com,naseer@akshar.co.in,aroranidhi10@gmail.com,leena3911@gmail.com,jatinsapra2008@gmail.com,chhabrasbm@gmail.com,kavi.arya@gmail.com,puneet.3743@gmail.com,ramya.nandipati18@yahoo.com,ajit.sonu2@gmail.com,adapamurthy007@gmail.com,nrlprk85@gmail.com,chetankushwaha0@gmail.com,pranavmekkadan@gmail.com,goelananya2@gmail.com,01shubham10@gmail.com,akshay.khaladkar93@gmail.com,ghatugadesweety@gmail.com,garg_akshay@yahoo.com,amolbaykar@india.com,navleshgavhale777@gmail.com,ashishdoke111@gmail.com,nishadasthagir@gmail.com,karthi10ece@gmail.com,kedarkasarpatil22@gmail.com,ajinkya.pawar847@gmail.com,sharma_rohit1993@yahoo.com,gnana.kabilai@gmail.com,krish.achar2112@gmail.com,manikthorbole09@gmail.com,sohamganatra@gmail.com,amiteshmohite999@gmail.com,ji4mech@gmail.com,sparshjainsj20@gmail.com,ketanbhat980@gmail.com,s.purnish@yahoo.com,kumar.amlesh077@gmail.com,sayakdx10@gmail.com,gheeghee77@gmail.com,neeraj.k17@gmail.com,naman.govil@students.iiit.ac.in,ksoni004@gmail.com,Narendrachowdary058@gmail.com,sneha.sunshine9@gmail.com,sadique1565@gmail.com,anirudhprasad18@gmail.com,sidhant25@hotmail.com,mahendrasridattacheekati@gmail.com,niksh.bansal@gmail.com,gurshaantsingh.malik@students.iiit.ac.in,himanshutiwari@gmail.com,zeshane.khan@gmail.com,shivamgupta1001@gmail.com,jijoveliyath@gmail.com,khanzeshane@gmail.com,thejusjoby@gmail.com,anakakmr@gmail.com,uvapriya93@gmail.com,sandeep0803@hotmail.com,harish.rv5@gmail.com,www.bante_manish@rediffmail.com,jayeshpashilkar@gmail.com,rahul.cp888@gmail.com,girishhp03@gmail.com,ragura481@gmail.com,joshuavettel@gmail.com,sagardy22@gmail.com,india_cp@yahoo.com,ainamdar92.ai@gmail.com,vishantsingh94@gmail.com,souvikroy73@gmail.com,rsushmitharamesh@gmail.com,jerrinprasad@gmail.com,rawat1993@ymail.com,fantasticv04@gmail.com,ashutoshshrivastav007@hotmail.com,akhtha22@gmail.com,bancypatel@gmail.com,darshb34@gmail.com,edwinyeasu@gmail.com,dhawarerohini@yahoo.com,lohithareddy0426@gmail.com,sksahu101294@gmail.com,rajatakre@gmail.com,siddhuyeturi@gmail.com,qureshiminaz@gmail.com,mayank.singh1603@gmail.com,chandanmahto001@gmail.com,tejasdj12@gmail.com,gutsy.gulati@gmail.com,thenani2012@gmail.com,bewithjobin@gmail.com,buttu.28@gmail.com,nishita2693@gmail.com,jesusanusha777@gmail.com,pramothpamu@gmail.com,prasadingle10@gmail.com,ahteshamshaikh@live.com,nik28july@gmail.com,girishauti84@gmail.com,nidhi.nair93@gmail.com,usha.pinku22@gmail.com,sharadpani7@gmail.com,karthik92vscet@gmail.com,puneethr063@gmail.com,gayatri.nair194@gmail.com,4444ashwin4444@gmail.com,indra.ipd@gmail.com,rajat.gupta@sitpune.edu.in,noormohammed532@gmail.com,kishsaharia21@yahoo.com,heeralshethia@gmail.com,ssgaokar1409@gmail.com,bhavikparekh51@gmail.com,abh.singh90@gmail.com,pranshu777@gmail.com,tusharsanap7@gmail.com,girisandeepkumar01@gmail.com,gurwinderbirsingh@yahoo.com,jawad_1018@yahoo.com,sundubalacool@gmail.com,jagtejgogo@yahoo.com,atulmalhotra93@gmail.com,ashwin.s.ravi@gmail.com,atishd12345@gmail.com,anand_10594@yahoo.com,rajeevhits040@gmail.com,sanjeethits054@gmail.com,lakshanareddy421@gmail.com,tkpandey001@gmail.com,aayush.leomessi@gmail.com,amey.sutavani@gmail.com,girish_bhupati@yahoo.com,aarthypoornila@yahoo.com,koulanurag@gmail.com,rahul281292@gmail.com,npawar100@gmail.com,shaily93@gmail.com,msminhas93@gmail.com,ankita14ganu@gmail.com,maxsdhir@gmail.com,snkbit93@gmail.com,gopivardhanu7@gmail.com,shivalingesh.b.m@gmail.com,bharath875@gmail.com,karthigayan.p1979@gmail.com,shiva.iuac@gmail.com,anusingh.engineer@gmail.com,sipani.suvil@gmail.com,ksbharath94@gmail.com,shahiltp05@gmail.com,meraid.kr@gmail.com,snigdha.parthan@gmail.com,arunkumar.aarthi@gmail.com,sowmianarayanan24@gmail.com,gvikas9406@gmail.com,siachin02@gmail.com,nithinkumarssv@gmail.com,sachinmksri.1992@gmail.com,kousalyakandhasamy@gmail.com,garymalik8080@gmail.com,tapankhattar@gmail.com,riteshgpt11@gmail.com,sowmiyapalanisamybmie@gmail.com,chakridhar37@gmail.com,karishmarnjain@gmail.com,rockyrajeev93@gmail.com,aksdoshi93@gmail.com,me.raghav29@gmail.com,mohitdatta4@gmail.com,janu.jananee@gmail.com,wprath32@gmail.com,apurvamalpure@gmail.com,ashutosh1305@gmail.com,ujjwalgarg1993@gmail.com,arunshanmukam@gmail.com,nikhilambad2812@gmail.com,kgp072@gmail.com,omprasad47@gmail.com,prakhar.sharma@students.iiit.ac.in,adrij0408@gmail.com,anilagarwalgreat@gmail.com,hninetythree@gmail.com,kavyalalithamiriyala@gmail.com,Dattaraj.sansgiri@vit.edu.in,anushkakurra07@gmail.com,singhswatijitendra@gmail.com,azeem.nituk@gmail.com,sunilgummuluri@gmail.com,girishhp222@gmail.com,bhurenilesh@yahoo.in,highbrowhijaker@gmail.com,atul.danda@gmail.com,shubhamkumawat72@yahoo.in,geethamailsyou93@gmail.com,nag.nani494@gmail.com,cniraj33@gmail.com,naikaj@gmail.com,pr.sunkesula@gmail.com,hema.nivas93@gmail.com,cholekiran1820@gmail.com,harshalp94@gmail.com,patilarchana.7343@gmail.com,pramod.infinity.singh@gmail.com,ishu.gunani2@gmail.com,omikave@gmail.com,gargaksh@gmail.com,farooqfarooq28@gmail.com,arunshanmugamso@gmail.com,arun9003033204@gmail.com,pratik3879@gmail.com,singamyaswanthreddy@gmail.com,vaibhav9428@gmail.com,harsh_horizons@yahoo.com,vivekgupt.gupta1@gmail.com,sowjanyasowji00@gmail.com,viral.gokani2810@gmail.com,abhinavgadikar@gmail.com,rushixyz1@gmail.com,nikhil9as@gmail.com,athirapillai28@gmail.com,sumukhdesu@gmail.com,omprasadmn@gmail.com,natarajan2994@gmail.com,razeen1992@gmail.com,aksnitu@gmail.com,aman271198@gmail.com,supri94@gmail.com,tharun123cool@gmail.com,parthaaaa@gmail.com,pprashanth24395@gmail.com,satyavani.marneedi@gmail.com,satbir.munier93@gmail.com,thippasanimadhavi@gmail.com,wathore.prachi93@gmail.com,noorfathima029@gmail.com,sharmamanish391@gmail.com,suvarnareddy470@gmail.com,shubham100pandey@gmail.com,sawantsingh13july@gmail.com,kazierum@gmail.com,Dhruvinshah1994@gmail.com,pratyushdbest@gmail.com,akashpanwar09@gmail.com,thesagaciousshyam@gmail.com,chandramohan.amrutha@gmail.com,shwetha.kumari.a13@gmail.com,abhibhupsh@gmail.com,var.datt@gmail.com,abhibhupesh@gmail.com,abranjankar@gmail.com,ravi.rey777@gmail.com,vinkeshkalal@gmail.com,khanmohsin.92@india.com,rishabsingh.til@gmail.com,jaysanadhya.hr@gmail.com,laxkarashok71@gmail.com,dineshchandragawariya@gmail.com,ayush35475@gmail.com,devikajay@gmail.com,pavanchintawar18@gmail.com,anilvishwasrao@gmail.com,samyukta.mogili@students.iiit.ac.in,dhruvkhandelwal@gmail.com,samyukta.mogily@students.iiit.ac.in,abiverma.007@gmail.com,jaykhade2233@gmail.com,sumit964482@gmail.com,divyatandon79@yahoo.in,saif93105@gmail.com,samratsamrat41@gmail.com,keshavkulkarni0@gmail.com,sisarobotics@gmail.com,kaushiktheimmortal@gmail.com,chrominance0610@gmail.com,ct0094@yahoo.com,laligambhir@gmail.com,vaibhavvishnu.patil@gmail.com,jagdeeshpatil225@yahoo.com,pandey.shweta50616@gmail.com,dhanshreepatel94@gmail.com,YUVRAJB83@GMAIL.COM,kabhier@gmail.com,naval.mehta95@gmail.com,chiragshah271093@gmail.com,arudra.gore@gmail.com,9628raisaurabh@gmail.com,anusurisai19@gmai.com,soujanyag99@gmail.com,ramdevbabarishi08@gmail.com,crazyboys.24@gmail.com,tejeswarbharath@gmail.com,pasad.jigar@gmail.com,eshanhotcool@gmail.com,tyagiaayushkumar@GMAIL.COM,peterkjose@gmail.com,rohanchoudhary93@yahoo.com,pandugabhageerath@gmail.com,sid.cdh@gmail.com,patil_sumaa@yahoo.co.in,lingarajmanturmath@gmail.com,smsshanmugaraja@gmail.com,sukhvirsinghsohal@yahoo.com,varunkumar1994@gmail.com,haarathi457@gmail.com,vaishnav.raghuvaran@gmail.com,irfaneyantra2013@gmail.com,amol.disale@vit.edu.in,ashwini.kumar.ak14@gmail.com,naraganichiranjeevi2@gmail.com,patankarnida@gmail.com,zakir_hussain93@yahoo.com,prateekbd1@gmail.com,imrozteria420@yahoo.com,viveka2712@gmail.com,ankurmehta003@gmail.com,nmjohnson66@gmail.com,nitishsinhaji@gmail.com,manjotsingh1469@gmail.com,jindal.abhi93@gmail.com,rohanshah8396@gmail.com,siddharthagrawal43@yahoo.co.in,komalsweetgal123@gmail.com,udaykiran7779@gmail.com,shindedarshan95@gmail.com,vp2talk@gmail.com,vedanarayana.koraganji@gmail.com,Davindersingh4213@gmail.com,bmr9293@gmail.com,rohitmooo123@gmail.com,nikhilasrani@hotmail.com,richashah003@gmail.com,pratheekonline@gmail.com,aathiramanoj@gmail.com,abhinav.moudgil@students.iiit.ac.in,bawane_priyanka.ghrceet@raisoni.net,praveshundercover@gmail.com,nile649@gmail.com,gati.kumar@gmail.com,panwarakash5@gmail.com,debshubham@gmail.com,mcsreerag007@gmail.com,cvreshma17@gmail.com,parth.kolekar@students.iiit.ac.in,shaikhhassan93@gmail.com,rishabh161995@gmail.com,manjinderkhatkar@yahoo.com,gautam.vepa@students.iiit.ac.in,pranupg@gmail.com,cniraj33@yahoo.in,roopal.nahar@students.iiit.ac.in,shreya.yellapantula@gmail.com,swaruppdesh@gmail.com,avinash.kalivarapu@gmail.com,harsh_329@yahoo.com,krishna.tulsyan@students.iiit.ac.in,dylandey1996@gmail.com,v.gokulvijayan@gmail.com,abhishek.k@students.iiit.ac.in,kt.krishna.tulsyan@gmail.com,apaar.garg@students.iiit.ac.in,ssuurraabbhhii1@gmail.com,nikhilhosur23@gmail.com,gharerohan@gmail.com,adibaskar@live.com,neeruchandana007@gmail.com,viveksingla23@gmail.com,devang865@gmail.com,tanmay.sahay@students.iiit.ac.in,pinanknagda@gmail.com,haritejareddy.p@gmail.com,prkhrawasthi@gmail.com,shahbhavya.93@gmail.com,arunshanmukham@gmail.com,mrinal.dhar@students.iiit.ac.in,sravanajyothi9@gmail.com,raj454raj@gmail.com,sahilguptafdk@gmail.com,gopalrathore94@gmail.com,abhishek.alhat@sitpune.edu.in,mahasurya123@gmail.com,iyer.ramakrishnan@sitpune.edu.in,varungupta1803@gmail.com,bibhas.dash15@gmail.com,abhay9729@gmail.com,anuhya.sai@gmail.com,us.adithya@gmail.com,varunsnair1994@gmail.com,ladaninikunj69@gmail.com,ankur135@gmail.com,gouravkhanijoe@gmail.com,vishalc120893@gmail.com,sapnaajmera@ymail.com,priya.j.nadkarni@gmail.com,prabhav2006@gmail.com,sheetalbohra9@gmail.com,ronak.m@somaiya.edu,ayushmittal189@gmail.com,k.daiya@yahoo.com,sanketgupte14@gmail.com,jairun25@gmail.com,adak.priyanka3@gmail.com,krishna.shankar92@gmail.com,anushkanehra@gmail.com,hitsgoraiya@gmail.com,spal2415@gmail.com,prithul.p@gmail.com,sndsh93@gmail.com,naveensongara@rediffmail.com,dedhiyaronak@gmail.com,rajeswarig411@gmail.com,ashishdhatterwal@gmail.com,renuinece@gmail.com,akhil_neelam@yahoo.co.in,pankajmali0791@gmail.com,aliasgardabhar@gmail.com,ajitwarang@gmail.com,myselfsiddhant@gmail.com,siri.rock1993@gmail.com,dsatwikkumar@gmail.com,shivamkhare2012@gmail.com,yadav.pankaj355@gmail.com,sudeep.rajput01@gmail.com,nit.m@outlook.com,dipalibendale555@gmail.com,rochinalexx@gmail.com,vishnu1802@gmail.com,apooravgupta93@gmail.com,vipulc659@gmail.com,abhyuday.cool@hotmail.com,manojmavig1994@gmail.com,anandram.ram123@gmail.com,itsnak1993@gmail.com,naman.singhal02@gmail.com,tarpansarkar78@gmail.com,jahnavichowdary29@gmail.com,adityasri1996@gmail.com,rvgurav158@gmail.com,gauravthegreatindian@gmail.com,shrinipuru@yahoo.in,pranav_752000@yahoo.com,anil.kmedi@gmail.com,raja16sekhar@yahoo.com,srimukhakarantha@gmail.com,virtuososmailbox@rediff.com,teamsextc212a@gmail.com,pulkitmangalsdvm@gmail.com,manjunath.gayakawad@gmail.com,sbharadwaj310@gmail.com,anandpopat@gmail.com,mishranitin2011@yahoo.com,vivek.suhanda@gmail.com,anmol.gupta1005@gmail.com,neha.parastish2011@gmail.com,manasa.lingamallu@students.iiit.ac.in,anandpopat9@gmail.com,spurusha@yahoo.com,sudeshdevi114@gmail.com,surajmore009@gmail.com,venkata.takkella@students.iiit.ac.in,syammohan2103@yahoo.com,prayag.ip@gmail.com,upparanithiya.shree@students.iiit.ac.in,snamitta@gmail.com,singhakhil33@gmail.com,sneha.kulkarni52@gmail.com,shivanandk58@gmail.com,sambuddha.basu@students.iiit.ac.in,vsaravanaprasanth@gmail.com,deshpande.apoorva17@gmail.com,akshayshruthi@yahoo.in,mituldp11@gmail.com,abm.110@live.com,ashwin.vivek7@gmail.com,pavithra.swami5@gmail.com,karandas90@yahoo.in,shivansh.2931993@gmail.com,mahalekshmi18@gmail.com,kunalbhalerao10@gmail.com,bhaskertaneja1995@gmail.com,joyrachel94@gmail.com,Saurabhjtp@gmail.com,rashmitha.nk@gmail.com,akhil.batra898@gmail.com,unknownwasmissing@gmail.com,vijay.prasad990@gmail.com,shrikantsharmaae1011@mriic.in,mvenkatesh1703@gmail.com,govindraj.1993@gmail.com,007ajaykarangale@gmail.com,pratikadam1234@gmail.com,stutiramola@gmail.com,chethan.venradhar@gmail.com,chaitanya.cricket@gmail.com,mishra4421@gmail.com,pskantha@yahoo.in,akashchavan011@hotmail.com,archanayantra@gmail.com,teenluvgames@gmail.com,kamblepravin65@gmail.com,arun3491@gmail.com,minal.0493@gmail.com,man.amujuri@gmail.com,rajemahesh777@gmail.com,teamynot92@gmail.com,vijjusprincess@gmail.com,jaisonphilip3@gmail.com,dhiman6595@gmail.com,naveenkumar250893@gmail.com,ytyagi03@gmail.com,sreekarchodavarapu09@gmail.com,dhruva.das@students.iiit.ac.in,pavan.allenki454@gmail.com,prashanth.rid@gmail.com,sandeep.viji11@gmail.com,saikomal.chanagam@gmail.com,polsaurabh275@gmail.com,kumar.himalaya26@gmail.com,festio94@yahoo.co.in,azakmerem@gmail.com,chaputchakma03@gmail.com,vishal_valluvan@yahoo.com,nalandajoshi@yahoo.com,nikhil04.arora@gmail.com,nikhildaliya@gmail.com,sriprakashkolluri@gmail.com,pruthvija23@gmail.com,nirajsalunkhe@hotmail.com,singhprerna106@gmail.com,kakadedipali1111@gmail.com,gauthamanchandran@gmail.com,satyarepala3@gmail.com,leezabarde112@gmail.com,nalanda95joshi@gmail.com,coolmishra27@gmail.com,k.ramachandran64@yahoo.com,fulloffun8@gmail.com,nishanth127127@gmail.com,noelpck@gmail.com,datchu.ss.1@gmail.com,sarat.vvs55@gmail.com,s.g.sridu@gmail.com,srikanthvangajala@gmail.com,agarwaladarsh95@yahoo.in,gauravvashist92@gmail.com,thilak.ece92@gmail.com,manojkarthick@ymail.com,akshay1412@gmail.com,ps.sivaselvakumar@gmail.com,rama241994@gmail.com,rajart0107@gmail.com,taruntprd07@gmail.com,mshaktiswarup@yahoo.com,bokeydeshmukh@gmail.com,ayush6mittal@gmail.com,charanjit.jolly@gmail.com,sumeetchanged007@gmail.com,shubforever1994@gmail.com,dharmendrachaubey9@gmail.com,nikkibb05@gmail.com,kmahajan18@gmail.com,banu26p@gmail.com,aravapallichandu@gmail.com,rahul.rrr093@gmail.com,atyamsriharsha@gmail.com,gandhigauri@rediffmail.com,ravivarma053@gmail.com,meet81193@gmail.com,bhaskartaneja1995@gmail.com,deshmukhchetan96@gmail.com,prmsnth@gmail.com,akash151293@yahoo.in,aakash.m3gtr@gmail.com,dheeraj.gattupalli@students.iiit.ac.in,parbhat123puri@yahoo.in,alphaone@sharklasers.com,mimit.vivek@gmail.com,shwetajain0103@gmail.com,sohan.gadri55@gmail.com"; 
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Results";
	
		$message =
"Dear Team Leader,

We thank you for your participation in the selection stage of the e-Yantra competition.

We regret to inform you that you have NOT been shortlisted for the e-Yantra Robotics Competition 2013.

We value your interest in e-Yantra and hope that we might have another chance at engaging with you sometime. Wishing you all the very best in your future endeavors.

Do please keep visiting our website (www.e-yantra.org) and Facebook page (https://www.facebook.com/eyantra ) for other similar opportunities.

Best wishes,
e-Yantra Team";
/*
$message =
"Dear Team Leader,

Congratulations !!!

We are happy to inform you that your team has been shortlisted for the e-Yantra Robotics Competition 2013.
 
The details of further process will be mailed to the team leader very soon.

Please keep visiting our portal website (portal.e-yantra.org) and Facebook page (https://www.facebook.com/eyantra ) for further activities and announcement.
 
Best Wishes,
e-Yantra Team";

*/
			$e = array();
			$e = explode(",",$email);
			echo $e;
		/*	foreach($line as $k)
			{
				$e[]=$k;
			}*/
		foreach($e as $toemail)
		{
		$m = new SimpleEmailServiceMessage();
		$m->addTo($toemail);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
		}	
	}// end of tp_all
	
  function sndinvite1(){
  	      if($this->session->userdata('quiz_logged_in')){  			
  			  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];			  
			  	   $file = fopen("contact.txt", "a+");				  
				   $frdContact = $_POST['frdcontact'] ; // contact array
				   $value = "\n\n".$data['username'];    //sender email id
				   $status=fwrite($file, $value);
				  		
				 // $status=fwrite($file, $data['username']);
				  for($i=0; $i < sizeof($frdContact);$i++){
				  	 $this->send_invite($frdContact[$i]);	
				  	//echo $frdContact[$i];
					  $value = "\n".$frdContact[$i];
					  $status=fwrite($file, $value);
					//echo $status;
					//$status = file_put_contents($file, $frdContact[$i].";", FILE_APPEND | LOCK_EX);  
				  }
				  fclose($file);
				  $this->session->set_flashdata('msg', 'success');
			   	  redirect('teamprofile/intfrd1','refresh');			   	  	
		  }else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
  		  }
		  
	
  }	

  function survey(){
  	if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];
  				
  			  $check_feedback = $this->erc_database->check_feedback_status($data['username']);
			    			  
			  	if($check_feedback == FALSE){
			  		$this->load->view('survey',$data);
			  	}else{
			  		$this->load->view('result',$data);
			  	}  			  		
			  }else{
	      		//If no session, redirect to login page
	      		redirect('home/quizlogin', 'refresh');
  			  }  	
  }
   function send_feedback($email){
			
		
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Online-Quiz-Feedback-Acknowledgement";
	
		$message =
"Dear User,

Thank you for your valuable feedback.

We appreciate your interest in e-Yantra Robotics Competition 2013 and wish you the very best in your future endeavors.


Best wishes,
e-Yantra Team";
		$m->addTo($email);	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_email
	
   function postsurvey(){
  	if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];
  				
  			  $check_feedback = $this->erc_database->check_postfeedback_status($data['username']);	  
			  	if($check_feedback == FALSE){
			  		$this->load->view('postsurvey',$data);
			  	}else{
			  		$this->load->view('result',$data);
			  	}  			  		
			  }else{
	      		//If no session, redirect to login page
	      		redirect('home/quizlogin', 'refresh');
  			  }  	
  }
  function feedback(){
  	if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];
			  	if($_POST){
			  		//print_r($_POST);
			  		$feedback = array(
						'teamId' => $data['loginId'],
						'email'  => $data['username'],
						'que1'	 => $_POST['que1'],
						'que2'	 => $_POST['que2'],
						'que3'	 => $_POST['que3'],
						'que4'	 => $_POST['que4'],
						'que5'	 => $_POST['que5'],
						'que6'	 => $_POST['que6'],
						'que7'	 => $_POST['que7'],
						'comment' => $_POST['comment']			
					);
					$this->erc_database->feedback($feedback);
					
					redirect('teamprofile/survey', 'refresh');
			  	}
	 }else{	      		//If no session, redirect to login page
	      		redirect('home/quizlogin', 'refresh');
  	}
 }
  
  function postfeedback(){
  	if($this->session->userdata('quiz_logged_in')){
	      	  $session_data = $this->session->userdata('quiz_logged_in'); 	  
		      $data['loginId'] = $session_data['teamid'];			  
	      	  $data['username'] = $session_data['username'];	  
			  $data['contact'] = $session_data['contact'];
			  
			  if($_POST['q1'])
				$q1=implode(',', $_POST['q1']);
			else 
				$q1 = "";
			  	if($_POST){
			  		//print_r($_POST);
			  		$feedback = array(
						'teamId' => $data['loginId'],
						'email'  => $data['username'],
						'que1'	 => $_POST['que1'],
						'que2'	 => $_POST['que2'],
						'que3'	 => $_POST['que3'],
						'que4'	 => $_POST['que4'],
						'que5'	 => $_POST['que5'],
						'que6'	 => $_POST['que6'],
						'concern'	 => $q1,
						'comment' => $_POST['comment']			
					);
					$this->erc_database->postfeedback($feedback);
					$this->erc_database->updateFeedbackPoints($data['loginId']); //code to update from 0 ->1
					//$this->load->view('survey');
					$this->send_feedback($data['username']);
					redirect('teamprofile/postsurvey', 'refresh');
			  	}
	 }else{	      		//If no session, redirect to login page
	      		redirect('home/quizlogin', 'refresh');
  	}
 }
  
 public function download() {
		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];			   
	  
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1){				  				  
				  $this->load->view('download', $data);
			   }else{
				  redirect('home/erc', 'refresh');
			   }
		}else{
		      //If no session, redirect to login page
		      redirect('home/erc', 'refresh');
		}
 }//end of download 
 
 public function upload(){
 		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];	
			  $data['theme'] = $session_data['theme'];		   
	  
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1) {				  				  
                  $uploadFlag = $this->erc_database->getUploadFlag($session_data['id']);
				  $videoLink = $this->erc_database->getTask3Link($session_data['id']);
				  
				  $data['uploadFlagStatus'] = $uploadFlag;	
				  $data['task3VideoLink'] = $videoLink;			 
				  
				  $this->load->view('file_uploader', $data);
			   }else{
				  redirect('home/erc', 'refresh');
			   }
		}else{
		      //If no session, redirect to login page
		      redirect('home/erc', 'refresh');
		}
	
 }//end of upload
 
 //send the acknowledgment of Task 3
  function send_link($loginId, $theme,$link, $email){
			
		$ses = new SimpleEmailService('AKIAISX3DLBHSFILNG5A', 'Ri5cVN9fIxszG5cXd8IqLI9taWLn6HueTCWgiS3h');
		$m = new SimpleEmailServiceMessage();
	    $subject = "e-YRC-13-Task-3-Demonstration-Acknowledgement-e-YRC#$loginId-$theme";
	
		$message =
"Dear Team Leader,

Thank you for uploading the link of the Task-3 Demonstration.

The link submitted by your team is : $link

The results of the Finalists coming to IIT Bombay will be declared on 13th March, 2014.

For any query mail us at helpdesk@e-yantra.org.


Best wishes,
e-Yantra Team";
		$m->addTo($email);
		//$m->addTo('shaileshjain1990@gmail.com');	
		$m->setFrom('admin@e-yantra.org');
		$m->addcc('eyantra.eyrc@gmail.com');		
		$m->setSubject($subject);
		$m->setMessageFromString($message);
		$ses->sendEmail($m);		
			
	}// end of send_link
	
	 public function task3submit(){
	 		if($this->session->userdata('logged_in')){
		      	  $session_data = $this->session->userdata('logged_in'); 	  
			      $data['loginId'] = $session_data['id'];	
				  $data['user'] = $session_data['user']; 
		      	  $data['username'] = $session_data['username'];	
				  $data['survey'] = $session_data['survey'];
				  $data['eyrc'] = $session_data['eyrc'];	
				  $data['theme'] = $session_data['theme'];		   
		  
				  if($session_data['user'] == 0 && $session_data['eyrc'] == 1) {                  	
	                  if($_POST){
	                  	$vdata = array(		
	                  		'task3link' => $_POST['vlink']
						);
						$this->erc_database->addVlink($session_data['id'],$vdata);
						$this->send_link($data['loginId'], $data['theme'], $_POST['vlink'],$data['username']);
						
						redirect('teamprofile/upload','refresh');	
	                  } 					  
				   }else{
					  redirect('home/erc', 'refresh');
				   }
			}else{
			      //If no session, redirect to login page
			      redirect('home/erc', 'refresh');
			}
		
	 }//end of upload
 
   function collegeContactDetail(){
	if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];	 
	  
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1){
			  	
			  $collegeDetail = $this->erc_database->getCollegeDetail($session_data['id']);					    
			  $data['collegeDetail'] = $collegeDetail;   
				  
			  $teamMember = $this->erc_database->getTeamMember($session_data['id']); 
			  $data['teamLeader'] = $teamMember;
				  
			  $grpimg = $this->erc_database->getGrpPic($session_data['id']);
			  $data['grpimg'] = $grpimg;	
			  
			  $collegeDetail = array(
						'teamId'=> $_POST["collegeteamId"],
						'teamEmail'=> $_POST["collegeemail"],
						'principalName'=> $_POST["pricipalname"],
						'collegeAddress'=> $_POST["collegeaddress"],						
						'collegeContact'=> $_POST["collegecontact"],
						'collegeEmail'=> $_POST["principalemail"],
						'state' => $_POST["collegestate"],
						'pincode' => $_POST["collegepincode"]
			  );
			  $this->erc_database->addShippingAddr($collegeDetail);			  			      
			   
			   //$this->load->view('teamprofile_view', $data);
			   redirect('/teamprofile');
			   }else{
					//echo 'Admin';			
					$this->load->view('admin_view', $data);
			   }
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}
  }//end of collegeContactDetail
  
  function theme(){
    if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];
			   
	  
			  if($session_data['user'] == 0){					
						$this->load->view('theme', $data);				 
			  }else{					
					redirect('/admin');
			  }
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}	
  }//end of theme function
  
  function tasklist(){
    if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];
			   
	  
			  if($session_data['user'] == 0){					
						$this->load->view('tasklist', $data);				 
			  }else{					
					redirect('/admin');
			  }
	}else{
	      //If no session, redirect to login page
	      redirect('home/erc', 'refresh');
	}	
  }//end of index function
	  
	  
public function download2() {
		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];			   
	  
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1){				  				  
				  $this->load->view('download2', $data);
			   }else{
				  redirect('home/erc', 'refresh');
			   }
		}else{
		      //If no session, redirect to login page
		      redirect('home/erc', 'refresh');
		}
 }//end of download 
 
public function taskStatus() {
		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];	
			  
			  $result = $this->erc_database->team_score( $data['loginId']);		  	
				   
	  			
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1){
			  	
			  	if($result)
				{
		   		$score = array();
		   		foreach($result as $row)
		   		{
		      		$score = array(
		          'theme' => $row->task1marks, 
		          'imple' => $row->task2marks,
		          'demo' => $row->task3marks, 
		          'docu' => $row->task4marks,
		          'Total' => $row->Total,
		          'comment' => $row->Comments,
		          'status' =>$row -> Status
		          		           
		        );		
			  	$data['score'] = $score;     			
				}
				}
				$check_feedback = $this->erc_database->check_FeedbackPoints($data['loginId']);	
				if($check_feedback >= 50)
				   $this->load->view('result_view', $data);
			  	if($check_feedback < 20){ 
				 $data['feedbackpoints'] = $check_feedback;
			  		$this->load->view('notice',$data);	
				}
				else				  
				  $this->load->view('result_view', $data);
				// $this->load->view('result_disp', $data);
			  
			}else{
				  redirect('home/erc', 'refresh');
			   }
		}
		else{
		      //If no session, redirect to login page
		      redirect('home/erc', 'refresh');
		}
 }//end of task Status
 
 public function robotDelivery() {
		if($this->session->userdata('logged_in')){
	      	  $session_data = $this->session->userdata('logged_in'); 	  
		      $data['loginId'] = $session_data['id'];	
			  $data['user'] = $session_data['user']; 
	      	  $data['username'] = $session_data['username'];	
			  $data['survey'] = $session_data['survey'];
			  $data['eyrc'] = $session_data['eyrc'];
			  $data['theme'] = $session_data['theme'];			   
	  
			  if($session_data['user'] == 0 && $session_data['eyrc'] == 1){
			  	 $robotFlag = $this->erc_database->getRobotFlag($session_data['id']);
				  $data['robotFlag'] = $robotFlag;					  				  
				  $this->load->view('robotDelivery', $data);
			   }else{
				  redirect('home/erc', 'refresh');
			   }
		}else{
		      //If no session, redirect to login page
		      redirect('home/erc', 'refresh');
		}
 }//end of download 
 
 
}//end of class TeamProfile