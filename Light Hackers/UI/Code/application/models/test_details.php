<?php

class Test_details extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database("default", TRUE);
	}

	public function get_current_slot(){

		$this->load->database('default',TRUE);
		$result = $this->db->query('SELECT EXTRACT(Hour from CURTIME()) as time_hh;');
		$result = $result->first_row();

		$hour = $result->time_hh . ':00:00';

		$bookings = $this->db->query('SELECT * FROM `bookings` WHERE `bookings`.`date` = CURDATE() AND `bookings`.`start` = CAST(\''.$hour.'\' as Time) ORDER BY `bookings`.`teamId` ASC');
		$row_table = NULL;
		$row_table .= '<h2>Total Students: '.($bookings->num_rows()*4).'</h2><br/>';
		$row_table .= '<table class="table"><tr><th>Team_ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Test Attempt</th><th>Test Set</th></tr>';

		foreach($bookings->result() as $row){
			$this->load->database('default',TRUE);
			$team_id = $row->teamId;
			$team_members = $this->db->select()->from('teammemberdetail')->where('teamId',$team_id)->get();

			foreach($team_members->result() as $tm_row){
				$moodle_db = $this->load->database('moodle', TRUE);

				$user_id = $this->db->select('id')->from('mdl_user')->where('username',$tm_row->email)->get();
				$user_id = $user_id->first_row()->id;

				$set = $this->db->select('groupid')->from('mdl_groups_members')->where('userid',$user_id)->get();
				$set = $set->first_row()->groupid;
				$test_set = null;
				
				switch($set){
					case 1:
						$test_set = 'Set-A1';
						break;
					case 2:
						$test_set = 'Set-A2';
						break;
					case 3:
						$test_set = 'Set-A3';
						break;
					case 4:
						$test_set = 'Set-A4';
						break;
					case 6:
						$test_set = 'Set-B1';
						break;
					case 7:
						$test_set = 'Set-B2';
						break;
					case 8:
						$test_set = 'Set-B3';
						break;
					case 9:
						$test_set = 'Set-B4';
						break;
					case 10:
						$test_set = 'Set-C1';
						break;
					case 11:
						$test_set = 'Set-C2';
						break;
					case 12:
						$test_set = 'Set-C3';
						break;
					case 13:
						$test_set = 'Set-C4';
						break;

					case 14:
						$test_set = 'Set-D1';
						break;

					case 15:
						$test_set = 'Set-D2';
						break;

					case 16:
						$test_set = 'Set-D3';
						break;

					case 17:
						$test_set = 'Set-D4';
						break;

				}
				
				//$row_table .= '<tr><td>'.$tm_row->teamId.'</td><td>'.$tm_row->name.'</td><td>'.$tm_row->email.'</td><td>'.$tm_row->contact.'</td><td>';
				
				if($tm_row->testattempt == 1){
					$row_table .= '<tr><td>'.$tm_row->teamId.'</td><td>'.$tm_row->name.'</td><td>'.$tm_row->email.'</td><td>'.$tm_row->contact.'</td><td>Yes';
				}
				else{
					$row_table .= '<tr class="error"><td>'.$tm_row->teamId.'</td><td>'.$tm_row->name.'</td><td>'.$tm_row->email.'</td><td>'.$tm_row->contact.'</td><td>No';
				}

				$row_table .= '</td><td>'.$test_set.'</td></tr>';
				
			}

		}
		$row_table .= '</table>';
		$this->load->database('default',TRUE);
		return $row_table;
	}

	public function get_team_scores_avg_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('avg DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_avg_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('avg ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_team_id_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('team_id DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_team_id_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('team_id ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_college_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('college DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_college_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('college ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_pin_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('pincode DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_pin_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('pincode ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_state_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('state DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_state_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('state ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_set_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('set DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_set_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('set ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_max_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('max DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_max_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('max ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_min_desc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('min DESC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function get_team_scores_min_asc(){
		$this->load->database("default",TRUE);

		$team_scores = $this->db->select()->from('average_grades')->order_by('min ASC')->get();

		if($team_scores->num_rows > 0)
			return $team_scores->result();
		else
			return NULL;
	}

	public function team_score_fresh(){
		$final_data = array();

		$this->load->database("default",TRUE);
		
		$this->db->empty_table('average_grades');
		$team_ids = $this->db->query('SELECT teamId, COUNT( testattempt ) AS total FROM  `teammemberdetail` WHERE testattempt =1 GROUP BY teamId ORDER BY teamId ASC');

		//print_r($team_ids->num_rows());
		foreach($team_ids->result() as $team){
			$this->load->database("default",TRUE);
		
			$team_members = $this->db->select('email,testattempt')->from('teammemberdetail')->where('teamId',$team->teamId)->get();
			
			// print_r($team_members->result());
			// echo '<br/><br/>';			
			
			$avg = 0;
			$max = 0;
			$min = 10000;
			$counter = 0;
			$row_data = array();

			foreach($team_members->result() as $member){
				$this->load->database("moodle",TRUE);

				$user_id = $this->db->select('id')->from('mdl_user')->where('username',$member->email)->get();

				// print_r($user_id->result());
				// echo '<br/><br/>';
				
				if($user_id->num_rows() > 0){
					$user_id = $user_id->first_row()->id;
					if($counter == 0){
						
						$group_res = $this->db->select('groupid')->from('mdl_groups_members')->where('userid',$user_id)->get();
						
						if($group_res->num_rows > 0){
							$group_id = $group_res->first_row()->groupid;

							$group_name = NULL;
							switch($group_id){
								case 1:
								case 2:
								case 3:
								case 4:
									$group_name = 'A';
									break;

								case 6:
								case 7:
								case 8:
								case 9:
									$group_name = 'B';
									break;

								case 10:
								case 11:
								case 12:
								case 13:
									$group_name = 'C';
									break;

								case 14:
								case 15:
								case 16:
								case 17:
									$group_name = 'D';
									break;
							}

							if($group_name != NULL)
								$row_data['set'] = $group_name;
							//echo $group_name.'<br/><br/>';
						}

						$this->load->database("default",TRUE);
						$clg_state = $this->db->select('collegeName,state,pincode')->from('teamdetail')->where('loginId',$team->teamId)->get();
						
						if($clg_state->num_rows() > 0){
							$temp = $clg_state->first_row();
							$row_data['college'] = $temp->collegeName;
							$row_data['state'] = $temp->state;
							$row_data['pincode'] = $temp->pincode;
							//echo $row_data['college'].'<br/><br/>';
						}
						else{
							$row_data['college'] = NULL;
							$row_data['state'] = NULL;
							$row_data['pincode'] = NULL;
						}
					}
					$this->load->database('moodle',TRUE);

					$grade_res = $this->db->query('SELECT `grade` FROM `mdl_quiz_grades` WHERE userid = '.$user_id);
					
					// print_r($grade_res->result());
					// echo '<br/><br/>';
					
					if($counter == 0){
						$row_data['email1'] = $member->email;
						
						if($grade_res->num_rows() > 0){
							$row_data['grade1'] = intval($grade_res->first_row()->grade);
						//print_r($row_data);
							if($max < intval($row_data['grade1']))
								$max = intval($row_data['grade1']);
							if($min > intval($row_data['grade1']))
								$min = intval($row_data['grade1']);

							$avg = intval($row_data['grade1']);
						}
						else{
							if($member->testattempt == 1)
								$row_data['grade1'] = 'NG';
							else
								$row_data['grade1'] = 'NTA';
							
							$avg = 0;
						}
						// print_r($row_data);
						// echo '<br/><br/>';
					}
					
					if($counter == 1){
						$row_data['email2'] = $member->email;
						
						if($grade_res->num_rows() > 0){
							$row_data['grade2'] = intval($grade_res->first_row()->grade);

							if($max < intval($row_data['grade2']))
								$max = intval($row_data['grade2']);
							if($min > intval($row_data['grade2']))
								$min = intval($row_data['grade2']);

							$avg += intval($row_data['grade2']);
						}
						else{
							if($member->testattempt == 1)
								$row_data['grade2'] = 'NG';
							else
								$row_data['grade2'] = 'NTA';
						}

						// print_r($row_data);
						// echo '<br/><br/>';
					}
					
					if($counter == 2){
						$row_data['email3'] = $member->email;
						
						if($grade_res->num_rows() > 0){
							$row_data['grade3'] = intval($grade_res->first_row()->grade);

							if($max < intval($row_data['grade3']))
								$max = intval($row_data['grade3']);
							if($min > intval($row_data['grade3']))
								$min = intval($row_data['grade3']);

							$avg += intval($row_data['grade3']);
						}
						else{
							if($member->testattempt == 1)
								$row_data['grade3'] = 'NG';
							else
								$row_data['grade3'] = 'NTA';
						}

						// print_r($row_data);
						// echo '<br/><br/>';
					}
					
					if($counter == 3){
						$row_data['email4'] = $member->email;
						
						if($grade_res->num_rows() > 0){
							$row_data['grade4'] = intval($grade_res->first_row()->grade);

							if($max < intval($row_data['grade4']))
								$max = intval($row_data['grade4']);
							if($min > intval($row_data['grade4']))
								$min = intval($row_data['grade4']);

							$avg += intval($row_data['grade4']);
						}
						else{
							if($member->testattempt == 1)
								$row_data['grade4'] = 'NG';
							else
								$row_data['grade4'] = 'NTA';
						}

						$avg /= 4;
						$row_data['avg'] = $avg;
						$row_data['max'] = $max;
						$row_data['min'] = $min;
						$row_data['team_id'] = $team->teamId;
						
						if(!($row_data['grade1'] == 'NTA' && $row_data['grade2'] == 'NTA' && $row_data['grade3'] == 'NTA' && $row_data['grade4'] == 'NTA')){
							if($row_data['min'] == 10000)
								$row_data['min'] = 0;
							
							array_push($final_data,$row_data);

							$this->load->database("default",TRUE);
							$this->db->insert('average_grades',$row_data);
							//echo $row_data.'<br/><br/>';
						}
						
						// print_r($row_data);
						// echo '<br/><br/>';
					}
					$counter++;
				}
			}
		}
	}

	public function get_slot_nums(){
		$date = $this->input->post('date');
		$time = 0;
		$data = NULL;
		$count = 0 ;
		for($i = 0; $i<3;$i++ ){
			$start = '0'.$i.':00:00';
			if($date != NULL)
				$where = array('date'	=> $date,
					'start' => $start);
			else
				$where = '`date` = CURDATE() and `start` = \''.$start.'\'';
			$res = $this->db->select('COUNT(*) as amt')->from('bookings')->where($where)->get();
			//echo $this->db->last_query();
			if($res->num_rows() == 1){
				$res = $res->first_row();
				$data[$count] = '<b>Slot: '.$start.'</b>&nbsp;&nbsp;&nbsp;<label>'.$res->amt.'</label><br/>';
				$count++;
			}
	
		}
		for($i = 5; $i<10;$i++ ){
			$start = '0'.$i.':00:00';
			if($date != NULL)
				$where = array('date'	=> $date,
					'start' => $start);
			else
				$where = '`date` = CURDATE() and `start` = \''.$start.'\'';
			
			$res = $this->db->select('COUNT(*) as amt')->from('bookings')->where($where)->get();
			//echo $this->db->last_query();
			if($res->num_rows() == 1){
				$res = $res->first_row();
				$data[$count] = '<b>Slot: '.$start.'</b>&nbsp;&nbsp;&nbsp;<label>'.$res->amt.'</label><br/>';
				$count++;
			}
	
		}
		for($i = 10; $i<24;$i++ ){
			$start = $i.':00:00';
			if($date != NULL)
				$where = array('date'	=> $date,
					'start' => $start);
			else
				$where = '`date` = CURDATE() and `start` = \''.$start.'\'';
			$res = $this->db->select('COUNT(*) as amt')->from('bookings')->where($where)->get();
			//echo $this->db->last_query();
			if($res->num_rows() == 1){
				$res = $res->first_row();
				$data[$count] = '<b>Slot: '.$start.'</b>&nbsp;&nbsp;&nbsp;<label>'.$res->amt.'</label><br/>';
				$count++;
			}
	
		}
		return $data;
	}
}