<?php

class Test_admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	/*public function index(){
		//$this->load->view("welcome_message");
		$this->load->model("test_details");
		$this->test_details->get_current_slot();
	}

	public function daily_slot_dist(){
		
		$this->load->model("test_details");
		$this->test_details->get_daily_slot_dist();

	}
*/
	public function update_team_scores(){
		$this->load->model("test_details");
		$this->test_details->team_score_fresh();
		redirect('test_admin/get_team_scores/update');
		//$this->load->view('team_scores',$data);

	}

	public function get_team_scores($from_update = NULL, $order = NULL){
		if($from_update != NULL && $from_update == 'update')
			$data['update'] = 1;
		else
			$data['update'] = 0;

		$this->load->model("test_details");
		
		if($from_update == 'avg' || $from_update == NULL){
			if($order == 2)
				$data['table'] = $this->test_details->get_team_scores_avg_desc();
			else
				$data['table'] = $this->test_details->get_team_scores_avg_asc();
		}
		else{
			if($from_update == 'team_id'){
				if($order == 2)
					$data['table'] = $this->test_details->get_team_scores_team_id_desc();
				else
					$data['table'] = $this->test_details->get_team_scores_team_id_asc();
			}
			else{
				if($from_update == 'college'){
					if($order == 2)
						$data['table'] = $this->test_details->get_team_scores_college_desc();
					else
						$data['table'] = $this->test_details->get_team_scores_college_asc();
				}
				else{
					if($from_update == 'pin'){
						if($order == 2)
							$data['table'] = $this->test_details->get_team_scores_pin_desc();
						else
							$data['table'] = $this->test_details->get_team_scores_pin_asc();
					}
					else{
						if($from_update == 'state'){
							if($order == 2)
								$data['table'] = $this->test_details->get_team_scores_state_desc();
							else
								$data['table'] = $this->test_details->get_team_scores_state_asc();
						}
						else{
							if($from_update == 'set'){
								if($order == 2)
									$data['table'] = $this->test_details->get_team_scores_set_desc();
								else
									$data['table'] = $this->test_details->get_team_scores_set_asc();
							}
							else{
								if($from_update == 'max'){
									if($order == 2)
										$data['table'] = $this->test_details->get_team_scores_max_desc();
									else
										$data['table'] = $this->test_details->get_team_scores_max_asc();
								}
								else{
									if($from_update == 'min'){
										if($order == 2)
											$data['table'] = $this->test_details->get_team_scores_min_desc();
										else
											$data['table'] = $this->test_details->get_team_scores_min_asc();		
									}
									else{
										$data['table'] = $this->test_details->get_team_scores_avg_desc();
									}
								}
							}
						}
					}
				}
			}
		}
		//$data['table'] = $this->test_details->get_team_scores_model();
		$this->load->view('team_scores',$data);
	}

	public function get_slot_nums(){
		$this->load->helper('form');
		$this->load->model("test_details");
		$data['data'] = $this->test_details->get_slot_nums();
		$this->load->view("slot_traffic",$data);
	}

}
