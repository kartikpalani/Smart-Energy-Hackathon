<?php

Class erc_database extends CI_Model {
	
	public function __construct(){
			parent::__construct();
			$this->load->database('default',TRUE);
	}
		
	//function to getCollegelist -> statewise
	function getCollegeList($state){
			
		$this -> db -> select('id , collegeName , pincode');
		$this -> db -> from('collegelist1');
		$this -> db -> where('state',$state);	
		$this -> db -> order_by('collegeName', 'asc');
		
		//$query = $this->db->get_where('collegeList', array('state' => $state));	 
		$query = $this -> db -> get();
		
		if($query -> num_rows() >= 1){
			return $query->result();
		} else {
			return false;
		}
	}//end of getCollege
	
	//insert login details
	function setLogin($data){
		
		$this->db->insert('login', $data); 
		return $this->db->insert_id();
	}//end of setLogin
	
	//check if already exist username
	function username_available($username){		
		$this -> db -> select('id');
		$this -> db -> from('teammemberdetail');
		$this -> db -> where('email',$username);		
			
		$query = $this -> db -> get();
		
		if($query -> num_rows() >= 1){
			return FALSE;
		} else {
			return TRUE;
		}
	}//end of username available
	
	//insert college detail for team
	function setTeamDetail($data){		 
		 $this->db->insert('teamdetail', $data);
		 //return $this->db->insert_id();
	}//end of setTeamDetails
	
	//insert TeamMemberDetails => TeamProfile
	function setTeamProfile($data){
		 //$data = array('name' => $id );
		 $this->db->insert('teammemberdetail', $data);
		 return $this->db->insert_id();
	}
	
	//Check login
	function login($username, $password){
		//$this -> db -> select('id','username','user');
		$this -> db -> from('eyrclogin');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . $password . "'");
		$this -> db -> where('active = 1'); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}//end of login
	
	//getCollegeDetail from table using loginId
	function getCollegeDetail($loginId){
		$query = $this->db->get_where('teamdetail', array('loginId' => $loginId));
		
		if($query->result()){			
			return $query->row_array();
		}
	}//end of getCollegeDetail
	
	//getTeamMember to get Team member details
	function getTeamMember($loginId){
		$rows = array();	
		$query = $this->db->get_where('teammemberdetail', array('teamId' => $loginId));
		
		foreach($query->result_array() as $row){    
        	$rows[] = $row; //add the fetched result to the result array;
    	}
   		return $rows; // returning rows, not row
	}//end of getTeamMember
	
	function getTeamMemberProfile($memberId){
  		$query = $this->db->get_where('teammemberdetail', array('id' => $memberId));
		
		if($query->result()){			
			return $query->row_array();
		}
  	}//get TeamMemberProfile
  	
  	function updateMemberProfile($memberId,$profile){  		
		$this->db->where('id', $memberId);
		$this->db->update('teammemberdetail', $profile); 
  	}//end of updateMemberProfile
  	
  	function uplodeGrpPic($data){
  		$this->db->insert('groupimage', $data);
  	}
	
	function getGrpPic($loginId){
		$query = $this->db->get_where('groupimage', array('teamId' => $loginId));
				
		if($query->result()){			
			return $query->row_array();
		}
	}
	
	function checkEmail($id,$hash){
		$this -> db -> from('login');
		$this -> db -> where('id = ' . "'" . $id . "'"); 
		$this -> db -> where('hash = ' . "'" . $hash . "'");
		
		return $query = $this -> db -> get();
	}
	
	function activateUser($id){
		$data = array ('active' => 1);
		$this->db->where('id', $id);
		$this->db->update('login', $data); 
	}
	
	function checkEmailMember($id,$hash){
		$this -> db -> from('teammemberdetail');
		$this -> db -> where('id = ' . "'" . $id . "'"); 
		$this -> db -> where('hash = ' . "'" . $hash . "'");
		
		return $query = $this -> db -> get();
	}
	
	function activateMember($id){
		$data = array ('active' => 1);
		$this->db->where('id', $id);
		$this->db->update('teammemberdetail', $data); 
	}
	
	function getSlot($date){
			
		$this -> db -> select('id , start');
		$this -> db -> from('bookings');
		$this -> db -> like('date',$date);	
		
		//$query = $this->db->get_where('collegeList', array('state' => $state));	
		$query = $this -> db -> get();
		
		$temp = array();
		foreach($query->result_array() as $a) {
		   $temp[] = $a['start'];
		}
		return $temp;
				
	}//end of getCollege
	
	function addSlot($data){
		 //$data = array('name' => $id );
		 $this->db->insert('bookings', $data);
	}
	
	function checkBookedSlot($teamId){		
		$this -> db -> from('bookings');
		$this -> db -> where('teamId',$teamId); 
		$this -> db -> limit(1);	
			
		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}	
	}
	
	//Check quizlogin
	function quizlogin($username, $password){
		$this -> db -> from('teammemberdetail');		 	
		$this -> db -> where('email = ' . "'" . $username . "'"); 
		$this -> db -> where('contact = ' . "'" . $password . "'");
		$this -> db -> where('active = 1');
		$this -> db -> limit(1);		

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}//end of quizlogin
				
	
	function getquiztime($teamId){
		
		$this -> db -> from('bookings');
		$this -> db -> where('teamId' , $teamId);
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		
		if($query -> num_rows() == 1)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}//end of getquiztime
	
	function addCollege($data){		
		$this->db->insert('collegelist1', $data);		
	}//end of addCollege
	
	function updateflag($teamId){		
		$this->db->where('id', $teamId);
		$this->db->update('login', array('survey' => 1)); 		
	}//end of setLogin	
	
	function addSurvey($data){		
		$this->db->insert('postersurvey', $data);		
	}//end of setLogin
	
	function checkProfileComplete($teamId){
						
		$this -> db -> from('teammemberdetail');
		$this -> db -> where('teamId',$teamId);	
		$this -> db -> where('contact ','');
		
		//$query = $this->db->get_where('collegeList', array('state' => $state));	 
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}//end of getCollege
	
	function getTeamMemberDetails($teamId) {
			
		//this query for obtaining the login credintial for quiz	
		$this -> db -> select('email,contact');
		$this -> db -> from('teammemberdetail');
		$this -> db -> where('teamId', $teamId);
		
		$query = $this -> db -> get();
		
		return $query->result();
		
	}
	// This function is to retrieve the data of slot booking 
	function getSlotBookedData($teamId) {
		
		$this -> db -> from('bookings');
		$this -> db -> where('teamId', $teamId);
		
		$query = $this -> db -> get();
		
		return $query->result();
	}
	
	function updatetestattempt($id){
		$this->db->where('id', $id);
		$this->db->update('teammemberdetail', array('testattempt' => 1)); 	
	}
	function updateposttestattempt($id){
		$this->db->where('id', $id);
		$this->db->update('teammemberdetail', array('postonlinetest' => 1)); 	
	}
	function feedback($data){
		$this->db->insert('feedback', $data);
	}	
	function postfeedback($data){
		$this->db->insert('postfeedback', $data);
	}
	function check_test_attempt($userId){
		$this -> db -> select('testattempt');
		$this -> db -> from('teammemberdetail');
		$this -> db -> where('id',$userId);
		
		$query = $this -> db -> get();
		return $query->result(); 
	}
	function check_posttest_attempt($userId){
		$return = $this->db->select('postonlinetest')->from('teammemberdetail')->where('id',$userId)->get();
		if($return->num_rows() == 1){
			$testFlag = $return->first_row()->postonlinetest;			
			return $testFlag;
		}	
	}
	
	function check_feedback_status($email){		
		$this -> db -> from('postfeedback');
		$this -> db -> where('email',$email);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	function check_postfeedback_status($email){		
		$this -> db -> from('postfeedback');
		$this -> db -> where('email',$email);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
	
	public function updateFeedbackPoints($teamId){
		$return = $this->db->select('feedbackPoints')->from('eyrclogin')->where('teamId',$teamId)->get();
		if($return->num_rows() == 1){
			$points = $return->first_row()->feedbackPoints;			
		}
		$points = $points + 5; 
 		$data = array(
			'feedbackPoints' => $points
		);	
 		$this->db->where('teamId', $teamId);
		$this->db->update('eyrclogin', $data);
 	}//end of updateFeedbackFlag
 	function check_FeedbackPoints($userId){
		$return = $this->db->select('feedbackPoints')->from('eyrclogin')->where('teamId',$userId)->get();
		if($return->num_rows() == 1){
			$testFlag = $return->first_row()->feedbackPoints;			
			return $testFlag;
		}	
	}
 	
	function check_shipping_address($teamId){		
		$this -> db -> from('shipping_address');
		$this -> db -> where('teamId',$teamId);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0){
			return "YES";
		} else {
			return "NO";
		}
	}
	
	function addShippingAddr($data){
		$this->db->insert('shipping_address', $data);
	}	
	
	public function changeUploadFlag($teamId){
 		$data = array(
			'task4Flag' => 1
		);	
 		$this->db->where('teamId', $teamId);
		$this->db->update('uploadFlagStatus', $data);
 	}
	
	//function to get upload flag status
  	public function getUploadFlag($teamId){
		$return = $this->db->select('task4Flag')->from('uploadFlagStatus')->where('teamId',$teamId)->get();
		if($return->num_rows() == 1){
			$uploadFlag = $return->first_row()->task4Flag;			
			return $uploadFlag;
		}
	}//end of get_username	
	
	//function to get task 3 video link
  	public function getTask3Link($teamId){
		$return = $this->db->select('task3link')->from('uploadFlagStatus')->where('teamId',$teamId)->get();
		if($return->num_rows() == 1){
			$videoLink = $return->first_row()->task3link;			
			return $videoLink;
		}
	}//end of getTask3Link
		
	// function to set the Robot delivery flag	
	public function changeRobotDeliveryFlag($teamId){
 		$data = array(
			'robotDelivery' => 1
		);	
 		$this->db->where('teamId', $teamId);
		$this->db->update('uploadFlagStatus', $data);
 	}//end of changeRobotDeliveryFlag
 	
 	public function updateRobotDeliveryFlag($teamId){
 		$data = array(
			'robotDelivery' => 2
		);	
 		$this->db->where('teamId', $teamId);
		$this->db->update('uploadFlagStatus', $data);
 	}//end of changeRobotDeliveryFlag
 	
 	//function to get upload flag status
  	public function getRobotFlag($teamId){
		$return = $this->db->select('robotDelivery')->from('uploadFlagStatus')->where('teamId',$teamId)->get();
		if($return->num_rows() == 1){
			$robotFlag = $return->first_row()->robotDelivery;			
			return $robotFlag;
		}
	}//end of get_username	
		
	function team_score($id){
		$query = $this->db->get_where('result', array('teamId' => $id));	
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	
	//insert applicants
	function addApplicant($data){		
		$this->db->insert('job', $data);		
	}//end of addApplicant
	
	function addVlink($teamId,$data){		 
		 $this->db->where('teamId', $teamId);
		 $this->db->update('uploadFlagStatus', $data);
	}
}//end of class		
?>	