<?php

	Class erc_admindb extends CI_Model {
		
		public function __construct(){
			parent::__construct();
			$this->load->database('default',TRUE);
			
		}
		function getDateArray(){			
			$query = $this->db->query('SELECT distinct cast(timestamp as DATE) as regidate from `login`');			
			return $query->result_array();
		}
		
		function getRegiCount($date){
			$query = $this->db->query("SELECT count( id ) AS total FROM `login` WHERE timestamp LIKE '$date%'");
			return $query->result_array();
		}
		
		function getStateArray(){			
			$query = $this->db->query('SELECT distinct state from `teamdetail`');	
			return $query->result_array();
		}
		
		function getStateCount($state){
			$query = $this->db->query("SELECT count( id ) AS total FROM `teamdetail` WHERE state = '$state'");
			return $query->result_array();
		}
		
		function getGrpImage($offset){
			//$query = $this->db->query("SELECT * FROM `groupimage` ORDER BY id DESC LIMIT $offset,20");
			$query = $this->db->query("SELECT * FROM `groupimage` INNER JOIN login ON groupimage.teamId = login.id WHERE login.eyrc = 1 ORDER BY groupimage.teamId DESC LIMIT $offset , 160");
			return $query->result_array();
		}
		
		function getImageCount(){
			$query = $this->db->query("SELECT * FROM `groupimage`");
			return $query->num_rows();
		}
		
		function getSlotDateArray(){			
			$query = $this->db->query('SELECT distinct cast(date as DATE) as testdate from `bookings` ORDER BY testdate ASC');			
			return $query->result_array();
		}
		
		function getSlotTeamCount($date){
			$query = $this->db->query("SELECT count( id ) AS total FROM `bookings` WHERE date LIKE '$date%'");
			return $query->result_array();
		} 
		function getTestAttempt(){
			$query = $this->db->query("SELECT count( id ) AS total FROM `teammemberdetail` WHERE testattempt = '1'");
			return $query->result_array();
		}
		function getTeamTestStatus(){			
			$query = $this->db->query("SELECT COUNT( testattempt ) AS total FROM  `teammemberdetail` WHERE testattempt =1 GROUP BY teamId ORDER BY total DESC ");
			return $query->result_array();		
		}
		function getFlexStatus(){
			$query = $this->db->query("SELECT COUNT( id ) AS total FROM  `uploadFlagStatus` GROUP BY task0Flag");
			return $query->result_array();
		}
		function getRobotStatus(){
			$query = $this->db->query("SELECT COUNT( id ) AS total FROM  `uploadFlagStatus` GROUP BY robotDelivery");
			return $query->result_array();
		}
		function getVideoStatus(){
			$query = $this->db->query("SELECT COUNT( id ) AS total FROM  `uploadFlagStatus` where task3link =''");
			return $query->result_array();
		}
		function getDocuStatus(){
			$query = $this->db->query("SELECT COUNT( id ) AS total FROM `uploadFlagStatus` GROUP BY task4Flag");
			return $query->result_array();
		}
		function getAllEmailTl(){			
			$this -> db -> select('username');
			$this -> db -> from('eyrclogin');
			$this -> db -> where('eyrc',1);
						 
			$query = $this -> db -> get();
			
			if($query -> num_rows() >= 1){
				return $query->result();
			} else {
				return false;
			}
		}//end of getAllEmailTl
		
		function getTeamList($theme){			
			//$this -> db -> select('task0Flag');
			$this -> db -> from('node');
			$this -> db -> where('hubid',$theme);						
			//$this -> db -> where('eyrc',1);		 
			$query = $this -> db -> get();
			
			if($query -> num_rows() >= 1){
				return $query->result();
			} else {
				return false;
			}
		}//end of getTeamList
		
		function getHubinfo($theme){
			//$query = $this->db->query("SELECT distinct(*) FROM hub");
			$query = $this -> db -> from ('hub');							 
			$query = $this -> db -> get();
			
			if($query -> num_rows() >= 1){
				return $query->result();
			} else {
				return false;
			}
		}//end of getTeamList
		
		function getHubcount(){
		
		}
		function approveFlag($teamId){
			$data = array(
			'task0Flag' => 2
			);	
	 		$this->db->where('teamId', $teamId);
			$this->db->update('uploadFlagStatus', $data);
		}
		
		function getUserName($teamId){
			$return = $this->db->select('username')->from('eyrclogin')->where('teamId',$teamId)->get();
			$user = $return->first_row()->username;	
			//echo $user;
			return $user;
		}
		
		function getTeamDetails($teamId){
			
			$this -> db -> from('teammemberdetail');
			$this -> db -> where('teamId',$teamId);	
			
			$result = $this -> db -> get();

			$return_data = array();
	
			if($result->num_rows > 0){
				foreach($result->result() as $row){
					array_push($return_data, $row);
				}
				return $return_data;
			}
			else
				return NULL;
		}
		
		function getTeamId($email){
			$return = $this->db->select('teamId')->from('teammemberdetail')->where('email',$email)->get();
			
			if($return->num_rows == 1){
				$teamId = $return->first_row()->teamId;			
				return $teamId;
			}else{
				return NULL;
			}	
		}
		
		function getTeamOtherDetails($teamId){
			$result = $this->db->query("SELECT * FROM `teamdetail` INNER JOIN eyrclogin ON teamdetail.loginId = eyrclogin.teamId WHERE teamdetail.loginId = ".$teamId);	
			
			$return_data = array();
	
			if($result->num_rows == 1){
				foreach($result->result() as $row){
					array_push($return_data, $row);
				}
				return $return_data;
			}
			else
				return NULL;			 
		}
		
	}//end of erc_admindb
	
?>		
	